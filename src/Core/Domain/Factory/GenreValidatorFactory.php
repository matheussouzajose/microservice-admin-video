<?php

namespace Core\Domain\Factory;

use Core\Domain\Validation\GenreRakitValidator;
use Core\Domain\Validation\ValidatorInterface;

class GenreValidatorFactory
{
    /**
     * @return ValidatorInterface
     */
    public static function create(): ValidatorInterface
    {
        return new GenreRakitValidator();
    }
}
