
<?php include 'views/layouts/navegacion.php'; ?>

<main id="main" class="main">

    <div class="pagetitle">
        <h1>Nueva Asignacion de Ambulancias</h1>
        <nav>
            <ol class="breadcrumb">


                <li class="breadcrumb-item active">Registro de Ambulancias Asignadas</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="row">

        <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Ingrese los Datos de la Ambulancias Asignadas:</h5>


            <div class="card">
                <div class="card-body">
                    <h5 class="card-title"></h5>


                    <?php if (isset($_SESSION['registrar']) && $_SESSION['registrar'] == 'completado'): ?>
                        <script>
                            mensaje('Asignacion de Ambulancia', 'Regitrada');
                        </script>
                    <?php elseif (isset($_SESSION['registrar']) && $_SESSION['registrar'] == 'fallido'): ?>
                        <script>
                            mensajeadvertencia();
                        </script>
                    <?php endif; ?>
                    <?php utilidades::destruirSesion('registrar') ?>

                    <!-- Browser Default Validation -->
                    <form class="row g-3" action="<?= base_url ?>asignacion/guardar" method="POST">
                        <div class="col-md-4">
                            <label for="departamento1d" class="form-label">Departamento:</label>

                            <select class="form-select" id="departamento"  name="departamento" onchange="javascript:getciudad();" required>
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
                            <label for="conductor" class="form-label">Conductor de Ambulancia:</label>
                            <select class="form-select" id="conductor"  name="conductor" required>
                                <option selected disabled value="">Seleccione un Conductor</option>

                            </select>
                        </div>

                        <div class="col-md-4">
                            <label for="paramedico" class="form-label">Paramédico:</label>
                            <select class="form-select" id="paramedico"  name="paramedico" required>
                                <option selected disabled value="">Seleccione un Paramédico</option>

                            </select>
                        </div>


                        <div class="col-md-4">
                            <label for="puntid" class="form-label">Punto Estratégico:</label>

                            <select class="form-select" id="punto"  name="punto"  onchange="javascript:getambulancias();" required>
                                <option selected disabled value="">Seleccione un Punto Estratégico</option>
                            </select>
                        </div>

                        <div class="col-md-4">
                            <label for="ambulanciaid" class="form-label">Ambulancia:</label>
                            <select class="form-select" id="ambulancia" name="ambulancia" required >
                                <option selected disabled value="">Seleccione una Ambulancia</option>
                            </select>
                        </div>


                        <div class="col-md-4">
                            <label for="fechaingresos" class="form-label">Fecha de Asignación:</label>
                            <input type="date" class="form-control" id="fechaingreso"  name="fechaingreso" required>
                        </div>




                        <div class="col-12">
                        <button class="btn btn-primary rounded-pill" onclick="return confirm('¿Esta Seguro que Desea Guardar Este Registro?')" type="submit">Guardar Registro</button></center> 
                        </div>
                    </form>
                </div>

            </div>




    </section>

</main><!-- End #main -->



<?php include ('views/layouts/piepagina.php'); ?>