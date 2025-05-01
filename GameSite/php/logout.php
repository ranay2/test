<?php
session_start();
session_unset();
session_destroy();  //delete on sever

//delete cookie in browser




header("Location: ../Home.php");
exit();
?>
