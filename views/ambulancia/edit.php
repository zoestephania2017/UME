<!-- El formulario solo será visible si el usuario tiene uno de dos roles específicos -->

<?php if ($_SESSION['usuario']->id_rol == "1" || $_SESSION['usuario']->id_rol == "2"): ?>


    <?php include 'views/layouts/navegacion.php'; ?>

    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Modificación de Ambulancia</h1>
            <nav>
                <ol class="breadcrumb">


                    <li class="breadcrumb-item active">Datos del Ambulancia</li>
                </ol>
            </nav>
        </div><

        <section class="section">
            <div class="row">


                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Ingrese los Datos de la Ambulancia a Modificar</h5>


                        
                        <form class="row g-3" action="<?= base_url ?>ambulancia/guardar" method="POST">

                            <input type="number" class="form-control" id="id"  name="id" value="<?= $pe->id ?>" hidden>

                            <div class="col-md-4">
                                <label for="descripcion" class="form-label">Nombre del Ambulancia:</label>
                                <input type="text" class="form-control" id="descripcion"  name="descripcion" value="<?= $pe->unidad ?>" required>
                            </div>

                            <div class="col-md-4">
                                <label for="departamento1d" class="form-label">Departamento:</label>
                             <!--actualizar dinámicamente las opciones de ciudad y punto estratégico cuando se selecciona un departamento o ciudad -->
                            <select class="form-select" id="departamento"  name="departamento" onchange="javascript:getciudad()" required>
                                <option selected disabled value="">Seleccione un departamento...</option>
                                <?php while ($departamento = $departamentos->fetch_object()): ?> 
                                    <option value="<?= $departamento->id ?>" <?= $pe->iddepartamento == $departamento->id ? 'selected' : '' ?>><?= $departamento->id ?>--<?= $departamento->descripcion ?></option>
                                <?php endwhile; ?> 
                            </select>
                            </div>


                            <div class="col-md-4">
                                <label for="ciuda1d" class="form-label">Ciudad:</label>

                                <select class="form-select" id="ciudad"  name="ciudad" onchange="javascript:getpunto();" required>
                                    <option selected disabled value="">Seleccione una Ciudad...</option>
                                    <?php while ($ciudad = $ciudades->fetch_object()): ?> 
                                        <option value="<?= $ciudad->id ?>" <?= $pe->idciudad == $ciudad->id ? 'selected' : '' ?> >--<?= $ciudad->descripcion ?>--</option>
                                    <?php endwhile; ?> 
                                </select>
                            </div>


                            <div class="col-md-4">
                                <label for="ciuda1d" class="form-label">Seleccione un Punto Estratégico:</label>

                                <select class="form-select" id="punto"  name="punto" required>
                                    <option selected disabled value="">Seleccione un Punto Estrategico...</option>
                                    <?php while ($punto = $puntos->fetch_object()): ?> 
                                        <option value="<?= $punto->id ?>" <?= $pe->id_punto == $punto->id ? 'selected' : '' ?> >--<?= $punto->descripcion ?>--</option>
                                    <?php endwhile; ?> 
                                </select>
                            </div>

                            <div class="col-md-4">
                                <label for="fechaingresos" class="form-label">Fecha Ingreso:</label>
                                <input type="date" class="form-control" id="fechaingreso"  name="fechaingreso"   value="<?= $pe->fecha_ingreso ?>"required>
                            </div>


                    <div class="col-12">
                        <center><button class="btn btn-warning rounded-pill" onclick="return confirm('¿Estas seguro que desea modificar el Ambulancia?')" type="submit">Modificar</button></center> 
                    </div>
                    </form>
                   
                </div>

            </div>

        </section>

    </main>


<!-- pie de pagina -->
    <?php include ('views/layouts/piepagina.php'); ?>


<?php else: ?>

    <?php header("Location:" . base_url . "inicio/index"); ?>

<?php endif; ?>

