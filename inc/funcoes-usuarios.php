<?php
/* Carregando o script de acesso ao servidor de BD */
require "conecta.php";


// Usada em admin/usuario-insere.php
function inserirUsuario($conexao, $nome, $email, $senha, $tipo){
    /* Variável montada com o comando SQL para INSERT
    dos dados capturados através do formulário */
    $sql = "INSERT INTO usuarios(nome, email, senha, tipo) 
            VALUES('$nome', '$email', '$senha', '$tipo')";
    
    /* Executando o comando SQL montado acima */
    mysqli_query($conexao, $sql) or die(mysqli_error($conexao));

} // fim inserirUsuario


// Usada em usuarios.php
function lerUsuarios($conexao){
    // Montando o comando SQL SELECT para leitura dos usuários
    $sql = "SELECT id, nome, email, tipo FROM usuarios ORDER BY nome";

    // Guardando o resultado da operação de consulta SELECT
    $resultado = mysqli_query($conexao, $sql) 
                or die(mysqli_error($conexao));

    /* Criando um array vazio que receberá
    outros arrays contendo os dados de cada usuário */
    $usuarios = [];

    /* Loop while (enquanto) que a cada ciclo de repetição,
    irá extrair os dados de cada usuario provenientes do
    resultado da consulta. Essa extração é feita pela função
    mysqli_fetch_assoc e é guardada na variável $usuario. */
    while($usuario = mysqli_fetch_assoc($resultado)){
        /* Pegamos os dados de cada $usuario (array),
        e os colocamos dentro (array_push) 
        do grande array $usuarios. */
        array_push($usuarios, $usuario);
    }

    /*  Levamos para fora da função a matriz $usuarios,
    contendo os dados de cada $usuario */
    return $usuarios;
} // fim lerUsuarios


// Usada em usuario-exclui.php
function excluiUsuario($conexao, $id){
    /* Montando o comando de exclusão (DELETE) passando
    como condição (WHERE) o id do usuário que será excluído. */
    $sql = "DELETE FROM usuarios WHERE id = $id";

    /* Executando o comando sql */
    mysqli_query($conexao, $sql) or die(mysqli_error($conexao));
} // fim excluiUsuario



// Usada em usuario-atualizada.php
// função para carregamento/exibição dos dados de UM USUÁRIO
function lerUmUsuario($conexao, $id){
    /* Comando SQL para carregamento dos dados de
    um determinado usuário pelo id */
    $sql = "SELECT * FROM usuarios WHERE id = $id";

    /* Executamos a quer (consulta) e, em caso de sucesso,
    guardamos o resultado em memória. Obs.: este resultado
    ainda não está pronto para ser usado diretamente na aplicação
    (ou seja, dentro do formulário/página HTML) */
    $resultado = mysqli_query($conexao, $sql)
                or die(mysqli_error($conexao));
    /* Extraimos de dentro do resultado só o que nos interessa:
    os dados do usuário selecionado, já estruturais como
    um ARRAY ASSOCIATIVO */
    return mysqli_fetch_assoc($resultado);
} // fim/intenção LerUmUsuario

// Usada em cada usuario-atualizada.php
function atualizarUsuario($conexao, $id, $nome, $tipo, $email, $senha){
    $sql = "UPDATE usuarios SET nome = '$nome', email = '$email',
    senha = '$senha', tipo = '$tipo' WHERE id = $id";

    mysqli_query($conexao, $sql) or die(mysqli_error($conexao));

} // Fim atualizarUsuario