<?php

namespace Feature\App\Repositories\Eloquent;

use App\Models\User as Model;
use App\Repositories\Eloquent\AuthEloquentRepository;
use App\Services\Criptography\Hasher;
use Core\Domain\Entity\User;
use Core\Domain\Repository\AuthRepositoryInterface;
use Tests\TestCase;

class AuthEloquentRepositoryTest extends TestCase
{
    protected AuthRepositoryInterface $repository;

    protected function setUp(): void
    {
        parent::setUp();

        $this->repository = new AuthEloquentRepository(
            new Model()
        );
    }

    public function testImplementsInterfaceSuccess()
    {
        $this->assertInstanceOf(
            AuthRepositoryInterface::class,
            $this->repository
        );
    }

    public function testSignUpSuccess()
    {
        $entity = new User(
            firstName: 'Matheus',
            lastName: 'Jose',
            email: 'matheus.jose@mail.com'
        );

        $hashedPassword = (new Hasher())->hash('123456');
        $entity->updatePassword($hashedPassword);

        $this->repository->signUp($entity);

        $this->assertDatabaseHas('users', [
            'id' => $entity->id(),
            'first_name' => $entity->firstName,
            'last_name' => $entity->lastName,
            'email' => $entity->email,
            'password' => $entity->password,
        ]);
    }
}
