<?php

namespace Feature\Api;

use Tests\TestCase;

class UnAuthenticationApiTest extends TestCase
{
    protected string $endpoint = 'api/v1/';

    public function test_autenthication_category()
    {
        $this->getJson($this->endpoint.'categories')
            ->assertStatus(401);

        $this->getJson($this->endpoint.'categories/fake_id')
            ->assertStatus(401);

        $this->postJson($this->endpoint.'categories')
            ->assertStatus(401);

        $this->putJson($this->endpoint.'categories/fake_id')
            ->assertStatus(401);

        $this->deleteJson($this->endpoint.'categories/fake_id')
            ->assertStatus(401);
    }

    public function test_autenthication_genres()
    {
        $this->getJson($this->endpoint.'genres')
            ->assertStatus(401);

        $this->getJson($this->endpoint.'genres/fake_id')
            ->assertStatus(401);

        $this->postJson($this->endpoint.'genres')
            ->assertStatus(401);

        $this->putJson($this->endpoint.'genres/fake_id')
            ->assertStatus(401);

        $this->deleteJson($this->endpoint.'genres/fake_id')
            ->assertStatus(401);
    }

    public function test_autenthication_cast_members()
    {
        $this->getJson($this->endpoint.'cast_members')
            ->assertStatus(401);

        $this->getJson($this->endpoint.'cast_members/fake_id')
            ->assertStatus(401);

        $this->postJson($this->endpoint.'cast_members')
            ->assertStatus(401);

        $this->putJson($this->endpoint.'cast_members/fake_id')
            ->assertStatus(401);

        $this->deleteJson($this->endpoint.'cast_members/fake_id')
            ->assertStatus(401);
    }

    public function test_autenthication_video()
    {
        $this->getJson($this->endpoint.'videos')
            ->assertStatus(401);

        $this->getJson($this->endpoint.'videos/fake_id')
            ->assertStatus(401);

        $this->postJson($this->endpoint.'videos')
            ->assertStatus(401);

        $this->putJson($this->endpoint.'videos/fake_id')
            ->assertStatus(401);

        $this->deleteJson($this->endpoint.'videos/fake_id')
            ->assertStatus(401);
    }
}
