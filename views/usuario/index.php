<?php if ($_SESSION['usuario']->id_rol != "1"): ?>

    <?php header("Location:" . base_url . "inicio/index"); ?>

<?php endif; ?>

<?php include 'views/layouts/navegacion.php'; ?>


<main id="main" class="main">
    <?php if (isset($_SESSION['registrar']) && $_SESSION['registrar'] == 'completado'): ?>
        <script>
            mensaje('Usuario', 'Modificado');
        </script>
    <?php elseif (isset($_SESSION['registrar']) && $_SESSION['registrar'] == 'fallido'): ?>
        <script>
            mensajeadvertencia();
        </script>

    <?php elseif (isset($_SESSION['registrar']) && $_SESSION['registrar'] == 'resetear'): ?>
        <script>
            mensaje('Contraseña de Usuario', 'Reseteada');
        </script>
    <?php endif; ?>
    <?php utilidades::destruirSesion('registrar') ?>



    <div class="pagetitle">
        <h1>Registro de Usuarios</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item">Lista de Usuarios Registrados</li>
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
                                        <th scope="col">Correo:</th>
                                        <th scope="col">Contraseña:</th>
                                        <th scope="col">Departamento:</th> 
                                        <th scope="col">Ciudad:</th> 
                                        <th scope="col">Fecha de Ingreso:</th>
                                        <th scope="col">Rol:</th>  
                                        <th scope="col">Estado:</th>  
                                        <th scope="col">Acciones:</th> 
                                    </tr>
                                </thead>
                                <tbody>

                                    <?php while ($usuario = $usuarios->fetch_object()): ?> 
                                        <tr>

                                            <th><?= $usuario->identidad ?></th>
                                            <td><?= $usuario->primer_nombre ?> <?= $usuario->segundo_nombre ?> </td>
                                            <td><?= $usuario->primer_apellido ?> <?= $usuario->segundo_apellido ?></td>
                                            <td><?= $usuario->estado_civil ?></td>
                                            <td><?= $usuario->genero ?></td>
                                            <td><?= $usuario->fecha_nacimiento ?></td>
                                            <td><?= $usuario->direccion ?></td>
                                            <td><?= $usuario->telefono ?></td>
                                            <td><?= $usuario->correo ?></td>
                                            <td><?= $usuario->contrasena ?></td>
                                            <td><?= $usuario->departamento ?></td>
                                            <td><?= $usuario->ciudad ?></td>
                                            <td><?= $usuario->fecha_ingreso ?></td>
                                            <td><?= $usuario->rol ?></td>
                                            <td><?= $usuario->estado ?></td>


                                            <td>   
                                    <center>
                                        <a class="bi bi-pencil-fill" href="<?= base_url ?>usuario/edit&id=<?= $usuario->id ?>&iddepartamento=<?= $usuario->iddepartamento ?>" ></a>
                                        <a class="bx bx-reset" href="<?= base_url ?>usuario/resetear&id=<?= $usuario->id ?>" onclick="return confirm('¿Estas Seguro que Desea Resetear la Contraseña?')" ></a>
                                    </center>
                                    </td>   
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