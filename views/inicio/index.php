<?php include 'views/layouts/navegacion.php'; ?>
<!-- Importación de Navegación -->


<main id="main" class="main">
  
    <div class="pagetitle">
        <h1>Inicio </h1>
        <nav>
            <ol class="breadcrumb"> <!-- breadcrumb para indicar la posición dentro del sitio web -->
                <li class="breadcrumb-item">Datos|</li>
            </ol>
        </nav>
    </div>

    <section class="section dashboard">
        <div class="row">

            
            <div class="col-lg-8">
                <div class="row">

                    <div class="col-xxl-4 col-md-6">
                        <div class="card info-card sales-card">

                                <!--  Tarjeta de Ciudad -->
                            <div class="card-body">
                                <h5 class="card-title">Ciudad: <span>|  <?= $_SESSION['usuario']->ciudad ?></span></h5>

                                <div class="d-flex align-items-center">
                                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                        <i class="bx bxs-city"></i>
                                      </div>
                                    <div class="ps-3">

                                        <?php while ($contarciudad = $contarciudades->fetch_object()): ?> 

                                            <h6>   N.º <?= $contarciudad->porciudad ?></h6>
                                        <?php endwhile; ?> 

                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>

                    
                    <div class="col-xxl-4 col-md-6">
                        <div class="card info-card revenue-card">

                           <!--  Tarjeta de Usuario-->
                            <div class="card-body">
                                <h5 class="card-title">Usuario: <span>| <?= $_SESSION['usuario']->primer_nombre ?> <?= $_SESSION['usuario']->primer_apellido ?> </span></h5>

                                <div class="d-flex align-items-center"> 
                                    <div class="card  -icon rounded-circle d-flex align-items-center justify-content-center">
                                        <i class="ri ri-user-shared-2-fill">  </i>
                                    </div>
                                    <div class="ps-3">

                                        <?php while ($contarusuario = $contarusuarios->fetch_object()): ?> 

                                            <h6>   N.º <?= $contarusuario->porusuario ?></h6>
                                        <?php endwhile; ?> 
                                        
    <!--<span class="text-success small pt-1 fw-bold">8%</span> <span class="text-muted small pt-2 ps-1">increase</span>-->

                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>

            
                    <div class="col-xxl-4 col-xl-12">

                        <div class="card info-card customers-card">
                                   
                           <!--  Tarjeta de Atenciones Totales-->
                            <div class="card-body">
                                <h5 class="card-title">Atenciones: <span>| Totales</span></h5>

                                <div class="d-flex align-items-center">
                                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                        <i class="bx bx-first-aid"></i>
                                    </div>
                                    <div class="ps-3">
                                        <?php while ($totalatencion = $totalatenciones->fetch_object()): ?> 

                                            <h6>   N.º <?= $totalatencion->totalatenciones ?></h6>
                                        <?php endwhile; ?> 

                               <!--< <span class="text-danger small pt-1 fw-bold">12%</span> <span class="text-muted small pt-2 ps-1">decrease</span>-->

                                    </div>
                                </div>

                            </div>
                        </div>

                    </div>

                    <!-- Reportes -->
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Departamentos<span> | Atenciones</span></h5>
                               
                                <!-- Gráfico de pastel (Atenciones por Departamento) -->
                                <div id="pieChart"></div>

                                <script>
                                    document.addEventListener("DOMContentLoaded", () => {
                                    new ApexCharts(document.querySelector("#pieChart"), {
                                    series: [

                                            <?php while ($total = $totaldepartamento->fetch_object()): ?>
                                                <?php echo "$total->totales" ?>,
                                            <?php endwhile; ?>
                                            ],
                                            chart: {
                                            height: 350,
                                                    type: 'pie',
                                                    toolbar: {
                                                    show: true
                                                    }
                                            },
                                            labels: [

                                            <?php while ($descripcion = $totaldepartamento1->fetch_object()): ?>
                                                                                            '<?php echo "$descripcion->departamento" ?>',
                                            <?php endwhile; ?>
                                            ]
                                    }).render();
                                    });
                                </script>
                               
                            </div>
                        </div>


                    </div>


                    <div class="col-lg-12">

                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Ciudades<span> | Atenciones</span></h5>

                                <!-- Gráfico de Barras (Atenciones por Ciudad)-->
                                <div id="barCharts"></div>

                                <script>
                                    document.addEventListener("DOMContentLoaded", () => {
                                    new ApexCharts(document.querySelector("#barCharts"), {
                                    series: [{
                                    data: [
                                        
                                            <?php while ($descripcion = $totalciudades1->fetch_object()): ?>
                                            <?php echo "$descripcion->totales" ?>,
                                            <?php endwhile; ?>
                                        
                                    ]
                                    }],
                                            chart: {
                                            type: 'bar',
                                                    height: 350
                                            },
                                            plotOptions: {
                                            bar: {
                                            borderRadius: 4,
                                                    horizontal: true,
                                            }
                                            },
                                            dataLabels: {
                                            enabled: false
                                            },
                                            xaxis: {
                                            categories: [
                                            <?php while ($descripcion = $totalciudades->fetch_object()): ?>
                                            '<?php echo "$descripcion->ciudad" ?>',
                                            <?php endwhile; ?>
                                            ],
                                            }
                                    }).render();
                                    });
                                </script>
                               

                            </div>
                        </div>

                    </div>



                </div>
            </div>

            <div class="col-lg-4">

                <div class="row">


                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">ATENCIONES <span>| Estado</span></h5>

                                   <!-- Gráfico Circular Atenciones por Estado-->
                                <div id="trafficChart" style="min-height: 400px;" class="echart"></div>

                                <script>
                                    document.addEventListener("DOMContentLoaded", () => {
                                    echarts.init(document.querySelector("#trafficChart")).setOption({
                                    tooltip: {
                                    trigger: 'item'
                                    },
                                            legend: {
                                            top: '5%',
                                                    left: 'center'
                                            },
                                            series: [{
                                            name: 'Atenciones',
                                                    type: 'pie',
                                                    radius: ['40%', '70%'],
                                                    avoidLabelOverlap: false,
                                                    label: {
                                                    show: false,
                                                            position: 'center'
                                                    },
                                                    emphasis: {
                                                    label: {
                                                    show: true,
                                                            fontSize: '18',
                                                            fontWeight: 'bold'
                                                    }
                                                    },
                                                    labelLine: {
                                                    show: false
                                                    },
                                                    data: [
                                                    <?php while ($atencionporestado = $atencionporestados->fetch_object()): ?>
                                                        {
                                                        value: <?php echo "$atencionporestado->porestado" ?>,
                                                                name: '<?php echo "$atencionporestado->estado" ?>' },
                                                    <?php endwhile; ?>




                                                    ]
                                            }]
                                    });
                                    });
                                </script>

                            </div>
                        </div>
                    </div>
                


                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">PACIENTES<span>| Género</span></h5>

                               
                                <canvas id="barChart" style="max-height: 400px;"></canvas>
                                <script>
                                    document.addEventListener("DOMContentLoaded", () => {
                                    new Chart(document.querySelector('#barChart'), {
                                    type: 'bar',
                                            data: {
                                            labels: [
                                                    <?php while ($totalgenero = $totalgeneros->fetch_object()): ?>
                                                                                                    '<?php echo "$totalgenero->genero" ?>',
                                                    <?php endwhile; ?>



                                            ],
                                                    datasets: [{
                                                    label: 'Total',
                                                            data: [

                                                    <?php while ($totalgenero1 = $totalgeneros1->fetch_object()): ?>
                                                        <?php echo "$totalgenero1->totales" ?>,
                                                    <?php endwhile; ?>


                                                            ],
                                                            backgroundColor: [
                                                                    'rgba(255, 99, 132, 0.2)',
                                                                    'rgba(255, 159, 64, 0.2)',
                                                                    'rgba(255, 205, 86, 0.2)',
                                                                    'rgba(75, 192, 192, 0.2)',
                                                                    'rgba(54, 162, 235, 0.2)',
                                                                    'rgba(153, 102, 255, 0.2)',
                                                                    'rgba(201, 203, 207, 0.2)'
                                                            ],
                                                            borderColor: [
                                                                    'rgb(255, 99, 132)',
                                                                    'rgb(255, 159, 64)',
                                                                    'rgb(255, 205, 86)',
                                                                    'rgb(75, 192, 192)',
                                                                    'rgb(54, 162, 235)',
                                                                    'rgb(153, 102, 255)',
                                                                    'rgb(201, 203, 207)'
                                                            ],
                                                            borderWidth: 1
                                                    }]
                                            },
                                            options: {
                                            scales: {
                                            y: {
                                            beginAtZero: true
                                            }
                                            }
                                            }
                                    });
                                    });
                                </script>
                               
                            </div>
                        </div>

                    </div>



                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">TRASLADO<span> | Atenciones</span></h5>

                               
                                <div id="pieCharts" style="min-height: 400px;" class="echart"></div>

                                <script>
                                    document.addEventListener("DOMContentLoaded", () => {
                                    echarts.init(document.querySelector("#pieCharts")).setOption({
                                    title: {
                                    text: '',
                                            subtext: '',
                                            left: 'center'  
                                    },
                                            tooltip: {
                                            trigger: 'item'
                                            },
                                            legend: {
                                            orient: 'vertical',
                                                    left: 'left'
                                            },
                                            series: [{
                                            name: 'Total',
                                                    type: 'pie',
                                                    radius: '50%',
                                                    data: [
                                                   <?php while ($totaltraslado = $totaltraslados->fetch_object()): ?>


                                                        {
                                                        value: <?php echo "$totaltraslado->totales" ?>,
                                                                name: '<?php echo "$totaltraslado->traslado" ?>'
                                                        },
                                                    <?php endwhile; ?>

                                                    ],
                                                    emphasis: {
                                                    itemStyle: {
                                                    shadowBlur: 10,
                                                            shadowOffsetX: 0,
                                                            shadowColor: 'rgba(0, 0, 0, 0.5)'
                                                    }
                                                    }
                                            }]
                                    });
                                    });
                                </script>
                                
                            </div>
                        </div>
                    </div>




                </div>



            </div>


    </section>

</main>




<?php include ('views/layouts/piepagina.php'); ?>