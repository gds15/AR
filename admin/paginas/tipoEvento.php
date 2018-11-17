<?php

$id = $tipo = "";

//verificar se está editando
if ( isset ($parametro[1] ) ) {

    //recuperar o id por get
    $id = trim( $parametro[1] );
    //selecionar os dados do banco
    $sql = "select * from tipoevento where id = ? limit 1";
    //prepare
    $consulta = $pdo->prepare( $sql );
    //passar um parametro
    $consulta->bindParam( 1, $id );
    //executa
    $consulta->execute();
    //separar os dados
    $dados = $consulta->fetch(PDO::FETCH_OBJ);

    $id = $dados->id;
    $tipo = $dados->tipo;

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
                        <form name="formcadastro" method="post" action="salvarTipoEvento" novalidate>
                            <fieldset>
                                <legend>Preencha os campos:</legend>

                                <div class="control-group">
                                    <label for="id">ID:</label>
                                    <div class="controls">
                                        <input type="text" name="id"
                                        class="form-control"
                                        readonly
                                        value="<?=$id;?>">
                                    </div>
                                </div>

                                <div class="control-group">
                                    <label for="tipo">
                                    Tipo Evento:</label>
                                    <div class="controls">
                                        <input type="text" 
                                        name="tipo"
                                        class="form-control"
                                        required
                                        data-validation-required-message="Preencha o tipo"
                                        value="<?=$tipo;?>">
                                    </div>
                                </div>
                                <br>
                                
                                <button type="submit" class="btn btn-outline-primary"><i class="fas fa-save"></i> Salvar</button>

                                <!-- Button trigger modal -->
                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#ajudaTipoE">
                                  AJUDA!!!
                                </button>
                               
                               

                            </fieldset>
		                </form>

                        </div>
                    </div>
        </div>
    </div>
</div>

