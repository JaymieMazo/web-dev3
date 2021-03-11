
<?php
require_once('Regular.php');
require_once('Premium.php');
require_once('index.php');
echo json_encode($_POST);
if($_POST['service'] == 'Regular'){
$reg = new Regular($_POST['bill'],$_POST['chargeam'],$_POST['chargepm']);
$reg->compute();
} 
else if($_POST['service'] == 'Premium'){
    $prem = new Premium($_POST['bill'],$_POST['chargeam'],$_POST['chargepm']);
    $prem->compute();
}
?>