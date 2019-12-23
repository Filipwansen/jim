<script src="../plugins/jquery/jquery.min.js"></script>
<?php

require_once "classes/addcme.class.php";

global $addcme;
$addcme = new AddCMEObject();

require_once "classes/incomecme.class.php";

global $incomecme;
$incomecme = new IncomeCMEObject();

require_once "template/paymentviewcme.php";

?>