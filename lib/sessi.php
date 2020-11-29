<?php
	if (!isset($_SESSION['user'])) {
		exit(header("Location: ".$web['base']['url']."adm/login"));
	}