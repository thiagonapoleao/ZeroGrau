<?php

require_once 'init.php';

// abre a conexão
$PDO = db_connect();

$data = date('Y-m-d');
$id_venda = 1;

if (isset($_POST['searchAdress'])) {
    $ean = $_POST['ean'];

    $sql = "SELECT id, ean, descricao, valor, catecoria, codigo FROM cadastro_produto  where ean = $ean";
    $stmt_array = $PDO->prepare($sql);
    $stmt_array->execute();
    $return = $stmt_array->fetch(PDO::FETCH_ASSOC);


    echo json_encode($return);
 
}
