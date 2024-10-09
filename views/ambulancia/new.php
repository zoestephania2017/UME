<!-- Solo los usuarios con estos roles pueden ver esta página -->

<?php if ($_SESSION['usuario']->id_rol == "1" || $_SESSION['usuario']->id_rol == "2"): ?>


    <?php include 'views/layouts/navegacion.php'; ?>



    <?php if (isset($_SESSION['registrar']) && $_SESSION['registrar'] == 'completado'): ?>
        <script>
            mensaje('Ambulancia', 'Regitrada');
        </script>
    <?php elseif (isset($_SESSION['registrar']) && $_SESSION['registrar'] == 'fallido'): ?>
        <script>
            mensajeadvertencia();
        </script>
    <?php endif; ?>
    <?php utilidades::destruirSesion('registrar') ?>


    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Nueva Ambulancia</h1>
            <nav>
                <ol class="breadcrumb">


                    <li class="breadcrumb-item active">Registro de una Nueva Ambulancia</li>
                </ol> 
            </nav>
        </div>

        <section class="section">
            <div class="row">

            <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Ingrese los Datos Correspondientes de la Ambulancia:</h5>

                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title"></h5>

                        <form class="row g-3" action="<?= base_url ?>ambulancia/guardar" method="POST">
                            <div class="col-md-4">
                                <label for="descripcion" class="form-label">Registro de Ambulancia:</label>
                                <input type="text" class="form-control" id="descripcion"  name="descripcion" required>
                            </div>

                            <div class="col-md-4">
                                <label for="departamento1d" class="form-label">Departamento:</label>

                                <select class="form-select" id="departamento"  name="departamento" onchange="javascript:getciudad()" required>
                                    <option selected disabled value="">Seleccione un Departamento</option>
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
                                <label for="puntid" class="form-label">Punto Estratégico:</label>

                                <select class="form-select" id="punto"  name="punto" required>
                                    <option selected disabled value="">Seleccione un Punto Estratégico</option>
                                </select>
                            </div>

                            <div class="col-md-4">
                                <label for="fechaingresos" class="form-label">Fecha Ingreso:</label>
                                <input type="date" class="form-control" id="fechaingreso"  name="fechaingreso" required>
                            </div>

                            <div class="col-12">
                            <button class="btn btn-primary rounded-pill" onclick="return confirm('¿Esta Seguro que Desea Guardar Este Registro?')" type="submit" >Guardar Registro</button></center> 
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



