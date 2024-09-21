
 <?php if ($_SESSION['usuario']->id_rol == "1" ||$_SESSION['usuario']->id_rol == "2"): ?>
   

<?php include 'views/layouts/navegacion.php'; ?>

<main id="main" class="main">

    <div class="pagetitle">
        <h1>Modificación de Sala</h1>
        <nav>
            <ol class="breadcrumb">


                <li class="breadcrumb-item active">Datos del Sala</li>
            </ol>
        </nav>
    </div>

    <section class="section">
        <div class="row">


            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Ingrese los Datos de la Sala a Modificar</h5>


                    
                    <form class="row g-3" action="<?= base_url ?>sala/guardar" method="POST">
                    
                        <input type="number" class="form-control" id="id"  name="id" value="<?= $di->id?>" hidden>
                        
                        <div class="col-md-4">
                            <label for="descripcion" class="form-label">Nombre de la Sala:</label>
                            <input type="text" class="form-control" id="descripcion"  name="descripcion" value="<?= $di->descripcion?>" required>
                        </div>


                        <div class="col-12">
                            <center><button class="btn btn-warning rounded-pill" onclick="return confirm('¿Estas seguro que desea modificar la sala?')" type="submit">Modificar</button></center> 
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

