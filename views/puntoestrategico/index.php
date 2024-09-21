<?php if ($_SESSION['usuario']->id_rol == "1" || $_SESSION['usuario']->id_rol == "2"): ?>


    <?php include 'views/layouts/navegacion.php'; ?>



    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Ver Punto Estrategico</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">Lista de Puntos Estrategicos Registrados al Nivel Nacional</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">


                            <?php if (isset($_SESSION['registrar']) && $_SESSION['registrar'] == 'completado'): ?>
                                <script>
                                    mensaje('Punto Estrategico', 'Modificado');
                                </script>
                            <?php elseif (isset($_SESSION['registrar']) && $_SESSION['registrar'] == 'fallido'): ?>
                                <script>
                                    mensajeadvertencia();
                                </script>

                            <?php elseif (isset($_SESSION['registrar']) && $_SESSION['registrar'] == 'eliminar'): ?>
                                <script>
                                    mensaje('Punto Estrategico', 'Eliminado');
                                </script>
                            <?php endif; ?>
                            <?php utilidades::destruirSesion('registrar') ?>
                            <div class="table-responsive">
                                <!-- Table with stripped rows -->
                                <table class="table datatable">

                                    <thead>
                                        <tr>

                                            <th scope="col">N.º:</th>
                                            <th scope="col">Punto Estrategico:</th>
                                            <th scope="col">Departamento:</th>
                                            <th scope="col">Ciudad:</th>
                                            <th scope="col">Estado:</th>
                                            <?php if ($_SESSION['usuario']->id_rol == "1" || $_SESSION['usuario']->id_rol == "2"): ?>
                                                <th scope="col">Acciones:</th> 
                                            <?php endif; ?>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        <?php while ($punto = $puntoestrategicos->fetch_object()): ?> 
                                            <tr>

                                                <th><?= $punto->id ?></th>
                                                <td><?= $punto->descripcion ?> </td>
                                                <td><?= $punto->departamento ?> </td>
                                                <td><?= $punto->ciudad ?> </td>
                                                <td><?= $punto->estado ?></td>
                                                <?php if ($_SESSION['usuario']->id_rol == "1" || $_SESSION['usuario']->id_rol == "2"): ?>
                                                    <td>   

                                                        <a class="bi bi-pencil-fill" href="<?= base_url ?>puntoestrategico/edit&id=<?= $punto->id ?>&iddepartamento=<?= $punto->iddepartamento?>" ></a>
                                                        <?php if ($_SESSION['usuario']->id_rol == "1"): ?>
                                                            <a class="bi bi-eraser-fill" href="<?= base_url ?>puntoestrategico/eliminar&id=<?= $punto->id ?>" onclick="return confirm('¿Esta Seguro que Desea Eliminar el Punto Estrategico?')"></a>
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

