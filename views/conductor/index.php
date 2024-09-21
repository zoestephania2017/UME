<?php if ($_SESSION['usuario']->id_rol == "1" || $_SESSION['usuario']->id_rol == "2"): ?>


    <?php include 'views/layouts/navegacion.php'; ?>
    <main id="main" class="main">
        <?php if (isset($_SESSION['registrar']) && $_SESSION['registrar'] == 'completado'): ?>
            <script>
                mensaje('Conductor', 'Modificado');
            </script>
        <?php elseif (isset($_SESSION['registrar']) && $_SESSION['registrar'] == 'fallido'): ?>
            <script>
                mensajeadvertencia();
            </script>   
        <?php elseif (isset($_SESSION['registrar']) && $_SESSION['registrar'] == 'eliminar'): ?>
            <script>
                mensaje('Conductor', 'Eliminado');
            </script>

        <?php endif; ?>
        <?php utilidades::destruirSesion('registrar') ?>



        <div class="pagetitle">
            <h1>Ver Conductores</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">Lista de Conductores Registrados</li>
                </ol>
            </nav>
        </div>

        <section class="section">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="table-responsive">
                                
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

                                        <?php while ($conductor = $conductores->fetch_object()): ?> 
                                            <tr>

                                                <th><?= $conductor->identidad ?></th>
                                                <td><?= $conductor->primer_nombre ?> <?= $conductor->segundo_nombre ?> </td>
                                                <td><?= $conductor->primer_apellido ?> <?= $conductor->segundo_apellido ?></td>
                                                <td><?= $conductor->estado_civil ?></td>
                                                <td><?= $conductor->genero ?></td>
                                                <td><?= $conductor->fecha_nacimiento ?></td>
                                                <td><?= $conductor->direccion ?></td>
                                                <td><?= $conductor->telefono ?></td>
                                                <td><?= $conductor->departamento ?></td>
                                                <td><?= $conductor->ciudad ?></td>
                                                <td><?= $conductor->fecha_ingreso ?> </td>
                                                <td><?= $conductor->estado ?></td>
                                                <?php if ($_SESSION['usuario']->id_rol == "1" || $_SESSION['usuario']->id_rol == "2"): ?>
                                                    <td>   

                                                        <a class="bi bi-pencil-fill" href="<?= base_url ?>conductor/edit&id=<?= $conductor->id ?>&iddepartamento=<?= $conductor->iddepartamento ?>" ></a>
                                                        <?php if ($_SESSION['usuario']->id_rol == "1"): ?>
                                                            <a class="bi bi-eraser-fill" href="<?= base_url ?>conductor/eliminar&id=<?= $conductor->id ?>" onclick="return confirm('¿Esta Seguro que Desea Eliminar a Este Conductor?')"></a>
                                                        <?php endif; ?>
                                                    </td>   

                                                <?php endif; ?>
                                            </tr>

                                        <?php endwhile; ?> 



                                        </var>
                                    </tbody>
                                </table>
                              
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </section>

    </main>


    <?php include ('views/layouts/piepagina.php'); ?>


<?php else: ?>

    <?php header("Location:" . base_url . "inicio/index"); ?>

<?php endif; ?>

