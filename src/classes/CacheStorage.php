<?php


namespace App\classes;
use App\interfaces\KeyValueStorageInterface;

class CacheStorage implements KeyValueStorageInterface
{
    protected $cache = [];
    public function set($key, $value)
    {
        $this->cache[$key] = $value;
    }
    public function get($key)
    {
        if (isset($this->cache[$key])) {
            return $this->cache[$key];
        }
        return null;
    }
    public function has($key)
    {
        if (!empty($this->cache[$key])) {
            return true;
        }
        return false;
    }


    public function remove($key)
    {
        $this->cache[$key] = null;
    }


    public function clear($key)
    {
        if (isset($this->cache[$key])) {
            unset($this->cache[$key]);
        }
    }
}