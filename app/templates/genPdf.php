<?php


use IIA\PdfGen\InvoicePdf as InvoicePdf;
//use \TCPDF as TCPDF;


date_default_timezone_set('Europe/Bratislava');
error_reporting(E_ALL);
ini_set('display_errors', '1');

# Generate an HTML version of the invoice page, using the specified data.

function generateHTML($data) {
    ?>
    <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
    <html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
        <head>
            <title>Invoice</title>
            <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
            <meta http-equiv="Content-language" content="en" />
            <meta name="keywords" content="PHP, sample, invoice, PDF, TCPDF"/>
            <meta name="description" content="A simple invoice example for 'Creating PDFs on the fly with TCPDF' on IBM's developerWorks"/>
            <style type="text/css" media="all">
                @import url("Invoice.css");
            </style>
        </head>
        <body>
            <div id="header">
                <!-- Icon from Azuresol's "Sketchy" set, found via iconfinder.com (http://www.iconfinder.com/icondetails/38897/128/) -->
                <p class="companyName">STU FEI</p>
                <address>
                    Ilkovičova č.3, Mlynská dolina,<br />
                    Bratislava, Slovensko<br />
                </address>
            </div>
            <div id="content">
                <table class="invoice">
                    <thead>
                        <tr class="invoiceHead">
                            <th class="itemCol">Položka</th>
                            <th class="quantityCol">Množstvo</th>
                            <th class="priceCol">Cena ks</th>
                            <th class="costCol">Cena</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($data['items'] as $item) {
                            echo '<tr class="invoiceRow">' . "\n";
                            echo '	<td class="itemCol">' . $item[0] . "</td>\n";
                            echo '	<td class="quantityCol">' . $item[1] . "</td>\n";
                            echo '	<td class="priceCol">' . $item[2] . "</td>\n";
                            echo '	<td class="costCol">' . $item[3] . "</td>\n";
                            echo "</tr>\n";
                        }
                        ?>
                        <tr class="totalRow">
                            <th class="totalHead" colspan="3">Cena dokopy:</th>
                            <?php
                            echo '<td class="totalCol">' . $data['total'] . "</td>\n";
                            ?>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div id="footer">
                <p class="print">
                    <a href="genSchedulePdf?PDF">
                        <!-- Icon from Gentleface.com's "Wireframe mono icons" set, found via iconfinder.com (http://www.iconfinder.com/icondetails/42317/48/) -->
                        <img src="gentleface_print.png" width="48" height="48" alt="Click here to print." />
                    </a>
                </p>
                <p class="info">
                    <?php
                    echo 'Faktúra pripravená pre ' . $data['user'] . ' ' . $data['date'] . "\n";
                    ?>
                </p>
            </div>
        </body>
    </html>
    <?php
}


//require_once( $docRoot . '../tcpdf/htmlcolors.php' );


function generatePDF($data) {
    # Create a new PDF document.
    $pdf = new InvoicePdf($data, 'P', 'pt', 'LETTER');

    # Generate the invoice.
    $pdf->CreateInvoice();

    # Output the PDF document.
    $pdf->Output('Your_Invoice.pdf', 'D');
}

# Set up the data.
#
# You could pull this data from a database, web service, XML
# file, etc. To simplify the example, I'm just going to
# include it directly here.
$invoiceData = array(
    'user' => 'user@stuba.sk',
    'date' => date_format(new \DateTime(), \DateTime::W3C),
    'items' => array()
);
$invoiceData['items'][] = array('Procesor Intel Core i5', 2, 109.99, 2 * 109.99);
$invoiceData['items'][] = array('Licencia Visual Studio 2010 Professional', 2, 29.35, 2 * 29.35);
$invoiceData['items'][] = array('MSDNAA licencia na produkty Microsoft', 12, 0, 24 * 0);
$invoiceData['total'] = 0;
foreach ($invoiceData['items'] as $item) {
    $invoiceData['total'] += $item[3];
}

# If URL has ?PDF=1, we need to make a PDF instead of HTML.

if (array_key_exists('PDF', $_REQUEST)) {
    generatePDF($invoiceData);
} else {
    generateHTML($invoiceData);
}
?>
