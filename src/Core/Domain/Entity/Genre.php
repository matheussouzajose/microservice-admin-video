<?php

namespace Core\Domain\Entity;

use Core\Domain\Exception\NotificationException;
use Core\Domain\Factory\GenreValidatorFactory;
use Core\Domain\ValueObject\Uuid;

class Genre extends Entity
{
    /**
     * @throws NotificationException
     */
    public function __construct(
        protected string $name,
        protected ?Uuid $id = null,
        protected bool $isActive = true,
        protected array $categoriesId = [],
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
    public function update(string $name): void
    {
        $this->name = $name;

        $this->validate();
    }

    public function addCategory(string $categoryId): void
    {
        $this->categoriesId[] = $categoryId;
    }

    public function removeCategory(string $categoryId): void
    {
        unset($this->categoriesId[array_search($categoryId, $this->categoriesId)]);
    }

    /**
     * @throws NotificationException
     */
    protected function validate(): void
    {
        GenreValidatorFactory::create()->validate($this);

        if ($this->notification->hasErrors()) {
            throw new NotificationException(
                $this->notification->messages('genre')
            );
        }
    }
}
