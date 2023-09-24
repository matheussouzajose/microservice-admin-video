<?php

namespace Core\Domain\ValueObject;

use Ramsey\Uuid\Uuid as RamseyUuid;

class Uuid
{
    public function __construct(protected string $value)
    {
        $this->ensureIsValid($value);
    }

    public function __toString(): string
    {
        return $this->value;
    }

    public static function random(): self
    {
        return new self(RamseyUuid::uuid4()->toString());
    }

    private function ensureIsValid(string $id): void
    {
        if (! RamseyUuid::isValid($id)) {
            throw new \InvalidArgumentException('<%s> does not allow the value <%s>.', static::class, $id);
        }
    }
}
