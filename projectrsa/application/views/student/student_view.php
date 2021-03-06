<div class="row">
    <div class="box col-md-12" id="head">
        <div class="box-content">
            <table class="table table-striped table-bordered responsive">
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Cédula</th>
                        <th>Carrera</th>
                        <th>Inglés</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                 
                    <?php
                        if ($students != null) {
                        foreach($students as $fila):
                        ?>
                        <tr>
                            <td id="name<?=$fila->id?>"><?=$fila->name?></td>
                            <td class="grid_2" id="cedula<?=$fila->id?>"><?=$fila->idn?></td>
                            <td class="grid_3" id="career<?=$fila->id?>"><?=$fila->career_id?></td>
                            <td class="grid_3" id="english<?=$fila->id?>"><?=$fila->englishlvl?></td>
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
