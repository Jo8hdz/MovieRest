<a class="btn btn-danger" href="<?php echo base_url() ?>core/dashboard/genero_save">
    <i class="fa fa-plus"></i> Crear
</a>
<br><br>
<table class="table">
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Nombre</th>
            <th scope="col">Acciones</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($genero as $key => $genero) : ?>
            <tr>
                <th scope = "row"><?php echo $genero->idGenero ?></th>
                <td><?php echo $genero->nombre ?></td>
                <td>
                    <a target="_blank" class="btn btn-primary btn-sm" href="<?php echo base_url() ?>core/dashboard/genero_show/<?php echo $genero->idGenero ?>">
                        <i class="fa fa-eye"></i>
                    </a>
                    <a class="btn btn-danger btn-sm" href="<?php echo base_url() ?>core/dashboard/genero_delete/<?php echo $genero->idGenero ?>">
                        <i class="fa fa-trash"></i>
                    </a>
                    <a class="btn btn-primary btn-sm" href="<?php echo base_url() ?>core/dashboard/genero_save/<?php echo $genero->idGenero ?>">
                        <i class="fa fa-pencil-alt"></i>
                    </a>
                </td>
            </tr>
        <?php endforeach;
        ?>
    </tbody>
</table>