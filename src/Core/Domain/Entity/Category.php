<?php

namespace Core\Domain\Entity;

use Core\Domain\Exception\NotificationException;
use Core\Domain\Factory\CategoryValidatorFactory;
use Core\Domain\ValueObject\Uuid;

class Category extends Entity
{
    /**
     * @throws NotificationException
     */
    public function __construct(
        protected string $name,
        protected ?Uuid $id = null,
        protected string $description = '',
        protected bool $isActive = true,
        protected ?\DateTime $createdAt = null,
    ) {
        parent::__construct();

        $this->id = $this->id ?? Uuid::random();
        $this->createdAt = $this->createdAt ?? new \DateTime();

        $this->validate();
    }

    public function activate(): void
    {
        $this->isActive = true;
    }

    public function deactivate(): void
    {
        $this->isActive = false;
    }

    /**
     * @throws NotificationException
     */
    public function update(string $name, string $description = ''): void
    {
        $this->name = $name;
        $this->description = $description;

        $this->validate();
    }

    /**
     * @throws NotificationException
     */
    private function validate(): void
    {
        CategoryValidatorFactory::create()->validate($this);

        if ($this->notification->hasErrors()) {
            throw new NotificationException(
                $this->notification->messages('category')
            );
        }

        //        DomainValidation::strMinLength($this->name);
        //        DomainValidation::strMaxLength($this->name);
        //        DomainValidation::strCanNullAndMaxLength($this->description);
    }
}
