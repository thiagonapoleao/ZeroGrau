<?php

require_once '../init.php';
$PDO = db_connect();

// pega os dados do formuário
$cpf = isset($_POST['cpf']) ? $_POST['cpf'] : null;
$nome = isset($_POST['nome']) ? $_POST['nome'] : null;
$dtnascimento = isset($_POST['dtnascimento']) ? $_POST['dtnascimento'] : null;
$endereco = isset($_POST['endereco']) ? $_POST['endereco'] : null;
$numero = isset($_POST['numero']) ? $_POST['numero'] : null;
$bairro = isset($_POST['bairro']) ? $_POST['bairro'] : null;
$cidade = isset($_POST['cidade']) ? $_POST['cidade'] : null;
$cep = isset($_POST['cep']) ? $_POST['cep'] : null;
$telefone = isset($_POST['telefone']) ? $_POST['telefone'] : null;
$celular = isset($_POST['celular']) ? $_POST['celular'] : null;
$dtcadastro = isset($_POST['dtcadastro']) ? $_POST['dtcadastro'] : null;


if (empty($cpf) || empty($nome)) {
	echo "Erro ao Cadastrar cliente";
} else {
	$sql_count = "select count(*) cpf from cadastro_cliente where cpf = '" . $cpf. "' ";
	$stmt_count = $PDO->prepare($sql_count);
	$stmt_count->execute();
	$total = $stmt_count->fetchColumn();
	if ($total == 1)
	{
		echo ("<script LANGUAGE='JavaScript'>
		window.alert('CPF já cadastrada, tente novamente!');
		window.location.href='cadastro.php';
		</script>");
	}
	else
	{
	// insere no banco

	$sql = "INSERT INTO cadastro_cliente(cpf, nome, dtnascimento, endereco, numero, bairro, cidade, cep, telefone, celular, dtcadastro ) VALUES(:cpf, :nome, :dtnascimento, :endereco, :numero, :bairro, :cidade, :cep, :telefone, :celular, :dtcadastro)";
	$stmt = $PDO->prepare($sql);
	$stmt->bindParam(':cpf', $cpf);
	$stmt->bindParam(':nome', $nome);
	$stmt->bindParam(':dtnascimento', $dtnascimento);
	$stmt->bindParam(':endereco', $endereco);
	$stmt->bindParam(':numero', $numero);
	$stmt->bindParam(':bairro', $bairro);
	$stmt->bindParam (':cidade',$cidade);
	$stmt->bindParam(':cep', $cep);
	$stmt->bindParam(':telefone', $telefone);
	$stmt->bindParam(':celular', $celular);
	$stmt->bindParam(':dtcadastro', $dtcadastro);
	if ($stmt->execute()) {
		header('Location: cadastro.php');
	} else {
		echo "Erro ao cadastrar";
		print_r($stmt->errorInfo());
		header('Location: cadastro.php');
	}
	}
	
	
}

?>
