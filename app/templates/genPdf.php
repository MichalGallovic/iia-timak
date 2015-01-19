<?php

use \TCPDF as TCPDF;
use IIA\service\MyApi as MyApi;

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
            <title>Schedule</title>
            <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
            <meta http-equiv="Content-language" content="en" />
            <meta name="keywords" content="PHP, sample, invoice, PDF, TCPDF"/>
            <meta name="description" content="A simple invoice example for 'Creating PDFs on the fly with TCPDF' on IBM's developerWorks"/>
            <style type="text/css" media="all">
                @import url("Schedule.css");
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

function getScheduleData() {
    
    $scheduleData = array(
        'user' => 'user@stuba.sk',
        'date' => date_format(new DateTime(), DateTime::W3C),
        'items' => array()
    );
    $scheduleData['items'][] = array('Procesor Intel Core i5', 2, 109.99, 2 * 109.99);
    $scheduleData['items'][] = array('Licencia Visual Studio 2010 Professional', 2, 29.35, 2 * 29.35);
    $scheduleData['items'][] = array('MSDNAA licencia na produkty Microsoft', 12, 0, 24 * 0);
    $scheduleData['total'] = 0;
    foreach ($scheduleData['items'] as $item) {
        $scheduleData['total'] += $item[3];
    }
    return $scheduleData;
}

//require_once( $docRoot . '../tcpdf/htmlcolors.php' );

class SchedulePdf extends TCPDF {

    private $scheduleData;

    function __construct($data, $orientation, $unit, $format) {
        parent::__construct($orientation, $unit, $format, true, 'UTF-8', false);

        $this->scheduleData = $data;

        # Set the page margins: 72pt on each side, 36pt on top/bottom.
        $this->SetMargins(72, 36, 72, true);
        $this->SetAutoPageBreak(true, 36);

        # Set document meta-information
        $this->SetCreator(PDF_CREATOR);
        $this->SetAuthor('STU User (user@stuba.sk)');
        $this->SetTitle('Schedule for ' . $this->scheduleData['user']);
        $this->SetSubject("A simple schedule example for 'Creating PDFs on the fly with TCPDF' on IBM's developerWorks");
        $this->SetKeywords('PHP, sample, schedule, PDF, TCPDF');

        //set image scale factor
        $this->setImageScale(PDF_IMAGE_SCALE_RATIO);

        //set some language-dependent strings
        global $l;
        $this->setLanguageArray($l);
    }

    # Page header and footer code.

    public function Header() {
        global $webcolor;

        # The image is this much larger than the company name text.
        $bigFont = 14;
        $imageScale = ( 128.0 / 26.0 ) * $bigFont;
        $smallFont = ( 16.0 / 26.0 ) * $bigFont;

        //$this->ImagePngAlpha('logoFEI.png', 82, 36, 128, 128, $imageScale, $imageScale, 'PNG', null, 'T', false, 72, 'L');
        $this->SetFont('times', 'b', $bigFont);
        $this->Cell(0, 0, 'FEI STU', 0, 1);
        $this->SetFont('times', 'i', $smallFont);
        $this->Cell($imageScale);
        $this->Cell(0, 0, '', 0, 1);
        $this->Cell($imageScale);
        $this->Cell(0, 0, 'Ilkovicova c.3, Mlynska dolina', 0, 1);
        $this->Cell($imageScale);
        $this->Cell(0, 0, 'Bratislava, Slovensko', 0, 1);

        $this->SetY(1.5 * 72, true);
        $this->SetLineStyle(array('width' => 2, 'color' => array($webcolor['black'])));
        $this->Line(72, 36 + $imageScale, $this->getPageWidth() - 72, 36 + $imageScale);
    }

    public function Footer() {
        global $webcolor;

        $this->SetLineStyle(array('width' => 2, 'color' => array($webcolor['black'])));
        $this->Line(72, $this->getPageHeight() - 1.5 * 72 - 2, $this->getPageWidth() - 72, $this->getPageHeight() - 1.5 * 72 - 2);
        $this->SetFont('times', '', 8);
        $this->SetY(-1.5 * 72, true);
        $this->Cell(72, 0, 'Faktúra pripravená pre ' . $this->scheduleData['user'] . ' ' . $this->scheduleData['date']);
    }

    public function CreateSchedule() {
        $this->AddPage();
        $this->SetFont('helvetica', '', 11);
        $this->SetY(144, true);

        # Table parameters
        #
		# Column size, wide (description) column, table indent, row height.
        $col = 72;
        $wideCol = 3 * $col;
        $indent = ( $this->getPageWidth() - 2 * 72 - $wideCol - 3 * $col ) / 2;
        $line = 18;

        # Table header
        $this->SetFont('', 'b');
        $this->Cell($indent);
        $this->Cell($wideCol, $line, 'Položka', 1, 0, 'L');
        $this->Cell($col, $line, 'Množstvo', 1, 0, 'R');
        $this->Cell($col, $line, 'Cena ks', 1, 0, 'R');
        $this->Cell($col, $line, 'Cena', 1, 0, 'R');
        $this->Ln();

        # Table content rows
        $this->SetFont('', '');
        foreach ($this->scheduleData['items'] as $item) {
            $this->Cell($indent);
            $this->Cell($wideCol, $line, $item[0], 1, 0, 'L');
            $this->Cell($col, $line, $item[1], 1, 0, 'R');
            $this->Cell($col, $line, $item[2], 1, 0, 'R');
            $this->Cell($col, $line, $item[3], 1, 0, 'R');
            $this->Ln();
        }

        # Table Total row
        $this->SetFont('', 'b');
        $this->Cell($indent);
        $this->Cell($wideCol + $col * 2, $line, 'Cena dokopy:', 1, 0, 'R');
        $this->SetFont('', '');
        $this->Cell($col, $line, $this->scheduleData['total'], 1, 0, 'R');
    }

}

function generatePDF($data) {
    # Create a new PDF document.
    $pdf = new SchedulePdf($data, 'P', 'pt', 'LETTER');

    # Generate the schedule.
    $pdf->CreateSchedule();

    # Output the PDF document.
    $pdf->Output('Your_Invoice.pdf', 'D');
}

# If URL has ?PDF=1, we need to make a PDF instead of HTML.

if (array_key_exists('PDF', $_REQUEST)) {
    generatePDF(getScheduleData());
} else {
    generateHTML(getScheduleData());
}
?>
