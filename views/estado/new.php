 <?php if ($_SESSION['usuario']->id_rol != "1"): ?>
   
<?php header("Location:" . base_url . "inicio/index");?>

<?php endif; ?>
<?php include 'views/layouts/navegacion.php'; ?>
<main id="main" class="main">

    <div class="pagetitle">
        <h1>Ingreso de Estados</h1>
        <nav>
            <ol class="breadcrumb">


                <li class="breadcrumb-item active">Registro de Estados</li>
            </ol>
        </nav>
    </div>

    <section class="section">
        <div class="row">


            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Ingrese los Datos del Estados</h5>
                    <?php if (isset($_SESSION['registrar']) && $_SESSION['registrar'] == 'completado'): ?>
                        <div class="alert alert-success bg-success text-light border-0 alert-dismissible fade show" role="alert">
                            Estado Registrado Exitosamente!
                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    <?php elseif (isset($_SESSION['registrar']) && $_SESSION['registrar'] == 'fallido'): ?>
                        <div class="alert alert-danger bg-danger text-light border-0 alert-dismissible fade show" role="alert">
                            Estado no Registrado, Complete los campos!
                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    <?php endif; ?>
                    <?php utilidades::destruirSesion('registrar') ?>


                    
                    <form class="row g-3" action="<?= base_url ?>estado/guardar" method="POST">
                        <div class="col-md-4">
                            <label for="descripcion" class="form-label">Descripción:</label>
                            <input type="text" class="form-control" id="descripcion"  name="descripcion" required>
                        </div>
                        <div class="col-12">
                            <center><button class="btn btn-success"  type="submit">Guardar</button></center> 
                        </div>
                    </form>
                  

                </div>

            </div>




    </section>

</main>



<?php include ('views/layouts/piepagina.php'); ?>