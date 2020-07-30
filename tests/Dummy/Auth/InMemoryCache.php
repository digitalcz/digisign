<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Dummy\Auth;

use Psr\SimpleCache\CacheInterface;

class InMemoryCache implements CacheInterface
{
    /**
     * @var array<mixed>
     */
    private $memory = [];

    /**
     * @param string $key
     * @param null $default
     * @return mixed
     */
    public function get($key, $default = null)
    {
        return isset($this->memory[$key]) ? $this->memory[$key] : null;
    }

    /**
     * @param string $key
     * @param mixed $value
     * @param null $ttl
     * @return bool|void
     */
    public function set($key, $value, $ttl = null)
    {
        $this->memory[$key] = $value;
    }

    /**
     * @param string $key
     * @return bool|void
     */
    public function delete($key)
    {
        reset($this->memory[$key]);
    }

    /**
     * @return bool|void
     */
    public function clear()
    {
        $this->memory = [];
    }

    /**
     * @param array<mixed> $keys
     * @param null $default
     * @return array<mixed>
     */
    public function getMultiple($keys, $default = null)
    {
        return $this->memory;
    }

    /**
     * @param array<mixed> $values
     * @param null $ttl
     * @return bool|void
     */
    public function setMultiple($values, $ttl = null)
    {
        $this->memory = $values;
    }

    /**
     * @param array<mixed> $keys
     * @return bool|void
     */
    public function deleteMultiple($keys)
    {
        foreach ($keys as $key) {
            unset($this->memory[$key]);
        }
    }

    /**
     * @param string $key
     * @return bool|mixed
     */
    public function has($key)
    {
        return isset($this->memory[$key]);
    }
}
