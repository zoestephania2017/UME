

<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8">
        <meta content="width=device-width, initial-scale=1.0" name="viewport">

        <title>Sistema de Control de Pacientes</title>
        <link rel="icon" href="views/assets/img/logocopeco.png">
        <meta content="" name="description">
        <meta content="" name="keywords">

        <!-- Favicons -->
        <link href="<?= base_url ?>views/assets/img/favicon.png" rel="icon">
        <link href="<?= base_url ?>views/assets/img/apple-touch-icon.png" rel="apple-touch-icon">

        <!-- Google Fonts -->
        <link href="https://fonts.gstatic.com" rel="preconnect">
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

        <!-- Vendor CSS Files -->
        <link href="<?= base_url ?>views/assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <link href="<?= base_url ?>views/assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
        <link href="<?= base_url ?>views/assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
        <link href="<?= base_url ?>views/assets/vendor/quill/quill.snow.css" rel="stylesheet">
        <link href="<?= base_url ?>views/assets/vendor/quill/quill.bubble.css" rel="stylesheet">
        <link href="<?= base_url ?>views/assets/vendor/remixicon/remixicon.css" rel="stylesheet">
        <link href="<?= base_url ?>views/assets/vendor/simple-datatables/style.css" rel="stylesheet">

        <!-- Template Main CSS File -->
        <link href="<?= base_url ?>views/assets/css/style.css" rel="stylesheet">

    
    </head>

    <body>

        <main>
            <div class="container">
            <center><!--img  src="views/assets/img/logo.jpg" width="200" class="img-responsive" alt="User Image"--></center>
            <div class="container">
            <center><img  src="views/assets/img/logoclinica.jpg" width="200" class="img-responsive" alt="User Image"></center>
            <body style="background: url(views/assets/img/Fondo.jpg) no-repeat; background-size: cover"></body>

            <section class="section register min-vh-10 d-flex flex-column align-items-center justify-content-center py-4">
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">

                                <div class="d-flex justify-content-center py-4">
                                    <a href="login.php" class="logo d-flex align-items-center w-auto">
                                        <span class="d-none d-lg-block">SALUDSYS </span>
                                    </a>
                                </div><!-- End Logo -->

                                <div class="card mb-3">

                                    <div class="card-body">

                                        <div class="pt-4 pb-2">
                                            <h5 class="card-title text-center pb-0 fs-4">Inicio de Sesión</h5>
                                            <p class="text-center small">Ingrese su  Usuario y Contraseña</p>
                                        </div>

                                        <form class="row g-3" action="<?= base_url ?>usuario/login" method="POST">
                                            <?php if (isset($_SESSION['login']) && $_SESSION['login'] == 'Fallido'): ?>
                                                <div class="alert alert-danger bg-danger text-light border-0 alert-dismissible fade show" role="alert">
                                                    Usuario y/o Contraseña Invalidos, intente nuevamente.
                                                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
                                                </div>

                                            <?php elseif (isset($_SESSION['cambiocontrasena']) && $_SESSION['cambiocontrasena'] == 'completado'): ?>
                                                <div class="alert alert-danger bg-danger text-light border-0 alert-dismissible fade show" role="alert">
                                                    La contraseña fue cambiada, la sesión expiró.
                                                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
                                                </div>
                                            <?php elseif (isset($_SESSION['login']) && $_SESSION['login'] == 'Vacio'): ?>
                                                <div class="alert alert-warning bg-warning border-0 alert-dismissible fade show" role="alert">
                                                    El usuario y la contraseña deben ser ingresados.
                                                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
                                                </div>

                                            <?php endif; ?>
                                            <?php utilidades::destruirSesion('cambiocontrasena') ?>
                                            <?php utilidades::destruirSesion('login') ?>
                                            
                                            <div class="col-12">
                                                <label for="usuario" class="form-label">Usuario</label>
                                                <div class="input-group has-validation">
                                                    <span class="input-group-text" id="inputGroupPrepend">@</span>
                                                    <input type="email" name="usuario" class="form-control" id="usuario" required placeholder="Usuario">
                                                    <div class="invalid-feedback">Ingrese su Usuario.</div>
                                                </div>
                                            </div>

                                            <div class="col-12">
                                                <label for="contrasena" class="form-label">Contraseña</label>
                                                <input type="password" name="contrasena" class="form-control" id="contrasena" placeholder="Contraseña" required>
                                                <div class="invalid-feedback">Ingrese su Contraseña!</div>
                                            </div>

                                            <div class="col-12">
                                                <button class="btn btn-primary w-100" type="submit"  >Iniciar Sesión</button>
                                            </div>
                                        </form>


                                    </div>
                                </div>


                            </div>
                        </div>
                    </div>

                </section>
            </div>
        </main><!-- End #main -->

        <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

        <!-- Vendor JS Files -->
        <script src="<?= base_url ?>views/assets/vendor/apexcharts/apexcharts.min.js"></script>
        <script src="<?= base_url ?>views/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
        <script src="<?= base_url ?>views/assets/vendor/chart.js/chart.min.js"></script>
        <script src="<?= base_url ?>views/assets/vendor/echarts/echarts.min.js"></script>
        <script src="<?= base_url ?>views/assets/vendor/quill/quill.min.js"></script>
        <script src="<?= base_url ?>views/assets/vendor/simple-datatables/simple-datatables.js"></script>
        <script src="<?= base_url ?>views/assets/vendor/tinymce/tinymce.min.js"></script>
        <script src="<?= base_url ?>views/assets/vendor/php-email-form/validate.js"></script>

        <!-- Template Main JS File -->
        <script src="<?= base_url ?>views/assets/js/main.js"></script>
        <script src="<?= base_url ?>views/assets/js/utilidades.js"></script>
        <script src="<?= base_url ?>views/assets/js/jquery-3.6.0.min.js"></script>
        <script src="<?= base_url ?>views/assets/js/sweetalert2.js"></script>
        <script>
            usuario.focus();
        </script>


    </body>

</html>