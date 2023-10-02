<?php

namespace Feature\Api;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\Response;
use Tests\Fixtures\UserFixtures;
use Tests\TestCase;

class AuthApiTest extends TestCase
{
    protected string $endpoint = 'api/v1';

    public function testStoreSignUpValidationFalse()
    {
        $data = [];

        $response = $this->postJson("{$this->endpoint}/sign-up", $data);

        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
        $response->assertJsonStructure([
            'message',
            'errors' => [
                'first_name',
                'last_name',
                'email',
                'password',
            ],
        ]);
    }

    public function testSignUpSuccess()
    {
        $data = [
            'first_name' => UserFixtures::FIRST_NAME_MATHEUS,
            'last_name' => UserFixtures::LAST_NAME_MATHEUS,
            'email' => UserFixtures::EMAIL_MATHEUS,
            'password' => UserFixtures::DEFAULT_PASSWORD,
            'password_confirmation' => UserFixtures::DEFAULT_PASSWORD,
        ];

        $response = $this->postJson("{$this->endpoint}/sign-up", $data);
        $response->assertStatus(Response::HTTP_CREATED);

        $this->assertNotEmpty($response['data']['id']);
        $this->assertNotEmpty($response['data']['created_at']);
        $this->assertEquals($data['first_name'], $response['data']['first_name']);
        $this->assertEquals($data['last_name'], $response['data']['last_name']);
        $this->assertEquals($data['email'], $response['data']['email']);
    }

    public function testStoreSignInValidationFalse()
    {
        $data = [];

        $response = $this->postJson("{$this->endpoint}/sign-in", $data);

        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
        $response->assertJsonStructure([
            'message',
            'errors' => [
                'email',
                'password'
            ],
        ]);
    }

    public function testSignInSuccess()
    {
        User::factory()->create([
            'email' => UserFixtures::EMAIL_MATHEUS,
            'password' => Hash::make(UserFixtures::DEFAULT_PASSWORD)
        ]);

        $data = [
            'email' => UserFixtures::EMAIL_MATHEUS,
            'password' => UserFixtures::DEFAULT_PASSWORD,
        ];

        $response = $this->postJson("{$this->endpoint}/sign-in", $data);
        $response->assertStatus(Response::HTTP_OK);

        $this->assertNotEmpty($response['data']['access_token']);
        $this->assertEquals('Bearer', $response['data']['token_type']);
    }
}
