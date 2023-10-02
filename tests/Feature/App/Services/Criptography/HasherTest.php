<?php

namespace Feature\App\Services\Criptography;

use App\Services\Criptography\Hasher;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class HasherTest extends TestCase
{
    public function testHashSuccess()
    {
        $plaintext = '123456789';
        $hash = (new Hasher())->hash($plaintext);

        $this->assertNotEquals($plaintext, $hash);
    }

    public function testHashExistsInfo()
    {
        $plaintext = Hash::make('123456789');
        $hash = (new Hasher())->hash($plaintext);

        $this->assertEquals($plaintext, $hash);
    }

    public function testCompare()
    {
        $plaintext = '123456789';
        $hashed = Hash::make($plaintext);
        $result = (new Hasher())->compare($plaintext, $hashed);

        $this->assertTrue($result);
    }
}
