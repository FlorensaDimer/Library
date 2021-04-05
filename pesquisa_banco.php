<html>

<head>
    <title>Pesquisar Livros</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
</head>

<body>
    <?php
    require "navbar.php";
    ?>
    <div class="container">
        <?php
        require "banco.php";
        $sql = "SELECT * FROM livros WHERE 1=1";
        if (!empty($_GET["IdLivro"])) {
            $sql .= " AND IdLivro = " . $_GET["IdLivro"];
        }
        if (!empty($_GET["Titulo"])) {
            $sql .= " AND Titulo like '%" . $_GET["Titulo"] . "%'";
        }
        if (!empty($_GET["Editora"])) {
            $sql .= " AND Editora like '%" . $_GET["Editora"] . "%'";
        }
        if (!empty($_GET["Isbn"])) {
            $sql .= " AND Isbn = " . $_GET["Isbn"];
        }
        $result = $conn->query($sql);
        ?>
        <div class="row">
            <form action="pesquisa_banco.php" method="get">
                <div class="input-field col s12 m6">
                    <input placeholder="" type="number" name="IdLivro" value="<?php if (isset($_GET["IdLivro"])) echo $_GET["IdLivro"]; ?>">
                    <label>Código do Livro</label>
                </div>
                <div class="input-field col s12 m6">
                    <input placeholder="" type="text" name="Titulo" value="<?php if (isset($_GET["Titulo"])) echo $_GET["Titulo"]; ?>">
                    <label>Título</label>
                </div>
                <div class="input-field col s12 m6">
                    <input placeholder="" type="text" name="Editora" value="<?php if (isset($_GET["Editora"])) echo $_GET["Editora"]; ?>">
                    <label>Editora</label>
                </div>
                <div class="input-field col s12 m6">
                    <input placeholder="" type="number" name="Isbn" value="<?php if (isset($_GET["Isbn"])) echo $_GET["Isbn"]; ?>">
                    <label>ISBN</label>
                </div>
                <div class="col s12">
                    <button class="btn waves-effect waves-light" type="submit">Pesquisar</button>
                    <a class="btn waves-effect waves-light" href="pesquisa_banco.php">Limpar</a>
                </div>
            </form>
        </div>
        
        <table class="striped highlight responsive-table">
            <thead>
                <tr>
                    <th>Código</th>
                    <th>Título</th>
                    <th>Editora</th>
                    <th>ISBN</th>
                    <th>Alterar</th>
                    <th>Excluir</th>
                </tr>
            </thead>
            <tbody>
                <?php
                while ($row = $result->fetch_assoc()) {
                ?>
                    <tr>
                        <td><?= $row["IdLivro"] ?></td>
                        <td><?= $row["Titulo"] ?></td>
                        <td><?= $row["Editora"] ?></td>
                        <td><?= $row["Isbn"] ?></td>
                        <td><button class="waves-effect waves-light btn-floating" onclick="alterarLivro(<?= $row['IdLivro'] ?>)"><i class="material-icons">edit</i></button></td>
                        <td><button class="waves-effect waves-light btn-floating red" onclick="excluirLivro(<?= $row['IdLivro'] ?>)"><i class="material-icons">delete</i></button></td>
                    </tr>
                <?php
                }
                ?>
            </tbody>
        </table>
        <p> <?= $result->num_rows ?> Resultado(s) encontrado(s).</p>
    </div>

    <script src="http://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.sidenav').sidenav();
        });

        function excluirLivro(IdLivro) {
            if (confirm("Deseja realmente excluir esta pessoa?")) {
                window.open("excluir_banco.php?IdLivro=" + IdLivro, "_self");
            }
        }

        function alterarLivro(IdLivro) {
            window.open("cadastra_banco.php?IdLivro=" + IdLivro, "_self");
        }
    </script>
</body>

</html>