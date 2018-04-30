<?php

session_start();
session_destroy();
header('Location: /LoginUsuarioWeb.php');
exit();



