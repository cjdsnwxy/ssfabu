<?php
include $_SERVER['DOCUMENT_ROOT'].'/Controllers/controller.php';
$demo = new controller();
$model = $demo->M('Demo');
$res = $model->demo();
