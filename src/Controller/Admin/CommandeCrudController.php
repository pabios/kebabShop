<?php

namespace App\Controller\Admin;

use App\Entity\Commande;
use App\Form\CommandDetailsType;
use EasyCorp\Bundle\EasyAdminBundle\Field\CollectionField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class CommandeCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Commande::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        $config = parent::configureFields($pageName);
        $config[]=
            CollectionField::new('commandeDetails')
            ->setEntryType(CommandDetailsType::class);
            
        return $config;
    }
    
}
