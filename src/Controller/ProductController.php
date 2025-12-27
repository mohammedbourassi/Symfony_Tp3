<?php

namespace App\Controller;

use App\Form\AddToCartType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProductController extends AbstractController
{
    #[Route('/product/{id}', name: 'product_show')]
    public function show(int $id, Request $request): Response
    {
        // Simulation d’un produit (normalement depuis la DB)
        $product = [
            'id' => $id,
            'name' => 'Premium Wireless Headphones',
            'price' => 129.99,
            'brand' => 'AudioTech',
            'color' => 'Matte Black',
            'connectivity' => 'Bluetooth 5.0',
            'battery' => '30 hours',
            'image' => 'https://images.pexels.com/photos/90946/pexels-photo-90946.jpeg?auto=compress&cs=tinysrgb&w=800'
        ];

        $form = $this->createForm(AddToCartType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();
            // ici tu peux ajouter au panier
            $this->addFlash('success', 'Produit ajouté au panier');
        }

        return $this->render('product/show.html.twig', [
            'product' => $product,
            'form' => $form->createView()
        ]);
    }
}

