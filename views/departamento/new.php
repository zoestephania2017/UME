
 <?php if ($_SESSION['usuario']->id_rol == "1" ||$_SESSION['usuario']->id_rol == "2"): ?>
   

<?php include 'views/layouts/navegacion.php'; ?>



               <?php if (isset($_SESSION['registrar']) && $_SESSION['registrar'] == 'completado'): ?>
                    <script>
                        mensaje('Departamento','Regitrada');
                        </script>
                    <?php elseif (isset($_SESSION['registrar']) && $_SESSION['registrar'] == 'fallido'): ?>
                      <script>
                        mensajeadvertencia();
                       </script>
                    <?php endif; ?>
                    <?php utilidades::destruirSesion('registrar') ?>



<main id="main" class="main">

    <div class="pagetitle">
        <h1>Nuevo Departamento</h1>
        <nav>
            <ol class="breadcrumb">


                <li class="breadcrumb-item active">Ingrese un Nuevo Departamento</li>
            </ol>
        </nav>
    </div>

    <section class="section">
        <div class="row">

        <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Nombre del Departamento:</h5>



            <div class="card">
                <div class="card-body">
                    <h5 class="card-title"></h5>

     

                  
                    <form class="row g-3" action="<?= base_url ?>departamento/guardar" method="POST">
                        <div class="col-md-4">
                            
                            <input type="text" class="form-control" id="descripcion"  name="descripcion" required>
                        </div>
                       
                        <div class="col-12">
                        <button class="btn btn-primary rounded-pill" onclick="return confirm('¿Estas Seguro que Desea Guardar Este Registro?')" type="submit" >Guardar Registro</button></center> 
                        </div>
                    </form>
                </div>

            </div>




    </section>

</main>






<?php include ('views/layouts/piepagina.php'); ?>




<?php else: ?>

<?php header("Location:" . base_url . "inicio/index");?>

<?php endif; ?>



