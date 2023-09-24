<?php

namespace Core\Domain\Entity;

use Core\Domain\Exception\NotificationException;
use Core\Domain\Factory\GenreValidatorFactory;
use Core\Domain\ValueObject\Uuid;

class Genre extends Entity
{

    /**
     * @param string $name
     * @param Uuid|null $id
     * @param bool $isActive
     * @param array $categoriesId
     * @param \DateTime|null $createdAt
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
     * @return void
     * @throws NotificationException
     */
    public function update(string $name): void
    {
        $this->name = $name;

        $this->validate();
    }

    /**
     * @param string $categoryId
     * @return void
     */
    public function addCategory(string $categoryId): void
    {
        $this->categoriesId[] = $categoryId;
    }

    /**
     * @param string $categoryId
     * @return void
     */
    public function removeCategory(string $categoryId): void
    {
        unset($this->categoriesId[array_search($categoryId, $this->categoriesId)]);
    }

    /**
     * @return void
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
