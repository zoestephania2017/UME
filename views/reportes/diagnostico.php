
<?php if ($_SESSION['usuario']->id_rol == "1" || $_SESSION['usuario']->id_rol == "2"): ?>


    <?php include 'views/layouts/navegacion.php'; ?>




    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Atenciones por Diagnostico </h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item active">Reporte de Atenciones por Diagnostico</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section">
            <div class="row">

            <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Complete los Campos de Acorde a la Informacion:</h5>


                <div class="card">
                    <div class="card-body">

                        <?php if (isset($_SESSION['registrar']) && $_SESSION['registrar'] == 'fallido'): ?>
                            <script>
                                mensajeadvertencia();
                            </script>
                        <?php endif; ?>
                        <?php utilidades::destruirSesion('registrar') ?>
                        <h5 class="card-title"></h5>



                        <!-- Browser Default Validation -->
                        <form class="row g-3" target="_blank" action="<?= base_url ?>reporte/diagnosticopdf" method="POST">

                            <div class="col-md-4">
                                <label for="inicioid" class="form-label">Fecha de Inicio:</label>
                                <input type="date" class="form-control" id="inicio"  name="inicio" required>
                            </div>

                            <div class="col-md-4">
                                <label for="finid" class="form-label">Fecha de Fin:</label>
                                <input type="date" class="form-control" id="fin"  name="fin" required>
                            </div>

                            <div class="col-md-4">
                                <label for="diagnostico" class="form-label">Diagnostico:</label>
                                <select class="form-select" id="diagnostico" name="diagnostico" required >
                                    <option selected disabled value="">Seleccione un Diagnostico</option>
                                    <?php while ($diagnostico = $diagnosticos->fetch_object()): ?> 
                                        <option value="<?= $diagnostico->id ?>"><?= $diagnostico->id ?>--<?= $diagnostico->descripcion ?></option>
                                    <?php endwhile; ?> 
                                    <option value="*" >Todos los Diagnosticos</option>  
                                </select>

                            </div>


                            <div class="col-12">
                            <button class="btn btn-primary rounded-pill" onclick="return confirm('¿Esta Seguro que Desea Generar el PDF?')" type="submit" >Generar Reporte</button></center> 
                            </div>
                        </form>
                        <!-- End Browser Default Validation -->

                    </div>

                </div>




        </section>

    </main><!-- End #main -->






    <?php include ('views/layouts/piepagina.php'); ?>




<?php else: ?>

    <?php header("Location:" . base_url . "inicio/index"); ?>

<?php endif; ?>



