<?php 
require 'codebarre/vendor/autoload.php';
$generator = new Picqer\Barcode\BarcodeGeneratorHTML();
$generatorSVG = new Picqer\Barcode\BarcodeGeneratorSVG();
$generatorPNG = new Picqer\Barcode\BarcodeGeneratorPNG();

echo $generator->getBarcode('yael', $generator::TYPE_CODE_128);
echo $generatorSVG->getBarcode('081231723898', $generatorPNG::TYPE_EAN_13);
//echo $generatorSVG->getBarcode(EncodeTypes::CODE_128, "12367891011");
//echo '<br/><img src="data:image/png;base64,' . base64_encode($generatorPNG->getBarcode('081231723897', $generatorPNG::TYPE_CODE_128)) . '">';


// set image resolution
//$generator1->getParameters()->setResolution(200);
// generate and save barcode
//$generator1->save("barcodes/generate-barcode.png"); 
?>
