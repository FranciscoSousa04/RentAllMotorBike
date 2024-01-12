<?php

use Dompdf\Dompdf;
use Dompdf\Options;

/**
 * Set the Dompdf options
 */
$options = new Options;
$options->setChroot(__DIR__);
$options->setIsRemoteEnabled(true);

$dompdf = new Dompdf($options);

/**
 * Set the paper size and orientation
 */
$dompdf->setPaper("A4", "portrait");

/**
 * Load the HTML and replace placeholders with values from the form
 */
ob_start();
require_once('template.php');
$html = ob_get_contents();
ob_end_clean();

$dompdf->loadHtml($html);

/**
 * Create the PDF and set attributes
 */
$dompdf->render(); 

$dompdf->addInfo("Title", "Fatura rentallmotorbike"); // "add_info" in earlier versions of Dompdf

/**
 * Send the PDF to the browser
 */
$dompdf->stream("fatura_rentallmotorbike.pdf", ["Attachment" => 0]); 

die;