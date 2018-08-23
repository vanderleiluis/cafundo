<?php
/**
 * Created by PhpStorm.
 * User: Vanderlei Weber
 * Date: 23/08/2018
 * Time: 01:23
 */
include_once ('scraping.php');
if(isset($_REQUEST['urlDaPesquisa']))
{
    $urlDaPesquisa = $_REQUEST['urlDaPesquisa'];
    switch ($_REQUEST['urlDaPesquisa'])
    {
        case 'https://www.sciencenews.org/topic/life-evolution':
            $topico = 'Life & Evolution';
            break;
        case'https://www.sciencenews.org/topic/atom-cosmos':
            $topico = 'Atom & Cosmos';
            break;
        case 'https://www.sciencenews.org/topic/body-brain':
            $topico = 'Body & Brain';
            break;
        case 'https://www.sciencenews.org/topic/earth-environment':
            $topico = 'Earth & Environment';
            break;
        case 'https://www.sciencenews.org/topic/genes-cells':
            $topico = 'Genes & Cells';
            break;
        case 'https://www.sciencenews.org/topic/humans-society':
            $topico = 'Humans & Society';
            break;
        case 'https://www.sciencenews.org/topic/math-technology':
            $topico = 'Math & Techology';
            break;
        case 'https://www.sciencenews.org/topic/matter-energy':
            $topico = 'Matter & Energy';
            break;
    }
}
else
{
    $urlDaPesquisa = 'https://www.sciencenews.org/topic/life-evolution';
    $topico = 'Life & Evolution';
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Teste Scraping Science - C4FU - ND0</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/estilo.css">
    <script language="JavaScript" src="js/jquery.min.js"></script>
    <script language="JavaScript" src="js/bootstrap.min.js"></script>
    <script src="https://use.fontawesome.com/releases/v5.2.0/js/all.js" data-auto-replace-svg="nest"></script>
</head>
<body>
<form action="<?php echo $_SERVER['PHP_SELF']; ?>">

<div class="container">
    <div class="row">
        <select id="urlDaPesquisa" name="urlDaPesquisa" class="form-control" onchange="this.form.submit();">
            <option>Escolha um tópico</option>
            <option value="https://www.sciencenews.org/topic/life-evolution">Life & Evolution</option>
            <option value="https://www.sciencenews.org/topic/atom-cosmos">Atom & Cosmos</option>
            <option value="https://www.sciencenews.org/topic/body-brain">Body & Brain</option>
            <option value="https://www.sciencenews.org/topic/earth-environment">Earth & Environment</option>
            <option value="https://www.sciencenews.org/topic/genes-cells">Genes & Cells</option>
            <option value="https://www.sciencenews.org/topic/humans-society">Humans & Society</option>
            <option value="https://www.sciencenews.org/topic/math-technology">Math & Techology</option>
            <option value="https://www.sciencenews.org/topic/matter-energy">Matter & Energy</option>
        </select>
    </div>


    <div class="row">
        <h1>Tópico: <?php echo $topico; ?></h1>
    </div>


    <?php
    $lista = scraping_script($urlDaPesquisa);
    if($lista == false)
    {
?>
        <div class="row">
            Artigos não encontrados
        </div>
<?php
    }
    else {
        $i = 0;
        foreach ($lista[1] as $key => $value) {
            $i++;
            ?>
            <div class="row">
                <div class="col-sm-1">
                    <?= $i; ?>
                </div>
                <div class="col-sm-8">
                    <?php
                        //ajustando a url do link para acesso ao topico original
                        $tamanhoString = strlen($value);
                        $copiaDeValor = $value;
                        $parte1 = substr($value, 0, 45);
                        $parte2 = $urlDaPesquisa;
                        $parte3 = substr($copiaDeValor, 45, $tamanhoString);
                        //Ajuste necessário pois o scraping copiou o link referencial real.
                        echo  $novoLink = $parte1.$parte2.$parte3;
                    ?>
                </div>
                <div class="col-sm-3">
                    <i class="fas fa-images"></i>
                </div>
            </div>
            <?php
        }
    }
?>
</div>


</form>



</body>
</html>

