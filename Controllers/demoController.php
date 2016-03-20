<?php
/**
 * demoController
 */
include 'controller.php';

class demoController extends controller
{
  public function actionDemo(){
    echo "this is demoControllser actionDemo!<br>";
    $model = $this->M('Demo');
    $res = $model->demo();
  }
}
