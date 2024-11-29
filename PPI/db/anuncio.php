<?php

class Anuncio
{
  static function Create($pdo, $marca, $modelo, $ano, $cor, $quilometragem, $descricao, $valor, $estado, $cidade, $idAnunciante)
  {
    $stmt = $pdo->prepare(
      <<<SQL
      INSERT INTO Anuncio (marca, modelo, ano, cor, quilometragem, descricao, valor, estado, cidade, idAnunciante)
      VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)
      SQL
    );

    $stmt->execute([$marca, $modelo, $ano, $cor, $quilometragem, $descricao, $valor, $estado, $cidade, $idAnunciante]);

    return $pdo->lastInsertId();
  }

///////////////////////////////////////////////////////////////////////////////////////////////////////////

  static function GetAll($pdo, $idAnunciante)
  {
    $stmt = $pdo->prepare(
        <<<SQL
        SELECT id, marca, modelo, ano, cor, quilometragem, descricao, valor, estado, cidade
        FROM Anuncio
        WHERE idAnunciante = ?
        SQL
    );

    $stmt->execute([$idAnunciante]);

    $arrayAnuncios = $stmt->fetchAll(PDO::FETCH_OBJ);
    return $arrayAnuncios;
  }

///////////////////////////////////////////////////////////////////////////////////////////////////////////

  static function GetAdvertiserByAd($pdo, $idAnuncio) 
  {
    $stmt = $pdo->prepare(
      <<<SQL
      SELECT idAnunciante
      FROM Anuncio
      WHERE id = ?
      SQL
    );

    $stmt->execute([$idAnuncio]);

    $anuncio = $stmt->fetch(PDO::FETCH_OBJ);
    return $anuncio;
  }

///////////////////////////////////////////////////////////////////////////////////////////////////////////

  static function GetAdById($pdo, $idAnuncio) 
  {
    $stmt = $pdo->prepare(
      <<<SQL
      SELECT marca, modelo, ano, cor, quilometragem, descricao, valor, estado, cidade
      FROM Anuncio
      WHERE id = ?
      SQL
    );

    $stmt->execute([$idAnuncio]);

    $anuncio = $stmt->fetchAll(PDO::FETCH_OBJ);
    return $anuncio;
  }

///////////////////////////////////////////////////////////////////////////////////////////////////////////

  static function Get20($pdo)
  {
    session_start();
    $string = "";
    if ($_SESSION['loggedIn'])
      $string = "WHERE idAnunciante <> ?";

    $stmt = $pdo->prepare(
        <<<SQL
        SELECT id, marca, modelo, ano, cor, quilometragem, descricao, valor, estado, cidade
        FROM Anuncio
        $string
        ORDER BY dataHora DESC
        LIMIT 20
        SQL
    );
    if ($_SESSION['loggedIn'])
      $stmt->execute([$_SESSION['user_id']]);
    else
      $stmt->execute([]);

    $arrayAnuncios = $stmt->fetchAll(PDO::FETCH_OBJ);
    return $arrayAnuncios;
  }

///////////////////////////////////////////////////////////////////////////////////////////////////////////

  static function Get20search($pdo, $select, $search)
  {
    session_start();
    $string = "";
    $selectOp = "";
    if ($_SESSION['loggedIn'])
      $string = "AND idAnunciante <> ?";

    if ($select == "brand") 
      $selectOp = "WHERE marca = ?";
    else if ($select == "model")
      $selectOp = "WHERE modelo = ?";
    else 
      $selectOp = "WHERE cidade = ?";

    $stmt = $pdo->prepare( <<<SQL
        SELECT id, marca, modelo, ano, cor, quilometragem, descricao, valor, estado, cidade
        FROM Anuncio
        $selectOp $string
        ORDER BY dataHora DESC
        LIMIT 20
        SQL
    );

    if ($_SESSION['loggedIn'])
      $stmt->execute([$search, $_SESSION['user_id']]);
    else
      $stmt->execute([$search]);
  
    $arrayAnuncios = $stmt->fetchAll(PDO::FETCH_OBJ);
    return $arrayAnuncios;
  }

///////////////////////////////////////////////////////////////////////////////////////////////////////////

  static function Delete($pdo, $idAnuncio) 
  {
        $stmt = $pdo->prepare(
          <<<SQL
            DELETE FROM Anuncio WHERE id = ?
            SQL
        );

        return $stmt->execute([$idAnuncio]);
  }
}
