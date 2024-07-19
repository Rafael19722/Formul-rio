<?php

//pegando os dados vindos do formulário
$nome = $_POST['nome'];
$email = $_POST['email'];
$telefone = $_POST['telefone'];
$genero = $_POST['genero'];
$cidade = $_POST['cidade'];
$estado = $_POST['estado'];
$endereco = $_POST['endereco'];

//configuracoes de credenciais
$server = 'localhost';
$usuario = 'root';
$senha = '';
$banco = 'formulario_clientes';

//conexao com o banco
$conn = new mysqli($server, $usuario, $senha, $banco);

//verificar conexao
if ($conn->connect_error) {
  die('falha ao se comunicar com banco de dados'.$conn->connect_error);
}

$smtp = $conn->prepare("INSERT INTO clientes (nome, email, telefone, genero, cidade, estado, endereco) VALUES (?,?,?,?,?,?,?)");
$smtp->bind_param("sssssss",$nome,$email,$telefone,$genero,$cidade,$estado,$endereco);

if($smtp->execute()) {
  echo "formulário enviado com sucesso!";
} else {
  echo "Erro no envio da mensagem: ".$smtp->error;
}

$smtp->close();
$conn->close();

?>