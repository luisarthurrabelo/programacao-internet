<?php

require "connectionMysql.php";
require "anunciante.php";
require "interesse.php";
require "anuncio.php";
require "loginResult.php";
require "foto.php";
require "carregaImagem.php";

// resgata a ação a ser executada
$action = $_GET['action'];

// conecta ao servidor do MySQL
$pdo = mysqlConnect();

switch ($action) {
//----------------------------------------------------------------------------------------------------------------------------------------------------------------------------
  case "register_advertiser":
    try {
      $cookieParams = session_get_cookie_params();
      $cookieParams['httponly'] = true;
      session_set_cookie_params($cookieParams);

      session_start();
      
      $nome = $_POST["nome"] ?? "";
      $cpf = $_POST["cpf"] ?? "";
      $email = $_POST["email"] ?? "";
      $senha = $_POST["senha"] ?? "";
      $telefone = $_POST["telefone"] ?? "";

      header('Content-Type: application/json; charset=utf-8');

      if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo json_encode(["success" => false, "message" => "EMAIL inválido."]);
        exit();
      }
      // Deixa apenas os números do CPF e do Telefone para testar se são válidos
      $cpf = preg_replace('/[^0-9]/', '', $cpf);
      if (strlen($cpf) != 11) {
        echo json_encode(["success" => false, "message" => "CPF precisa de 11 digitos."]);
        exit();
      }
      $telefone = preg_replace('/[^0-9]/', '', $telefone);
      if (strlen($telefone) != 9 || strlen($telefoneNuns) != 8) {
        echo json_encode(["success" => false, "message" => "Número precisa de 8 ou 9 digitos."]);
        exit();
      }

      // gera o hash da senha
      $senhaHash = password_hash($senha, PASSWORD_DEFAULT);
      $_SESSION['user_id'] = Anunciante::Create($pdo, $nome, $cpf, $email, $senhaHash, $telefone);
      $_SESSION['loggedIn'] = true;
      $_SESSION['user'] = $email;
      header("location: ../index_intern.php");
      echo json_encode(["success" => true, "message" => "Registro com Sucesso"]);
    } catch (Exception $e) {
      throw new Exception($e->getMessage());
    }
    break;
//----------------------------------------------------------------------------------------------------------------------------------------------------------------------------
  case "login_advertiser":
    try {
      $email = $_POST['email'] ?? '';
      $senha = $_POST['senha'] ?? '';

      // Verifique as credenciais e receba o ID do usuário
      $user_id = Anunciante::checkUserCredentials($pdo, $email, $senha);

      if ($user_id) {
          $cookieParams = session_get_cookie_params();
          $cookieParams['httponly'] = true;
          session_set_cookie_params($cookieParams);

          session_start();
          $_SESSION['loggedIn'] = true;
          $_SESSION['user_id'] = $user_id;
          $_SESSION['user'] = $email;
          $response = new LoginResult(true, '../index_intern.php');
      } else {
          $response = new LoginResult(false, '');
      }

      header('Content-Type: application/json; charset=utf-8');
      echo json_encode($response);
    } catch (Exception $e) {
      throw new Exception($e->getMessage());
    }
    break;
//----------------------------------------------------------------------------------------------------------------------------------------------------------------------------    
  case "create_ad":
    try {
      $pdo->beginTransaction();
      session_start();
      if (!isset($_SESSION['loggedIn']) || !isset($_SESSION['user_id'])) {
        header("Location: ../index.php");
        exit ();
      }
      $estadosValidos = [
        "AC", "AL", "AP", "AM", "BA", "CE", "DF", "ES", "GO", 
        "MA", "MT", "MS", "MG", "PA", "PB", "PR", "PE", "PI", 
        "RJ", "RN", "RS", "RO", "RR", "SC", "SP", "SE", "TO"
      ];
      
      $marca = $_POST["marca"] ?? "";
      $modelo = $_POST["modelo"] ?? "";
      $ano = $_POST["ano"] ?? 0;
      $cor = $_POST["cor"] ?? "";
      $quilometragem = $_POST["quilometragem"] ?? 0;
      $descricao = $_POST["descricao"] ?? "";
      $valor = $_POST["valor"] ?? 0;
      $estado = $_POST["estado"] ?? "";
      $cidade = $_POST["cidade"] ?? "";
      $idAnunciante = $_SESSION['user_id'];

      header('Content-Type: application/json; charset=utf-8');

      if (!is_numeric($ano)) {
        $pdo->rollBack();
        echo json_encode(["success" => false, "message" => "Ano precisa ser um número"]);
        exit();
      }
      if (!is_numeric($quilometragem)) {
        $pdo->rollBack();
        echo json_encode(["success" => false, "message" => "Quilometragem precisa ser um número"]);
        exit();
      }
      if (!is_numeric($valor)) {
        $pdo->rollBack();
        echo json_encode(["success" => false, "message" => "Valor precisa ser um número"]);
        exit();
      }
      if (!in_array($estado, $estadosValidos)) {
        $pdo->rollBack();
        echo json_encode(["success" => false, "message" => "Estado inválido"]);
        exit();
      }

      // Cria o anúncio no banco de dados e obtém o ID do novo anúncio
      $idAnuncio = Anuncio::Create($pdo, $marca, $modelo, $ano, $cor, $quilometragem, $descricao, $valor, $estado, $cidade, $idAnunciante);
      salvaFotos($pdo, $idAnunciante, $idAnuncio);
      // Redireciona para a página interna após o registro
      echo json_encode(["success" => true, "message" => "Criar anúncio foi realizado com Sucesso"]);
      $pdo->commit();
    } catch (Exception $e) {
      $pdo->rollBack();
    }
    break;
//----------------------------------------------------------------------------------------------------------------------------------------------------------------------------
case "list_ad":
  try {
    session_start();
    if (!isset($_SESSION['loggedIn']) || !isset($_SESSION['user_id'])) {
      header("Location: ../index.php");
      exit ();
    }

    $arrayAnuncios = Anuncio::GetAll($pdo, $_SESSION['user_id']);
    header('Content-Type: application/json; charset=utf-8');
    echo json_encode($arrayAnuncios);
  } catch (Exception $e) {
    throw new Exception($e->getMessage());
  }
  break;
//----------------------------------------------------------------------------------------------------------------------------------------------------------------------------
case "get_firstAd":
  try {
    session_start();
    if (!isset($_SESSION['loggedIn']) || !isset($_SESSION['user_id'])) {
      header("Location: ../index.php");
      exit ();
    }

    $idAnuncio = $_GET['idAnuncio'] ?? 0;

    $anuncio = Anuncio::GetAdById($pdo, $idAnuncio);
    header('Content-Type: application/json; charset=utf-8');
    echo json_encode($anuncio);
  } 
  catch (Exception $e) {
    throw new Exception($e->getMessage());
  }
  break;
//----------------------------------------------------------------------------------------------------------------------------------------------------------------------------
case "delete_ad":
  try{
    session_start();
    $idAnuncio = $_GET['idAnuncio'] ?? 0;

    $userId = $_SESSION['user_id'];

    $anuncio = Anuncio::GetAdvertiserByAd($pdo, $idAnuncio);
    
    if (!$anuncio || $anuncio->idAnunciante != $userId) {
      header('Content-Type: application/json; charset=utf-8');
      echo json_encode(["success" => false, "message" => "Você não tem permissão para deletar este anúncio."]);
      exit;
    }

    $resultado = Anuncio::Delete($pdo, $idAnuncio);  
    header('Content-Type: application/json; charset=utf-8');
    echo json_encode(["success" => true, "message" => "Anuncio deletado com sucesso!"]);
  } 
  catch(Exception $e){
    throw new Exception($e->getMessage());
  }

  break;
//----------------------------------------------------------------------------------------------------------------------------------------------------------------------------
case "get_firstImage":
  try {
    $idAnuncio = $_GET['idAnuncio'] ?? 0;

    $foto = Foto::GetFirst($pdo, $idAnuncio);
    header('Content-Type: application/json; charset=utf-8');
    echo json_encode($foto);
  } catch (Exception $e) {
    throw new Exception($e->getMessage());
  }
  break;
//----------------------------------------------------------------------------------------------------------------------------------------------------------------------------
case "get_images":
  try {
    $idAnuncio = $_GET['idAnuncio'] ?? 0;

    $arrayImages = Foto::GetFotosById($pdo, $idAnuncio);
    header('Content-Type: application/json; charset=utf-8');
    echo json_encode($arrayImages);
  } catch (Exception $e) {
    throw new Exception($e->getMessage());
  }
  break;
//----------------------------------------------------------------------------------------------------------------------------------------------------------------------------
case "index":
  try {
    $select = $_POST['select'] ?? "";
    $search = $_POST['search'] ?? "";

    if ($select == "" or $search == "")
      $arrayAnuncios = Anuncio::Get20($pdo);
    else
      $arrayAnuncios = Anuncio::Get20search($pdo, $select, $search);
    header('Content-Type: application/json; charset=utf-8');
    echo json_encode($arrayAnuncios);
  } catch (Exception $e) {
    throw new Exception($e->getMessage());
  }
  break;
//----------------------------------------------------------------------------------------------------------------------------------------------------------------------------
  case "register_interest":
    try {
      $nome = $_POST["nome"] ?? "";
      $telefone = $_POST["telefone"] ?? "";
      $mensagem = $_POST["mensagem"] ?? "";
      $idAnuncio = $_POST["idAnuncio"] ?? "";

      Interesse::Create($pdo, $nome, $telefone, $mensagem, $idAnuncio);
      header("location: ../index_intern.php");
    } catch (Exception $e) {
      echo json_encode(["success" => false, "message" => $e->getMessage()]);
      exit ();
    }
    break;
//----------------------------------------------------------------------------------------------------------------------------------------------------------------------------
  case "getInterestsAd":
    try {
      session_start();
      $idAnuncio = $_GET['idAnuncio'] ?? 0;
      $userId = $_SESSION['user_id'];
      $anuncio = Anuncio::GetAdvertiserByAd($pdo, $idAnuncio);
      
      if (!$anuncio || $anuncio->idAnunciante != $userId) {
        header('Content-Type: application/json; charset=utf-8');
        echo json_encode(["success" => false, "message" => "Você não tem permissão para acessar esses interesses."]);
        exit;
      }

      $interessados = Interesse::GetInterestedUsersByAdId($pdo, $idAnuncio);
      header('Content-Type: application/json; charset=utf-8');
      echo json_encode($interessados); 
    } 
    catch (Exception $e) {
      header('Content-Type: application/json; charset=utf-8');
      echo json_encode(["success" => false, "message" => $e->getMessage()]);
    }
    break;

  default:
    exit("Ação não disponível");
}
