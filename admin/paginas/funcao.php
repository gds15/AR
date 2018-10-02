<?php

$id = $funcao = "";

//verificar se está editando
if ( isset ( $_GET["id"] ) ) {

    //recuperar o id por get
    $id = trim( $_GET["id"] );
    //selecionar os dados do banco
    $sql = "select * from funcao where id = ? limit 1";
    //prepare
    $consulta = $pdo->prepare( $sql );
    //passar um parametro
    $consulta->bindParam( 1, $id );
    //executa
    $consulta->execute();
    //separar os dados
    $dados = $consulta->fetch(PDO::FETCH_OBJ);

    $id = $dados->id;
    $funcao = $dados->funcao;

}
?>

<div class="container py-1">
    <div class="row">
        <div class="mx-auto col-sm-12">
                    <!-- form funcao -->
                    <div class="card">
                        <div class="card-header">
                            <h4 class="mb-0">Cadastro de Função</h4>
                        </div>
                        <div class="card-body">
                            <form name="formcadastro" class="form" method="POST" action="salvarFuncao" novalidate>
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label form-control-label">ID:</label>
                                    <div class="col-lg-9">
                                        <input class="form-control" readonly type="text" value="<?=$id;?>">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label form-control-label">Função:</label>
                                    <div class="col-lg-9">
                                        <input class="form-control" id="func" type="text" 
                                        required 
						                data-validation-required-message="Preencha a função" value="<?=$funcao;?>">
                                    </div>
                                </div>
                                
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label form-control-label"></label>
                                    <div class="col-lg-9"> 
                                        <button type="submit" class="btn btn-primary">Salvar</button>
                                    </div>
                                </div>
                            </form>
                        </div>

                    </div>
        </div>
    </div>
</div>

