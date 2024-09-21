
 <?php if ($_SESSION['usuario']->id_rol == "1" ||$_SESSION['usuario']->id_rol == "2"): ?>
   

<?php include 'views/layouts/navegacion.php'; ?>

<main id="main" class="main">

    <div class="pagetitle">
        <h1>Modificación de Departamento</h1>
        <nav>
            <ol class="breadcrumb">


                
            </ol>
        </nav>
    </div>

    <section class="section">
        <div class="row">


            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Ingrese el Nuevo Nombre del Departamento:</h5>


                  
                    <form class="row g-3" action="<?= base_url ?>departamento/guardar" method="POST">
                    
                        <input type="number" class="form-control" id="id"  name="id" value="<?= $dp->id?>" hidden>
                        
                        <div class="col-md-4">
                            
                            <input type="text" class="form-control" id="descripcion"  name="descripcion" value="<?= $dp->descripcion?>" required>
                        </div>


                        <div class="col-12">
                            <button class="btn btn-warning rounded-pill" onclick="return confirm('¿Estas Seguro que Desea Modificar el Departamento?')" type="submit">Modificar Departamento</button>
                        </div>
                    </form>
                    

                </div>

            </div>




    </section>

</main><!-- End #main -->



<?php include ('views/layouts/piepagina.php'); ?>


<?php else: ?>

<?php header("Location:" . base_url . "inicio/index");?>

<?php endif; ?>

