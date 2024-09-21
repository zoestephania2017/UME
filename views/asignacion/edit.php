
<?php if ($_SESSION['usuario']->id_rol == "1" || $_SESSION['usuario']->id_rol == "2"): ?>


    <?php include 'views/layouts/navegacion.php'; ?>

    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Modificación de Datos de Asignacion de Ambulancia</h1>
            <nav>
                <ol class="breadcrumb">


                    <li class="breadcrumb-item active"></li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section">
            <div class="row">

            <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Ingrese los Datos Correspondientes de la Ambulancia Asignada:</h5>


                        <!-- Browser Default Validation -->
                        <form class="row g-3" action="<?= base_url ?>asignacion/guardar" method="POST">

                            <input type="number" class="form-control" id="id"  name="id" value="<?= $as->id ?>" hidden>


                            <div class="col-md-4">
                                <label for="departamento1d" class="form-label">Departamento:</label>

                                <select class="form-select" id="departamento"  name="departamento" onchange="javascript:getciudad()" required>
                                    <option selected disabled value="">Seleccione un Departamento</option>
                                    <?php while ($departamento = $departamentos->fetch_object()): ?> 
                                        <option value="<?= $departamento->id ?>" <?= $as->iddepartamento == $departamento->id ? 'selected' : '' ?>><?= $departamento->id ?>--<?= $departamento->descripcion ?></option>
                                    <?php endwhile; ?> 
                                </select>
                            </div>


                            <div class="col-md-4">
                                <label for="ciuda1d" class="form-label">Ciudad:</label>

                                <select class="form-select" id="ciudad"  name="ciudad" onchange="javascript:getpuntoestado();" required>
                                    <option selected disabled value="">Seleccione una Ciudad</option>
                                    <?php while ($ciudad = $ciudades->fetch_object()): ?> 
                                        <option value="<?= $ciudad->id ?>" <?= $as->idciudad == $ciudad->id ? 'selected' : '' ?> >--<?= $ciudad->descripcion ?>--</option>
                                    <?php endwhile; ?> 
                                </select>
                            </div>

                            <div class="col-md-4">
                                <label for="conductor" class="form-label">Conductor de Ambulancia:</label>
                                <select class="form-select" id="conductor"  name="conductor" required>
                                    <option selected disabled value="">Seleccione un Conductor</option>
                                    <?php while ($conductor = $conductores->fetch_object()): ?> 
                                        <option value="<?= $conductor->id ?>" <?= $as->idconductor == $conductor->id ? 'selected' : '' ?> ><?= $conductor->identidad ?>--<?= $conductor->primer_nombre ?> <?= $conductor->primer_apellido ?></option>
                                    <?php endwhile; ?> 

                                </select>
                            </div>

                            <div class="col-md-4">
                                <label for="paramedico" class="form-label">Paramédico:</label>
                                <select class="form-select" id="paramedico"  name="paramedico" required>
                                    <option selected disabled value="">Seleccione un Paramédico</option>
                                    <?php while ($paramedico = $paramedicos->fetch_object()): ?> 
                                        <option value="<?= $paramedico->id ?>" <?= $as->idparamedico == $paramedico->id ? 'selected' : '' ?> ><?= $paramedico->identidad ?>--<?= $paramedico->primer_nombre ?> <?= $paramedico->primer_apellido ?></option>
                                    <?php endwhile; ?> 

                                </select>
                            </div>

                            <div class="col-md-4">
                                <label for="puntoid" class="form-label">Punto Estratégico:</label>

                                <select class="form-select" id="punto"  name="punto" onchange="javascript:getambulancia();"  required>
                                    <option selected disabled value="">Seleccione un Punto Estrategico</option>
                                    <?php while ($punto = $puntos->fetch_object()): ?> 
                                        <option value="<?= $punto->id ?>" <?= $as->idpunto == $punto->id ? 'selected' : '' ?> >--<?= $punto->descripcion ?>--</option>
                                    <?php endwhile; ?> 
                                </select>
                            </div>

                            <div class="col-md-4">
                                <label for="ambulanciaid" class="form-label">Ambulancia:</label>
                                <select class="form-select" id="ambulancia" name="ambulancia" required >
                                    <option selected disabled value="">Seleccione una Ambulancia</option>
                                    <?php while ($ambulancia = $ambulancias->fetch_object()): ?> 
                                        <option value="<?= $ambulancia->id ?>" <?= $as->idambulancia == $ambulancia->id ? 'selected' : '' ?> >--<?= $ambulancia->unidad ?>--</option>
                                    <?php endwhile; ?> 
                                </select>
                            </div>

                            <div class="col-md-4">
                                <label for="fechaingresos" class="form-label">Fecha de Asignación:</label>
                                <input type="date" class="form-control" id="fechaingreso"  name="fechaingreso"   value="<?= $as->fecha_ingreso ?>"required>
                            </div>



                            <div class="col-12">
                            <button class="btn btn-warning rounded-pill" onclick="return confirm('¿Esta Seguro que Desea Modificar Este Registro?')" type="submit">Modificar Registro</button></center> 
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

