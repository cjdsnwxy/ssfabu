<?php
/**
 * Created by PhpStorm.
 * User: king
 * Date: 16-3-19
 * Time: 下午12:49
 */

include $_SERVER['DOCUMENT_ROOT'].'/Controllers/controller.php';

class indexController extends controller
{
    public function actionIndex(){
        $this->display('Index/index',array(
            'a' => 'this is a',
            'b' => 'this is b'
        ));
    }

    public function actionD(){
        echo "ddd";
    }
}
