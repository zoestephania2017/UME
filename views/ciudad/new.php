
<?php if ($_SESSION['usuario']->id_rol == "1" || $_SESSION['usuario']->id_rol == "2"): ?>


    <?php include 'views/layouts/navegacion.php'; ?>



    <?php if (isset($_SESSION['registrar']) && $_SESSION['registrar'] == 'completado'): ?>
        <script>
            mensaje('Ciudad', 'Regitrada');
        </script>
    <?php elseif (isset($_SESSION['registrar']) && $_SESSION['registrar'] == 'fallido'): ?>
        <script>
            mensajeadvertencia();
        </script>
    <?php endif; ?>
    <?php utilidades::destruirSesion('registrar') ?>



    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Nueva Ciudad</h1>
            <nav>
                <ol class="breadcrumb">


                    
                </ol>
            </nav>
        </div>

        <section class="section">
            <div class="row">

            
            <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Ingrese los Datos de la Ciudad:</h5>


                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title"></h5>

                        <form class="row g-3" action="<?= base_url ?>ciudad/guardar" method="POST">
                            
                            <div class="col-md-4">
                                <label for="departamento1d" class="form-label">Departamento:</label>

                                <select class="form-select" id="departamento"  name="departamento" required>
                                    <option selected disabled value="">Seleccione un departamento</option>
                                    <?php while ($departamento = $departamentos->fetch_object()): ?> 
                                        <option value="<?= $departamento->id ?>"><?= $departamento->id ?>--<?= $departamento->descripcion ?></option>
                                    <?php endwhile; ?> 
                                </select>
                            </div>



                            <div class="col-md-4">
                                <label for="descripcion" class="form-label">Nombre de la Ciudad:</label>
                                <input type="text" class="form-control" id="descripcion"  name="descripcion" required>
                            </div>

                            <div class="col-12">
                            <button class="btn btn-primary rounded-pill" onclick="return confirm('¿Estas Seguro que Desea Guardar Este Dato?')" type="submit" >Guardar Ciudad</button></center> 
                            </div>
                        </form>
                        

                    </div>

                </div>




        </section>

    </main>






    <?php include ('views/layouts/piepagina.php'); ?>




<?php else: ?>

    <?php header("Location:" . base_url . "inicio/index"); ?>

<?php endif; ?>



