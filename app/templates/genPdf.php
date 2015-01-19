<?php


try
{   
    // create an API client instance
    $client = new Pdfcrowd("iiaGenPdf", "d576214237c57128cbba8b8ef172050e");

    // convert a web page and store the generated PDF into a $pdf variable
    $pdf = $client->convertURI('http://getbootstrap.com/getting-started/');

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
