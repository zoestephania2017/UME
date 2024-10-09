

<?php include 'views/layouts/navegacion.php'; ?>



<main id="main" class="main">

    <div class="pagetitle">
        <h1>Ver Unidades Asignadas</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item">Lista de Ambulancias Asignadas</li>
            </ol>
        </nav>
    </div>

    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">

                        <?php if (isset($_SESSION['registrar']) && $_SESSION['registrar'] == 'completado'): ?>
                            <script>
                                mensaje('Asignación', 'Modificada');
                            </script>
                        <?php elseif (isset($_SESSION['registrar']) && $_SESSION['registrar'] == 'fallido'): ?>
                            <script>
                                mensajeadvertencia();
                            </script>

                        <?php elseif (isset($_SESSION['registrar']) && $_SESSION['registrar'] == 'eliminar'): ?>
                            <script>
                                mensaje('Asignación', 'Eliminada');
                            </script>
                        <?php endif; ?>
                        <?php utilidades::destruirSesion('registrar') ?>
                        <div class="table-responsive">
                    
                            <table class="table datatable">

                                <thead>
                                    <tr>
                                        <th scope="col">Conductor:</th>
                                        <th scope="col">Paramédico:</th>
                                        <th scope="col">Departamento:</th>
                                        <th scope="col">Ciudad:</th>
                                        <th scope="col">Punto Estrategico:</th>
                                        <th scope="col">Ambulancia:</th>
                                        <th scope="col">Fecha de Asignación:</th>
                                        <?php if ($_SESSION['usuario']->id_rol == "1" || $_SESSION['usuario']->id_rol == "2"): ?>
                                            <th scope="col">Acciones:</th> 
                                        <?php endif; ?>
                                    </tr>
                                </thead>
                                <tbody>

                                    <?php while ($asignacion = $asignaciones->fetch_object()): ?> 
                                        <tr>
                                            <td><?= $asignacion->identidadconductor ?>--<?= $asignacion->nombreconductor ?> <?= $asignacion->apellidoconductor ?></td>
                                            <td><?= $asignacion->identidadparamedico ?>--<?= $asignacion->nombreparamedico ?> <?= $asignacion->apellidoparamedico ?></td>
                                            <td><?= $asignacion->departamento ?></td>
                                            <td><?= $asignacion->ciudad ?></td>
                                            <td><?= $asignacion->punto ?> </td>
                                            <td><?= $asignacion->unidad ?> </td>
                                            <td><?= $asignacion->fecha_ingreso ?> </td>

                                            <?php if ($_SESSION['usuario']->id_rol == "1" || $_SESSION['usuario']->id_rol == "2"): ?>
                                                <td>   

                                                    <a class="bi bi-pencil-fill" href="<?= base_url ?>asignacion/edit&id=<?= $asignacion->id ?>&iddepartamento=<?= $asignacion->iddepartamento ?>&idciudad=<?= $asignacion->idciudad ?>&idpunto=<?= $asignacion->idpunto ?>" ></a>
                                                    <?php if ($_SESSION['usuario']->id_rol == "1"): ?>
                                                        <a class="bi bi-eraser-fill" href="<?= base_url ?>asignacion/eliminar&id=<?= $asignacion->id ?>" onclick="return confirm('¿Esta Seguro que Desea Eliminar la Asignación de Esta Ambulancia?')"></a>
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

</main><!-- End #main -->



<?php include ('views/layouts/piepagina.php'); ?>