<html>

<head>
    <title>Cadastrar Livro</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <link rel="stylesheet" type="text/css" href="estilo.css">
</head>

<body>
    <?php
    require "navbar.php";
    require "banco.php";
    $IdLivro = 0;
    $Titulo = "";
    $Editora = "";
    $Isbn;
    $textoCadastrarAlterar = "Cadastrar";
    if (isset($_GET["IdLivro"])) {
        $IdLivro = $_GET["IdLivro"];
        $sql = "SELECT * FROM livros WHERE IdLivro = $IdLivro";
        $result = $conn->query($sql);
        while ($row = $result->fetch_assoc()) {
            $Titulo = $row["Titulo"];
            $Editora = $row["Editora"];
            $Isbn = $row["Isbn"];
        }
        $textoCadastrarAlterar = "Alterar";
    }
    ?>
    <div id="formulario" class="container">
        <h3><?= $textoCadastrarAlterar ?> Livro</h3>
        <div class="row">
            <form action="cadastra_banco.php" method="post">

                <input placeholder="Código do Livro" type="hidden" name="IdLivro" value="<?= $IdLivro ?>">

                <div class="input-field col s12 m4">
                    <input placeholder="" type="text" name="Titulo" value="<?= $Titulo ?>">
                    <label>Título</label>
                </div>
                <div class="input-field col s12 m4">
                    <input placeholder="" type="text" name="Editora" value="<?= $Editora ?>">
                    <label>Editora</label>
                </div>
                <div class="input-field col s12 m4">
                    <input placeholder="" type="number" name="Isbn" value="<?= $Isbn ?>">
                    <label>ISBN</label>
                </div>

        </div>
        <div class="col s12">
            <button class="btn waves-effect" type="submit"><?= $textoCadastrarAlterar ?></button>
        </div>
        </form>
    </div>
    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (empty($_POST["Titulo"])) {
            echo "<p>Preencha o título para cadastrar!</p>";
        } else {
            $IdLivro = $_POST["IdLivro"];
            $Titulo = $_POST["Titulo"];
            $Editora = $_POST["Editora"];
            $Isbn;
            if (empty($_POST["Isbn"])) {
                $Isbn = "null";
            } else {
                $Isbn = $_POST["Isbn"];
            }
            if ($IdLivro == 0) {
                $sql = "INSERT INTO livros (Titulo, Editora, Isbn) VALUES ('$Titulo', '$Editora', $Isbn);";
                if ($conn->query($sql) === true) {
                    echo "<p>Livro cadastrado com sucesso!</p>";
                } else {
                    echo "<p>Erro ao cadastrar o livro.</p>";
                    echo "$conn->error";
                }
            } else {
                $sql = "UPDATE livros SET Titulo = '$Titulo', Editora = '$Editora', Isbn = $Isbn WHERE IdLivro = $IdLivro";
                if ($conn->query($sql) === true) {
                    echo "<p>Informações alteradas.</p>";
                } else {
                    echo "<p>Foi foi possível realizar as alterações.</p>";
                }
                header("Location: pesquisa_banco.php");
            }
        }
    }
    ?>
    </div>

    <script src="http://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.sidenav').sidenav();
        });
    </script>
</body>

</html>