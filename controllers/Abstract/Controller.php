<?php
/**
 * Created by PhpStorm.
 * User: art
 * Date: 12/10/14
 * Time: 7:35 PM
 */

class Abstract_Controller {

    public static function getApp()
    {
        return \Slim\Slim::getInstance();
    }

    public static function getView()
    {
        return self::getApp()->view();
    }
}