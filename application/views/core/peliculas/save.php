<?php echo form_open_multipart(); ?>

<?php if (validation_errors() !== ""): ?>
    <div class="alert alert-danger" role="alert">
        <?php echo validation_errors(); ?>
    </div>
<?php endif; ?>


<div class="form-group">
    <?php
    echo form_label('Nombre', 'nombre');
    $input = array(
        'name' => 'nombre',
        'value' => $nombre,
        'class' => 'form-control',
        'placeholder' => "Nombre"
    );
    echo form_input($input)
    ?>
</div>


<div class="form-group">
    <?php
    echo form_label('Descripción', 'descripcion');
    $input = array(
        'name' => 'descripcion',
        'value' => $descripcion,
        'class' => 'form-control',
    );
    echo form_textarea($input)
    ?>
</div>

<div class="form-group">
    <?php
    echo form_label('Año', 'anio');
    $input = array(
        'name' => 'anio',
        'value' => $anio,
        'type' => 'number',
        'class' => 'form-control',
        'placeholder' => "Año"
    );
    echo form_input($input)
    ?>
</div>

<div class="form-group">
    <?php
    echo form_label('Imagen', 'imagen');
    $input = array(
        'name' => 'imagen',
        'type' => 'file',
        'class' => 'form-control',
    );
    echo form_input($input)
    ?>
</div>

<div class="form-group">
    <?php 
    echo form_label('Tipo', 'genero');
    echo form_dropdown('idGenero', $genero, $idGenero,'class="form-control input-lg"');
    ?>
</div>

<?php if ($imagen != ""): ?>
    <img class="img-small" src="<?php echo base_url() ?>uploads/peliculas/<?php echo $imagen ?>">
<?php endif; ?>

<?php echo form_submit('submit', 'Guardar', 'class="btn btn-primary"'); ?>

<?php echo form_close(); ?>