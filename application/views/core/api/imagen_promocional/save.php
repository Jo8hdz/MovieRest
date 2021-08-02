<?php echo form_open_multipart(); ?>



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


<?php if ($imagen != ""): ?>
    <img class="img-small" src="<?php echo base_url() ?>uploads/api/<?php echo $imagen ?>">
<?php endif; ?>

<?php echo form_submit('submit', 'Guardar', 'class="btn btn-primary"'); ?>

<?php echo form_close(); ?>