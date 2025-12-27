<?php

namespace App\Service;

use App\Service\Contract\CartServiceInterface;
use Symfony\Component\HttpFoundation\RequestStack;

class CartService implements CartServiceInterface
{
    private $session;

    public function __construct(RequestStack $requestStack)
    {
        $this->session = $requestStack->getSession();
    }

    public function add(array $product, array $data): void
    {
        $cart = $this->session->get('cart', []);

        $cart[] = [
            'product_id' => $product['id'],
            'name'       => $product['name'],
            'price'      => $product['price'],
            'quantity'   => $data['quantity'],
            'color'      => $data['color'],
        ];

        $this->session->set('cart', $cart);
    }
}

