<?php

namespace Tests\Unit\Core\Domain\Validation;

use Core\Domain\Exception\EntityValidationException;
use Core\Domain\Validation\DomainValidation;
use PHPUnit\Framework\TestCase;

class DomainValidationUnitTest extends TestCase
{
    const ERROR_MESSAGE = 'Message Error';

    public function testNotNull()
    {
        $this->expectException(EntityValidationException::class);
        DomainValidation::notNull('');
    }

    public function testNotNullCustomMessageException()
    {
        $this->expectException(EntityValidationException::class);
        $this->expectExceptionMessage(self::ERROR_MESSAGE);

        DomainValidation::notNull('', self::ERROR_MESSAGE);
    }

    public function testStrMaxLength()
    {
        $this->expectException(EntityValidationException::class);
        $this->expectExceptionMessage(self::ERROR_MESSAGE);

        DomainValidation::strMaxLength('Strings', 5, self::ERROR_MESSAGE);
    }

    public function testStrMinLength()
    {
        $this->expectException(EntityValidationException::class);
        $this->expectExceptionMessage(self::ERROR_MESSAGE);

        DomainValidation::strMinLength('Min', 3, self::ERROR_MESSAGE);
    }

    public function testStrCanNullAndMaxLength()
    {
        $this->expectException(EntityValidationException::class);
        $this->expectExceptionMessage(self::ERROR_MESSAGE);

        DomainValidation::strCanNullAndMaxLength('MaxLength', 3, self::ERROR_MESSAGE);
    }
}
