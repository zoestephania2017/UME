<?php
if (!isset($_SESSION['login'])):
    header("Location:" . base_url);
endif;
?>
<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8">
        <meta content="width=device-width, initial-scale=1.0" name="viewport">

        <title>SALUDSYS </title>
        <link rel="icon" href="views/assets/img/logoclinica.jpg">
        <meta content="" name="description">
        <meta content="" name="keywords">

        
        <link href="<?= base_url ?>views/assets/img/favicon.png" rel="icon">
        <link href="<?= base_url ?>views/assets/img/apple-touch-icon.png" rel="apple-touch-icon">

       
        <link href="https://fonts.gstatic.com" rel="preconnect">
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

        
        <link href="<?= base_url ?>views/assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <link href="<?= base_url ?>views/assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
        <link href="<?= base_url ?>views/assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
        <link href="<?= base_url ?>views/assets/vendor/quill/quill.snow.css" rel="stylesheet">
        <link href="<?= base_url ?>views/assets/vendor/quill/quill.bubble.css" rel="stylesheet">
        <link href="<?= base_url ?>views/assets/vendor/remixicon/remixicon.css" rel="stylesheet">
        <link href="<?= base_url ?>views/assets/vendor/simple-datatables/style.css" rel="stylesheet">

        
        <link href="<?= base_url ?>views/assets/css/style.css" rel="stylesheet">


        <script src="<?= base_url ?>views/assets/js/utilidades.js"></script>
        <script src="<?= base_url ?>views/assets/js/jquery-3.6.0.min.js"></script>
        <script src="<?= base_url ?>views/assets/js/sweetalert2.js"></script>

    </head>

    <body>

        
        <header id="header" class="header fixed-top d-flex align-items-center">


            <div class="d-flex align-items-center justify-content-between">
                <img src="<?= base_url ?>views/assets/img/logoclinica.jpg" style="width: 70px;height:50px"  alt="UME">
                <a href="<?= base_url ?>inicio/index" class="logo d-flex align-items-center">
                    <span class="d-none d-lg-block">SALUDSYS </span>
                </a>
                <i class="bi bi-list toggle-sidebar-btn"></i>
            </div>



            <nav class="header-nav ms-auto">
                <ul class="d-flex align-items-center">


                    <li class="nav-item dropdown pe-3">

                        <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
                          <!--  <img src="<?= base_url ?>assets/img/profile-img.jpg" alt="Profile" class="rounded-circle">-->
                            <span class="d-none d-md-block dropdown-toggle ps-2"><?= $_SESSION['usuario']->primer_nombre ?> <?= $_SESSION['usuario']->primer_apellido ?></span>
                        </a><!-- End Profile Iamge Icon -->

                        <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
                            <li class="dropdown-header">
                                <h6><?= $_SESSION['usuario']->primer_nombre ?> <?= $_SESSION['usuario']->segundo_nombre ?> <?= $_SESSION['usuario']->primer_apellido ?> <?= $_SESSION['usuario']->segundo_apellido ?></h6>
                                <span><?= $_SESSION['usuario']->correo ?></span>
                            </li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>

                            <li>
                                <a class="dropdown-item d-flex align-items-center" href="<?= base_url ?>login/perfil">
                                    <i class="bi bi-person"></i>
                                    <span>Mi Perfil</span>
                                </a>
                            </li>

                            <li>
                                <hr class="dropdown-divider">
                            </li>

                            <li>

                                <a class="dropdown-item d-flex align-items-center" <?php utilidades::destruirSesion('inicio') ?> href="<?= base_url ?>">
                                    <i class="bi bi-box-arrow-right"></i>
                                    <span>Cerrar Sesión</span>
                                </a>
                            </li>

                        </ul><!-- End Profile Dropdown Items -->
                    </li><!-- End Profile Nav -->

                </ul>
            </nav><!-- End Icons Navigation -->

        </header><!-- End Header -->

        <!-- ======= Sidebar ======= -->
        <aside id="sidebar" class="sidebar">

            <ul class="sidebar-nav" id="sidebar-nav">

                <!-- COMIENZO INICIO NAVEGACION -->
                <li class="nav-item">
                    <a class="nav-link " href="<?= base_url ?>inicio/index">
                        <i class="bi bi-grid"></i>
                        <span>Inicio</span>
                    </a>
                </li>
                <!-- FIN INICIO NAVEGACION -->


                <!-- COMIENZO NAVEGACION PACIENTE -->
                <li class="nav-item">
                    <a class="nav-link collapsed" data-bs-target="#pacientesnav" data-bs-toggle="collapse" href="#">
                        <i class="bi bi-file-earmark-person-fill"></i><span>Pacientes</span><i class="bi bi-chevron-down ms-auto"></i>
                    </a>
                    <ul id="pacientesnav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                        <li>
                            <a href="<?= base_url ?>paciente/nuevo">
                                <i class="bi bi-circle"></i><span>Nuevo Paciente</span>
                            </a>
                        </li>
                        <li>
                            <a href="<?= base_url ?>paciente/index">
                                <i class="bi bi-circle"></i><span>Ver Pacientes</span>
                            </a>

                    </ul>
                </li>
                <!-- FIN DE NAVEGACION PACIENTE -->



                <!-- COMIENZO NAVEGACION ATENCIONES -->
                <li class="nav-item">
                    <a class="nav-link collapsed" data-bs-target="#atencionesnav" data-bs-toggle="collapse" href="#">
                        <i class="bx bx-plus-medical"></i><span>Atenciones</span><i class="bi bi-chevron-down ms-auto"></i>
                    </a>
                    <ul id="atencionesnav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                        <li>
                            <a href="<?= base_url ?>atencion/nuevo">
                                <i class="bi bi-circle"></i><span>Nueva Atencion</span>
                            </a>
                        </li>
                        <li>
                            <a href="<?= base_url ?>atencion/index">
                                <i class="bi bi-circle"></i><span>Ver Atenciones </span>
                            </a>

                    </ul>
                </li>
                <!-- FIN DE NAVEGACION ATENCIONES -->

                <?php if ($_SESSION['usuario']->id_rol == "1" || $_SESSION['usuario']->id_rol == "2"): ?>

                    <!-- COMIENZO NAVEGACION DEPARTAMENTO -->
                    <li class="nav-item">
                        <a class="nav-link collapsed" data-bs-target="#departamentosnav" data-bs-toggle="collapse" href="#">
                            <i class="bx bx-world"></i><span>Departamentos</span><i class="bi bi-chevron-down ms-auto"></i>
                        </a>
                        <ul id="departamentosnav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                            <li>
                                <a href="<?= base_url ?>departamento/nuevo">
                                    <i class="bi bi-circle"></i><span>Nuevo Departamento</span>
                                </a>
                            </li>
                            <li>
                                <a href="<?= base_url ?>departamento/index">
                                    <i class="bi bi-circle"></i><span>Ver Departamentos </span>
                                </a>

                        </ul>
                    </li>
                    <!-- FIN DE NAVEGACION DEPARTAMENTO -->

                    <!-- COMIENZO NAVEGACION CIUDAD -->
                    <li class="nav-item">
                        <a class="nav-link collapsed" data-bs-target="#ciudadesnav" data-bs-toggle="collapse" href="#">
                            <i class="bx bxs-city"></i><span>Ciudades</span><i class="bi bi-chevron-down ms-auto"></i>
                        </a>
                        <ul id="ciudadesnav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                            <li>
                                <a href="<?= base_url ?>ciudad/nuevo">
                                    <i class="bi bi-circle"></i><span>Nueva Ciudad</span>
                                </a>
                            </li>
                            <li>
                                <a href="<?= base_url ?>ciudad/index">
                                    <i class="bi bi-circle"></i><span>Ver Ciudades </span>
                                </a>

                        </ul>
                    </li>
                    <!-- FIN DE NAVEGACION CIUDAD -->

                    <!-- COMIENZO NAVEGACION CENTRO ASISTENCIAL -->
                    <li class="nav-item">
                        <a class="nav-link collapsed" data-bs-target="#centronav" data-bs-toggle="collapse" href="#">
                            <i class="bx bxs-clinic"></i><span>Centros Asistenciales</span><i class="bi bi-chevron-down ms-auto"></i>
                        </a>
                        <ul id="centronav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                            <li>
                                <a href="<?= base_url ?>centroasistencial/nuevo">
                                    <i class="bi bi-circle"></i><span>Nuevo Centro Asistencial</span>
                                </a>
                            </li>
                            <li>
                                <a href="<?= base_url ?>centroasistencial/index">
                                    <i class="bi bi-circle"></i><span>Ver Centros Asistenciales </span>
                                </a>

                        </ul>
                    </li>
                    <!-- FIN DE NAVEGACION CENTRO ASISTENCIAL -->


                    <!-- COMIENZO NAVEGACION CENTRO ASISTENCIAL -->
                    <li class="nav-item">
                        <a class="nav-link collapsed" data-bs-target="#puntonav" data-bs-toggle="collapse" href="#">
                            <i class="bx bxs-map"></i><span>Puntos Estrategicos</span><i class="bi bi-chevron-down ms-auto"></i>
                        </a>
                        <ul id="puntonav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                            <li>
                                <a href="<?= base_url ?>puntoestrategico/nuevo">
                                    <i class="bi bi-circle"></i><span>Nuevo Punto Estrategico</span>
                                </a>
                            </li>
                            <li>
                                <a href="<?= base_url ?>puntoestrategico/index">
                                    <i class="bi bi-circle"></i><span>Ver Puntos Estrategicos </span>
                                </a>

                        </ul>
                    </li>
                    <!-- FIN DE NAVEGACION CENTRO ASISTENCIAL -->


                    <!-- COMIENZO NAVEGACION AMBULANCIA -->
                    <li class="nav-item">
                        <a class="nav-link collapsed" data-bs-target="#ambulancianav" data-bs-toggle="collapse" href="#">
                            <i class="bx bxs-ambulance"></i><span>Ambulancias</span><i class="bi bi-chevron-down ms-auto"></i>
                        </a>
                        <ul id="ambulancianav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                            <li>
                                <a href="<?= base_url ?>ambulancia/nuevo">
                                    <i class="bi bi-circle"></i><span>Nueva Ambulancia</span>
                                </a>
                            </li>
                            <li>
                                <a href="<?= base_url ?>ambulancia/index">
                                    <i class="bi bi-circle"></i><span>Ver Ambulancia </span>
                                </a>

                        </ul>
                    </li>
                    <!-- FIN DE NAVEGACION AMBULANCIA -->


                    <!-- COMIENZO NAVEGACION MEDICO -->
                    <li class="nav-item">
                        <a class="nav-link collapsed" data-bs-target="#mediconav" data-bs-toggle="collapse" href="#">
                            <i class="bx bx-shield-quarter "></i><span>Médicos</span><i class="bi bi-chevron-down ms-auto"></i>
                        </a>
                        <ul id="mediconav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                            <li>
                                <a href="<?= base_url ?>medico/nuevo">
                                    <i class="bi bi-circle"></i><span>Nuevo Médicos</span>
                                </a>
                            </li>
                            <li>
                                <a href="<?= base_url ?>medico/index">
                                    <i class="bi bi-circle"></i><span>Ver Médicos </span>
                                </a>

                        </ul>
                    </li>
                    <!-- FIN DE NAVEGACION MEDICO -->


                    <!-- COMIENZO NAVEGACION PARAMEDICO -->
                    <li class="nav-item">
                        <a class="nav-link collapsed" data-bs-target="#paramediconav" data-bs-toggle="collapse" href="#">
                            <i class="ri ri-first-aid-kit-fill"></i><span>Paramédico</span><i class="bi bi-chevron-down ms-auto"></i>
                        </a>
                        <ul id="paramediconav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                            <li>
                                <a href="<?= base_url ?>paramedico/nuevo">
                                    <i class="bi bi-circle"></i><span>Nuevo Paramédico</span>
                                </a>
                            </li>
                            <li>
                                <a href="<?= base_url ?>paramedico/index">
                                    <i class="bi bi-circle"></i><span>Ver Paramédicos </span>
                                </a>

                        </ul>
                    </li>
                    <!-- FIN DE NAVEGACION PARAMEDICO -->


                    <!-- COMIENZO NAVEGACION CONDUCTOR DE AMBULANCIA -->
                    <li class="nav-item">
                        <a class="nav-link collapsed" data-bs-target="#conductornav" data-bs-toggle="collapse" href="#">
                            <i class="ri ri-user-2-fill"></i><span>Conductor</span><i class="bi bi-chevron-down ms-auto"></i>
                        </a>
                        <ul id="conductornav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                            <li>
                                <a href="<?= base_url ?>conductor/nuevo">
                                    <i class="bi bi-circle"></i><span>Nuevo Conductor</span>
                                </a>
                            </li>
                            <li>
                                <a href="<?= base_url ?>conductor/index">
                                    <i class="bi bi-circle"></i><span>Ver Conductores </span>
                                </a>

                        </ul>
                    </li>
                    <!-- FIN DE NAVEGACION CONDUCTOR DE AMBULANCIA -->


                    <!-- COMIENZO NAVEGACION RESPONSABLES DE AMBULANCIA -->
                    <li class="nav-item">
                        <a class="nav-link collapsed" data-bs-target="#asignacionnav" data-bs-toggle="collapse" href="#">
                            <i class="ri ri-team-fill"></i><span>Asignacion de Ambulancia</span><i class="bi bi-chevron-down ms-auto"></i>
                        </a>
                        <ul id="asignacionnav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                            <li>
                                <a href="<?= base_url ?>asignacion/nuevo">
                                    <i class="bi bi-circle"></i><span>Nueva Asignacion de Ambulancias</span>
                                </a>
                            </li>
                            <li>
                                <a href="<?= base_url ?>asignacion/index">
                                    <i class="bi bi-circle"></i><span>Ver Unidades Asignadas </span>
                                </a>

                        </ul>
                    </li>
                    <!-- FIN DE RESPONSABLES DE AMBULANCIA-->


                    <!-- COMIENZO NAVEGACION DIAGNOSTICO -->
                    <li class="nav-item">
                        <a class="nav-link collapsed" data-bs-target="#diagnosticosnav" data-bs-toggle="collapse" href="#">
                            <i class="ri ri-capsule-fill"></i><span>Diagnósticos</span><i class="bi bi-chevron-down ms-auto"></i>
                        </a>
                        <ul id="diagnosticosnav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                            <li>
                                <a href="<?= base_url ?>diagnostico/nuevo">
                                    <i class="bi bi-circle"></i><span>Nuevo Diagnóstico</span>
                                </a>
                            </li>
                            <li>
                                <a href="<?= base_url ?>diagnostico/index">
                                    <i class="bi bi-circle"></i><span>Ver Diagnósticos </span>
                                </a>

                        </ul>
                    </li>
                    <!-- FIN DE NAVEGACION DIAGNOSTICO -->

                    <!-- COMIENZO NAVEGACION SALA -->
                    <li class="nav-item">
                        <a class="nav-link collapsed" data-bs-target="#salanav" data-bs-toggle="collapse" href="#">
                            <i class="ri ri-hotel-bed-fill"></i><span>Salas</span><i class="bi bi-chevron-down ms-auto"></i>
                        </a>
                        <ul id="salanav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                            <li>
                                <a href="<?= base_url ?>sala/nuevo">
                                    <i class="bi bi-circle"></i><span>Nueva Sala</span>
                                </a>
                            </li>
                            <li>
                                <a href="<?= base_url ?>sala/index">
                                    <i class="bi bi-circle"></i><span>Ver Salas </span>
                                </a>

                        </ul>
                    </li>
                    <!-- FIN DE NAVEGACION SALA -->

                    <!-- COMIENZO NAVEGACION SALA -->
                    <li class="nav-item">
                        <a class="nav-link collapsed" data-bs-target="#reportesnav" data-bs-toggle="collapse" href="#">
                            <i class="bx bxs-report"></i><span>Reportes</span><i class="bi bi-chevron-down ms-auto"></i>
                        </a>
                        <ul id="reportesnav" class="nav-content collapse " data-bs-parent="#sidebar-nav">

                            <li>
                                <a href="<?= base_url ?>reporte/departamento">
                                    <i class="bi bi-circle"></i><span>Atenciones por Departamento</span>
                                </a>
                            </li>

                            <li>

                            <li>
                                <a href="<?= base_url ?>reporte/ciudad">
                                    <i class="bi bi-circle"></i><span>Atenciones por Ciudad</span>
                                </a>
                            </li>
                            <li>
                                <a href="<?= base_url ?>reporte/centro">
                                    <i class="bi bi-circle"></i><span>Atenciones por Centro Asistencial</span>
                                </a>
                            </li>
                            <li>
                                <a href="<?= base_url ?>reporte/ambulancia">
                                    <i class="bi bi-circle"></i><span>Atenciones por Ambulancia </span>
                                </a>

                            </li>
                            <li>
                                <a href="<?= base_url ?>reporte/tipoatencion">
                                    <i class="bi bi-circle"></i><span>Atenciones por Tipo de Atención </span>
                                </a>

                            </li>
                            <li>
                                <a href="<?= base_url ?>reporte/traslado">
                                    <i class="bi bi-circle"></i><span>Atenciones por Traslado </span>
                                </a>

                            </li>
                            <li>
                                <a href="<?= base_url ?>reporte/sala">
                                    <i class="bi bi-circle"></i><span>Atenciones por Sala </span>
                                </a>

                            </li>
                            <li>
                                <a href="<?= base_url ?>reporte/diagnostico">
                                    <i class="bi bi-circle"></i><span>Atenciones por Diagnóstico </span>
                                </a>

                        </ul>
                    </li>


                    <!-- FIN DE NAVEGACION SALA -->


                <?php endif; ?>

                <?php if ($_SESSION['usuario']->id_rol == "1"): ?>

                    <!-- COMIENZO NAVEGACION USUARIOS -->
                    <li class="nav-item">
                        <a class="nav-link collapsed" data-bs-target="#usuariosnav" data-bs-toggle="collapse" href="#">
                            <i class="bi bi-people-fill"></i><span>Usuarios</span><i class="bi bi-chevron-down ms-auto"></i>
                        </a>
                        <ul id="usuariosnav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                            <li>
                                <a href="<?= base_url ?>usuario/nuevo">
                                    <i class="bi bi-circle"></i><span>Nuevo Usuario</span>
                                </a>
                            </li>
                            <li>
                                <a href="<?= base_url ?>usuario/index">
                                    <i class="bi bi-circle"></i><span>Ver Usuarios </span>
                                </a>

                        </ul>
                    </li>
                    <!-- FIN DE NAVEGACION USUARIOS -->

                    <!-- COMIENZO NAVEGACION ESTADOS 
                    <li class="nav-item">
                        <a class="nav-link collapsed" data-bs-target="#estadosnav" data-bs-toggle="collapse" href="#">
                            <i class="bi bi-lightning-charge-fill"></i><span>Estados</span><i class="bi bi-chevron-down ms-auto"></i>
                        </a>
                        <ul id="estadosnav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                            <li>
                                <a href="<?= base_url ?>estado/nuevo">
                                    <i class="bi bi-circle"></i><span>Nuevo Estado</span>
                                </a>
                            </li>
                            <li>
                                <a href="<?= base_url ?>estado/index">
                                    <i class="bi bi-circle"></i><span>Ver Estados </span>
                                </a>

                        </ul>
                    </li>
                    <!-- FIN DE NAVEGACION ESTADOS -->


                    <!-- COMIENZO NAVEGACION BITACORA -->
                    <li class="nav-item">
                        <a class="nav-link collapsed" data-bs-target="#bitacoranav" data-bs-toggle="collapse" href="#">
                            <i class="bi bi-book-fill"></i><span>Bitacora</span><i class="bi bi-chevron-down ms-auto"></i>
                        </a>
                        <ul id="bitacoranav" class="nav-content collapse " data-bs-parent="#sidebar-nav">       
                            <li>
                                <a href="<?= base_url ?>bitacora/index">
                                    <i class="bi bi-circle"></i><span>Ver Bitacora </span>
                                </a>

                        </ul>
                    </li>
                    <!-- FIN DE NAVEGACION BITACORA -->


                <?php endif; ?>



            </ul>

        </aside><!-- End Sidebar-->


    </body>

</html>


