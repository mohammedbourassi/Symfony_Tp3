<?php

namespace App\Service\Contract;

interface CartServiceInterface
{
    public function add(array $product, array $data): void;
}

