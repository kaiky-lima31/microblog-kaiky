<?php 
/* Sesspes no PHP
Recurso usado ára o controle de acesso
á determinadas páginas e/o recursos do site. Exemplo:
área administrativa, área do cliente/aluno.

Nestas áreas, o acesso só é possível mediante alguma forma 
de autenticação. Exemplo: login/senha. */

// Se não existir uma sessão em funcionamento
if( !isset($_SESSION)){
    // Então, inicie uma sessão
    session_start();
}

/* Usada todas as páginas admin */
function verificaAcesso(){
 /* Senão existir uma vareável de SESSÃO
 baseada no id do úsuario, significa que ele/ela 
 NÃO ESTÁ logado(a) no sistema */
if( !isset($_SESSION['id'])){
    // Destrua qualquer tipo de sessão
    session_destroy();

    // Redirecione para o formulário de login
    header("location:../login.php");

    // Pare completamente qualquer outra execução
    exit; // ou die()
}
}