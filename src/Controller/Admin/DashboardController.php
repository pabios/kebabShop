<?php

namespace App\Controller\Admin;

use App\Entity\Client;
use App\Entity\Product;
use App\Entity\Commande;
use App\Entity\CommandeDetails;
use App\Controller\Admin\AdminCrudController;
use Symfony\Component\HttpFoundation\Response;
use App\Controller\Admin\ProductCrudController;
use Symfony\Component\Routing\Annotation\Route;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;


class DashboardController extends AbstractDashboardController
{
    #[Route('/admin', name: 'admin')]
    public function index(): Response
    {
        //return parent::index();
        //option

            // Option 1. You can make your dashboard redirect to some common page of your backend
            //
            $adminUrlGenerator = $this->container->get(AdminUrlGenerator::class);
            return $this->redirect($adminUrlGenerator->setController(ProductCrudController::class)->generateUrl());
            // Option 2. You can make your dashboard redirect to different pages depending on the user
            //
            // if ('jane' === $this->getUser()->getUsername()) {
            //     return $this->redirect('...');
            // }

            // Option 3. You can render some custom template to display a proper dashboard with widgets, etc.
            // (tip: it's easier if your template extends from @EasyAdmin/page/content.html.twig)
            //
            // return $this->render('some/path/my-dashboard.html.twig');
        
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Kebabskusku');
    }

    public function configureMenuItems(): iterable
    {
        return [
            MenuItem::linkToDashboard('Dashboard', 'fa fa-home'),
            MenuItem::linkToCrud('Client', 'fa fa-file-text', Client::class),
            MenuItem::linkToCrud('Product', 'fa fa-file-text', Product::class),
            MenuItem::linkToCrud('Commande', 'fa fa-file-text', Commande::class),
            MenuItem::linkToCrud('CommandeDetails', 'fa fa-file-text', CommandeDetails::class)
          //  MenuItem::linkToCrud('Category', 'fa fa-file-text', Product::class)
          ];
        //yield MenuItem::linkToDashboard('Dashboard', 'fa fa-home');
        // yield MenuItem::linkToCrud('The Label', 'fas fa-list', EntityClass::class);
    }
}
