 <?php if ($_SESSION['usuario']->id_rol != "1"): ?>
   
<?php header("Location:" . base_url . "inicio/index");?>

<?php endif; ?>

<?php include 'views/layouts/navegacion.php'; ?>
<main id="main" class="main">

    <div class="pagetitle">
        <h1>Modificacion de Usuarios</h1>
        <nav>
            <ol class="breadcrumb">


                <li class="breadcrumb-item active">Registro de Usuario</li>
            </ol>
        </nav>
    </div>
    <section class="section">
        <div class="row">

        <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Ingrese los Datos a Modificar del Usuario:</h5>



            <div class="card">
                <div class="card-body">
                    <h5 class="card-title"></h5>

                    
                    <form class="row g-3" action="<?= base_url ?>Usuario/guardar" method="POST">
                        
                        <input type="number" class="form-control" id="id"  name="id" value="<?= $us->id?>" hidden="" >
                        <div class="col-md-4">
                            <label for="identidad" class="form-label">Identidad:</label>
                            <input type="number" class="form-control" id="identidad"  name="identidad" maxlength="13" value="<?= $us->identidad?>"  oninput="limitarlongitud(this);" required>
                        </div>
                        <div class="col-md-4">
                            <label for="primernombre" class="form-label">Primer Nombre:</label>
                            <input type="text" class="form-control" id="primernombre" name="primernombre" value="<?= $us->primer_nombre?>"  required >
                        </div>


                        <div class="col-md-4">
                            <label for="segundonombre" class="form-label">Segundo Nombre:</label>
                            <input type="text" class="form-control" id="segundonombre" name="segundonombre" value="<?= $us->segundo_nombre?>" required >
                        </div>
                        <div class="col-md-4">
                            <label for="primerapellido" class="form-label">Primer Apellido:</label>
                            <input type="text" class="form-control" id="primerapellido" name="primerapellido" value="<?= $us->primer_apellido?>" required>
                        </div>


                        <div class="col-md-4">
                            <label for="segundoapellido" class="form-label">Segundo Apellido:</label>
                            <input type="text" class="form-control" id="segundoapellido" name="segundoapellido" value="<?= $us->segundo_apellido?>" required>
                        </div>

                        <div class="col-md-4">
                            <label for="direccion" class="form-label">Dirección:</label>
                            <textarea type="text" class="form-control" id="direccion" name="direccion"  required><?= $us->direccion?></textarea>
                        </div>

                        <div class="col-md-4">
                            <label for="telefono" class="form-label">Teléfono:</label>
                            <input type="number" class="form-control" id="telefono"  name="telefono" maxlength="8"  value="<?= $us->telefono?>" oninput="limitarlongitud(this);" required>
                        </div>


                        <div class="col-md-4">
                            <label for="genero" class="form-label">Género:</label>
                            <select class="form-select" id="genero" name="genero" required>
                                <option selected disabled value="">Seleccione un Género</option>
                                <option value="Masculino" <?=$us->genero == "Masculino" ? 'selected': ''?>>Masculino</option>
                                <option value="Femenino" <?=$us->genero == "Femenino" ? 'selected': ''?>>Femenino</option>
                            </select>
                        </div>

                        <div class="col-md-4">
                            <label for="estadocivil" class="form-label">Estado Civil:</label>
                            <select class="form-select" id="estadocivil" name="estadocivil" required>
                                <option selected disabled value="">Seleccione un Estado Civil</option>
                                <option value="Casado" <?=$us->estado_civil == "Casado" ? 'selected': ''?>>Casado</option>
                                <option value="Unión Libre"<?=$us->estado_civil == "Unión Libre" ? 'selected': ''?>>Unión Libre</option>
                                <option value="Soltero"<?=$us->estado_civil == "Soltero" ? 'selected': ''?>>Soltero</option>
                                <option value="Viudo"<?=$us->estado_civil == "Viudo" ? 'selected': ''?>>Viudo</option>
                            </select>
                        </div>


                        <div class="col-md-4">
                            <label for="fechanacimiento" class="form-label">Fecha Nacimiento:</label>
                            <input type="date" class="form-control" id="fechanacimiento"  name="fechanacimiento"  value="<?= $us->fecha_nacimiento?>" required>
                        </div>


                        <div class="col-md-4">
                            <label for="correo" class="form-label">Correo:</label>
                            <input type="email" class="form-control" id="correo" name="correo"  value="<?= $us->correo?>" required="" >
                        </div>

                        <div class="col-md-4">
                            <label for="rol" class="form-label">Rol:</label>
                            <select class="form-select" id="rol" name="rol" required="">
                                <option selected disabled value="">Seleccione un Rol de Usuario</option>
                                <?php while ($rol = $roles->fetch_object()): ?> 

                                    <option value="<?= $rol->id ?>" <?=$us->id_rol == $rol->id ? 'selected': ''?>><?= $rol->id ?>--<?= $rol->descripcion ?></option>
                                <?php endwhile; ?> 
                            </select>
                        </div>
                            <div class="col-md-4">
                                <label for="departamento1d" class="form-label">Departamento:</label>

                                <select class="form-select" id="departamento"  name="departamento" onchange="javascript:getciudad()" required>
                                    <option selected disabled value="">Seleccione un Departamento</option>
                                    <?php while ($departamento = $departamentos->fetch_object()): ?> 
                                        <option value="<?= $departamento->id ?>" <?= $us->iddepartamento == $departamento->id ? 'selected' : '' ?>><?= $departamento->id ?>--<?= $departamento->descripcion ?></option>
                                    <?php endwhile; ?> 
                                </select>
                            </div>


                            <div class="col-md-4">
                                <label for="ciuda1d" class="form-label">Ciudad:</label>

                                <select class="form-select" id="ciudad"  name="ciudad" required>
                                    <option selected disabled value="">Seleccione una Ciudad</option>
                                    <?php while ($ciudad = $ciudades->fetch_object()): ?> 
                                        <option value="<?= $ciudad->id ?>" <?= $us->idciudad == $ciudad->id ? 'selected' : '' ?> >--<?= $ciudad->descripcion ?>--</option>
                                    <?php endwhile; ?> 
                                </select>
                            </div>
                        
                       <div class="col-md-4">
                            <label for="fechaingresos" class="form-label">Fecha Ingreso:</label>
                            <input type="date" class="form-control" id="fechaingreso"  name="fechaingreso"   value="<?= $us->fecha_ingreso?>"required>
                        </div>
                        
                      <div class="col-md-4">
                            <label for="ciuda1d" class="form-label">Estado</label>

                            <select class="form-select" id="estado"  name="estado" required>
                                <option selected disabled value="">Seleccione un Estado</option>
                                <?php while ($estado = $estados->fetch_object()): ?> 
                                    <option value="<?= $estado->id ?>"   <?=$us->idestado == $estado->id ? 'selected': ''?> ><?= $estado->id ?>--<?= $estado->descripcion ?></option>
                                <?php endwhile; ?> 
                            </select>
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