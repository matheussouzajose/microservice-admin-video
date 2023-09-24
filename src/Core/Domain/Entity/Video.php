<?php

namespace Core\Domain\Entity;

use Core\Domain\Enum\Rating;
use Core\Domain\Exception\NotificationException;
use Core\Domain\Factory\VideoValidatorFactory;
use Core\Domain\ValueObject\Image;
use Core\Domain\ValueObject\Media;
use Core\Domain\ValueObject\Uuid;

class Video extends Entity
{
    /**@var array */
    protected array $categoriesId = [];

    /** @var array */
    protected array $genresId = [];

    /** @var array */
    protected array $castMemberIds = [];

    /**
     * @param string $title
     * @param string $description
     * @param int $yearLaunched
     * @param int $duration
     * @param bool $opened
     * @param Rating $rating
     * @param Uuid|null $id
     * @param bool $published
     * @param \DateTime|null $createdAt
     * @param Image|null $thumbFile
     * @param Image|null $thumbHalf
     * @param Image|null $bannerFile
     * @param Media|null $trailerFile
     * @param Media|null $videoFile
     * @throws NotificationException
     */
    public function __construct(
        protected string $title,
        protected string $description,
        protected int $yearLaunched,
        protected int $duration,
        protected bool $opened,
        protected Rating $rating,
        protected ?Uuid $id = null,
        protected bool $published = false,
        protected ?\DateTime $createdAt = null,
        protected ?Image $thumbFile = null,
        protected ?Image $thumbHalf = null,
        protected ?Image $bannerFile = null,
        protected ?Media $trailerFile = null,
        protected ?Media $videoFile = null,
    ) {
        parent::__construct();

        $this->id = $this->id ?? Uuid::random();
        $this->createdAt = $this->createdAt ?? new \DateTime();

        $this->validation();
    }

    /**
     * @throws NotificationException
     */
    public function update(string $title, string $description): void
    {
        $this->title = $title;
        $this->description = $description;

        $this->validation();
    }

    /**
     * @param string $categoryId
     * @return void
     */
    public function addCategoryId(string $categoryId): void
    {
        $this->categoriesId[] = $categoryId;
    }

    /**
     * @param string $categoryId
     * @return void
     */
    public function removeCategoryId(string $categoryId): void
    {
        unset($this->categoriesId[array_search($categoryId, $this->categoriesId)]);
    }

    /**
     * @param string $genreId
     * @return void
     */
    public function addGenre(string $genreId): void
    {
        $this->genresId[] = $genreId;
    }

    /**
     * @param string $genreId
     * @return void
     */
    public function removeGenre(string $genreId): void
    {
        unset($this->genresId[array_search($genreId, $this->genresId)]);
    }

    /**
     * @param string $castMemberId
     * @return void
     */
    public function addCastMember(string $castMemberId): void
    {
        $this->castMemberIds[] = $castMemberId;
    }

    /**
     * @param string $castMemberId
     * @return void
     */
    public function removeCastMember(string $castMemberId): void
    {
        unset($this->castMemberIds[array_search($castMemberId, $this->castMemberIds)]);
    }

    /**
     * @return Image|null
     */
    public function thumbFile(): ?Image
    {
        return $this->thumbFile;
    }

    /**
     * @param Image $thumbFile
     * @return void
     */
    public function setThumbFile(Image $thumbFile): void
    {
        $this->thumbFile = $thumbFile;
    }

    /**
     * @return Image|null
     */
    public function thumbHalf(): ?Image
    {
        return $this->thumbHalf;
    }

    public function setThumbHalf(Image $thumbHalf): void
    {
        $this->thumbHalf = $thumbHalf;
    }

    public function bannerFile(): ?Image
    {
        return $this->bannerFile;
    }

    public function setBannerFile(Image $bannerFile): void
    {
        $this->bannerFile = $bannerFile;
    }

    public function trailerFile(): ?Media
    {
        return $this->trailerFile;
    }

    public function setTrailerFile(Media $trailerFile): void
    {
        $this->trailerFile = $trailerFile;
    }

    public function videoFile(): ?Media
    {
        return $this->videoFile;
    }

    public function setVideoFile(Media $videoFile): void
    {
        $this->videoFile = $videoFile;
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
