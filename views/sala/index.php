 <?php if ($_SESSION['usuario']->id_rol == "1" ||$_SESSION['usuario']->id_rol == "2"): ?>

<?php include 'views/layouts/navegacion.php'; ?>



<main id="main" class="main">

    <div class="pagetitle">
        <h1>Ver Salas</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item">Lista de Salas Registradas:</li>
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
                                mensaje('Sala', 'Modificada');
                            </script>
                        <?php elseif (isset($_SESSION['registrar']) && $_SESSION['registrar'] == 'fallido'): ?>
                            <script>
                                mensajeadvertencia();
                            </script>

                        <?php elseif (isset($_SESSION['registrar']) && $_SESSION['registrar'] == 'eliminar'): ?>
                            <script>
                             mensaje('Sala', 'Eliminada');
                            </script>
                        <?php endif; ?>
                        <?php utilidades::destruirSesion('registrar') ?>
                        <div class="table-responsive">
                           
                            <table class="table datatable">

                                <thead>
                                    <tr>

                                        <th scope="col">N.º:</th>
                                        <th scope="col">Descripcion:</th>
                                        <th scope="col">Estado:</th>
                                        <?php if ($_SESSION['usuario']->id_rol == "1" || $_SESSION['usuario']->id_rol == "2"): ?>
                                            <th scope="col">Acciones:</th> 
                                        <?php endif; ?>
                                    </tr>
                                </thead>
                                <tbody>

                                    <?php while ($sala = $salas->fetch_object()): ?> 
                                        <tr>

                                            <th><?= $sala->id ?></th>
                                            <td><?= $sala->descripcion ?> </td>
                                            <td><?= $sala->estado ?></td>
                                            <?php if ($_SESSION['usuario']->id_rol == "1" || $_SESSION['usuario']->id_rol == "2"): ?>
                                                <td>   

                                                    <a class="bi bi-pencil-fill" href="<?= base_url ?>sala/edit&id=<?= $sala->id ?>" ></a>
                                                    <?php if ($_SESSION['usuario']->id_rol == "1"): ?>
                                                        <a class="bi bi-eraser-fill" href="<?= base_url ?>sala/eliminar&id=<?= $sala->id ?>" onclick="return confirm('¿Esta Seguro que Desea Eliminar Esta Sala?')"></a>
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

<?php header("Location:" . base_url . "inicio/index");?>

<?php endif; ?>

