<?php

require('class/github.php');
require('class/github_repository.php');
require('class/application.php');

error_reporting(E_ERROR);

$application = new Application;
$application->index();

return 0;

?>
