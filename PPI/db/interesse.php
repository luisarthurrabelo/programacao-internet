<?php

class Interesse
{
  static function Create($pdo, $nome, $telefone, $mensagem, $idAnuncio)
  {
    $stmt = $pdo->prepare(
      <<<SQL
      INSERT INTO Interesse (nome, telefone, mensagem, idAnuncio)
      VALUES (?, ?, ?, ?)
      SQL
    );

    $stmt->execute([$nome, $telefone, $mensagem, $idAnuncio]);

    return $pdo->lastInsertId();
  }

///////////////////////////////////////////////////////////////////////////////////////////////////////////

  public static function GetInterestedUsersByAdId($pdo, $idAnuncio) {
    try {
      $stmt = $pdo->prepare(
        <<<SQL
        SELECT nome, telefone, mensagem 
        FROM Interesse 
        WHERE idAnuncio = ?
        SQL
      );
      
      $stmt->execute([$idAnuncio]);

      return $stmt->fetchAll(PDO::FETCH_OBJ);
    } catch (Exception $e) {
      throw new Exception($e->getMessage());
    }
    
}
}
