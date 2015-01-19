<?php


try
{
    if (!isset($_POST) || empty($_POST['print_url'])) {
        return;
    }
    
    $printUrl = $_POST['print_url'];
    // create an API client instance
    $client = new Pdfcrowd("iiaGenPdf", "d576214237c57128cbba8b8ef172050e");

    // convert a web page and store the generated PDF into a $pdf variable
    $url = "http://".$_SERVER['HTTP_HOST'].$_POST['print_url'];
    $pdf = $client->convertURI($url);

    // set HTTP response headers
    header("Content-Type: application/pdf");
    header("Cache-Control: max-age=0");
    header("Accept-Ranges: none");
    header("Content-Disposition: attachment; filename=\"google_com.pdf\"");

    // send the generated PDF
    echo $pdf;
}
catch(PdfcrowdException $why)
{
    echo "Pdfcrowd Error: " . $why;
}
?>