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

/* Usada em noticias.php */
function lerNoticias($conexao, $idUsuarioLogado, $tipoUsuarioLogado){
    if($tipoUsuarioLogado == 'admin'){
        /* SQL do admin: pode carregar/ver tudo de TODOS. */
        $sql = "SELECT
        noticias.id,
        noticias.titulo,
        noticias.data,
        usuarios.nome
    FROM noticias INNER JOIN usuarios
    ON noticias.usuario_id = usuarios.id
    ORDER BY data DESC";
    }else {
        /* SQL do editor: pode carregar/ver tudo DELE APENAS */
        $sql = "SELECT * FROM noticias WHERE usuario_id = $idUsuarioLogado
        ORDER BY data DESC";
    }

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

/* Usada */
function formataData($data){
    /* Asa funções abaixo recebem a data no formato 
    de sistema (banco de dados) e a formatam num modelo
    mais amigavel (dia/mes/ano hora:mintuo) */
    return date("d/m/y H:i", strtotime($data));
}// fim formataData

/* Usada em noticia-atualizada.php */
function lerUmaNoticia($conexao, $idNoticia, $idUsuarioLogado, $tipoUsuarioLogado){

    if($tipoUsuarioLogado == 'admin'){
        /* SQL do admin: carregas os dados de qualquer noticia */
        $sql = "SELECT * FROM noticias WHERE id = $idNoticia";
    } else {
        /* SQL do editor: carrega os dados somente na noticia dele */
        $sql = "SELECT * FROM noticias WHERE id = $idNoticia
                AND usuario_id = $idUsuarioLogado";
    }

    $resultado = mysqli_query($conexao, $sql)
                or die(mysqli_error($conexao));

    return mysqli_fetch_assoc($resultado);
} // fim lerUmaNoticia


/* Usada em noticia-atualiza.php */
function atualizarNoticia($conexao, $titulo, $texto, $resumo, $imagem, $idNoticia, $idUsuarioLogado, $tipoUsuarioLogado){
    if($tipoUsuarioLogado == 'admin'){
        $sql = "UPDATE noticias SET titulo = '$titulo', 
        texto = '$texto',
        resumo = '$resumo',
        imagem = '$imagem'
     WHERE id = $idNoticia";

    } else{
        /* SQL do editor: pode atualizar somente sua própria noticia */
        $sql = "UPDATE noticias SET titulo = '$titulo', 
        texto = '$texto',
        resumo = 'resumo',
        imagem = 'imagem'
    WHERE id = $idNoticia AND usuario_id = $idUsuarioLogado";
    }

    mysqli_query($conexao, $sql) or die(mysqli_error($conexao));
}// fim atualizarNoticia

/* Usada em noticia-exclui.php */
function excluirNoticia($conexao, $idNoticia, $idUsuarioLogado, $tipoUsuarioLogado){

    if($tipoUsuarioLogado == 'admin'){
        /* SQL do admin: pode apagar qualquer notícia pelo id */
        $sql = "DELETE FROM noticias WHERE id = $idNoticia";
    }else {
        /* SQL do editor: pode apagar somente suas próprias noticias 
        (pelo id da notícia e pelo seu próprio id) */
        $sql = "DELETE FROM noticias WHERE id = $idNoticia
                AND usuario_id = $idUsuarioLogado";
    }

    mysqli_query($conexao, $sql) or die(mysqli_error($conexao));
} // fim excluirNoticia 

/* Funções usadas nas páginas na área pública */


/* Usada em index.php */
function lerTodasNoticias($conexao){
        $sql = "SELECT id, data, titulo, resumo, imagem FROM noticias ORDER BY data DESC";

    $resultado = mysqli_query($conexao, $sql)
                or die(mysqli_error($conexao));

     
    $noticias = [];

    while($noticia = mysqli_fetch_assoc($resultado)){
        
        array_push($noticias, $noticia);
    }


    return $noticias;
} // fim lerTodasNoticias

/* Usada em noticia.php */
function lerDetalhes($conexao, $id){
    $sql = "SELECT  noticias.id, 
                    noticias.titulo,
                    noticias.data,
                    noticias.imagem,
                    noticias.texto,
                    usuarios.nome
                FROM noticias INNER JOIN usuarios
                ON noticias.usuario_id = usuarios.id
                WHERE noticias.id = $id";
    $resultado = mysqli_query($conexao, $sql)
                        or die(mysqli_error($conexao));
    return mysqli_fetch_assoc($resultado);
}// fim lerDetalhes

/* Usada em resultados.php */
function busca($conexao, $termo){
    $sql = "SELECT * FROM noticias WHERE titulo LIKE '%$termo%' OR
                                         texto LIKE '%$termo%' OR
                                         resumo LIKE '%$termo%' 
                                    ORDER BY data DESC"; 

    $resultado = mysqli_query($conexao, $sql)
                or die(mysqli_error($conexao));

    $noticias = [];

    while($noticia = mysqli_fetch_assoc($resultado)){
        array_push($noticias, $noticia);
    }

    return $noticias;
} // Fim busca