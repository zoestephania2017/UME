
<?php include 'views/layouts/navegacion.php'; ?>

<main id="main" class="main">

    <div class="pagetitle">
        <h1>Modificación de Datos del Pacientes</h1>
        <nav>
            <ol class="breadcrumb">


                <li class="breadcrumb-item active">Datos Actuales del Paciente</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="row">


            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Ingrese los Nuevos Datos del Paciente a Modificar</h5>


                    <!-- Browser Default Validation -->
                    <form class="row g-3" action="<?= base_url ?>Paciente/guardar" method="POST">
                    
                        <input type="number" class="form-control" id="id"  name="id" value="<?= $pa->id?>" hidden="">
                        
                        <div class="col-md-4">
                            <label for="identidad" class="form-label">Identidad:</label>
                            <input type="number" class="form-control" id="identidad"  name="identidad" maxlength="13"  oninput="limitarlongitud(this);" value="<?= $pa->identidad?>" >
                        </div>
                        <div class="col-md-4">
                            <label for="primernombre" class="form-label">Primer Nombre:</label>
                            <input type="text" class="form-control" id="primernombre"  name="primernombre"  value="<?= $pa->nombre?>" >
                        </div>
                        <div class="col-md-4">
                            <label for="primerapellido" class="form-label">Primer Apellido:</label>
                            <input type="text" class="form-control" id="primerapellido" name="primerapellido"  value="<?= $pa->apellido?>" >
                        </div>

                        <div class="col-md-4">
                            <label for="fechanacimiento" class="form-label">Fecha de Nacimiento:</label>
                            <input type="date" class="form-control" id="fechanacimiento" name="fechanacimiento" value="<?= $pa->fecha_nacimiento?>" >
                        </div>

                        <div class="col-md-4">
                            <label for="ocupacion" class="form-label">Ocupación:</label>
                            <input type="text" class="form-control" id="ocupacion" name="ocupacion" value="<?= $pa->ocupacion?>" >
                        </div>


                        <div class="col-md-4">
                            <label for="genero" class="form-label">Género:</label>
                            <select class="form-select" id="genero" name="genero" value="<?= $pa->genero?>" required>
                                <option selected disabled value="" <?=$pa->genero == " " ? 'selected': ''?>>Seleccione un Género</option>
                                <option value="Masculino" <?=$pa->genero == "Masculino" ? 'selected': ''?>>Masculino</option>
                                <option value="Femenino"<?=$pa->genero == "Femenino" ? 'selected': ''?>>Femenino</option>
                            </select>
                        </div>

                        <div class="col-md-4">
                            <label for="estadocivil" class="form-label">Estado Civil:</label>
                            <select class="form-select" id="estadocivil" name="estadocivil" value="<?= $pa->estado_civil?>"  >
                                <option value=" " <?=$pa->estado_civil == " " ? 'selected': ''?>>Seleccione un Estado Civil</option>
                                <option value="Casado" <?=$pa->estado_civil == "Casado" ? 'selected': ''?>>Casado</option>
                                <option value="Unión Libre" <?=$pa->estado_civil == "Unión Libre" ? 'selected': ''?>>Unión Libre</option>
                                <option value="Soltero" <?=$pa->estado_civil == "Soltero" ? 'selected': ''?>>Soltero</option>
                                <option value="Viudo" <?=$pa->estado_civil == "Viudo" ? 'selected': ''?>>Viudo</option>

                            </select>
                        </div>

                        <div class="col-md-4">
                            <label for="direccion" class="form-label">Domicilio:</label>
                            <textarea type="text" class="form-control" id="direccion" name="direccion"  ><?= $pa->direccion?></textarea>
                        </div>
                        <div class="col-md-4">
                            <label for="acompanante" class="form-label">Acompañante:</label>
                            <input type="text" class="form-control" id="acompanante" name="acompanante"  value="<?= $pa->acompanante?>" >
                        </div>


                        <div class="col-md-4">
                            <label for="parentesco" class="form-label">Parentesco:</label>
                            <input type="text" class="form-control" id="parentesco"  name="parentesco" value="<?= $pa->parentesco?>" >
                        </div>

                        <div class="col-md-4">
                            <label for="telefono" class="form-label">Teléfono:</label>
                            <input type="number" class="form-control" id="telefono"  name="telefono" maxlength="8"  value="<?= $pa->telefono?>"  oninput="limitarlongitud(this);" >
                        </div>
                        

                            <div class="col-md-4">
                                <label for="departamento1d" class="form-label">Departamento:</label>

                                <select class="form-select" id="departamento"  name="departamento" onchange="javascript:getunaciudad()" required>
                                    <option selected disabled value="">Seleccione un departamento</option>
                                    <?php while ($departamento = $departamentos->fetch_object()): ?> 
                                        <option value="<?= $departamento->id ?>" <?= $pa->iddepartamento == $departamento->id ? 'selected' : '' ?>><?= $departamento->id ?>--<?= $departamento->descripcion ?></option>
                                    <?php endwhile; ?> 
                                </select>
                            </div>


                            <div class="col-md-4">
                                <label for="ciuda1d" class="form-label">Ciudad:</label>

                                <select class="form-select" id="ciudad"  name="ciudad" required>
                                    <option selected disabled value="">Seleccione una Ciudad</option>
                                    <?php while ($ciudad = $ciudades->fetch_object()): ?> 
                                        <option value="<?= $ciudad->id ?>" <?= $pa->idciudad == $ciudad->id ? 'selected' : '' ?> >--<?= $ciudad->descripcion ?>--</option>
                                    <?php endwhile; ?> 
                                </select>
                            </div>

                        <div class="col-md-12">
                            <label for="comentario" class="form-label">Comentario:</label>
                            <textarea type="text" class="form-control" id="comentario" name="comentario" required maxlength="256"><?= $pa->comentario?></textarea>
                        </div>

                        <div class="col-12">
                        <button class="btn btn-warning rounded-pill" onclick="return confirm('¿Estas seguro que desea modificar el paciente?')" type="submit">Modificar Datos</button></center> 
                        </div>
                    </form>
                    <!-- End Browser Default Validation -->

                </div>

            </div>




    </section>

</main><!-- End #main -->



<?php include ('views/layouts/piepagina.php'); ?>


