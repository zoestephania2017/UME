 <?php if ($_SESSION['usuario']->id_rol != "1"): ?>
   
<?php header("Location:" . base_url . "inicio/index");?>

<?php endif; ?>

<?php include 'views/layouts/navegacion.php'; ?>


<!-- Favicons -->
<link href="../../assets/img/favicon.png" rel="icon">
<link href="../../assets/img/apple-touch-icon.png" rel="apple-touch-icon">

<!-- Google Fonts -->
<link href="https://fonts.gstatic.com" rel="preconnect">
<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

<!-- Vendor CSS Files -->
<link href="../../assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
<link href="../../assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
<link href="../../assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
<link href="../../assets/vendor/quill/quill.snow.css" rel="stylesheet">
<link href="../../assets/vendor/quill/quill.bubble.css" rel="stylesheet">
<link href="../../assets/vendor/remixicon/remixicon.css" rel="stylesheet">
<link href="../../assets/vendor/simple-datatables/style.css" rel="stylesheet">

<!-- Template Main CSS File -->
<link href="../../assets/css/style.css" rel="stylesheet">



<main id="main" class="main">

    <div class="pagetitle">
        <h1>Registro de Pacientes</h1>
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
                        <div class="table-responsive">
                            <!-- Table with stripped rows -->
                            <table class="table datatable">

                                <thead>
                                    <tr>

                                        <th scope="col">Identidad</th>
                                        <th scope="col">Nombre</th>
                                        <th scope="col">Apellido</th>
                                        <th scope="col">Edad</th>
                                        <th scope="col">Ocupacion</th>
                                        <th scope="col">Genero</th>
                                        <th scope="col">Estado Civil</th>   
                                        <th scope="col">Direccion</th>   
                                        <th scope="col">Telefono</th>  
                                        <th scope="col">Acompañante</th>  
                                        <th scope="col">Parentesco</th>  
                                        <th scope="col">Comentario</th>  
                                        <th scope="col">Ciudad</th> 
                                        <th scope="col">Acciones</th> 
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>

                                        <td>0801199915371</td>
                                        <td>Alex </td>
                                        <td>Gamez</td>
                                        <td>22</td>
                                        <td>Desarollador web</td>
                                        <td>Masculino</td>
                                        <td>Soltero</td>
                                        <td>Col.La Esperanza</td>
                                        <td>98348048</td>
                                        <td>Mario Gamez</td>
                                        <td>Hermano</td>
                                        <td>Se metio un vergazo</td>
                                        <td>Tegucigalpa</td>
                                        <td>   
                                <center>
                                    <a class="bi bi-pencil-fill" href="#" ></a>
                                    <a class="bi bi-eraser-fill" href="#" ></a>
                                </center>
                                </td>   
                                </tr>


                                <tr>
                                    <td>0801199915371</td>
                                    <td>Alex </td>
                                    <td>Gamez</td>
                                    <td>22</td>
                                    <td>Desarollador web</td>
                                    <td>Masculino</td>
                                    <td>Soltero</td>
                                    <td>Col.La Esperanza</td>
                                    <td>98348048</td>
                                    <td>Mario Gamez</td>
                                    <td>Primo</td>
                                    <td>Se metio un vergazo</td>
                                    <td>Tegucigalpa</td>
                                    <td>   
                                <center>
                                    <a class="bi bi-pencil-fill" href="#" ></a>
                                    <a class="bi bi-eraser-fill" href="#" ></a>
                                </center>
                                </td>   
                                </tr>

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