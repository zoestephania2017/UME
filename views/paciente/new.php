
<?php include 'views/layouts/navegacion.php'; ?>



               <?php if (isset($_SESSION['registrar']) && $_SESSION['registrar'] == 'completado'): ?>
                    <script>
                        mensaje('Paciente','Regitrado');
                        </script>
                    <?php elseif (isset($_SESSION['registrar']) && $_SESSION['registrar'] == 'fallido'): ?>
                      <script>
                        mensajeadvertencia();
                       </script>
                    <?php endif; ?>
                    <?php utilidades::destruirSesion('registrar') ?>



<main id="main" class="main">

    <div class="pagetitle">
        <h1>Nuevo Paciente</h1>
        <nav>
            <ol class="breadcrumb">


                <li class="breadcrumb-item active">Aqui Ingresara a un Nuevo Paciente</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="row">

        <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Ingrese los Datos del Paciente:</h5>


            <div class="card">
                <div class="card-body">
                    <h5 class="card-title"></h5>

     

                    <!-- Browser Default Validation -->
                    <form class="row g-3" action="<?= base_url ?>Paciente/guardar" method="POST">
                        <div class="col-md-4">
                            <label for="identidad" class="form-label">Identidad:</label>
                            <input type="number" class="form-control" id="identidad"  name="identidad" maxlength="13"  oninput="limitarlongitud(this);">
                        </div>
                        <div class="col-md-4">
                            <label for="primernombre" class="form-label">Primer Nombre:</label>
                            <input type="text" class="form-control" id="primernombre"  name="primernombre"  >
                        </div>
                        <div class="col-md-4">
                            <label for="primerapellido" class="form-label">Primer Apellido:</label>
                            <input type="text" class="form-control" id="primerapellido" name="primerapellido"  >
                        </div>

                        <div class="col-md-4">
                            <label for="fechanacimiento" class="form-label">Fecha de Nacimiento:</label>
                            <input type="date" class="form-control" id="fechanacimiento" name="fechanacimiento" >
                        </div>

                        <div class="col-md-4">
                            <label for="ocupacion" class="form-label">Ocupación:</label>
                            <input type="text" class="form-control" id="ocupacion" name="ocupacion" >
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
                            <select class="form-select" id="estadocivil" name="estadocivil" >
                                <option value=" ">Seleccione un Estado Civil</option>
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
                            <label for="direccion" class="form-label">Domicilio:</label>
                            <textarea type="text" class="form-control" id="direccion" name="direccion" ></textarea>
                        </div>
                        <div class="col-md-4">
                            <label for="acompanante" class="form-label">Acompañante:</label>
                            <input type="text" class="form-control" id="acompanante" name="acompanante"  >
                        </div>


                        <div class="col-md-4">
                            <label for="parentesco" class="form-label">Parentesco:</label>
                            <input type="text" class="form-control" id="parentesco"  name="parentesco" >
                        </div>

                        <div class="col-md-4">
                            <label for="telefono" class="form-label">Teléfono:</label>
                            <input type="number" class="form-control" id="telefono"  name="telefono" maxlength="8"  oninput="limitarlongitud(this);" >
                        </div>
                        
                            <div class="col-md-4">
                                <label for="departamento1d" class="form-label">Departamento:</label>

                                <select class="form-select" id="departamento"  name="departamento" onchange="javascript:getunaciudad();" required>
                                    <option selected disabled value="">Seleccione un Departamento</option>
                                    <?php while ($departamento = $departamentos->fetch_object()): ?> 
                                        <option value="<?= $departamento->id ?>"><?= $departamento->id ?>--<?= $departamento->descripcion ?></option>
                                    <?php endwhile; ?> 
                                </select>
                            </div>

                            <div class="col-md-4">
                                <label for="ciuda1d" class="form-label">Ciudad:</label>

                                <select class="form-select" id="ciudad"  name="ciudad" required>
                                <option selected disabled value="">Seleccione una ciudad</option>

                                <?php while ($ciudade = $ciudades->fetch_object()): ?> 
                                        <option value="<?= $ciudade->id ?>"><?= $ciudade->id ?>--<?= $ciudade->descripcion ?></option>
                                    <?php endwhile; ?> 

                                </select>
                            </div>
                        <div class="col-md-12">
                            <label for="comentario" class="form-label">Comentario:</label>
                            <textarea type="text" class="form-control" id="comentario" name="comentario" required maxlength="256"></textarea>
                        </div>

                        <!--<div class="col-md-4">
                            <label for="acompanante" class="form-label">City</label>
                            <input type="text" class="form-control" id="validationDefault03" minlength="13" maxlength="13"  required>
                        </div>
                        -->



                        <!-- 
                    
                    <div class="col-12">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="invalidCheck2" required>
                            <label class="form-check-label" for="invalidCheck2">
                                Agree to terms and conditions
                            </label>
                        </div>
                    </div>
                        -->
                        <div class="col-12">
                        <button class="btn btn-primary rounded-pill" onclick="return confirm('¿Esta Seguro que Desea Guardar Estos Datos?')" type="submit" >Guardar Datos del Paciente</button></center> 
                        </div>
                    </form>
                    <!-- End Browser Default Validation -->

                </div>

            </div>




    </section>

</main><!-- End #main -->






<?php include ('views/layouts/piepagina.php'); ?>


