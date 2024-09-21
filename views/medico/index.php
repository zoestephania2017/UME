<?php if ($_SESSION['usuario']->id_rol == "1" || $_SESSION['usuario']->id_rol == "2"): ?>


    <?php include 'views/layouts/navegacion.php'; ?>
    <main id="main" class="main">
        <?php if (isset($_SESSION['registrar']) && $_SESSION['registrar'] == 'completado'): ?>
            <script>
                mensaje('Médico', 'Modificado');
            </script>
        <?php elseif (isset($_SESSION['registrar']) && $_SESSION['registrar'] == 'fallido'): ?>
            <script>
                mensajeadvertencia();
            </script>

        <?php elseif (isset($_SESSION['registrar']) && $_SESSION['registrar'] == 'eliminar'): ?>
            <script>
                mensaje('Médico', 'Eliminado');
            </script>


        <?php endif; ?>
        <?php utilidades::destruirSesion('registrar') ?>



        <div class="pagetitle">
            <h1>Ver Médicos</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">Lista de Médicos Registrados</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="table-responsive">
                                <!-- Table with stripped rows -->
                                <table class="table datatable">

                                    <thead>
                                        <tr>
                                            <th scope="col">Identidad:</th>
                                            <th scope="col">Nombres:</th>
                                            <th scope="col">Apellidos:</th>
                                            <th scope="col">Estado Civil:</th>
                                            <th scope="col">Genero:</th>
                                            <th scope="col">Fecha de Nacimiento:</th>
                                            <th scope="col">Dirección:</th>
                                            <th scope="col">Teléfono:</th>
                                            <th scope="col">Departamento:</th>  
                                            <th scope="col">Ciudad:</th>   
                                            <th scope="col">Fecha de Ingreso:</th>
                                            <th scope="col">Estado:</th>  
                                            <?php if ($_SESSION['usuario']->id_rol == "1" || $_SESSION['usuario']->id_rol == "2"): ?>
                                                <th scope="col">Acciones:</th> 
                                            <?php endif; ?>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        <?php while ($medico = $medicos->fetch_object()): ?> 
                                            <tr>

                                                <th><?= $medico->identidad ?></th>
                                                <td><?= $medico->primer_nombre ?> <?= $medico->segundo_nombre ?> </td>
                                                <td><?= $medico->primer_apellido ?> <?= $medico->segundo_apellido ?></td>
                                                <td><?= $medico->estado_civil ?></td>
                                                <td><?= $medico->genero ?></td>
                                                <td><?= $medico->fecha_nacimiento ?></td>
                                                <td><?= $medico->direccion ?></td>
                                                <td><?= $medico->telefono ?></td>
                                                <td><?= $medico->departamento ?></td>
                                                <td><?= $medico->ciudad ?></td>
                                                <td><?= $medico->fecha_ingreso ?> </td>
                                                <td><?= $medico->estado ?></td>

                                                <?php if ($_SESSION['usuario']->id_rol == "1" || $_SESSION['usuario']->id_rol == "2"): ?>
                                                    <td>   

                                                        <a class="bi bi-pencil-fill" href="<?= base_url ?>medico/edit&id=<?= $medico->id?>&iddepartamento=<?= $medico->iddepartamento?>" ></a>
                                                        <?php if ($_SESSION['usuario']->id_rol == "1"): ?>
                                                            <a class="bi bi-eraser-fill" href="<?= base_url ?>medico/eliminar&id=<?= $medico->id ?>" onclick="return confirm('¿Esta Seguro que Desea Eliminar Este Medico?')"></a>
                                                        <?php endif; ?>
                                                    </td>   

                                                <?php endif; ?>
                                            </tr>

                                        <?php endwhile; ?> 




                                        </var>
                                    </tbody>
                                </table>
                                <!-- End Table with stripped rows -->
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </section>

    </main><!-- End #main -->


    <?php include ('views/layouts/piepagina.php'); ?>


<?php else: ?>

    <?php header("Location:" . base_url . "inicio/index"); ?>

<?php endif; ?>

