<?php

namespace Core\Domain\Entity;

use Core\Domain\Enum\Rating;
use Core\Domain\Exception\NotificationException;
use Core\Domain\Factory\VideoValidatorFactory;
use Core\Domain\ValueObject\Image;
use Core\Domain\ValueObject\Media;
use Core\Domain\ValueObject\Uuid;

class User extends Entity
{
    public function __construct(
        protected string $firstName,
        protected string $lastName,
        protected string $email,
        protected string $password,
        protected ?string $userAvatar = null,
        protected ?Uuid $id = null,
        protected ?\DateTime $createdAt = null,
    ) {
        parent::__construct();

        $this->id = $this->id ?? Uuid::random();
        $this->createdAt = $this->createdAt ?? new \DateTime();

//        $this->validation();
    }

    /**
     * @throws NotificationException
     */
    protected function validation(): void
    {
        VideoValidatorFactory::create()->validate($this);

        if ($this->notification->hasErrors()) {
            throw new NotificationException(
                $this->notification->messages('video')
            );
        }
    }
}
