<?php

namespace Core\Domain\Validation;

use Core\Domain\Entity\Entity;
use Rakit\Validation\Validator;

class GenreRakitValidator implements ValidatorInterface
{
    public function validate(Entity $entity): void
    {
        $data = $this->convertEntityForArray($entity);

        $validation = (new Validator())->validate($data, [
            'name' => 'required|min:3|max:255',
            'is_active' => 'nullable|boolean',
        ]);

        if ($validation->fails()) {
            foreach ($validation->errors()->all() as $error) {
                $entity->notification->addError([
                    'context' => 'category',
                    'message' => $error,
                ]);
            }
        }
    }

    private function convertEntityForArray(Entity $entity): array
    {
        return [
            'name' => $entity->name,
            'is_active' => $entity->isActive,
        ];
    }
}
