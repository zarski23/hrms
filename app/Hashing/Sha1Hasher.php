<?php

// app/Hashing/Sha1Hasher.php

namespace App\Hashing;

class Sha1Hasher
{
    public function make($value)
    {
        return sha1($value);
    }

    public function check($value, $hashedValue)
    {
        return $this->make($value) === $hashedValue;
    }
}

