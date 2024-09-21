
<?php if ($_SESSION['usuario']->id_rol == "1" || $_SESSION['usuario']->id_rol == "2"): ?>


    <?php include 'views/layouts/navegacion.php'; ?>

    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Modificación de Ciudad</h1>
            <nav>
                <ol class="breadcrumb">


                    
                </ol>
            </nav>
        </div>

        <section class="section">
            <div class="row">


                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Ingrese los Datos de la Ciudad a Modificar:</h5>


                       
                        <form class="row g-3" action="<?= base_url ?>ciudad/guardar" method="POST">

                            <input type="number" class="form-control" id="id"  name="id" value="<?= $ci->id ?>" hidden>

                            <div class="col-md-4">
                                <label for="departamento1d" class="form-label">Departamento:</label>

                                <select class="form-select" id="departamento"  name="departamento" required>
                                    <option selected disabled value="">Seleccione un Departamento</option>
                                    <?php while ($departamento = $departamentos->fetch_object()): ?> 
                                        <option value="<?= $departamento->id ?>" <?= $ci->id_departamento == $departamento->id ? 'selected' : '' ?>><?= $departamento->id ?>--<?= $departamento->descripcion ?></option>
                                    <?php endwhile; ?> 
                                </select>
                            </div>

                            <div class="col-md-4">
                                <label for="descripcion" class="form-label">Ciudad:</label>
                                <input type="text" class="form-control" id="descripcion"  name="descripcion" value="<?= $ci->descripcion ?>" required>
                            </div>


                            <div class="col-12">
                            <button class="btn btn-warning rounded-pill" onclick="return confirm('¿Esta Seguro que Desea Modificar Este Dato?')" type="submit">Modificar Dato</button></center> 
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

