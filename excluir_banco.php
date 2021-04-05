<?php
require "banco.php";
if (isset($_GET["IdLivro"])) {
    $sql = "DELETE FROM livros WHERE IdLivro = ". $_GET["IdLivro"];
    if ($conn->query($sql) === true){
        
    }// poderia fazer um else para caso a exclusão não seja feita
}
header("Location: pesquisa_banco.php");
?>