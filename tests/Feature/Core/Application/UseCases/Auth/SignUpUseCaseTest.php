<?php

namespace Tests\Feature\Core\Application\UseCases\Auth;

use App\Models\User;
use Core\Application\UseCases\Auth\SignUpUseCase;
use Core\Domain\Exception\EmailAlreadyInUseException;
use Core\Domain\Repository\AuthRepositoryInterface;
use Core\Domain\UseCases\Auth\SignUpUseCaseInterface;
use Core\Intermediate\Dtos\Auth\SignUpInputDto;
use Illuminate\Support\Facades\Event;
use Tests\Stubs\HasherStub;
use Tests\Stubs\TransactionStub;
use Tests\Stubs\UserEventStub;
use Tests\TestCase;

class SignUpUseCaseTest extends TestCase
{

    private function makeSut(): SignUpUseCaseInterface
    {
        return new SignUpUseCase(
            repository: $this->app->make(AuthRepositoryInterface::class),
            hasher: new HasherStub(),
            eventManager: new UserEventStub(),
            transaction: new TransactionStub()
        );
    }

    private function makeInputDto(): SignUpInputDto
    {
        return new SignUpInputDto(
            firstName: 'Matheus',
            lastName: 'Jose',
            email: 'matheus.jose@mail.com',
            password: '123456789'
        );
    }

    public function testThrowsIfEmailAlreadyInUseThrows()
    {
        $this->expectException(EmailAlreadyInUseException::class);
        $this->expectExceptionMessage("Email already in use");

        User::factory()->create([
           'email' => 'matheus.jose@mail.com'
        ]);

        $useCase = $this->makeSut();
        $useCase->execute(
            input: $this->makeInputDto()
        );
    }

    /**
     * @dataProvider stubProvider
     */
    public function testException(string $stub)
    {
        $this->expectException(\Exception::class);

        Event::listen($stub, function () {
            throw new \Exception();
        });

        $useCase = $this->makeSut();
        $useCase->execute(
            input: $this->makeInputDto()
        );

        $this->assertDatabaseCount('users', 0);
    }

    public function stubProvider(): array
    {
        return [
            [HasherStub::class],
            [UserEventStub::class],
            [TransactionStub::class]
        ];
    }

    public function testCreateUserSuccess()
    {
        $useCase = $this->makeSut();
        $response = $useCase->execute(
            input: $this->makeInputDto()
        );

        $this->assertDatabaseCount('users', 1);

        $this->assertNotEmpty($response->id);
        $this->assertNotEmpty($response->createdAt);
        $this->assertEquals('Matheus', $response->firstName);
        $this->assertEquals('Jose', $response->lastName);
        $this->assertEquals('matheus.jose@mail.com', $response->email);
    }
}
