
<?php include 'views/layouts/navegacion.php'; ?>

<main id="main" class="main">

    <div class="pagetitle">
        <h1>Nueva Atencion</h1>
        <nav>
            <ol class="breadcrumb">


                <li class="breadcrumb-item active">Registro de Atenciones</li>
            </ol>
        </nav>
    </div>

    <section class="section">
        <div class="row">

        <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Ingrese los Datos de la Atención:</h5>


            <div class="card">
                <div class="card-body">
                    <h5 class="card-title"></h5>


                    <?php if (isset($_SESSION['registrar']) && $_SESSION['registrar'] == 'completado'): ?>
                        <script>
                            mensaje('Atencion', 'Regitrada');
                        </script>
                    <?php elseif (isset($_SESSION['registrar']) && $_SESSION['registrar'] == 'fallido'): ?>
                        <script>
                            mensajeadvertencia();
                        </script>
                    <?php endif; ?>
                    <?php utilidades::destruirSesion('registrar') ?>

                    
                    <form class="row g-3" action="<?= base_url ?>Atencion/guardar" method="POST">
                        <div class="col-md-4">
                            <label for="departamento1d" class="form-label">Departamento:</label>

                            <select class="form-select" id="departamento"  name="departamento" onchange="javascript:getunaciudad();" required>
                                <option selected disabled value="">Seleccione un departamento</option>
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
                            <label for="paciente" class="form-label">Paciente</label>
                            <select class="form-select" id="paciente"  name="paciente" required>
                                <option selected disabled value="">Seleccione un Paciente</option>
                                <?php while ($paciente = $pacientes->fetch_object()): ?> 
                                    <option value="<?= $paciente->id ?>"><?= $paciente->id ?>--<?= $paciente->nombre ?></option>
                                <?php endwhile; ?> 

                            </select>
                        </div>


                        <div class="col-md-4">
                            <label for="tipoincidente" class="form-label">Tipo de Incidente:</label>
                            <input type="text" class="form-control" id="tipoincidente" name="tipoincidente" required>
                        </div>

                        <div class="col-md-4">
                            <label for="lugarincidente" class="form-label">Lugar del Incidente:</label>
                            <textarea type="text" class="form-control" id="lugarincidente" name="lugarincidente" required></textarea>
                        </div>


                        <div class="col-md-4">
                            <label for="atencionbrindada" class="form-label">Atención Brindada:</label>
                            <select class="form-select" id="atencionbrindada" name="atencionbrindada" required>
                                <option selected disabled value="">Seleccione la Atención Bridada</option>
                                <option value="Ninguno">Ninguno</option>
                                <option value="Primero Auxilios">Primero Auxilios</option>
                                <option value="Traslado Hospital">Traslado a Hospital</option>
                                <option value="Rehusó">Rehusó</option>

                            </select>
                        </div>

                        <div class="col-md-4">
                            <label for="traslado" class="form-label">Traslado:</label>
                            <select class="form-select" id="traslado" name="traslado"  required>
                                <option selected disabled value="">Seleccione un traslado</option>
                                <option value="Se Rehusá">Se Rehusá</option>
                                <option value="Por Ambulancia UME">Unidad Medica de Emergencias UME</option>
                                <option value="Por Otra Ambulancia">Otra Ambulancia</option>
                                <option value="Por Policia Nacional">Policia Nacional</option>
                                <option value="Por Policia Militar">Policia Militar</option>
                                <option value="Por Policia Bomberos">Bomberos</option>
                                <option value="Carro Particular">Carro Particular</option>

                            </select>
                        </div>

                        <div class="col-md-4">
                            <label for="puntid" class="form-label">Punto Estratégico:</label>

                            <select class="form-select" id="punto"  name="punto"  onchange="javascript:getambulancia();" required>
                                <option selected disabled value="">Seleccione un Punto Estratégico:</option>
                                <?php while ($punto = $puntos->fetch_object()): ?>
                                   <option value="<?= $punto->id ?>"><?= $punto->id ?> -- <?= $punto->descripcion ?></option>
                                <?php endwhile;?>
                            </select>
                        </div>


                        <div class="col-md-4">
                            <label for="ambulancia" class="form-label">Ambulancia:</label>
                            <select class="form-select" id="ambulancia" name="ambulancia" required >
                                <option selected disabled value="">Seleccione una Ambulancia</option>
                                <?php while ($ambulancia = $ambulancias->fetch_object()): ?> 
                                    <option value="<?= $ambulancia->id ?>"><?= $ambulancia->id ?>--<?= $ambulancia->unidad ?></option>
                                <?php endwhile; ?> 
                            </select>
                        </div>
                                <!--Cambios -->

                        <div class="col-md-4">
                            <label for="centroasistencial" class="form-label">Centro Asistencial:</label>
                            <select class="form-select" id="centroasistencial" name="centroasistencial" required >
                                <option selected disabled value="">Seleccione un Centro Asistencial</option>
                                <?php while ($CentroAsistencial = $CentrosAsistencial->fetch_object()): ?>
                                   <option value="<?= $CentroAsistencial->id ?>"><?= $CentroAsistencial->id ?> -- <?= $CentroAsistencial->descripcion ?></option>
                                <?php endwhile;?>
                            </select>
                        </div>

                        <div class="col-md-4">
                            <label for="ophs" class="form-label">OPHS:</label>
                            <select class="form-select" id="ophs" name="ophs" required>
                                <option selected disabled value="">Seleccione un Medico</option>
                            </select>
                        </div>


                        <div class="col-md-4">
                            <label for="sala" class="form-label">Sala de Ingreso:</label>
                            <select class="form-select" id="sala" name="sala" required>
                                <option selected disabled value="">Seleccione una Sala</option>
                                <?php while ($sala = $salas->fetch_object()): ?> 
                                    <option value="<?= $sala->id ?>"><?= $sala->id ?>--<?= $sala->descripcion ?></option>
                                <?php endwhile; ?> 
                            </select>
                        </div>

                        <div class="col-md-4">
                            <label for="diagnostico" class="form-label">Diagnostico:</label>
                            <select class="form-select" id="diagnostico" name="diagnostico" required >
                                <option selected disabled value="">Seleccione un Diagnostico</option>
                                <?php while ($diagnostico = $diagnosticos->fetch_object()): ?> 
                                    <option value="<?= $diagnostico->id ?>"><?= $diagnostico->id ?>--<?= $diagnostico->descripcion ?></option>
                                <?php endwhile; ?> 
                            </select>
                        </div>


                        <div class="col-md-4">
                            <label for="patologia" class="form-label">Patología:</label>
                            <textarea type="text" class="form-control" id="patologia" name="patologia" required></textarea>
                        </div>


                        <div class="col-md-4">
                            <label for="estado" class="form-label">Estado de la Atención:</label>
                            <select class="form-select" id="estado" name="estado" required>
                                <option selected disabled value="">Seleccione el Estado</option>
                                <option value="Exitoso">Exitoso</option>
                                <option value="Fallido">Fallido</option>
                                <option value="Falsa Alarma">Falsa Alarma</option>

                            </select>
                        </div>


                        <div class="col-12">
                        <button class="btn btn-primary rounded-pill" onclick="return confirm('¿Estas Seguro que Desea Guardar Este Registro?')" type="submit">Guardar Registro</button></center> 
                        </div>
                    </form>
                </div>

            </div>




    </section>

</main><!-- End #main -->



<?php include ('views/layouts/piepagina.php'); ?>