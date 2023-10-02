<?php

namespace App\Services\Criptography;

use Core\Domain\Services\HasherInterface;
use Illuminate\Support\Facades\Hash;

class Hasher implements HasherInterface
{
    public function hash(string $plaintext): string
    {
        $hashInfo = Hash::info($plaintext);
        if (! $hashInfo['algo']) {
            return Hash::make($plaintext);
        }

        return $plaintext;
    }

    public function compare(string $plaintext, string $hashed): bool
    {
        return Hash::check($plaintext, $hashed);
    }
}
