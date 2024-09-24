<?php if ($_SESSION['usuario']->id_rol == "1" || $_SESSION['usuario']->id_rol == "2"): ?>

    <?php include 'views/layouts/navegacion.php'; ?>
    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Nuevos Médicos</h1>
            <nav>
                <ol class="breadcrumb">


                    <li class="breadcrumb-item active">Registro de un Nuevo Médico</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section">
            <div class="row">

            <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Ingrese los Datos del Nuevo Medico:</h5>


                <div class="card">
                    <div class="card-body">
                        <?php if (isset($_SESSION['registrar']) && $_SESSION['registrar'] == 'completado'): ?>
                            <script>
                                mensaje('Médico', 'Regitrado');
                            </script>
                        <?php elseif (isset($_SESSION['registrar']) && $_SESSION['registrar'] == 'fallido'): ?>
                            <script>
                                mensajeadvertencia();
                            </script>
                            <?php elseif (isset($_SESSION['registrar']) && $_SESSION['registrar'] == 'duplicated'): ?>
                            <script>
                                messageDuplicated('El campo id ya existe, por favor coloca otro');
                                </script>
                        <?php elseif (isset($_SESSION['registrar']) && $_SESSION['registrar'] == 'existe'): ?>
                            <script>
                                mensajeerror();
                            </script>
                        <?php endif; ?>
                        <?php utilidades::destruirSesion('registrar') ?>


                        <!-- Browser Default Validation -->
                        <form class="row g-3" action="<?= base_url ?>medico/guardar" method="POST">
                            <div class="col-md-4">
                                <label for="identidad" class="form-label">Identidad:</label>
                                <input type="number" class="form-control" id="identidad"  name="identidad" maxlength="13"  oninput="limitarlongitud(this);" required>
                            </div>
                            <div class="col-md-4">
                                <label for="primernombre" class="form-label">Primer Nombre:</label>
                                <input type="text" class="form-control" id="primernombre" name="primernombre" required >
                            </div>


                            <div class="col-md-4">
                                <label for="segundonombre" class="form-label">Segundo Nombre:</label>
                                <input type="text" class="form-control" id="segundonombre" name="segundonombre" required >
                            </div>
                            <div class="col-md-4">
                                <label for="primerapellido" class="form-label">Primer Apellido:</label>
                                <input type="text" class="form-control" id="primerapellido" name="primerapellido" required>
                            </div>


                            <div class="col-md-4">
                                <label for="segundoapellido" class="form-label">Segundo Apellido:</label>
                                <input type="text" class="form-control" id="segundoapellido" name="segundoapellido" required>
                            </div>

                            <div class="col-md-4">
                                <label for="direccion" class="form-label">Dirección:</label>
                                <textarea type="text" class="form-control" id="direccion" name="direccion"  required></textarea>
                            </div>

                            <div class="col-md-4">
                                <label for="telefono" class="form-label">Teléfono:</label>
                                <input type="number" class="form-control" id="telefono"  name="telefono" maxlength="8"  oninput="limitarlongitud(this);" required>
                            </div>


                            <div class="col-md-4">
                                <label for="genero" class="form-label">Género:</label>
                                <select class="form-select" id="genero" name="genero" required>
                                    <option selected disabled value="">Seleccione un Género</option>
                                    <option value="Masculino">Masculino</option>
                                    <option value="Femenino">Femenino</option>
                                </select>
                            </div>

                            <div class="col-md-4">
                                <label for="estadocivil" class="form-label">Estado Civil:</label>
                                <select class="form-select" id="estadocivil" name="estadocivil" required>
                                    <option selected disabled value="">Seleccione un Estado Civil</option>
                                    <option value="Casado">Casado</option>
                                    <option value="Casada">Casada</option>
                                    <option value="Unión Libre">Unión Libre</option>
                                    <option value="Soltero">Soltero</option>
                                    <option value="Soltera">Soltera</option>
                                    <option value="Viudo">Viudo</option>
                                    <option value="Viuda">Viuda</option>
                                </select>
                            </div>

                            <div class="col-md-4">
                                <label for="fechanacimiento" class="form-label">Fecha Nacimiento:</label>
                                <input type="date" class="form-control" id="fechanacimiento"  name="fechanacimiento" minlength="8" maxlength="8" required>
                            </div>


                      <div class="col-md-4">
                                <label for="departamento1d" class="form-label">Departamento:</label>

                                <select class="form-select" id="departamento"  name="departamento" onchange="javascript:getciudad()" required>
                                    <option selected disabled value="">Seleccione un departamento</option>
                                    <?php while ($departamento = $departamentos->fetch_object()): ?> 
                                        <option value="<?= $departamento->id ?>"><?= $departamento->id ?>--<?= $departamento->descripcion ?></option>
                                    <?php endwhile; ?> 
                                </select>
                            </div> 

                            <div class="col-md-4">
                                <label for="ciuda1d" class="form-label">Ciudad:</label>

                                <select class="form-select" id="ciudad"  name="ciudad" required>
                                    
                                <option selected disabled value="">Seleccione un departamento</option>
                                    <?php while ($ciudad = $ciudades->fetch_object()): ?> 
                                        <option value="<?= $ciudad->id ?>"><?= $ciudad->id ?>--<?= $ciudad->descripcion ?></option>
                                    <?php endwhile; ?> 
                                </select>
                            </div>

                            <div class="col-md-4">
                                <label for="fechaingresos" class="form-label">Fecha Ingreso:</label>
                                <input type="date" class="form-control" id="fechaingreso"  name="fechaingreso" required>
                            </div>


                            <div class="col-12">
                            <button class="btn btn-primary rounded-pill" type="submit" onclick="return confirm('¿Esta Seguro que Desea Guardar Este Registro?')">Guardar Registro</button></center> 
                            </div>
                        </form>


                    </div>

                </div>




        </section>

    </main><!-- End #main -->





    <?php include ('views/layouts/piepagina.php'); ?>



<?php else: ?>

    <?php header("Location:" . base_url . "inicio/index"); ?>

<?php endif; ?>

