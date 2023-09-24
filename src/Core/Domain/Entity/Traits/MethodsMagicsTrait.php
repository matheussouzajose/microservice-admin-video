<?php

namespace Core\Domain\Entity\Traits;

trait MethodsMagicsTrait
{
    /**
     * @param $property
     * @return mixed
     * @throws \Exception
     */
    public function __get($property)
    {
        if (isset($this->{$property})) {
            return $this->{$property};
        }

        $className = get_class($this);
        throw new \Exception("Property {$property} not found in class {$className}");
    }

    /**
     * @return string
     */
    public function id(): string
    {
        return (string) $this->id;
    }

    public function createdAt(): string
    {
        return $this->createdAt->format('Y-m-d H:i:s');
    }
}
