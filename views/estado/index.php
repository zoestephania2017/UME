 <?php if ($_SESSION['usuario']->id_rol != "1"): ?>
   
<?php header("Location:" . base_url . "inicio/index");?>

<?php endif; ?>

<?php include 'views/layouts/navegacion.php'; ?>
<main id="main" class="main">

    <div class="pagetitle">
        <h1>Registro de Estados</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item">Lista de Estados Registrados</li>
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

                                        <th scope="col">Id</th>
                                        <th scope="col">Descripción</th>
                                        <th scope="col">Acciones</th>


                                    </tr>
                                </thead>
                                <tbody>
                                          <?php while ($estado = $estados->fetch_object()): ?> 
                                        <tr>
                                            <td><?=$estado->id ?></td>
                                            <td><?=$estado->descripcion ?></td>
                                            <td>   

                                                <a class="bi bi-pencil-fill" href="#" ></a>
                                                <a class="bi bi-eraser-fill" href="#" ></a>

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