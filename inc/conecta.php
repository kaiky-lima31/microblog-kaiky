<?php
/* Parâmetros de acesso ao
servidor de banco de dados MySQL */ 
$servidor = "localhost";
$usuario = "root";
$senha = "";
$banco = "microblog_kaiky";

/* Usando a função mysqli_cennect para conectar ao servidor */
$conexao = mysqli_connect($servidor, $usuario, $senha, $banco);

/* definindo o charset UTF8 tambem para a comunicação
com o banco de dados */
mysqli_set_charset($conexao, "utf8");

if( !$conexao ){
    die(mysqli_connect_error($conexao));
}/* else {
    echo "<p>Beleza, banco conectado!</p>";
} */