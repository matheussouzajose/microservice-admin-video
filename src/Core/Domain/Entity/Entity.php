<?php

namespace Core\Domain\Entity;

use Core\Domain\Notification\Notification;
use Exception;

abstract class Entity
{
    /** @var Notification */
    protected Notification $notification;

    public function __construct()
    {
        $this->notification = new Notification();
    }

    /**
     * @throws Exception
     */
    public function __get($property)
    {
        if (isset($this->{$property})) {
            return $this->{$property};
        }

        $className = get_class($this);
        throw new Exception("Property {$property} not found in class {$className}");
    }

    /**
     * @return string
     */
    public function id(): string
    {
        return (string) $this->id;
    }

    /**
     * @return string
     */
    public function createdAt(): string
    {
        return $this->createdAt->format('Y-m-d H:i:s');
    }
}