<?php

namespace Ipalaus\Sqwiggle;

use ArrayAccess;
use Countable;

class Collection implements ArrayAccess, Countable
{

    protected $items = array();

    public function offsetSet($key, $value)
    {
        if (is_null($key)) {
            $this->items[] = $value;
        } else {
            $this->items[$key] = $value;
        }
    }

    public function offsetExists($key)
    {
        return array_key_exists($key, $this->items);
    }

    public function offsetUnset($key)
    {
        unset($this->items[$key]);
    }

    public function offsetGet($key)
    {
        return $this->items[$key];
    }

    public function count()
    {
        return count($this->items);
    }

}
