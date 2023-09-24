<?php

namespace Core\Domain\Factory;

use Core\Domain\Validation\CategoryRakitValidator;
use Core\Domain\Validation\ValidatorInterface;

class CategoryValidatorFactory
{
    /**
     * @return ValidatorInterface
     */
    public static function create(): ValidatorInterface
    {
        return new CategoryRakitValidator();
    }
}
