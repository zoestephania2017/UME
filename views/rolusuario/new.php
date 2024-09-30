 <?php if ($_SESSION['usuario']->id_rol != "1"): ?>
   
<?php header("Location:" . base_url . "inicio/index");?>

<?php endif; ?>

<?php include 'views/layouts/navegacion.php'; ?>

<main id="main" class="main">

    <div class="pagetitle">
        <h1>Ingreso de Pacientes</h1>
        <nav>
            <ol class="breadcrumb">


                <li class="breadcrumb-item active">Registro de Paciente</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="row">


            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Ingrese los Datos del Paciente</h5>

                    <!-- Browser Default Validation -->
                    <form class="row g-3">
                        <div class="col-md-4">
                            <label for="identidad" class="form-label">Identidad:</label>
                            <input type="text" class="form-control" id="identidad"   minlength="13" maxlength="13">
                        </div>
                        <div class="col-md-4">
                            <label for="primernombre" class="form-label">Primer Nombre:</label>
                            <input type="text" class="form-control" id="primernombre" value="" >
                        </div>
                        <div class="col-md-4">
                            <label for="primerapellido" class="form-label">Primer Apellido:</label>
                            <input type="text" class="form-control" id="primerapellido" value="">
                        </div>

                        <div class="col-md-4">
                            <label for="primerapellido" class="form-label">Ocupación:</label>
                            <input type="text" class="form-control" id="primerapellido" value="">
                        </div>


                        <!--   <div class="col-md-4">
                            <label for="validationDefaultUsername" class="form-label">Username</label>
                           <div class="input-group">
                                <span class="input-group-text" id="inputGroupPrepend2">@</span>
                                <input type="text" class="form-control" id="validationDefaultUsername" aria-describedby="inputGroupPrepend2" required>
                            </div>-->

                        <div class="col-md-4">
                            <label for="edad" class="form-label">Edad:</label>
                            <input type="number" class="form-control" id="edad">
                        </div>

                        <div class="col-md-4">
                            <label for="genero" class="form-label">Género:</label>
                            <select class="form-select" id="genero">
                                <option selected disabled value="">Seleccione un Género...</option>
                                <option>Masculino</option>
                                <option>Femenino</option>
                            </select>
                        </div>

                        <div class="col-md-4">
                            <label for="estadocivil" class="form-label">Estado Civil:</label>
                            <select class="form-select" id="estadocivil">
                                <option selected disabled value="">Seleccione un Estado Civil...</option>
                                <option>Casado</option>
                                <option>Unión Lbre</option>
                                <option>Soltero</option>
                                <option>Viudo</option>
                            </select>
                        </div>

                        <div class="col-md-4">
                            <label for="direccion" class="form-label">Dirección:</label>
                            <input type="text" class="form-control" id="direccion" >
                        </div>
                        <div class="col-md-4">
                            <label for="telefono" class="form-label">Teléfono:</label>
                            <input type="number" class="form-control" id="telefono" >
                        </div>

                        <div class="col-md-4">
                            <label for="acompanante" class="form-label">Acompañante:</label>
                            <input type="text" class="form-control" id="acompanante" >
                        </div>


                        <div class="col-md-4">
                            <label for="parentesco" class="form-label">Parentesco:</label>
                            <input type="text" class="form-control" id="parentesco" >
                        </div>

                        <div class="col-md-4">
                            <label for="ciudad" class="form-label">Ciudad</label>
                            <select class="form-select" id="ciudad">
                                <option selected disabled value="">Seleccione una Ciudad...</option>
                                <option>...</option>
                            </select>
                        </div>

                        <div class="col-md-12">
                            <label for="comentario" class="form-label">Comentario:</label>
                            <textarea type="text" class="form-control" id="comentario" required="" maxlength="256"></textarea>
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
                            <center><button class="btn btn-success" type="submit">Guardar</button></center> 
                        </div>
                    </form>
                    <!-- End Browser Default Validation -->

                </div>

            </div>




    </section>

</main><!-- End #main -->






<?php include ('views/layouts/piepagina.php'); ?>