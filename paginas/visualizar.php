<?php
//ordeno o array de clientes
if(isset($_POST['ordem'])){
    if($_POST['ordem'] == "asc")
        $complemento = " order by id asc";
    elseif($_POST['ordem'] == "desc")
        $complemento = " order by id desc";

    $clientes = new \EJS\Database\Clientes(\EJS\Database\Conexao::getConnection());
    $registros = $clientes->read($complemento);
}else{
    $clientes = new \EJS\Database\Clientes(\EJS\Database\Conexao::getConnection());
    $registros = $clientes->read();
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>POO - Fase04</title>
    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet" media="screen">
</head>
<body>

<div class="container-fluid">
    <h1>Clientes cadastrados no sistema</h1>


    <form method="post" action="" class="form-horizontal">
        <fieldset>
            <label>Ordenar registros de forma:</label>
            <select name="ordem">
                <option value="asc" <?php if(isset($_POST['ordem']) and $_POST['ordem'] == "asc"){ echo "selected";  }else null; ?>>Ascendente</option>
                <option value="desc" <?php if(isset($_POST['ordem']) and $_POST['ordem'] == "desc"){ echo "selected";  }else null; ?> >Descendente</option>
            </select>
            <button type="submit" class="btn btn-warning" name="submit"><i class="icon-retweet icon-white"></i> Classificar</button>
        </fieldset>
    </form>
    <hr/>
    <div class="accordion" id="accordion2">
        <?php foreach ($registros as $dados) { ?>
            <div class="accordion-group">
                <div class="accordion-heading">
                    <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="<?php echo '#collapse'.$dados['id'];?>">
                        <?php
                        $tipo = $dados['tipo'];
                        if($tipo == "PF"){
                            $descricao = "Pessoa Física";
                            $celular = '<strong>Celular: </strong>'.$dados['celular'].'<br/>';
                            $sede = "";
                        }else{
                            $descricao = "Pessoa Jurídica";
                            $celular = "";
                            $sede = '<strong>Estado de origem da empresa (Estado Sede) : </strong>'.$dados['sede'].'<br/>';
                        }
                        echo '<h4>Registro [ID: '.$dados['id'].'] </h4> <strong>Nome: </strong>'.$dados['nome']. ' - ' .$descricao;
                        ?>
                    </a>
                </div>
                <div id="<?php echo 'collapse'.$dados['id'];?>" class="accordion-body collapse">
                    <div class="accordion-inner">
                        <?php
                        echo '<strong>CPF: </strong>'.$dados['cpfcnpj'].'<br/>';
                        echo '<strong>Endereço: </strong>'.$dados['endereco'].'<br/>';
                        echo '<strong>EMail: </strong>'.$dados['email'].'<br/>';
                        echo '<strong>Grau de Importância: </strong>'.$dados['grau_importancia'].' estrela(s).<br/>';

                        echo '<strong>Tipo: </strong>'.$descricao.'<br/>';

                        if(isset($celular))
                            echo $celular;

                        if(isset($sede))
                            echo $sede;

                        if(!is_null($dados['endereco_cobranca']) and !is_null($dados['cidade_cobranca'])){
                            echo '--------------------------------------------------------------------------------<br/>';
                            echo '<strong>Endereço de Cobrança: </strong>'. $dados['endereco_cobranca'] .'<br/>';
                            echo '<strong>Cidade de Cobrança: </strong>'. $dados['cidade_cobranca'] .'<br/>';
                        }
                        ?>
                    </div>
                </div>
            </div>
        <?php }?>
    </div>

</div>

<script src="http://code.jquery.com/jquery-latest.js"></script>
<script src="js/bootstrap.min.js"></script>

</body>
</html>
