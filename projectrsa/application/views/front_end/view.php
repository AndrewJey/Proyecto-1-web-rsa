
<div class="row">
    <div class="box col-md-12" id="head">
        <div class="box-content">
        <span> <img style="width: 200px; height: 200px; margin-left:355px;" class="thumb" src=<?=$student->photo?> title=""></span>
            <table class="table table-striped table-bordered responsive" style="margin-top:12px;">
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Cédula</th>
                        <th>Carrera</th>
                        <th>Inglés</th>
                    </tr>
                </thead>
                <tbody>
                 
                    <?php
                        if ($student != null) {
                        ?>
                        <tr>
                            <td id="name<?=$student->id?>"><label><?php echo "$student->name" ?> </label></td>
                            <td class="grid_2" id="cedula<?=$student->id?>"><label><?php echo "$student->idn" ?></label></td>
                            <td class="grid_3" id="career<?=$student->id?>"><label><?php echo "$student->career_id" ?></label></td>
                            <td class="grid_3" id="english<?=$student->id?>"><label><?php echo "$student->englishlvl"?></label></td>
                            <td class="grid_3" id="projects<?=$student->id?>"><select id="proyectos"><?php echo "$projects"; ?></select>
                                <div class="btn-group">
                                    <a class="btn btn-default btn-sm" href="#"><i class="glyphicon glyphicon-user icon-red"></i> Herramientas</a>
                                    <a class="btn btn-default btn-sm" data-toggle="dropdown" href="#"><span class="caret"></span></a>
                                    <ul class="dropdown-menu">
                                        <li><a  class="listar" href="#"><i class="glyphicon glyphicon-eye-open"></i> Ver</a></li>
                                    </ul>
                                </div>
                            </td>
                        </tr>
                        <?php
                    }
                    ?>
                </tbody>
            </table>
            <h3>Habilidades</h3>
            <?php echo "$skills"; ?><br /><br />
            <h4>Comentarios:</h4>
            <div id="comments" class='comments'>
            <?php if(isset($comments)){
                echo $comments;
                echo "</div> ";
            } ?>
            <br /><br />
        </div>