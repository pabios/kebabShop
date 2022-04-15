<?php

namespace App\Controller;

use App\Repository\ProductRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HomeController extends AbstractController
{
    #[Route('/home', name: 'app_home')]
    public function index(): Response
    {
        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    }

    #[Route('/apiSearch', name: 'apiSearch')]
    public function search(Request $request, ProductRepository $productRepo): Response
    {
        $search= $request->query->get("search");
        $allProduct = $productRepo->search($search);
         
        $rep=[];

        foreach($allProduct as $all ){
             $rep[]=$all->getName();
             
        }
        return new JsonResponse($rep);

        /*return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
            'products' => $allProduct
        ]);*/
    }

}
