<?php

class Anunciante
{
  static function Create($pdo, $nome, $cpf, $email, $senhaHash, $telefone)
  {
    $stmt = $pdo->prepare(
      <<<SQL
      INSERT INTO Anunciante (nome, cpf, email, senhaHash, telefone)
      VALUES (?, ?, ?, ?, ?)
      SQL
    );

    $stmt->execute([$nome, $cpf, $email, $senhaHash, $telefone]);

    return $pdo->lastInsertId();
  }

///////////////////////////////////////////////////////////////////////////////////////////////////////////

  static function checkUserCredentials($pdo, $email, $senha)
  {
    $sql = <<<SQL
      SELECT id, senhaHash
      FROM Anunciante
      WHERE email = ?
      SQL;

    try {
      $stmt = $pdo->prepare($sql);
      $stmt->execute([$email]);
      $anunciante = $stmt->fetch(PDO::FETCH_OBJ);

      if (!$anunciante)  
          return false;

      if (password_verify($senha, $anunciante->senhaHash)) 
          return $anunciante->id;

      return false;
    } 
    catch (Exception $e) {
      exit('Falha inesperada: ' . $e->getMessage());
    }
  }
}
