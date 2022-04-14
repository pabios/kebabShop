<?php

namespace App\Controller;

use DateTime;
use App\Entity\Post;
use App\Entity\Client;
use App\Entity\Commande;
use App\Entity\CommandeDetails;
use App\Repository\ProductRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class OrderController extends AbstractController
{
    #[Route('/order', name: 'app_order')]
    public function index(): Response
    {
        return $this->render('order/index.html.twig', [
            'controller_name' => 'OrderController',
        ]);
    }

    #[Route('/order/checkout', name: 'checkout_order')]
    public function checkout(ProductRepository $productRepo, ManagerRegistry $doctrine ,SessionInterface $session): Response
    {
        $productsInOrder = [];
        $totalPrice = 0;

        $order = new Commande();
        $entityManager = $doctrine->getManager();

        foreach ($session->get("cart", []) as $id => $quantity) {
            if($quantity > 0){
                //$productsInOrder[$id] = $quantity;
                $productsInOrder[] = $productRepo->find($id)->setQuantity($quantity);
                $totalPrice += ($productRepo->find($id)->getPrice() * $productRepo->find($id)->getQuantity());
                $orderLine = new CommandeDetails();
                $orderLine->setProductQuantity($quantity);
                $orderLine->setIdProduct($productRepo->find($id));
                $orderLine->setIdCommande($order);
                $entityManager->persist($orderLine);
            }
        }

        $client = $doctrine->getRepository(Client::class)->find(1);

        
        $order->setIdClient($client);
        $order->setCreationDate(new DateTime());
        $order->setSendDate(new DateTime());
        $order->setStatut("En attente de payement");
        $order->setTotalPrice($totalPrice);
        $entityManager->persist($order);

        $entityManager->flush();


        // pour cote template
        $totalPrice =$totalPrice;
        $id = $orderLine->getIdCommande();
        $laDate = $order->getCreationDate();
        
        //dd($totalPrice);

        return $this->renderForm('order/index.html.twig', [
             'totalPrice'=>$totalPrice,
             'id' => $id,
             'laDate' => $laDate
        ]);
    }
}