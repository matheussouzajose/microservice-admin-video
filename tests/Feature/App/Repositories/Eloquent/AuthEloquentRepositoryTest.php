<?php

namespace Feature\App\Repositories\Eloquent;

use App\Models\User as Model;
use App\Repositories\Eloquent\AuthEloquentRepository;
use App\Services\Criptography\Hasher;
use Core\Domain\Entity\User;
use Core\Domain\Exception\NotFoundException;
use Core\Domain\Exception\NotificationException;
use Core\Domain\Repository\AuthRepositoryInterface;
use Tests\Fixtures\UserFixtures;
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

        $this->repository->insert($entity);

        $this->assertDatabaseHas('users', [
            'id' => $entity->id(),
            'first_name' => $entity->firstName,
            'last_name' => $entity->lastName,
            'email' => $entity->email,
            'password' => $entity->password,
        ]);
    }

    /**
     * @throws NotificationException
     */
    public function testFindByEmailThrows()
    {
        $this->expectException(NotFoundException::class);
        $this->expectExceptionMessage("User " .  UserFixtures::EMAIL_MATHEUS . " Not Found");

        $this->repository->findByEmail(UserFixtures::EMAIL_MATHEUS);
    }

    public function testFindByEmailSuccess()
    {
        Model::factory()->create([
            'email' => UserFixtures::EMAIL_MATHEUS
        ]);

        $result = $this->repository->findByEmail(UserFixtures::EMAIL_MATHEUS);
        $this->assertEquals(UserFixtures::EMAIL_MATHEUS, $result->email);
    }

    /**
     * @throws NotFoundException
     */
    public function testCreateTokenByUserIdThrows()
    {
        $this->expectException(NotFoundException::class);
        $this->expectExceptionMessage("User " .  UserFixtures::UUID_MATHEUS . " Not Found");

        $this->repository->createTokenByUserId(UserFixtures::UUID_MATHEUS);
    }

    /**
     * @throws NotFoundException
     */
    public function testCreateTokenByUserIdSuccess()
    {
        $user = Model::factory()->create([
            'email' => UserFixtures::EMAIL_MATHEUS
        ]);

        $result = $this->repository->createTokenByUserId($user->id);
        $this->assertNotEmpty($result);
    }

    public function testLogoutThrows()
    {
        $this->expectException(NotFoundException::class);
        $this->expectExceptionMessage("User " .  UserFixtures::UUID_MATHEUS . " Not Found");
        $this->repository->logout(UserFixtures::UUID_MATHEUS);
    }

    /**
     * @throws NotFoundException
     */
    public function testLogoutSuccess()
    {
        $user = Model::factory()->create([
            'id' => UserFixtures::UUID_MATHEUS,
            'email' => UserFixtures::EMAIL_MATHEUS
        ]);

        $user->createToken('authtoken');

        $result = $this->repository->logout($user->id);
        $this->assertTrue($result);
    }
}
