
<div class="form-group">
    <?php
    echo form_label('Nombre', 'nombre');
    $input = array(
        'name' => 'nombre',
        'value' => $nombre,
        'readonly' => 'readonly',
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
        'readonly' => 'readonly',
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
        'readonly' => 'readonly',
        'value' => $anio,
        'type' => 'number',
        'class' => 'form-control',
        'placeholder' => "Año"
    );
    echo form_input($input)
    ?>
</div>

<?php if ($imagen != ""): ?>
    <img class="img-small" src="<?php echo base_url() ?>uploads/peliculas/<?php echo $imagen ?>">
<?php endif; ?>
