<?php

namespace Core\Domain\Validation;

use Core\Domain\Exception\EntityValidationException;

class DomainValidation
{
    /**
     * @param string $value
     * @param string|null $exceptMessage
     * @return void
     * @throws EntityValidationException
     */
    public static function notNull(string $value, string $exceptMessage = null): void
    {
        if (empty($value)) {
            throw new EntityValidationException($exceptMessage ?? "Should not empty");
        }
    }

    /**
     * @param string $value
     * @param int $length
     * @param string|null $exceptMessage
     * @return void
     * @throws EntityValidationException
     */
    public static function strMaxLength(string $value, int $length = 255, string $exceptMessage = null): void
    {
        if (strlen($value) >= $length) {
            throw new EntityValidationException($exceptMessage ?? "The value must not be greater than {$length} characters");
        }
    }

    /**
     * @param string $value
     * @param int $length
     * @param string|null $exceptMessage
     * @return void
     * @throws EntityValidationException
     */
    public static function strMinLength(string $value, int $length = 3, string $exceptMessage = null): void
    {
        if (strlen($value) <= $length) {
            throw new EntityValidationException($exceptMessage ?? "The value must be at least {$length} characters");
        }
    }

    /**
     * @param string $value
     * @param int $length
     * @param string|null $exceptMessage
     * @return void
     * @throws EntityValidationException
     */
    public static function strCanNullAndMaxLength(string $value = '', int $length = 255, string $exceptMessage = null): void
    {
        if (!empty($value) && strlen($value) > $length) {
            throw new EntityValidationException($exceptMessage ?? "The value must not be greater than {$length} characters");
        }
    }
}