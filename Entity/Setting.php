<?php

namespace Svi\SettingsBundle\Entity;

use Svi\OrmBundle\Entity;

class Setting extends Entity
{
    private $key;
    private $value;

    /**
     * @return mixed
     */
    public function getKey()
    {
        return $this->key;
    }

    /**
     * @param mixed $key
     * @return $this
     */
    public function setKey($key)
    {
        $this->key = $key;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @param mixed $value
     * @return $this
     */
    public function setValue($value)
    {
        $this->value = $value;

        return $this;
    }

    public function __toString()
    {
        return $this->getKey() . '';
    }

}