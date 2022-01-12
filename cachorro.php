<!DOCTYPE html>
<html lang="pt-br">

<head>

    <link href="style.css" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=The+Nautigal&display=swap" rel="stylesheet">
    <?php

    include('config.php');

    //Recuperando as informações do cachorro via metodo GET
    $nome_cachorro = $_GET['nome_cachorro'];
    $raca_cachorro = $_GET['raca_cachorro'];
    $cor = $_GET['cor'];
    $fonte = $_GET['fonte'];
    $data_hora = $_GET['data_hora'];

    //Verificação se todos os dados estão presentes
    if(is_null($nome_cachorro) || is_null($raca_cachorro) || is_null($cor) || is_null($fonte)){

        header('LOCATION: index.php');

    }




    ?>

</head>

<body>

<?php

//Busca de imagem da raça do cachorro via API
$url = substr(IMAGENS_CACHORROS, 0,26) . $raca_cachorro . substr(IMAGENS_CACHORROS, -14);
$response = @file_get_contents($url);
$foto = json_decode($response, true);

?>

<!-- Nome do cachorro estilizado durante o cadastro  -->
<h1 class='<?php echo $fonte; ?> text-center mt-5' style="color:#<?php echo $cor; ?>"><?php echo $nome_cachorro . " ( $data_hora )";?> </h1>

<div class="text-center">
    <!-- Foto do cachorro recuperada via API  -->
<img src="<?php echo $foto['message']?>"  class="img-responsive" style="margin:0 auto;"/>

</div>






</body>

</html>