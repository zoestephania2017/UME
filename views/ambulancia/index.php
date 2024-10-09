<?php if ($_SESSION['usuario']->id_rol == "1" || $_SESSION['usuario']->id_rol == "2"): ?>


    <?php include 'views/layouts/navegacion.php'; ?>



    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Ver Ambulancias</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">Lista de Ambulancias Registradas</li>
                </ol>
            </nav>
        </div><

        <section class="section">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">


                            <?php if (isset($_SESSION['registrar']) && $_SESSION['registrar'] == 'completado'): ?>
                                <script>
                                    mensaje('Ambulancia', 'Modificada');
                                </script>
                            <?php elseif (isset($_SESSION['registrar']) && $_SESSION['registrar'] == 'fallido'): ?>
                                <script>
                                    mensajeadvertencia();
                                </script>

                            <?php elseif (isset($_SESSION['registrar']) && $_SESSION['registrar'] == 'eliminar'): ?>
                                <script>
                                    mensaje('Ambulancia', 'Eliminada');
                                </script>
                            <?php endif; ?>
                            <?php utilidades::destruirSesion('registrar') ?>
                            <div class="table-responsive">
                                
                                <table class="table datatable">

                                    <thead>
                                        <tr>
                                            <th scope="col">N.º:</th>
                                            <th scope="col">Ambulancia:</th>
                                            <th scope="col">Departamento:</th>
                                            <th scope="col">Ciudad:</th>
                                            <th scope="col">Punto Estrategico:</th>
                                            <th scope="col">Fecha de Ingreso:</th>
                                            <th scope="col">Estado:</th>
                                            <?php if ($_SESSION['usuario']->id_rol == "1" || $_SESSION['usuario']->id_rol == "2"): ?>
                                                <th scope="col">Acciones:</th> 
                                            <?php endif; ?>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        <?php while ($ambulancia = $ambulancias->fetch_object()): ?> 
                                            <tr>

                                                <th><?= $ambulancia->id ?></th>
                                                <td><?= $ambulancia->unidad ?> </td>
                                                <td><?= $ambulancia->departamento ?> </td>
                                                <td><?= $ambulancia->ciudad ?> </td>
                                                <td><?= $ambulancia->puntoestrategico ?> </td>
                                                <td><?= $ambulancia->fecha_ingreso ?> </td>
                                                <td><?= $ambulancia->estado ?></td>
                                                <?php if ($_SESSION['usuario']->id_rol == "1" || $_SESSION['usuario']->id_rol == "2"): ?>
                                                    <td>   

                                                        <a class="bi bi-pencil-fill" href="<?= base_url ?>ambulancia/edit&id=<?= $ambulancia->id ?>&iddepartamento=<?= $ambulancia->iddepartamento ?>&idciudad=<?= $ambulancia->idciudad ?>" ></a>
                                                        <?php if ($_SESSION['usuario']->id_rol == "1"): ?>
                                                            <a class="bi bi-eraser-fill" href="<?= base_url ?>ambulancia/eliminar&id=<?= $ambulancia->id ?>" onclick="return confirm('¿Esta Seguro que Desea Eliminar Este Registro?')"></a>
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

    <?php header("Location:" . base_url . "inicio/index"); ?>

<?php endif; ?>

