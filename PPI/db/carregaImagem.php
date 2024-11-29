<?php

function validaFoto($arquivoImagem)
{
   if (!is_uploaded_file($arquivoImagem))
      throw new InvalidArgumentException("Falha ao carregar o arquivo de imagem");

   // Resgata e verifica o tamanho da imagem
   list($width, $height, $type) = getimagesize($arquivoImagem);
   if (empty($width) || empty($height))
      throw new InvalidArgumentException("O arquivo informado não corresponde a uma imagem válida");

   // Verifica o formato do arquivo de imagem
   $imageType = image_type_to_mime_type($type);
   if ($imageType != "image/jpeg" && $imageType != "image/png")
      throw new InvalidArgumentException("A foto deve estar no formato JPEG ou PNG");

   // Verifica o tamanho do arquivo de imagem
   if (filesize($arquivoImagem) > 5*1024*1024)
      throw new InvalidArgumentException("A foto não deve ultrapassar 5MB");

   return $imageType;
}

function salvaFotos($pdo, $idAnunciante, $idAnuncio) {
   $pasta = "../upload/" . $idAnunciante . "/" . $idAnuncio;

   if (!is_dir("../upload")) {
      mkdir("../upload", 0777, true); 
   }
   if (!is_dir("../upload/" . $idAnunciante)) {
      mkdir("../upload/" . $idAnunciante, 0777, true); 
   }
   if (!is_dir($pasta)) {
      mkdir($pasta, 0777, true); 
   }
   $index = 0;
   // Mínimo de fotos
   $min = 3;
   $fotosEnviadas = count($_FILES["fotos"]["tmp_name"]);
   if ($fotosEnviadas < $min) {
      throw new InvalidArgumentException("O número mínimo de fotos é 3");
   }

   foreach ($_FILES["fotos"]["tmp_name"] as $arquivoImagemTemp) {
      try {
         $tipoArquivoImagem = validaFoto($arquivoImagemTemp);
         $dataHora = date('Ymd_His', time());
         $microtime = microtime(true);
         $extensao = substr($tipoArquivoImagem, 6);
         $destinoArquivo = "$pasta/{$dataHora}-{$microtime}-{$index}.{$extensao}";
         $index += 1;
         move_uploaded_file($arquivoImagemTemp, $destinoArquivo);
         $resposta = Foto::Create($pdo, $idAnuncio, $destinoArquivo);
      }
      catch (Exception $e) {
         echo "Erro".$e->getMessage();
         throw new InvalidArgumentException("A operação não pode ser realizada: " . $e->getMessage());
      }
   }
   
   
}