<?php

// autoload_psr4.php 

$vendorDir = dirname(dirname(__FILE__));
$baseDir = dirname($vendorDir);

return array(
    'Spipu\\Html2Pdf\\' => array($vendorDir . '/spipu/html2pdf/src'),
);
