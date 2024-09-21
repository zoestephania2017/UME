
<?php if ($_SESSION['usuario']->id_rol == "1" || $_SESSION['usuario']->id_rol == "2"): ?>


    <?php include 'views/layouts/navegacion.php'; ?>




    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Atenciones por Ambulancia</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item active">Reporte por Atenciones por Ambulancia</li>
                </ol>
            </nav>
        </div>

        <section class="section">
            <div class="row">

            <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Complete los Campos de Acorde a la Informacion:</h5>

            <div class="card">
                    <div class="card-body">
                        <h5 class="card-title"></h5>

                        <?php if (isset($_SESSION['registrar']) && $_SESSION['registrar'] == 'fallido'): ?>
                            <script>
                                mensajeadvertencia();
                            </script>
                        <?php endif; ?>
                        <?php utilidades::destruirSesion('registrar') ?>
                        <h5 class="card-title"></h5>


                        <form class="row g-3" target="_blank" action="<?= base_url ?>reporte/ambulanciapdf" method="POST">

                            <div class="col-md-4">
                                <label for="inicioid" class="form-label">Fecha de Inicio:</label>
                                <input type="date" class="form-control" id="inicio"  name="inicio" required>
                            </div>

                            <div class="col-md-4">
                                <label for="finid" class="form-label">Fecha de Fin:</label>
                                <input type="date" class="form-control" id="fin"  name="fin" required>
                            </div>

                            <div class="col-md-4">
                                <label for="departamento1d" class="form-label">Departamento:</label>

                                <select class="form-select" id="departamento"  name="departamento" onchange="javascript:getciudad()" required>
                                    <option selected disabled value="">Seleccione un Departamento</option>
                                    <?php while ($departamento = $departamentos->fetch_object()): ?> 
                                        <option value="<?= $departamento->id ?>"><?= $departamento->id ?>--<?= $departamento->descripcion ?></option>
                                    <?php endwhile; ?> 

                                </select>
                            </div>


                            <div class="col-md-4">
                                <label for="ciuda1d" class="form-label">Ciudad:</label>

                                <select class="form-select" id="ciudad"  name="ciudad" onchange="javascript:getpunto();" required>
                                    <option selected disabled value="">Seleccione una Ciudad</option>

                                </select>
                            </div>

                            <div class="col-md-4">
                                <label for="puntid" class="form-label">Punto Estratégico:</label>

                                <select class="form-select" id="punto"  name="punto" onchange="javascript:reporteambulancia();" required>
                                    <option selected disabled value="">Seleccione un Punto Estratégico</option>
                                </select>
                            </div>

                            <div class="col-md-4">
                                <label for="ambulancia" class="form-label">Ambulancia:</label>
                                <select class="form-select" id="ambulancia" name="ambulancia" required >
                                    <option selected disabled value="">Seleccione una Ambulancia</option>
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



