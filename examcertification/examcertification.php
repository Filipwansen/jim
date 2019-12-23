<script src="../plugins/jquery/jquery.min.js"></script>
<?php

require_once "classes/incomecertification.class.php";

global $incomecertification;
$incomecertification = new IncomeCertificationObject();

require_once "template/paymentcertification.php";

?>