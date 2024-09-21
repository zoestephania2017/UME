
<?php include 'views/layouts/navegacion.php'; ?>

<main id="main" class="main">

    <div class="pagetitle">
        <h1>Modificación de Atenciones</h1>
        <nav>
            <ol class="breadcrumb">


                <li class="breadcrumb-item active">Registro de Atención</li>
            </ol>
        </nav>
    </div>

    <section class="section">
        <div class="row">


            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Ingrese los Datos a modificar de la Atención</h5>

                    <?php if (isset($_SESSION['registrar']) && $_SESSION['registrar'] == 'completado'): ?>
                        <div class="alert alert-success bg-success text-light border-0 alert-dismissible fade show" role="alert">
                            ¡Atención Registrada Exitosamente!
                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    <?php elseif (isset($_SESSION['registrar']) && $_SESSION['registrar'] == 'fallido'): ?>
                        <div class="alert alert-danger bg-danger text-light border-0 alert-dismissible fade show" role="alert">
                            Atención no registrada, complete todos los campos requeridos.
                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    <?php endif; ?>
                    <?php utilidades::destruirSesion('registrar') ?>

                   
                    <form class="row g-3" action="<?= base_url ?>Atencion/guardar" method="POST">


                        <input type="number" class="form-control" id="id"  name="id" value="<?= $at->id ?>" hidden="" >


                        <div class="col-md-4">
                            <label for="paciente" class="form-label">Paciente</label>
                            <input type="text" class="form-control" id="paciente" name="paciente" required value="<?= $pa->identidad ?>--<?= $pa->nombre ?> <?= $pa->apellido ?>" disabled>

                        </div>


                        <div class="col-md-4">
                            <label for="tipoincidente" class="form-label">Tipo de Incidente:</label>
                            <input type="text" class="form-control" id="tipoincidente" name="tipoincidente" required value="<?= $at->tipo_incidente ?>">
                        </div>

                        <div class="col-md-4">
                            <label for="lugarincidente" class="form-label">Lugar del Incidente:</label>
                            <textarea type="text" class="form-control" id="lugarincidente" name="lugarincidente" required><?= $at->lugar_incidente ?></textarea>
                        </div>


                        <div class="col-md-4">
                            <label for="atencionbrindada" class="form-label">Atención Brindada:</label>
                            <select class="form-select" id="atencionbrindada" name="atencionbrindada" required>
                                <option selected disabled value="" >Seleccione la Atención Bridada...</option>
                                <option value="Ninguno" <?= $at->atencion_brindada == "Ninguno" ? 'selected' : '' ?>>Ninguno</option>
                                <option value="Primero Auxilios" <?= $at->atencion_brindada == "Primero Auxilios" ? 'selected' : '' ?>>Primero Auxilios</option>
                                <option value="Traslado Hospital" <?= $at->atencion_brindada == "Traslado Hospital" ? 'selected' : '' ?>>Traslado Hospital</option>
                                <option value="Rehusó" <?= $at->atencion_brindada == "Rehusó" ? 'selected' : '' ?>>Rehusó</option>

                            </select>
                        </div>

                        <div class="col-md-4">
                            <label for="traslado" class="form-label">Traslado:</label>
                            <select class="form-select" id="traslado" name="traslado"  required>
                                <option selected disabled value="">Seleccione un traslado...</option>
                                <option value="Se Rehusá" <?= $at->traslado == "Se Rehusá" ? 'selected' : '' ?>>Se Rehusá</option>
                                <option value="Por Ambulancia UME" <?= $at->traslado == "Por Ambulancia UME" ? 'selected' : '' ?>>Por Ambulancia UME</option>
                                <option value="Por Otra Ambulancia" <?= $at->traslado == "Por Otra Ambulancia" ? 'selected' : '' ?>>Por Otra Ambulancia</option>
                                <option value="Por Policia Nacional" <?= $at->traslado == "Por Policia Nacional" ? 'selected' : '' ?>>Por Policia Nacional</option>
                                <option value="Por Policia Militar" <?= $at->traslado == "Por Policia Militar" ? 'selected' : '' ?>>Por Policia Militar</option>
                                <option value="Por Policia Bomberos" <?= $at->traslado == "Por Policia Bomberos" ? 'selected' : '' ?>>Por Policia Bomberos</option>
                                <option value="Carro Particular" <?= $at->traslado == "Carro Particular" ? 'selected' : '' ?>>Carro Particular</option>

                            </select>
                        </div>
                        
                        <div class="col-md-4">
                            <label for="ciuda1d" class="form-label">Seleccione un Punto Estratégico:</label>

                            <select class="form-select" id="punto"  name="punto" onchange="javascript:getambulancia();" required>
                                <option selected disabled value="">Seleccione un Punto Estrategico...</option>
                                <?php while ($punto = $puntos->fetch_object()): ?> 
                                    <option value="<?= $punto->id ?>" <?= $at->idpunto == $punto->id ? 'selected' : '' ?> >--<?= $punto->descripcion ?>--</option>
                                <?php endwhile; ?> 
                            </select>
                        </div>


                        <div class="col-md-4">
                            <label for="ambulancia" class="form-label">Ambulancia:</label>
                            <select class="form-select" id="ambulancia" name="ambulancia" required >
                                <option selected disabled value="">Seleccione una ambulancia...</option>
                                <?php while ($ambulancia = $ambulancias->fetch_object()): ?>   
                                        <option value="<?= $ambulancia->id ?>" <?= $at->id_ambulancia == $ambulancia->id ? 'selected' : '' ?>>--<?= $ambulancia->unidad ?>--</option>
                           
                                <?php endwhile; ?> 
                            </select>
                        </div>


                        <div class="col-md-4">
                            <label for="centroasistencial" class="form-label">Centro Asistencial:</label>
                            <select class="form-select" id="centroasistencial" name="centroasistencial" required >
                                <option selected disabled value="">Seleccione un Centro Asistencial...</option>
                                <?php while ($centro = $centros->fetch_object()): ?> 
                             
                                        <option value="<?= $centro->id ?>" <?= $at->idcentro == $centro->id ? 'selected' : '' ?>>--<?= $centro->descripcion ?>--</option>
                               
                                <?php endwhile; ?>  
                            </select>
                        </div>

                        <div class="col-md-4">
                            <label for="ophs" class="form-label">OPHS:</label>
                            <select class="form-select" id="ophs" name="ophs" required>
                                <option selected disabled value="">Seleccione un Medico...</option>
                                <?php while ($medico = $medicos->fetch_object()): ?> 
     
                                        <option value="<?= $medico->id ?>" <?= $at->idmedico == $medico->id ? 'selected' : '' ?>><?= $medico->identidad ?>--<?= $medico->primer_nombre ?> <?= $medico->primer_apellido ?></option>
                    
                                <?php endwhile; ?> 
                            </select>
                        </div>


                        <div class="col-md-4">
                            <label for="sala" class="form-label">Sala de Ingreso:</label>
                            <select class="form-select" id="sala" name="sala" required>
                                <option selected disabled value="">Seleccione una Sala...</option>
                                <?php while ($sala = $salas->fetch_object()): ?> 
                                    <option value="<?= $sala->id ?>" <?= $at->id_sala == $sala->id ? 'selected' : '' ?>><?= $sala->id ?>--<?= $sala->descripcion ?></option>
                                <?php endwhile; ?> 
                            </select>
                        </div>

                        <div class="col-md-4">
                            <label for="diagnostico" class="form-label">Diagnostico:</label>
                            <select class="form-select" id="diagnostico" name="diagnostico" required >
                                <option selected disabled value="">Seleccione un Diagnostico...</option>
                                <?php while ($diagnostico = $diagnosticos->fetch_object()): ?> 
                                    <option value="<?= $diagnostico->id ?>"  <?= $at->id_diagnostico == $diagnostico->id ? 'selected' : '' ?>> <?= $diagnostico->id ?>--<?= $diagnostico->descripcion ?></option>
                                <?php endwhile; ?> 
                            </select>
                        </div>


                        <div class="col-md-4">
                            <label for="patologia" class="form-label">Patología:</label>
                            <textarea type="text" class="form-control" id="patologia" name="patologia" required><?= $at->patologia ?></textarea>
                        </div>


                        <div class="col-md-4">
                            <label for="estado" class="form-label">Estado de la Atención:</label>
                            <select class="form-select" id="estado" name="estado" required>
                                <option selected disabled value="">Seleccione el Estado...</option>
                                <option value="Exitoso" <?= $at->estado == "Exitoso" ? 'selected' : '' ?> >Exitoso</option>
                                <option value="Fallido" <?= $at->estado == "Fallido" ? 'selected' : '' ?>>Fallido</option>
                                <option value="Falsa Alarma" <?= $at->estado == "Falsa Alarma" ? 'selected' : '' ?>>Falsa Alarma</option>

                            </select>
                        </div>


                        <div class="col-12">
                            <center><button class="btn btn-warning" onclick="return confirm('¿Estas seguro que desea modificar la atención?')" type="submit">Modificar</button></center> 
                        </div>
                    </form>
                </div>

            </div>




    </section>

</main>



<?php include ('views/layouts/piepagina.php'); ?>