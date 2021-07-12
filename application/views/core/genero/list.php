<a class="btn btn-danger" href="<?php echo base_url() ?>core/dashboard/type_movie_save">
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
        <?php foreach ($types_movie as $key => $type_movie) : ?>
            <tr>
                <th scope = "row"><?php echo $type_movie->type_movie_id ?></th>
                <td><?php echo $type_movie->name ?></td>
                <td>
                    <a target="_blank" class="btn btn-primary btn-sm" href="<?php echo base_url() ?>core/dashboard/type_movie_show/<?php echo $type_movie->type_movie_id ?>">
                        <i class="fa fa-eye"></i>
                    </a>
                    <a class="btn btn-danger btn-sm" href="<?php echo base_url() ?>core/dashboard/type_movie_delete/<?php echo $type_movie->type_movie_id ?>">
                        <i class="fa fa-trash"></i>
                    </a>
                    <a class="btn btn-primary btn-sm" href="<?php echo base_url() ?>core/dashboard/type_movie_save/<?php echo $type_movie->type_movie_id ?>">
                        <i class="fa fa-pencil-alt"></i>
                    </a>
                </td>
            </tr>
        <?php endforeach;
        ?>
    </tbody>
</table>