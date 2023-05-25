<?php
require_once "conecta.php";

/* Usada em notícia-insere.php */
function inserirNoticia($conexao, $titulo, $texto, $resumo, $imagem, $idUsuarioLogado){
    $sql = "INSERT INTO noticias(titulo, texto, resumo, imagem, usuario_id) VALUES ('$titulo', '$texto', '$resumo', '$imagem', $idUsuarioLogado)";

    mysqli_query ($conexao, $sql) or die(mysqli_error($conexao));
} // fim insertNoticia


/* Usada em noticia-insere.php e noticia-atualiza.php */
function upload($arquivo){
    /* Array contendo a lista de formatos de imagem válidos */
    $tiposValidos = ["image/png", "image/jpeg", "image/gif","image/svg+xml"];

    // Só vai entrar em funcionamento se nao existir o arquivo nos tipos válidos, e entao ira aparecer uma msg formato invalido!!!
    if( !in_array($arquivo['type'], $tiposValidos) ){
        echo "<script>alert('Formato inválido!'); history.back();</script>";
        exit;
    }

    // Extraindo do arquivo apenas o "name" dele
    $nome = $arquivo['name'];

    // Extraindo do arquivo apenas o diretório/nome TEMPORÁRIO
    $temporario = $arquivo['tmp_name'];

    // Definindo a pasta final/destino dentro do nosso site
    // Usamos o ponto para concatenar com o nome do arquivo
    $destino = "../imagem/".$nome;
    
    // Mover o arquivo enviado da área temporária do servidor para a pasta de desetino final dentro do site
    move_uploaded_file($temporario, $destino);
} // fim upload

function lerNoticias($conexao){
    // sql improvisado
    $sql = "SELECT * FROM noticias ORDER BY data DESC";

    $resultado = mysqli_query($conexao, $sql) or die(mysqli_error($conexao));

    $noticias = [];

    /* Enquanto tiver dados de cada noticia no resultado
    do select sql, guarde cada umas da noticias e seus dados
    em uma variavel ($noticia) */
    while($noticia = mysqli_fetch_assoc($resultado)){
        /* E em seguida, coloque cada um dentro do array
        chamado $noticias */
        array_push($noticias, $noticia);
    }

    /* retornamos a matriz de notícias */
    return $noticias;
} // fim lerNoticias