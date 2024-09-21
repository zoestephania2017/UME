
<?php if ($_SESSION['usuario']->id_rol == "1" || $_SESSION['usuario']->id_rol == "2"): ?>


    <?php include 'views/layouts/navegacion.php'; ?>

    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Modificación de Datos del Centro Asistencial</h1>
            <nav>
                <ol class="breadcrumb">


                    <li class="breadcrumb-item active">Informacion del Centro Asistencial</li>
                </ol>
            </nav>
        </div>

        <section class="section">
            <div class="row">


                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Ingrese los Datos del Centro Asistencial a Modificar</h5>


                       
                        <form class="row g-3" action="<?= base_url ?>centroasistencial/guardar" method="POST">

                            <input type="number" class="form-control" id="id"  name="id" value="<?= $ce->id ?>" hidden>

                            <div class="col-md-4">
                                <label for="descripcion" class="form-label">Nombre del Centro Asistencial:</label>
                                <input type="text" class="form-control" id="descripcion"  name="descripcion" value="<?= $ce->descripcion ?>" required>
                            </div>

                            <div class="col-md-4">
                                <label for="departamento1d" class="form-label">Departamento:</label>

                                <select class="form-select" id="departamento"  name="departamento" onchange="javascript:getciudad()" required>
                                    <option selected disabled value="">Seleccione un departamento</option>
                                    <?php while ($departamento = $departamentos->fetch_object()): ?> 
                                        <option value="<?= $departamento->id ?>" <?= $ce->iddepartamento == $departamento->id ? 'selected' : '' ?>><?= $departamento->id ?>--<?= $departamento->descripcion ?></option>
                                    <?php endwhile; ?> 
                                </select>
                            </div>


                            <div class="col-md-4">
                                <label for="ciuda1d" class="form-label">Ciudad:</label>

                                <select class="form-select" id="ciudad"  name="ciudad" required>
                                    <option selected disabled value="">Seleccione una Ciudad</option>
                                    <?php while ($ciudad = $ciudades->fetch_object()): ?> 
                                        <option value="<?= $ciudad->id ?>" <?= $ce->id_ciudad == $ciudad->id ? 'selected' : '' ?> >--<?= $ciudad->descripcion?>--</option>
                                    <?php endwhile; ?> 
                                </select>
                            </div>


                            <div class="col-12">
                            <button class="btn btn-warning rounded-pill" onclick="return confirm('¿Estas Seguro que Desea Modificar los Datos de Este Centro Asistencial?')" type="submit">Modificar Dato</button></center> 
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

