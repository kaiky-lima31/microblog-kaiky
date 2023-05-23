<?php
require_once "../inc/funcoes-usuarios.php";

/* Capturando o valor recebido pelo parâmetro
id através da URL */
$id = $_GET["id"];

/* Chamando a função de excluir usuário passando
o id do usuário que será excluído */
excluiUsuario($conexao, $id);

/* Voltando para a página com a tabela/lista de usuários */
header("location:usuarios.php");