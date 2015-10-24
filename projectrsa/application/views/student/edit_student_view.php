
<div class="row">
    <div class="box col-md-12" id="head">
        <div class="box-content">
         <output id='list'><span> <img style="width: 200px; height: 200px; margin-left:355px;" class="thumb" src=<?=$student->photo?> title=""></span></output>
            <input style="width: 400px; margin-left:300px;" id='files' name='files' class= 'files' type='file'  size='5' required/> 
            <table class="table table-striped table-bordered responsive" style="margin-top:12px;">
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Cédula</th>
                        <th>Carrera</th>
                        <th>Inglés</th>
                        <th>Proyectos</th>
                    </tr>
                </thead>
                <tbody>
                 
                    <?php
                        if ($student != null) {
                        ?>
                        <tr>
                            <td id="name<?=$student->id?>"><input type="text" id="name" value="<?=$student->name?>" ></innput></td>
                            <td class="grid_3" id="cedula<?=$student->id?>"><input type="text" id="cedula" value="<?=$student->idn?>" </innput></td>
                            <td class="grid_3" id="career<?=$student->id?>"><select id="careers"><?php echo "$careers"; ?></select></td>
                            <td class="grid_3" id="english<?=$student->id?>"><select id="english"><option>Principiante</option><option>Intermedio</option><option>Avanzado</option></select></td>
                            <td class="grid_3" id="projects<?=$student->id?>"><select id="proyectos"><?php echo "$projects"; ?></select>
                                <div class="btn-group">
                                    <a class="btn btn-default btn-sm" href="#"><i class="glyphicon glyphicon-user icon-red"></i> Herramientas</a>
                                    <a class="btn btn-default btn-sm" data-toggle="dropdown" href="#"><span class="caret"></span></a>
                                    <ul class="dropdown-menu">
                                        <li><a  class="agregar" href="#"><i class="glyphicon glyphicon-plus-sign agregar"></i> Agregar</a></li>
                                        <li><a  class="editar" href="#"><i class="glyphicon glyphicon-pencil"></i> Editar</a></li>
                                        <li><a  class="eliminar" href="#"><i class="glyphicon glyphicon-trash"></i> Eliminar</a></li>
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
             <input class="btn btn-primary box col-md-12 edit" type="button" value="Editar" id="editar_estudiante">
            <br />
            <h4>Comentarios:</h4>
            <div id="comments" class='comments'>
            <?php if(isset($comments)){
                echo $comments;
                echo "</div> ";
            } ?>
            <br /><br />
            <form id="comment" method="post" action=""> 
                <textarea name="new_comment" id="new_comment" placeholder="Escriba su comentario" style="height:100px; width:100%;" required></textarea><br />
                <input type='hidden' name='id' class='id' id='id' value="<?=$student->id?>"><br/>
                <input class="btn btn-primary box col-md-12 comentar" type="submit" value="Comentar" id="comentar">
            </form>
            
        </div>
    </div>
</div>