<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CartController extends AbstractController
{
    #[Route('/buyer/cart', name: 'buyer_cart')]
    public function index(): Response
    {
        return $this->render('buyer/cart/index.html.twig', [
            'controller_name' => 'CartController',
        ]);
    }
}
