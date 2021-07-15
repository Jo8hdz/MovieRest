
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