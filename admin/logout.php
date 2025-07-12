<?php
session_start();
session_unset();     // bersihkan semua session variable
session_destroy();   // hancurkan session
header("Location: login.php");
exit;
?>
