<?php

require_once "../inc/funcoes-noticias.php";
require_once "../inc/funcoes-sessao.php";
verificaAcesso();

// Pegando o id da noticia vindo do parametro de URl
$idNoticia = $_GET['id'];

// Pegando o id e o tipo do usuário logado
$idUsuario = $_SESSION['id'];
$tipoUsuario = $_SESSION['tipo'];

// Executando a função de DELETE com os parametro
excluirNoticia($conexao, $idNoticia, $idUsuario, $tipoUsuario);

// Voltando pra páginas das notícias
header("location:noticias.php");