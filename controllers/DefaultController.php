<?php
/**
 * Created by PhpStorm.
 * User: art
 * Date: 12/10/14
 * Time: 6:51 PM
 */

class DefaultController extends Abstract_Controller {


    public static function index() {

        $app = self::getApp();
        $view = self::getView();

        try {
            $jsonData = file_get_contents('./DevTestData.json');
            //$jsonData = file_get_contents('http://jservers.com/kashman/DevTestData.json');

            $objArray = json_decode($jsonData);
            //var_dump($objArray); exit;
            if ($objArray === null)
            {
                $app->flashNow('error', 'JSON Error');
                $objArray = array();
            }

            $mapper = new JsonMapper();
            $personCollection = new PersonCollection();
            foreach ($objArray as $obj){
                $personCollection->addItem($mapper->map($obj, new Person()));
            }

            $sortKey = isset($_GET['key']) ? $_GET['key'] : 'LName';
            $sortOrder = strtoupper(isset($_GET['order']) ? $_GET['order'] : 'DESC');

            $keys = get_class_vars('Person');
            if (!array_key_exists($sortKey, $keys))
            {
                $sortKey = 'LName';
            }

            $personCollection->sortItems($sortKey, $sortOrder);

            $view->setData('items', $personCollection->getItems());
            $view->setData('sort', array('key' => $sortKey, 'order' => $sortOrder));

        } catch (Exception $e) {
            //echo $e->getMessage();
            $app->flashNow('error', $e->getMessage());
        }

        $app->render('index.phtml');

    }
}