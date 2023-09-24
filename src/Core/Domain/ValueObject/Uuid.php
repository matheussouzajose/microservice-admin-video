<?php

namespace Core\Domain\ValueObject;

use Ramsey\Uuid\Uuid as RamseyUuid;

class Uuid
{
    /**
     * @param string $value
     */
    public function __construct(protected string $value)
    {
        $this->ensureIsValid($value);
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->value;
    }

    /**
     * @return self
     */
    public static function random(): self
    {
        return new self(RamseyUuid::uuid4()->toString());
    }

    /**
     * @param string $id
     * @return void
     */
    private function ensureIsValid(string $id): void
    {
        if (!RamseyUuid::isValid($id)) {
            throw new \InvalidArgumentException('<%s> does not allow the value <%s>.', static::class, $id);
        }
    }
}
