

<?php include 'views/layouts/navegacion.php'; ?>



<main id="main" class="main">

    <div class="pagetitle">
        <h1>Ver Atenciones</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item">Lista de Atenciones Registradas:</li>
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
                                mensaje('Atencion', 'Modificada');
                            </script>
                        <?php elseif (isset($_SESSION['registrar']) && $_SESSION['registrar'] == 'fallido'): ?>
                            <script>
                                mensajeadvertencia();
                            </script>

                        <?php elseif (isset($_SESSION['registrar']) && $_SESSION['registrar'] == 'eliminar'): ?>
                            <script>
                                mensaje('Atencion', 'Eliminada');
                            </script>
                        <?php endif; ?>
                        <?php utilidades::destruirSesion('registrar') ?>
                        <div class="table-responsive">
                            <!-- Table with stripped rows -->
                            <table class="table datatable">

                                <thead>
                                    <tr>
                                        <th scope="col">Paciente:</th>
                                        <th scope="col">Departamento:</th>
                                        <th scope="col">Ciudad:</th>
                                        <th scope="col">Tipo de Incidente:</th>
                                        <th scope="col">Lugar de Incidente:</th>
                                        <th scope="col">Punto Estrategico:</th>
                                        <th scope="col">Ambulancia:</th>
                                        <th scope="col">Centro Asistencial:</th>
                                        <th scope="col">Medico:</th>
                                        <th scope="col">Sala:</th>
                                        <th scope="col">Diagnostico:</th>
                                        <th scope="col">Atención Brindada:</th> 
                                        <th scope="col">Traslado:</th> 
                                        <th scope="col">Patología:</th>
                                        <th scope="col">Estado de Atencion:</th>

                                        <?php if ($_SESSION['usuario']->id_rol == "1" || $_SESSION['usuario']->id_rol == "2"): ?>
                                            <th scope="col">Acciones:</th> 
                                        <?php endif; ?>
                                    </tr>
                                </thead>
                                <tbody>

                                    <?php while ($atencion = $atenciones->fetch_object()): ?> 
                                        <tr>
                                            <th><?= $atencion->identidad ?>--<?= $atencion->nombre ?> <?= $atencion->apellido ?></th>
                                            <td><?= $atencion->departamento ?></td>
                                            <td><?= $atencion->ciudad ?></td>
                                            <td><?= $atencion->tipo_incidente ?> </td>
                                            <td><?= $atencion->lugar_incidente ?> </td>
                                            <td><?= $atencion->punto ?> </td>
                                            <td><?= $atencion->unidad ?> </td>
                                            <td><?= $atencion->centro ?></td>
                                            <td><?= $atencion->identidadmedico ?>--<?= $atencion->nombremedico ?> <?= $atencion->apellidomedico ?></td>
                                            <td><?= $atencion->sala ?></td>
                                            <td><?= $atencion->diagnostico ?></td>
                                            <td><?= $atencion->atencion_brindada ?></td>
                                            <td><?= $atencion->traslado ?></td>
                                            <td><?= $atencion->patologia ?></td>
                                            <td><?= $atencion->estado ?></td>
                                            <?php if ($_SESSION['usuario']->id_rol == "1" || $_SESSION['usuario']->id_rol == "2"): ?>
                                                <td>   

                                                    <a class="bi bi-pencil-fill" href="<?= base_url ?>atencion/edit&id=<?= $atencion->id ?>&idpaciente=<?= $atencion->id_paciente ?>&idpunto=<?= $atencion->idpunto ?>&idciudad=<?= $atencion->idciudad ?>" ></a>
                                                    <?php if ($_SESSION['usuario']->id_rol == "1"): ?>
                                                        <a class="bi bi-eraser-fill" href="<?= base_url ?>atencion/eliminar&id=<?= $atencion->id ?>" onclick="return confirm('¿Estas Seguro que Desea Eliminar la Atención?')"></a>
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