<?php
/**
 * Created by PhpStorm.
 * User: art
 * Date: 12/10/14
 * Time: 9:35 PM
 */

class Abstract_Collection
{
    private $items = array();

    private $sortKey = null;
    private $sortOrder = null;


    public function addItem($obj, $key = null)
    {
        if ($key == null) {
            $this->items[] = $obj;
        }
        else {
            if (isset($this->items[$key])) {
                throw new Exception("Key $key already in use.");
            }
            else {
                $this->items[$key] = $obj;
            }
        }
    }

    public function deleteItem($key)
    {
        if (isset($this->items[$key])) {
            unset($this->items[$key]);
        }
        else {
            throw new Exception("Invalid key $key.");
        }
    }

    public function getItem($key)
    {
        if (isset($this->items[$key])) {
            return $this->items[$key];
        }
        else {
            throw new Exception("Invalid key $key.");
        }
    }

    public function getItems()
    {
        if (isset($this->items)) {
            return $this->items;
        }
        else {
            throw new Exception("Invalid data.");
        }
    }

    public function sortItems($key, $order = null)
    {
        $this->sortKey = $key;
        $this->sortOrder = strtoupper($order);
        return usort($this->items, array($this, 'cmp'));
    }

    private function cmp($a, $b)
    {
        if ($this->sortOrder == 'DESC')
        {
            return strcasecmp($b->getData($this->sortKey), $a->getData($this->sortKey));
        }
        return strcasecmp($a->getData($this->sortKey), $b->getData($this->sortKey));
    }

}