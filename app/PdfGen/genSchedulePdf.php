<?php

namespace IIA\PdfGen;

use IIA\PdfGen\SchedulePdf as SchedulePdf;

function generatePDF($data) {
    # Create a new PDF document.
    $pdf = new SchedulePdf($data, 'P', 'pt', 'LETTER');

    # Generate the invoice.
    $pdf->CreateSchedule();

    # Output the PDF document.
    $pdf->Output('Your_schedule.pdf', 'D');
}

# Set up the data.
$invoiceData = array(
    'user' => 'user@stuba.sk',
    'date' => date_format(new DateTime(), DateTime::W3C),
    'items' => array()
);
$invoiceData['items'][] = array('Procesor Intel Core i5', 2, 109.99, 2 * 109.99);
$invoiceData['items'][] = array('Licencia Visual Studio 2010 Professional', 2, 29.35, 2 * 29.35);
$invoiceData['items'][] = array('MSDNAA licencia na produkty Microsoft', 12, 0, 24 * 0);
$invoiceData['total'] = 0;
foreach ($invoiceData['items'] as $item) {
    $invoiceData['total'] += $item[3];
}

generatePDF($invoiceData);

?>

