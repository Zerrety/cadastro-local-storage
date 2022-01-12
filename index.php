<!DOCTYPE html>
<html lang="pt-br">

<head>

    <script type="text/javascript">
        //Função para salvar as informações no Local Storage
        function adicionar() {

            // Obtém a data/hora atual
            var data = new Date();

            // Guarda cada pedaço em uma variável
            var dia = data.getDate();
            var mes = data.getMonth();
            var ano4 = data.getFullYear();
            var hora = data.getHours();
            var min = data.getMinutes();
            var seg = data.getSeconds();

            // Formata a data e a hora (note o mês + 1)
            let str_data = dia + '/' + (mes + 1) + '/' + ano4;
            let str_hora = hora + ':' + min + ':' + seg;
            let data_hora = str_data + " - " + str_hora;



            let nome_cachorro = document.getElementById("nome-cachorro");
            let raca_cachorro = document.getElementById("raca-cachorro");
            let cores = document.getElementById("cores");
            let fonte = document.getElementById("fonte");

            if (nome_cachorro.value != "") {

                localStorage.setItem("nome_cachorro", nome_cachorro.value);
                localStorage.setItem("raca_cachorro", raca_cachorro.value);
                localStorage.setItem("cor", cores.value.replace('#', ''));
                localStorage.setItem("fonte", fonte.value);
                localStorage.setItem("data", data_hora);

                document.getElementById("sucesso").innerHTML = "Cachorro salvo com sucesso!!";

            }

            ver_cachorro();
        }
        //Função para atualizar o link com as informações
        function ver_cachorro() {
            document.getElementById("ver-cachorro").href = "cachorro.php?nome_cachorro=" + localStorage.getItem("nome_cachorro") + "&raca_cachorro=" + localStorage.getItem("raca_cachorro") + "&cor=" + localStorage.getItem("cor") + "&fonte=" + localStorage.getItem("fonte") + "&data_hora=" + localStorage.getItem("data");
        }
    </script>


    <link href="style.css" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=The+Nautigal&display=swap" rel="stylesheet">

</head>

<body onload="ver_cachorro()">


    <?php

    include('config.php');

    //Busca de lista de raças de cachorros via API
    $response = @file_get_contents(LISTA_CACHORROS);
    $cachorros = json_decode($response, true);

    ?>


    <div class="container pt-5">
        <div class="form-group">

            <h2 id="sucesso"></h2>
            <div class="col-md-6 offset-md-3">
                <label>Raça do cachorro</label>
                <select name="raca-cachorro" id="raca-cachorro" class="form-control">

                    <?php
                    foreach (array_keys($cachorros['message']) as $value) :
                    ?>

                        <option value="<?php echo $value; ?>"><?php echo $value; ?></option>

                    <?php
                    endforeach;
                    ?>

                </select>
            </div>
        </div>

        <div class="form-group">
            <div class="col-md-6 offset-md-3">
                <label> Nome do cachorro </label>
                <input type="text" name="nome-cachorro" id="nome-cachorro" class="form-control" placeholder="Nome do cachorro" required>
            </div>
        </div>

        <div class="form-group">
            <div class="col-md-6 offset-md-3">
                <label> Cor do nome </label>
                <input type="color" class="form-control" id="cores" name="cores" list="cinco-cores" value="#FF0000">
                <datalist id="cinco-cores">
                    <option value="#800080">Roxo</option>
                    <option value="#0000FF">Azul</option>
                    <option value="#FF0000">Vermelho</option>
                    <option value="#FFA500">Laranja</option>
                    <option value="#FFFF00">Amarelo</option>
                </datalist>
            </div>
        </div>

        <div class="form-group">
            <div class="col-md-6 offset-md-3">
                <label>Fonte (Será ultilizada no nome do cachorro)</label>
                <select name="fonte" id="fonte" class="form-control">
                    <option value="moon-dance" class="moon-dance">Moon Dance</option>
                    <option value="nautigal" class="nautigal">Nautigal</option>
                    <option value="pacifico" class="pacifico">Pacifico</option>
                    <option value="lobster" class="lobster">Lobster</option>
                    <option value="bebas-neue" class="bebas-neue">Bebas Neue</option>
                </select>
            </div>
        </div>

        <div class="form-group d-flex justify-content-center">
            <button class="btn btn-primary" onclick="adicionar()">Salvar</button>
            <a id="ver-cachorro" href="cachorro.php" class="ml-4 btn btn-primary">Ver cachorro salvo</a>
        </div>
    </div>
</body>

</html>