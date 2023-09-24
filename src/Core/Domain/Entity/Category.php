<?php

namespace Core\Domain\Entity;

use Core\Domain\Exception\NotificationException;
use Core\Domain\Factory\CategoryValidatorFactory;
use Core\Domain\ValueObject\Uuid;

class Category extends Entity
{
    /**
     * @param string $name
     * @param Uuid|null $id
     * @param string $description
     * @param bool $isActive
     * @param \DateTime|null $createdAt
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

    /**
     * @return void
     */
    public function activate(): void
    {
        $this->isActive = true;
    }

    /**
     * @return void
     */
    public function deactivate(): void
    {
        $this->isActive = false;
    }

    /**
     * @param string $name
     * @param string $description
     * @return void
     * @throws NotificationException
     */
    public function update(string $name, string $description = ''): void
    {
        $this->name = $name;
        $this->description = $description;

        $this->validate();
    }

    /**
     * @return void
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
