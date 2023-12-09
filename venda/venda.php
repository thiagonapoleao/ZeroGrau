<?php
require_once '../init.php';

// abre a conexão
$PDO = db_connect();

$data = date("Y-m-d");
$dataTime = date("d/m/Y,  g:i a");

// sql_count para contar o total de registros
$sql_count = "SELECT count(id_venda) FROM venda";
// conta o toal de registros
$stmt_count = $PDO->prepare($sql_count);
$stmt_count->execute();
$total = $stmt_count->fetchColumn();

// SQL para selecionar os registros
$sql_arry = "SELECT id, id_venda, descricao, data, codigo, ean, valor FROM venda order BY id asc ";
// seleciona os registros
$stmt_array = $PDO->prepare($sql_arry);
$stmt_array->execute();


?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Zero Grau - Beer</title>
    <link rel="stylesheet" type="text/css" href="stilo.css">
    <link rel="stylesheet" type="text/css" href="../css/variables.scss">
    <meta name="author" content="">
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width" scale="1">
    <script type="text/javascript" src="../js/jquery-3.6.0.min.js"></script>
    <script type="text/javascript" src="../js/jquery.js"></script>
    <script type="text/javascript" src="../bootstrap/js/bootstrap.min.js"></script>
    <link rel="stylesheet" type="text/css" href="../bootstrap/css/bootstrap.min.css">
    <!-- Adicionando JQuery -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js" integrity="sha384-SR1sx49pcuLnqZUnnPwx6FCym0wLsk5JZuNx2bPPENzswTNFaQU1RDvt3wT4gWFG" crossorigin="anonymous">
    </script>
</head>

<body style="background-image:  url('../img/ZeroGrau-article.png'); background-repeat: no-repeat; background-attachment: fixed; background-size: 100% 100%;font-size: 18px ">
    <section id="corpo">
        <!-- tag <section> barra principal da pagina-->
        <article id="noticia-principal">
            <div style="background-repeat: no-repeat; background-attachment: fixed; background-size: 100% 100%; margin-top: 30px;color: blanchedalmond; border-radius: 20px; font-size: 12px">
                <div class="container">
                    <form action="add.php" method="post" class="needs-validation" novalidate>
                        <div>
                            <div class="row justify-content-md-lef">
                                <div class="col-sm-10 mb-2">
                                    <label for="validationServer01">Codigo de barras</label>
                                    <input type="text" name="ean" id="ean" class="form-control form-control-lg" autofocus required onblur="myFunction()">
                                </div>
                            </div>
                            <div class="row justify-content-md-lef">
                                <div class="col-sm-10 mb-2">
                                    <label for="validationServer01">Produto</label>
                                    <input type="text" name="descricao" id="descricao" class="form-control form-control-lg" required>
                                </div>
                                <div class="col-sm-4 mb-2">
                                    <label for="validationServer01">Qtde</label>
                                    <input type="number" name="qtde" id="qtde" class="form-control form-control-lg" required>
                                </div>
                                <div class="col-sm-4 mb-2">
                                    <label for="validationServer01">Preço Unitario</label>
                                    <input type="number" name="valor" id="valor" class="form-control form-control-lg" required>
                                </div>
                                <div class="col-sm-4 mb-2">
                                    <label for="validationServer01">Total de Itens</label>
                                    <input type="number" name="itens" id="itens" class="form-control form-control-lg" required>
                                </div>
                                <div class="col-sm-5 mb-2">
                                    <label for="validationServer01">Total da Venda</label>
                                    <input type="number" name="vlvenda" id="vlvenda" class="form-control form-control-lg" required>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </article>
    </section>
    <br>
    <aside id="lateral" style="background-image:  url('../img/ZeroGrau-article.png'); background-repeat: no-repeat; background-attachment: fixed; background-size: 100% 100%; ">
        <div align="center" style="margin-top: -21px;">
            <div class="border border-danger" style="background-color: white; color: black; width: 95%; border-radius: 20px; font-size: 12px; min-height: 350px;">
                <div class="table-responsive">
                    <table table-responsive>
                        <tr align="center">
                            <td>BEER ZEROGRAU</td>
                        </tr>
                        <tr align="center">
                            <td>Av. Padre José de Anchieta, 949 - Jardim Padre Anchieta </td>
                        </tr>
                        <tr align="center">
                            <td>Araraquara - SP, 14807-212</td>
                        </tr>
                        <tr align="center">
                            <td>CNPJ: 61.234.456/0000-1 IE: 687138771234</td>
                        </tr>
                        <tr>
                            <td><?php echo $dataTime ?> </td>
                            <td>COD: 00040</td>
                        </tr>
                        <tr>
                            <td>________________________________________________________________________ </td>
                        </tr>
                    </table>
                    <BR>
                    <h6>CUPOM FISCAL</h1>

                        <?php if ($total > 0) : ?>
                            <div class="table-responsive">
                                <table table-responsive>
                                    <thead>
                                        <tr>
                                            <th>
                                                Item</th>
                                            <th>
                                                Codigo</th>
                                            <th>
                                                Descrição</th>
                                            <th>
                                                Valor Unitario</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php while ($cadastro = $stmt_array->fetch(PDO::FETCH_ASSOC)) : ?>
                                            <tr>
                                                <td>
                                                    <?php echo $cadastro['id'] ?></td>
                                                <td>
                                                    <?php echo ucwords($cadastro['codigo']) ?></td>
                                                <td>
                                                    <?php echo ucwords($cadastro['descricao']) ?></td>
                                                <td>
                                                    <?php echo $cadastro['valor'] ?></td>
                                            </tr>
                                        <?php endwhile; ?>
                                    </tbody>
                                </table>
                            </div>
                        <?php else : ?>
                        <?php endif; ?>
                        
                </div>
            </div>
        </div>
    </aside>
    </div>

    <script>
        document.getElementById("ean").onblur = function() {
            myFunction()
        };

        $("#ean").blur(function() {
            $.ajax({
                url: '../searchs.php',
                type: 'post',
                dataType: 'json',
                data: {
                    searchAdress: 1,
                    ean: $("#ean").val()
                }
            }).done(function(data) {
                if (data) {
                    $("#ean").val("");
                    $("#id").val(data.id);
                    $("#descricao").val(data.descricao);
                    $("#valor").val(data.valor);
                    $("#catecoria").val(data.catecoria);
                } else {
                    $("#id").val("");
                    $("#descricao").val("");
                    $("#valor").val("");
                    $("#catecoria").val("");
                }
            }).fail(function(data) {
                console.log(data)
            })
        });
    </script>
</body>

</html>

<script>
    // Example starter JavaScript for disabling form submissions if there are invalid fields
    (function() {
        'use strict'

        // Fetch all the forms we want to apply custom Bootstrap validation styles to
        var forms = document.querySelectorAll('.needs-validation')

        // Loop over them and prevent submission
        Array.prototype.slice.call(forms)
            .forEach(function(form) {
                form.addEventListener('submit', function(event) {
                    if (!form.checkValidity()) {
                        event.preventDefault()
                        event.stopPropagation()
                    }

                    form.classList.add('was-validated')
                }, false)
            })
    })()
</script>