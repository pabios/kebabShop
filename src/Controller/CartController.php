<?php

namespace App\Controller;

use App\Entity\Product;
use App\Repository\ProductRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CartController extends AbstractController
{
    #[Route('/addToCart/{id}', name: 'addToCart')]
    public function index(SessionInterface $session,Product $product, Request $request): Response
    {
        $quantity = $request->get("quantity");
        $data = $session->get("cart",[]);
        //array_push($data, $product->getId());
        if(!empty($data[$product->getId()]) && $data[$product->getId()] > 0){
            $data[$product->getId()] += $quantity;
        }
        else{
            $data[$product->getId()] = $quantity;
            
        }
        $session->set("cart", $data);

        //dd($data);

        return $this->redirectToRoute('cart');

        
    }

    #[Route('/cart', name: 'cart')]
    public function cart(ProductRepository $productRepo, SessionInterface $session, Request $request): Response
    {
        //$request->get("quantity");
        $data = $session->get("cart",[]);
        $products=[];
        foreach($data as $key => $value){
            $product =  $productRepo->find($key);
            $products[] = $product; 
            $product->setQuantity($value);

        }
        //dd($products);
        //$productRepo->find();
        return $this->render('cart/show.html.twig', [
            "products" => $products
        ]);
    }



     
}
