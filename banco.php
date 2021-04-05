<?php

        $servername = "localhost"; //Ou 192.168.0.1 para chamar o endereço do servidor
        $dbname = "biblioteca";
        $username = "root";
        $password = "";
        $conn = new mysqli($servername, $username, $password, $dbname);// conector de bando de dados orientado ao objeto

        if($conn->connect_error){// Para testar a conexão com o bando de dados. Se o atributo (connect_error) for verdadeiro entrara na condição.
            die("Erro ao conectar ao banco de dados!");
        }
        ?>