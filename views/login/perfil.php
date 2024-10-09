<?php include 'views/layouts/navegacion.php'; ?>

<main id="main" class="main">

    <div class="pagetitle">
        <h1>Perfil de Usuario</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item">Datos de Usuario</li>
            </ol>

        </nav>
    </div>

    <section class="section profile">
        <div class="row">
            <div class="col-xl-4">

                <div class="card">
                    <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">

                        <h2><?= $_SESSION['usuario']->primer_nombre ?> </h2>
                        <h3><?= $_SESSION['usuario']->primer_apellido ?></h3>

                    </div>
                </div>

            </div>

            <div class="col-xl-8">

                <div class="card">
                    <div class="card-body pt-3">
            
                        <ul class="nav nav-tabs nav-tabs-bordered">

                            <li class="nav-item">
                                <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#profile-overview">Visión General</button>
                            </li>

                            <li class="nav-item">
                                <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-change-password">Cambiar Contraseña</button>
                            </li>

                        </ul>
                        <div class="tab-content pt-2">

                            <?php if (isset($_SESSION['cambiocontrasena']) && $_SESSION['cambiocontrasena'] = "coincide"): ?>
                                <div class="alert alert-warning bg-warning border-0 alert-dismissible fade show" role="alert">
                                    Contraseña no modificada, verifique la contraseña actual y los campos esten completos.
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                            <?php elseif (isset($_SESSION['cambiocontrasena']) && $_SESSION['cambiocontrasena'] = "fallido"): ?>
                                <div class="alert alert-danger bg-danger border-0 alert-dismissible fade show" role="alert">
                                    Verifique que los campos esten completos
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                            <?php endif; ?>
                            <?php utilidades::destruirSesion('cambiocontrasena') ?>
                            <div class="tab-pane fade show active profile-overview" id="profile-overview">
                                <h5 class="card-title">Acerca</h5>
                                <p class="small fst-italic">Información del usuario</p>

                                <h5 class="card-title">Detalles del Perfil</h5>


                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label ">Identidad:</div>
                                    <div class="col-lg-9 col-md-8"><?= $_SESSION['usuario']->identidad ?></div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label ">Nombre Completo:</div>
                                    <div class="col-lg-9 col-md-8"><?= $_SESSION['usuario']->primer_nombre ?> <?= $_SESSION['usuario']->segundo_nombre ?> <?= $_SESSION['usuario']->primer_apellido ?> <?= $_SESSION['usuario']->segundo_apellido ?></div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label ">Género:</div>
                                    <div class="col-lg-9 col-md-8"><?= $_SESSION['usuario']->genero ?></div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label ">Fecha de Nacimiento:</div>
                                    <div class="col-lg-9 col-md-8"><?= $_SESSION['usuario']->fecha_nacimiento ?></div>
                                </div>


                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label ">Domicilio:</div>
                                    <div class="col-lg-9 col-md-8"><?= $_SESSION['usuario']->direccion ?></div>
                                </div>


                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label ">Telefono:</div>
                                    <div class="col-lg-9 col-md-8"><?= $_SESSION['usuario']->telefono ?></div>
                                </div>



                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label ">Correo:</div>
                                    <div class="col-lg-9 col-md-8"><?= $_SESSION['usuario']->correo ?></div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label ">Departamento:</div>
                                    <div class="col-lg-9 col-md-8"><?= $_SESSION['usuario']->departamento ?></div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label ">Ciudad:</div>
                                    <div class="col-lg-9 col-md-8"><?= $_SESSION['usuario']->ciudad ?></div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label ">Usuario:</div>
                                    <div class="col-lg-9 col-md-8"><?= $_SESSION['usuario']->rol ?></div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label ">Estado:</div>
                                    <div class="col-lg-9 col-md-8"><?= $_SESSION['usuario']->estado ?></div>
                                </div>
                            </div>

                            <div class="tab-pane fade pt-3" id="profile-change-password">


                        
                                <form id="formulario" name="formulario" class="row g-3" action="<?= base_url ?>usuario/cambiarcontrasena" method="POST">

                                    <div class="row mb-3">
                                        <label for="currentPassword" class="col-md-4 col-lg-3 col-form-label">Contraseña Actual:</label>
                                        <div class="col-md-8 col-lg-9">
                                            <input name="contrasenaactual" type="password" class="form-control" id="contrasenaactual" required>
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="newPassword" class="col-md-4 col-lg-3 col-form-label">Nueva Contraseña:</label>
                                        <div class="col-md-8 col-lg-9">
                                            <input name="nuevacontrasena" type="password" class="form-control" id="nuevacontrasena" required>
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="renewPassword" class="col-md-4 col-lg-3 col-form-label">Confirmar Contraseña</label>
                                        <div class="col-md-8 col-lg-9">
                                            <input name="confirmarcontrasena" type="password" class="form-control" id="confirmarcontrasena" onchange="confirmarcontraseña()" required>
                                        </div>
                                    </div>

                                    <div class="text-center">
                                        <button type="submit" onclick="return confirm('¿Estas seguro que desea modificar la contraseña?')"  class="btn btn-primary">Cambiar Contraseña</button>
                                    </div>     

                                </form>

                            </div>


                        </div>

                    </div>
                </div>

            </div>
        </div>
    </section>

</main>


<?php include ('views/layouts/piepagina.php'); ?>