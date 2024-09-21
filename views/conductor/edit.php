<?php if ($_SESSION['usuario']->id_rol == "1" || $_SESSION['usuario']->id_rol == "2"): ?>

    <?php include 'views/layouts/navegacion.php'; ?>
    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Modificacion de Conductores</h1>
            <nav>
                <ol class="breadcrumb">


                    <li class="breadcrumb-item active">Ingrese los Datos a Modificar del Conductor:</li>
                </ol>
            </nav>
        </div>

        <section class="section">
            <div class="row">


                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title"></h5>

                       
                        <form class="row g-3" action="<?= base_url ?>conductor/guardar" method="POST">

                            <input type="number" class="form-control" id="id"  name="id" value="<?= $me->id ?>" hidden="" >
                            <div class="col-md-4">
                                <label for="identidad" class="form-label">Identidad:</label>
                                <input type="number" class="form-control" id="identidad"  name="identidad" maxlength="13" value="<?= $me->identidad ?>"  oninput="limitarlongitud(this);" required>
                            </div>
                            <div class="col-md-4">
                                <label for="primernombre" class="form-label">Primer Nombre:</label>
                                <input type="text" class="form-control" id="primernombre" name="primernombre" value="<?= $me->primer_nombre ?>"  required >
                            </div>


                            <div class="col-md-4">
                                <label for="segundonombre" class="form-label">Segundo Nombre:</label>
                                <input type="text" class="form-control" id="segundonombre" name="segundonombre" value="<?= $me->segundo_nombre ?>" required >
                            </div>
                            <div class="col-md-4">
                                <label for="primerapellido" class="form-label">Primer Apellido:</label>
                                <input type="text" class="form-control" id="primerapellido" name="primerapellido" value="<?= $me->primer_apellido ?>" required>
                            </div>


                            <div class="col-md-4">
                                <label for="segundoapellido" class="form-label">Segundo Apellido:</label>
                                <input type="text" class="form-control" id="segundoapellido" name="segundoapellido" value="<?= $me->segundo_apellido ?>" required>
                            </div>

                            <div class="col-md-4">
                                <label for="direccion" class="form-label">Dirección:</label>
                                <textarea type="text" class="form-control" id="direccion" name="direccion"  required><?= $me->direccion ?></textarea>
                            </div>

                            <div class="col-md-4">
                                <label for="telefono" class="form-label">Teléfono:</label>
                                <input type="number" class="form-control" id="telefono"  name="telefono" maxlength="8"  value="<?= $me->telefono ?>" oninput="limitarlongitud(this);" required>
                            </div>


                            <div class="col-md-4">
                                <label for="genero" class="form-label">Género:</label>
                                <select class="form-select" id="genero" name="genero" required>
                                    <option selected disabled value="">Seleccione un Género</option>
                                    <option value="Masculino" <?= $me->genero == "Masculino" ? 'selected' : '' ?>>Masculino</option>
                                    <option value="Femenino" <?= $me->genero == "Femenino" ? 'selected' : '' ?>>Femenino</option>
                                </select>
                            </div>

                            <div class="col-md-4">
                                <label for="estadocivil" class="form-label">Estado Civil:</label>
                                <select class="form-select" id="estadocivil" name="estadocivil" required>
                                    <option selected disabled value="">Seleccione un Estado Civil</option>
                                    <option value="Casado" <?= $me->estado_civil == "Casado" ? 'selected' : '' ?>>Casado</option>
                                    <option value="Unión Libre"<?= $me->estado_civil == "Unión Libre" ? 'selected' : '' ?>>Unión Libre</option>
                                    <option value="Soltero"<?= $me->estado_civil == "Soltero" ? 'selected' : '' ?>>Soltero</option>
                                    <option value="Viudo"<?= $me->estado_civil == "Viudo" ? 'selected' : '' ?>>Viudo</option>
                                </select>
                            </div>


                            <div class="col-md-4">
                                <label for="fechanacimiento" class="form-label">Fecha Nacimiento:</label>
                                <input type="date" class="form-control" id="fechanacimiento"  name="fechanacimiento"  value="<?= $me->fecha_nacimiento ?>" required>
                            </div>

                            <div class="col-md-4">
                                <label for="departamento1d" class="form-label">Departamento:</label>

                                <select class="form-select" id="departamento"  name="departamento" onchange="javascript:getciudad()" required>
                                    <option selected disabled value="">Seleccione un departamento</option>
                                    <?php while ($departamento = $departamentos->fetch_object()): ?> 
                                        <option value="<?= $departamento->id ?>" <?= $me->iddepartamento == $departamento->id ? 'selected' : '' ?>><?= $departamento->id ?>--<?= $departamento->descripcion ?></option>
                                    <?php endwhile; ?> 
                                </select>
                            </div>


                            <div class="col-md-4">
                                <label for="ciuda1d" class="form-label">Ciudad:</label>

                                <select class="form-select" id="ciudad"  name="ciudad" required>
                                    <option selected disabled value="">Seleccione una Ciudad</option>
                                    <?php while ($ciudad = $ciudades->fetch_object()): ?> 
                                        <option value="<?= $ciudad->id ?>" <?= $me->idciudad == $ciudad->id ? 'selected' : '' ?> >--<?= $ciudad->descripcion ?>--</option>
                                    <?php endwhile; ?> 
                                </select>
                            </div>

                            <div class="col-md-4">
                                <label for="fechaingresos" class="form-label">Fecha Ingreso:</label>
                                <input type="date" class="form-control" id="fechaingreso"  name="fechaingreso"   value="<?= $me->fecha_ingreso ?>"required>
                            </div>




                            <div class="col-12">
                            <button class="btn btn-warning rounded-pill" type="submit" onclick="return confirm('¿Esta Seguro que Desea Modificar Este Registro?')" >Modificar Registro</button></center> 
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

