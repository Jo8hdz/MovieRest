<?php echo form_open_multipart(); ?>

<?php if ($movie_id !== ""): ?>
    <a href="<?php echo base_url(); ?>/core/dashboard/movie_save" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i> Crear</a>
    <br><br>
<?php endif; ?>

<?php if (validation_errors() !== ""): ?>
    <div class="alert alert-danger" role="alert">
        <?php echo validation_errors(); ?>
    </div>
<?php endif; ?>


<div class="form-group">
    <?php
    echo form_label('Nombre', 'name');
    $input = array(
        'name' => 'name',
        'value' => $name,
        'class' => 'form-control',
        'placeholder' => "Nombre"
    );
    echo form_input($input)
    ?>
</div>


<div class="form-group">
    <?php
    echo form_label('Descripción', 'description');
    $input = array(
        'name' => 'description',
        'value' => $description,
        'class' => 'form-control',
    );
    echo form_textarea($input)
    ?>
</div>

<div class="form-group">
    <?php
    echo form_label('Año', 'year');
    $input = array(
        'name' => 'year',
        'value' => $year,
        'type' => 'number',
        'class' => 'form-control',
        'placeholder' => "Año"
    );
    echo form_input($input)
    ?>
</div>
<!-- si se activa las funciones para upload video comentar todo dentro del siguiente div --> 
<div class="form-group">
    <?php
    /*echo form_label('URL', 'video');
    $input = array(
        'name' => 'video',
        'value' => $video,
        'class' => 'form-control',
        'placeholder' => "URL del video"
    );
    echo form_input($input)*/
    ?>
</div>

<div class="form-group">
    <?php
    echo form_label('Tipo', 'type_movie');
    echo form_dropdown('type_movie_id', $types_movie, $type_movie_id, 'class="form-control input-lg"');
    ?>
</div>





<table> 
    <tr>
        <td>
            <div class="form-group">
                <?php
                echo form_label('Imagen', 'image');
                $input = array(
                    'name' => 'image',
                    'type' => 'file',
                    'class' => 'form-control',
                );
                echo form_input($input)
                ?>
            </div>
            <a class="text-danger" href="<?php echo base_url()?>core/dashboard/movie_delete_image/<?php echo $movie_id ?>">Borrar imagen</a>
        </td>
        
        <td>
            <?php if ($image != ""): ?>               
                <img class="img-small" src="<?php echo base_url() ?>uploads/movies/<?php echo $image ?>">
                <br><br>
            <?php endif; ?>
        </td>
    </tr>
    <tr>
        <td>
            <div class="form-group">
                <?php
                echo form_label('Video', 'video');
                $input = array(
                    'name' => 'video',
                    'type' => 'file',
                    'class' => 'form-control',
                );
                echo form_input($input)
                ?>
            </div>
            <a class="text-danger" href="<?php echo base_url()?>core/dashboard/movie_delete_video/<?php echo $movie_id ?>">Borrar película</a>
        </td>
        
        <td>
            <?php if ($video != ""): ?>                
                
                <video class="img-small" src="<?php echo base_url() ?>uploads/movies/<?php echo $video ?>">
                
                <br><br> 
            <?php endif; ?>
        </td>
    </tr>
</table>

<br><br> 
<br><br> 

<?php echo form_submit('submit', 'Guardar', 'class="btn btn-primary"'); ?>

<?php echo form_close(); ?> 