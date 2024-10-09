<!-- Solo los usuarios con estos roles pueden ver esta página -->
     
<?php if ($_SESSION['usuario']->id_rol == "1" || $_SESSION['usuario']->id_rol == "2"): ?>


    <?php include 'views/layouts/navegacion.php'; ?>



    <main id="main" class="main">

     <!-- Muestra el título de la página y una pequeña navegación tipo breadcrumb -->
                        
        <div class="pagetitle">
            <h1>Ver Centros Asistenciales</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">Lista de Todos los Centros Asistenciales Registrados al Nivel Nacional</li>
                </ol>
            </nav>
        </div>

        <section class="section">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">

                        <!-- Muestra mensajes al usuario dependiendo de las acciones realizadas -->
                            <?php if (isset($_SESSION['registrar']) && $_SESSION['registrar'] == 'completado'): ?>
                                <script>
                                    mensaje('Centro Asistencial', 'Modificado');
                                </script>
                            <?php elseif (isset($_SESSION['registrar']) && $_SESSION['registrar'] == 'fallido'): ?>
                                <script>
                                    mensajeadvertencia();
                                </script>

                            <?php elseif (isset($_SESSION['registrar']) && $_SESSION['registrar'] == 'eliminar'): ?>
                                <script>
                                    mensaje('Centro Asistencial', 'Eliminado');
                                </script>
                            <?php endif; ?>
                            <?php utilidades::destruirSesion('registrar') ?>
                            <div class="table-responsive">
                                <!-- Table with stripped rows -->
                                <table class="table datatable">

                                    <thead>
                                        <tr>

                                            <th scope="col">N.º:</th>
                                            <th scope="col">Centro Asistencial:</th>
                                            <th scope="col">Departamento:</th>
                                            <th scope="col">Ciudad:</th>
                                            <th scope="col">Estado:</th>
                                            <?php if ($_SESSION['usuario']->id_rol == "1" || $_SESSION['usuario']->id_rol == "2"): ?>
                                                <th scope="col">Acciones:</th> 
                                            <?php endif; ?>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        <?php while ($centro = $centroasistenciales->fetch_object()): ?> 
                                            <tr>

                                                <th><?= $centro->id ?></th>
                                                <td><?= $centro->descripcion ?> </td>
                                                <td><?= $centro->departamento ?> </td>
                                                <td><?= $centro->ciudad ?> </td>
                                                <td><?= $centro->estado ?></td>
                                                <?php if ($_SESSION['usuario']->id_rol == "1" || $_SESSION['usuario']->id_rol == "2"): ?>
                                                    <td>   

                                                        <a class="bi bi-pencil-fill" href="<?= base_url ?>centroasistencial/edit&id=<?= $centro->id ?>&iddepartamento=<?= $centro->iddepartamento?>" ></a>
                                                        <?php if ($_SESSION['usuario']->id_rol == "1"): ?>
                                                            <a class="bi bi-eraser-fill" href="<?= base_url ?>centroasistencial/eliminar&id=<?= $centro->id ?>" onclick="return confirm('¿Estas Seguro que Desea Eliminar Este Centro Asistencial?')"></a>
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
<!-- Redirección en Caso de No Tener Permisos a la pag de inicio -->
    <?php header("Location:" . base_url . "inicio/index"); ?>

<?php endif; ?>

