<?php
session_start() ;
session_destroy() ;
header("Location: /projetweb/index.php");
exit() ;