<?php
require "inc/funcoes-noticias.php"; 
require "inc/cabecalho.php"; 

$termo = $_GET['busca'];
$resultadoDaBusca = busca($conexao, $termo);
//var_dump($resultadoDaBusca);
?>


<div class="row bg-white rounded shadow my-1 py-4">
    <h2 class="col-12 fw-light">
        Você procurou por <span class="badge bg-dark"><?=$termo?></span> e
        obteve <span class="badge bg-info"><?=count($resultadoDaBusca)?></span> resultados
    </h2>
    
    <?php foreach($resultadoDaBusca as $resultado) { ?>
    <div class="col-12 my-1">
        <article class="card">
            <div class="card-body">
                <h3 class="fs-4 card-title fw-light">Título da notícia...
                    <?=$resultado['titulo']?>
                </h3>
                <p class="card-text">
                    <time><?=formataData($resultado['data'])?></time> - 
                    <?=$resultado['resumo']?>
                </p>
                
                <a href="noticia.php?id=<?=$resultado['id']?>" class="btn btn-primary btn-sm">Continuar lendo</a>
            </div>
        </article>
    </div>
    <?php } ?>
        </article>
    </div>


</div>     

<?php 
require_once "inc/rodape.php";
?>

