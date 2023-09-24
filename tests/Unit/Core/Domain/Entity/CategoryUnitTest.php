<?php

namespace Tests\Unit\Core\Domain\Entity;

use Core\Domain\Entity\Category;
use Core\Domain\Exception\NotificationException;
use Core\Domain\ValueObject\Uuid;
use PHPUnit\Framework\TestCase;
use Ramsey\Uuid\Uuid as RamseyUuid;

class CategoryUnitTest extends TestCase
{
    public function testAttributes()
    {
        $uuid = (string) RamseyUuid::uuid4();
        $date = date('Y-m-d H:i:s');

        $genre = new Category(
            name: 'New Category',
            id: new Uuid($uuid),
            isActive: false,
            createdAt: new \DateTime($date),
        );

        $this->assertEquals($uuid, $genre->id());
        $this->assertEquals('New Category', $genre->name);
        $this->assertEquals(false, $genre->isActive);
        $this->assertEquals($date, $genre->createdAt());
    }

    public function testAttributesCreate()
    {
        $genre = new Category(
            name: 'New Category',
        );

        $this->assertNotEmpty($genre->id());
        $this->assertEquals('New Category', $genre->name);
        $this->assertEquals(true, $genre->isActive);
        $this->assertNotEmpty($genre->createdAt());
    }

    public function testDeactivate()
    {
        $genre = new Category(
            name: 'teste'
        );

        $this->assertTrue($genre->isActive);

        $genre->deactivate();

        $this->assertFalse($genre->isActive);
    }

    public function testActivate()
    {
        $genre = new Category(
            name: 'teste',
            isActive: false,
        );

        $this->assertFalse($genre->isActive);

        $genre->activate();

        $this->assertTrue($genre->isActive);
    }

    public function testUpdate()
    {
        $genre = new Category(
            name: 'teste'
        );

        $this->assertEquals('teste', $genre->name);

        $genre->update(
            name: 'Name Updated'
        );

        $this->assertEquals('Name Updated', $genre->name);
    }

    public function testEntityException()
    {
        $this->expectException(NotificationException::class);

        new Category(
            name: 's',
        );
    }

    public function testEntityUpdateException()
    {
        $this->expectException(NotificationException::class);

        $uuid = (string) RamseyUuid::uuid4();
        $date = date('Y-m-d H:i:s');

        $genre = new Category(
            name: 'New Category',
            id: new Uuid($uuid),
            isActive: false,
            createdAt: new \DateTime($date),
        );

        $genre->update(
            name: 's'
        );
    }
}
