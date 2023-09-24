<?php

namespace Core\Domain\Entity;

use Core\Domain\Enum\CastMemberType;
use Core\Domain\Exception\EntityValidationException;
use Core\Domain\Validation\DomainValidation;
use Core\Domain\ValueObject\Uuid;
use DateTime;

class CastMember extends Entity
{
    /**
     * @throws EntityValidationException
     */
    public function __construct(
        protected string $name,
        protected CastMemberType $type,
        protected ?Uuid $id = null,
        protected ?DateTime $createdAt = null,
    ) {
        parent::__construct();

        $this->id = $this->id ?? Uuid::random();
        $this->createdAt = $this->createdAt ?? new DateTime();

        $this->validate();
    }

    /**
     * @throws EntityValidationException
     */
    public function update(string $name): void
    {
        $this->name = $name;

        $this->validate();
    }

    /**
     * @throws EntityValidationException
     */
    protected function validate(): void
    {
        DomainValidation::strMaxLength($this->name);
        DomainValidation::strMinLength($this->name);
    }
}
