<?php
session_start();
session_destroy();
require("../config.php");
unset($_SESSION['user']);
exit(header("Location: ".$web['base']['url']."adm/login"));