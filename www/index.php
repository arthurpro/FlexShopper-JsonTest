<?php
/**
 * Created by PhpStorm.
 * User: art
 * Date: 12/10/14
 * Time: 6:02 PM
 */

require '../bootstrap.php';

$app->get('/', array('DefaultController', 'index'));
$app->run();

