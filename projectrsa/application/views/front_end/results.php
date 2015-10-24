<div class="row">
    <div class="box col-md-12" id="head">
        <div class="box-content">
            <table class="table table-striped table-bordered responsive">
                <thead>
                    <tr>
                        <th>Foto</th>
                        <th>Nombre</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                 
                    <?php
                        if ($students != null) {
                        foreach($students as $fila):
                        ?>
                        <tr>
                            <td class="grid_2" id="photo<?=$fila->id?>"><img src="<?=$fila->photo?>" style="width: 100px; height: 100px;"></td>
                            <td id="name<?=$fila->id?>"><?=$fila->name?></td>                            
                            <td class="center">
                                <a id="<?=$fila->id?>" class="btn btn-success listar" href="#">
                                    <i class="glyphicon glyphicon-zoom-in icon-white"></i>
                                    Ver
                                </a>
                            </td>
                        </tr>
                        <?php
                        endforeach;
                    }
                    ?>
                </tbody>
            </table>
        </div>
