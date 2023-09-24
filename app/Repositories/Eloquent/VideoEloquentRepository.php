<?php

namespace App\Repositories\Eloquent;

use App\Models\Video as Model;
use App\Repositories\Eloquent\Traits\VideoTrait;
use App\Repositories\Presenters\PaginationPresenter;
use Core\Domain\Builder\Video\UpdateVideoBuilder;
use Core\Domain\Entity\Entity;
use Core\Domain\Entity\Video;
use Core\Domain\Enum\MediaStatus;
use Core\Domain\Enum\Rating;
use Core\Domain\Exception\NotFoundException;
use Core\Domain\Exception\NotificationException;
use Core\Domain\Repository\PaginationInterface;
use Core\Domain\Repository\VideoRepositoryInterface;
use Core\Domain\ValueObject\Uuid;

class VideoEloquentRepository implements VideoRepositoryInterface
{
    use VideoTrait;

    public function __construct(protected Model $model)
    {
    }

    /**
     * @throws NotificationException
     */
    public function insert(Entity $entity): Entity
    {
        $result = $this->model->create([
            'id' => $entity->id(),
            'title' => $entity->title,
            'description' => $entity->description,
            'year_launched' => $entity->yearLaunched,
            'rating' => $entity->rating->value,
            'duration' => $entity->duration,
            'opened' => $entity->opened,
        ]);

        $this->syncRelationships($result, $entity);

        return $this->convertObjectToEntity($result);
    }

    /**
     * @throws NotificationException
     */
    protected function convertObjectToEntity(object $data): Entity
    {
        $entity = new Video(
            title: $data->title,
            description: $data->description,
            yearLaunched: (int) $data->year_launched,
            duration: (bool) $data->duration,
            opened: $data->opened,
            rating: Rating::from($data->rating),
            id: new Uuid($data->id)
        );

        foreach ($data->categories as $category) {
            $entity->addCategoryId($category->id);
        }

        foreach ($data->genres as $genre) {
            $entity->addGenre($genre->id);
        }

        foreach ($data->castMembers as $castMember) {
            $entity->addCastMember($castMember->id);
        }

        $builder = (new UpdateVideoBuilder())
            ->setEntity($entity);

        if ($trailer = $data->trailer) {
            $builder->addTrailer($trailer->file_path);
        }

        if ($mediaVideo = $data->media) {
            $builder->addMediaVideo(
                path: $mediaVideo->file_path,
                mediaStatus: MediaStatus::from($mediaVideo->media_status),
                encodedPath: $mediaVideo->encoded_path
            );
        }

        if ($banner = $data->banner) {
            $builder->addBanner($banner->path);
        }

        if ($thumb = $data->thumb) {
            $builder->addThumb($thumb->path);
        }

        if ($thumbHalf = $data->thumbHalf) {
            $builder->addThumbHalf($thumbHalf->path);
        }

        return $builder->getEntity();
    }

    /**
     * @throws NotFoundException
     * @throws NotificationException
     */
    public function findById(string $entityId): Entity
    {
        if (! $result = $this->model->find($entityId)) {
            throw new NotFoundException("Video {$entityId} not found");
        }

        return $this->convertObjectToEntity($result);
    }

    public function findAll(string $filter = '', string $order = 'DESC'): array
    {
        $result = $this->model->when($filter, function ($query) use ($filter) {
            $query->where('title', 'LIKE', "%{$filter}%");
        })
            ->orderBy('title', $order)
            ->get();

        return $result->toArray();
    }

    public function paginate(string $filter = '', string $order = 'DESC', int $page = 1, int $totalPage = 15): PaginationInterface
    {
        $result = $this->model->when($filter, function ($query) use ($filter) {
            $query->where('title', 'LIKE', "%{$filter}%");
        })
            ->with([
                'media',
                'trailer',
                'banner',
                'thumb',
                'thumbHalf',
                'categories',
                'castMembers',
                'genres',
            ])
            ->orderBy('title', $order)
            ->paginate($totalPage, ['*'], 'page', $page);

        return new PaginationPresenter($result);
    }

    /**
     * @throws NotFoundException
     * @throws NotificationException
     */
    public function update(Entity $entity): Entity
    {
        if (! $result = $this->model->find($entity->id())) {
            throw new NotFoundException("Video {$entity->id} not found");
        }

        $result->update([
            'title' => $entity->title,
            'description' => $entity->description,
            'year_launched' => $entity->yearLaunched,
            'rating' => $entity->rating->value,
            'duration' => $entity->duration,
            'opened' => $entity->opened,
        ]);

        $result->refresh();

        $this->syncRelationships($result, $entity);

        return $this->convertObjectToEntity($result);
    }

    /**
     * @throws NotFoundException
     */
    public function delete(string $entityId): bool
    {
        if (! $result = $this->model->find($entityId)) {
            throw new NotFoundException("Video {$entityId} not found");
        }

        return $result->delete();
    }

    /**
     * @throws NotFoundException
     * @throws NotificationException
     */
    public function updateMedia(Entity $entity): Entity
    {
        if (! $result = $this->model->find($entity->id())) {
            throw new NotFoundException("Video {$entity->id} not found");
        }

        $this->updateMediaVideo($entity, $result);
        $this->updateMediaTrailer($entity, $result);

        $this->updateImageBanner($entity, $result);
        $this->updateImageThumb($entity, $result);
        $this->updateImageThumbHalf($entity, $result);

        return $this->convertObjectToEntity($result);
    }

    protected function syncRelationships(Model $data, Entity $entity): void
    {
        $data->categories()->sync($entity->categoriesId);
        $data->genres()->sync($entity->genresId);
        $data->castMembers()->sync($entity->castMemberIds);
    }
}
