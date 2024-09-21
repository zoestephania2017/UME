<?php include 'views/layouts/navegacion.php'; ?>



<main id="main" class="main">

    <div class="pagetitle">
        <h1>Todos los Pacientes</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item">Lista de Pacientes Registrados</li>
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
                                mensaje('Paciente', 'Modificado');
                            </script>
                        <?php elseif (isset($_SESSION['registrar']) && $_SESSION['registrar'] == 'fallido'): ?>
                            <script>
                                mensajeadvertencia();
                            </script>

                        <?php elseif (isset($_SESSION['registrar']) && $_SESSION['registrar'] == 'eliminar'): ?>
                            <script>
                                mensaje('Paciente', 'Eliminado');
                            </script>
                        <?php endif; ?>
                        <?php utilidades::destruirSesion('registrar') ?>
                        <div class="table-responsive">
                            <!-- Table with stripped rows -->
                            <table class="table datatable">

                                <thead>
                                    <tr>

                                        <th scope="col">Identidad:</th>
                                        <th scope="col">Nombre:</th>
                                        <th scope="col">Apellido:</th>
                                        <th scope="col">Fecha de Nacimiento:</th>
                                        <th scope="col">Ocupacion:</th>
                                        <th scope="col">Genero:</th>
                                        <th scope="col">Estado Civil:</th>   
                                        <th scope="col">Direccion:</th>   
                                        <th scope="col">Acompañante:</th>  
                                        <th scope="col">Parentesco:</th>  
                                        <th scope="col">Telefono:</th>
                                        <th scope="col">Comentario:</th>
                                        <th scope="col">Departamento:</th> 
                                        <th scope="col">Ciudad:</th> 
                                        <th scope="col">Estado:</th>
                                        <?php if ($_SESSION['usuario']->id_rol == "1" || $_SESSION['usuario']->id_rol == "2"): ?>
                                            <th scope="col">Acciones:</th> 
                                        <?php endif; ?>
                                    </tr>
                                </thead>
                                <tbody>

                                    <?php while ($paciente = $pacientes->fetch_object()): ?> 
                                        <tr>

                                            <th><?= $paciente->identidad ?></th>
                                            <td><?= $paciente->nombre ?> </td>
                                            <td><?= $paciente->apellido ?></td>
                                            <td><?= $paciente->fecha_nacimiento ?></td>
                                            <td><?= $paciente->ocupacion ?></td>
                                            <td><?= $paciente->genero ?></td>
                                            <td><?= $paciente->estado_civil ?></td>
                                            <td><?= $paciente->direccion ?> </td>
                                            <td><?= $paciente->acompanante ?></td>
                                            <td><?= $paciente->parentesco ?></td>
                                            <td><?= $paciente->telefono ?></td>
                                            <td><?= $paciente->comentario ?></td>
                                            <td><?= $paciente->departamento ?></td>
                                            <td><?= $paciente->ciudad ?></td>
                                            <td><?= $paciente->estado ?></td>
                                            <?php if ($_SESSION['usuario']->id_rol == "1" || $_SESSION['usuario']->id_rol == "2"): ?>
                                                <td>   

                                                    <a class="bi bi-pencil-fill" href="<?= base_url ?>Paciente/edit&id=<?= $paciente->id ?>&iddepartamento=<?= $paciente->iddepartamento ?>" ></a>
                                                    <?php if ($_SESSION['usuario']->id_rol == "1"): ?>
                                                        <a class="bi bi-eraser-fill" href="<?= base_url ?>Paciente/eliminar&id=<?= $paciente->id ?>" onclick="return confirm('¿Estas Seguro que Desea Eliminar al Paciente?')"></a>
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