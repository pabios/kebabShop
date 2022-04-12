<?php

namespace App\Controller;

use App\Entity\Product;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CartController extends AbstractController
{
    #[Route('/addToCart/{id}', name: 'addToCart')]
    public function index(SessionInterface $session,Product $product): Response
    {
        $data = $session->get("cart",[]);
        array_push($data, $product->getId());
        $session->set('cart',$data);
        //dd($data);

        return $this->redirectToRoute('cart');

        
    }

    #[Route('/cart', name: 'cart')]
    public function cart(SessionInterface $session): Response
    {
         
        $products = $session->get("cart");
         
        return $this->render('cart/show.html.twig', [
            'products' => $products
        ]);
    }


     
}
