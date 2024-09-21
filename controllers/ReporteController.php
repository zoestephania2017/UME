<?php

require_once 'models/Atencion.php';
require_once 'models/Paciente.php';
require_once 'models/Departamento.php';
require_once 'models/Sala.php';
require_once 'models/Base.php';
require_once 'models/Diagnostico.php';
require_once 'models/Reportes.php';
require_once 'Controllers/ReporteController.php';

class ReporteController {

    public function departamento() {

        $departamento = new Departamento();

        $departamentos = $departamento->obtenerDepartamento();

        require_once 'views/reportes/departamento.php';
    }

    public function departamentopdf() {
        $atencion = new Reportes(); // instancia del modelo reportes
        $vista_departamento = new ReporteController();
        if (isset($_POST)) {
            $dp = isset($_POST['departamento']) ? $_POST['departamento'] : false;
            $finicio = isset($_POST['inicio']) ? $_POST['inicio'] : false;
            $ffin = isset($_POST['fin']) ? $_POST['fin'] : false;

            if ($dp && $finicio && $ffin) {

                $atenciones = $atencion->atencionesdp($dp, $finicio, $ffin);

                require_once 'views/pdf/departamento.php';
            } else {

                $_SESSION['registrar'] = "fallido";
                $vista_departamento->departamento();
            }
        }
    }

    public function ciudad() {

        $departamento = new Departamento();

        $departamentos = $departamento->obtenerDepartamento();

        require_once 'views/reportes/ciudad.php';
    }

    public function ciudadpdf() {
        $atencion = new Reportes(); // instancia del modelo reportes
        $vista_ciudad = new ReporteController();
        if (isset($_POST)) {
            $ci = isset($_POST['ciudad']) ? $_POST['ciudad'] : false;
            $finicio = isset($_POST['inicio']) ? $_POST['inicio'] : false;
            $ffin = isset($_POST['fin']) ? $_POST['fin'] : false;

            if ($ci && $finicio && $ffin) {

                $atenciones = $atencion->atencionesci($ci, $finicio, $ffin);

                require_once 'views/pdf/ciudad.php';
            } else {

                $_SESSION['registrar'] = "fallido";
                $vista_ciudad->ciudad();
            }
        }
    }

    public function centro() {

        $departamento = new Departamento();

        $departamentos = $departamento->obtenerDepartamento();

        require_once 'views/reportes/centro.php';
    }

    public function centropdf() {
        $atencion = new Reportes(); // instancia del modelo reportes
        $vista_centro = new ReporteController();
        if (isset($_POST)) {
            $dp = isset($_POST['departamento']) ? $_POST['departamento'] : false;
            $ce = isset($_POST['centroasistencial']) ? $_POST['centroasistencial'] : false;
            $finicio = isset($_POST['inicio']) ? $_POST['inicio'] : false;
            $ffin = isset($_POST['fin']) ? $_POST['fin'] : false;

            if ($dp && $ce && $finicio && $ffin) {

                $atenciones = $atencion->atencionesce($ce, $finicio, $ffin);

                require_once 'views/pdf/centro.php';
            } else {

                $_SESSION['registrar'] = "fallido";
                $vista_centro->centro();
            }
        }
    }

    public function ambulancia() {

        $departamento = new Departamento();

        $departamentos = $departamento->obtenerDepartamento();

        require_once 'views/reportes/ambulancia.php';
    }

    public function ambulanciapdf() {
        $atencion = new Reportes(); // instancia del modelo reportes
        $vista_centro = new ReporteController();
        if (isset($_POST)) {
            $dp = isset($_POST['departamento']) ? $_POST['departamento'] : false;
            $am = isset($_POST['ambulancia']) ? $_POST['ambulancia'] : false;
            $finicio = isset($_POST['inicio']) ? $_POST['inicio'] : false;
            $ffin = isset($_POST['fin']) ? $_POST['fin'] : false;

            if ($dp && $am && $finicio && $ffin) {

                $atenciones = $atencion->atencionesam($am, $finicio, $ffin);

                require_once 'views/pdf/ambulancia.php';
            } else {

                $_SESSION['registrar'] = "fallido";
                $vista_centro->ambulancia();
            }
        }
    }

    public function tipoatencion() {
        require_once 'views/reportes/tipoatencion.php';
    }

    public function tipoatencionpdf() {
        $atencion = new Reportes(); // instancia del modelo reportes
        $vista_centro = new ReporteController();
        if (isset($_POST)) {
            $at = isset($_POST['atencionbrindada']) ? $_POST['atencionbrindada'] : false;
            $finicio = isset($_POST['inicio']) ? $_POST['inicio'] : false;
            $ffin = isset($_POST['fin']) ? $_POST['fin'] : false;

            if ($at && $finicio && $ffin) {

                $atenciones = $atencion->atencionesat($at, $finicio, $ffin);

                require_once 'views/pdf/tipoatencion.php';
            } else {

                $_SESSION['registrar'] = "fallido";
                $vista_centro->tipoatencion();
            }
        }
    }

    public function traslado() {

        require_once 'views/reportes/traslado.php';
    }

    public function trasladopdf() {
        $atencion = new Reportes(); // instancia del modelo reportes
        $vista_centro = new ReporteController();
        if (isset($_POST)) {
            $tra = isset($_POST['traslado']) ? $_POST['traslado'] : false;
            $finicio = isset($_POST['inicio']) ? $_POST['inicio'] : false;
            $ffin = isset($_POST['fin']) ? $_POST['fin'] : false;

            if ($tra && $finicio && $ffin) {

                $atenciones = $atencion->atencionestra($tra, $finicio, $ffin);

                require_once 'views/pdf/traslado.php';
            } else {

                $_SESSION['registrar'] = "fallido";
                $vista_centro->traslado();
            }
        }
    }

    public function sala() {
        $sala = new Base();
        $salas = $sala->obtenerdatos('sala');

        require_once 'views/reportes/sala.php';
    }

    public function salapdf() {
        $atencion = new Reportes(); // instancia del modelo reportes
        $vista_centro = new ReporteController();
        if (isset($_POST)) {
            $sala = isset($_POST['sala']) ? $_POST['sala'] : false;
            $finicio = isset($_POST['inicio']) ? $_POST['inicio'] : false;
            $ffin = isset($_POST['fin']) ? $_POST['fin'] : false;

            if ($sala && $finicio && $ffin) {

                $atenciones = $atencion->atencionessala($sala, $finicio, $ffin);

                require_once 'views/pdf/sala.php';
            } else {

                $_SESSION['registrar'] = "fallido";
                $vista_centro->sala();
            }
        }
    }

    public function diagnostico() {
        $diagnostico = new Base();

        $diagnosticos = $diagnostico->obtenerdatos('diagnostico');
        require_once 'views/reportes/diagnostico.php';
    }

    public function diagnosticopdf() {
        $atencion = new Reportes(); // instancia del modelo reportes
        $vista_centro = new ReporteController();
        if (isset($_POST)) {
            $diagnostico = isset($_POST['diagnostico']) ? $_POST['diagnostico'] : false;
            $finicio = isset($_POST['inicio']) ? $_POST['inicio'] : false;
            $ffin = isset($_POST['fin']) ? $_POST['fin'] : false;

            if ($diagnostico && $finicio && $ffin) {

                $atenciones = $atencion->atencionesdiagnostico($diagnostico, $finicio, $ffin);

                require_once 'views/pdf/diagnostico.php';
            } else {

                $_SESSION['registrar'] = "fallido";
                $vista_centro->diagnostico();
            }
        }
    }

}
