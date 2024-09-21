 <?php if ($_SESSION['usuario']->id_rol != "1"): ?>
   
<?php header("Location:" . base_url . "inicio/index");?>

<?php endif; ?>

<?php include 'views/layouts/navegacion.php'; ?>
<main id="main" class="main">

    <div class="pagetitle">
        <h1>Registro de Bitacora</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item">Bitacora de Usuarios</li>
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
                                        <th scope="col">Tabla:</th>
                                        <th scope="col">Acción:</th>
                                        <th scope="col">Fecha:</th>
                                        <th scope="col">Usuario:</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    <?php while ($bitacora = $bitacoras->fetch_object()): ?> 
                                        <tr>
                                            <td><?= $bitacora->tabla ?></td>
                                            <td><?= $bitacora->accion ?></td>
                                            <td><?= $bitacora->fecha ?></td>
                                            <td><?= $bitacora->correo ?></td>
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