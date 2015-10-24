
<div class="row">
    <div class="box col-md-12" id="head">
        <div class="box-content">
            <table class="table table-striped table-bordered responsive scroll">
                <thead>
                    <tr>
                        <th>Código</th>
                        <th>Nombre</th>
                        <th>Acciones</th>

                    </tr>
                </thead>
                <tbody>

                    <?php
                    if ($careers != null) {
                        foreach($careers as $fila):
                            ?>
                        <tr>
                        <td class="grid_2" id="code<?=$fila->id?>"><?=$fila->code?></td>
                            <td class="grid_3" id="name<?=$fila->id?>"><?=$fila->name?></td>
                            <td class="center">
                                <a id="<?=$fila->id?>" class="btn btn-success listar" href="#">
                                    <i class="glyphicon glyphicon-zoom-in icon-white"></i>
                                    Ver
                                </a>
                                <a id="<?=$fila->id?>"  class="btn btn-info editar" href="#">
                                    <i class="glyphicon glyphicon-edit icon-white"></i>
                                    Editar
                                </a>
                                <a id="<?=$fila->id?>" class="btn btn-danger eliminar" href="#">
                                    <i class="glyphicon glyphicon-trash icon-white"></i>
                                    Borrar
                                </a>
                            </td>
                        </tr>
                        <?php
                        endforeach;
                    }
                    ?>
                </tbody>
            </table>
            <input class="btn btn-primary box col-md-12 agregar" type="button" value="Añadir" id="agregar">
        </div>
