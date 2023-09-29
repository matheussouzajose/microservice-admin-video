<?php

namespace Core\Domain\Entity;

use Core\Domain\Exception\NotificationException;
use Core\Domain\Factory\UserValidatorFactory;
use Core\Domain\ValueObject\Image;
use Core\Domain\ValueObject\Uuid;

class User extends Entity
{
    /**
     * @throws NotificationException
     */
    public function __construct(
        protected string $firstName,
        protected string $lastName,
        protected string $email,
        protected string $password,
        protected ?Image $userAvatar = null,
        protected ?Uuid $id = null,
        protected ?\DateTime $emailVerifiedAt = null,
        protected ?\DateTime $createdAt = null,
        protected ?\DateTime $updatedAt = null,
        protected ?\DateTime $deletedAt = null,
    ) {
        parent::__construct();

        $this->id = $this->id ?? Uuid::random();
        $this->createdAt = $this->createdAt ?? new \DateTime();
        $this->validation();
    }

    /**
     * @throws NotificationException
     */
    protected function validation(): void
    {
        UserValidatorFactory::create()->validate($this);

        if ($this->notification->hasErrors()) {
            throw new NotificationException(
                $this->notification->messages('user')
            );
        }
    }

    /**
     * @throws NotificationException
     */
    public function update(string $firstName, string $lastName, string $email): void
    {
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->email = $email;
        $this->updatedAt = new \DateTime();

        $this->validation();
    }

    public function setUserAvatar(Image $userAvatar): void
    {
        $this->userAvatar = $userAvatar;
        $this->updatedAt = new \DateTime();
    }

    public function userAvatar(): ?Image
    {
        return $this->userAvatar;
    }

    /**
     * @throws NotificationException
     */
    public function updatePassword(string $password): void
    {
        $this->password = $password;
        $this->updatedAt = new \DateTime();

        $this->validation();
    }
}
