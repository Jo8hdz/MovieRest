<a class="btn btn-danger" href="<?php echo base_url() ?>core/dashboard/pelicula_save">
    <i class="fa fa-plus"></i> Crear
</a>
<br><br>
<table class="table">
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Nombre</th>
            <th scope="col">Año</th>
            <th scope="col">Imagen</th>
            <th scope="col">Genero</th>
            <th scope="col">Acciones</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($peliculas as $key => $pelicula) : ?>
            <tr>
                <th scope = "row"><?php echo $pelicula->idPelicula ?></th>
                <td><?php echo $pelicula->nombre ?></td>
                <td><?php echo $pelicula->anio ?></td>
                <td>
                    <?php if ($pelicula->imagen != ""): ?>
                        <img class="img-small-2" src="<?php echo base_url() ?>uploads/peliculas/<?php echo $pelicula->imagen ?>">
                    <?php endif; ?>
                </td>
                <td><?php echo $pelicula->genero ?></td>
                <td>
                    <a target="_blank" class="btn btn-primary btn-sm" href="<?php echo base_url() ?>core/dashboard/pelicula_show/<?php echo $pelicula->idPelicula ?>">
                        <i class="fa fa-eye"></i>
                    </a>
                    <a class="btn btn-danger btn-sm" href="<?php echo base_url() ?>core/dashboard/pelicula_delete/<?php echo $pelicula->idPelicula ?>">
                        <i class="fa fa-trash"></i>
                    </a>
                    <a class="btn btn-primary btn-sm" href="<?php echo base_url() ?>core/dashboard/pelicula_save/<?php echo $pelicula->idPelicula ?>">
                        <i class="fa fa-pencil-alt"></i>
                    </a>
                </td>
            </tr>
        <?php endforeach;
        ?>
    </tbody>
</table>