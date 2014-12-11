<?php
/**
 * Created by PhpStorm.
 * User: art
 * Date: 12/10/14
 * Time: 9:34 PM
 */

class Abstract_Model
{
    public function getData($name = null)
    {
        if (isset($this->$name))
        {
            return $this->$name;
        }
        elseif ($name == null)
        {
            $vars = get_class_vars(get_class($this));
            return $vars;
        }
        else return null;
    }

    /**
     * Magic method (incomplete, created for the purpose of the test)
     * @param $name
     * @param $arguments
     * @return null
     */

    public function __call($name, $arguments)
    {
        //echo $name;
        //var_dump($arguments);
        preg_match('/^(.*?)([A-Z].*)$/', $name, $m);
        switch ($m[1]):
            case 'get':
                return isset($this->$m[2]) ? $this->$m[2] : null;
                break;

            default:
                return null;

        endswitch;

    }

}