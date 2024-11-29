<?php

class Foto
{
  static function Create($pdo, $idAnuncio, $nomeArqFoto)
  {
    try {
      $stmt = $pdo->prepare(
        <<<SQL
        INSERT INTO Foto (idAnuncio, nomeArqFoto)
        VALUES (?, ?)
        SQL
      );
 
      $stmt->execute([$idAnuncio, $nomeArqFoto]);

      return $pdo->lastInsertId();
    } catch (Exception $e) {
      return "Erro ao inserir foto: " . $e->getMessage();
    }
  }

///////////////////////////////////////////////////////////////////////////////////////////////////////////

  static function GetFirst($pdo, $idAnuncio)
  {
    $stmt = $pdo->prepare(
        <<<SQL
        SELECT nomeArqFoto
        FROM Foto
        WHERE idAnuncio = ?
        LIMIT 1
        SQL
    );

    $stmt->execute([$idAnuncio]);

    $foto = $stmt->fetch(PDO::FETCH_OBJ);
    return $foto;
  }

///////////////////////////////////////////////////////////////////////////////////////////////////////////

  static function GetFotosById($pdo, $idAnuncio)
  {
    $stmt = $pdo->prepare(
        <<<SQL
        SELECT nomeArqFoto
        FROM Foto
        WHERE idAnuncio = ?
        SQL
    );

    $stmt->execute([$idAnuncio]);

    $fotos = $stmt->fetchAll(PDO::FETCH_OBJ);
    return $fotos;
  }
}