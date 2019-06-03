<?php
include "phpqrcode/qrlib.php";

// create a QR Code with this text and display it
QRcode::png("http://share.krtkovo.eu/files/" . $_GET['filename']);