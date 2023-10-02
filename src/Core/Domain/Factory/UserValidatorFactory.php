<?php

namespace Core\Domain\Factory;

use Core\Domain\Validation\UserRakitValidator;
use Core\Domain\Validation\ValidatorInterface;

class UserValidatorFactory
{
    public static function create(): ValidatorInterface
    {
        return new UserRakitValidator();
    }
}
