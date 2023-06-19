<?php

namespace App\Controller\Admin;

use App\Entity\Voyage;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class VoyageCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Voyage::class;
    }


    
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')
                ->hideOnForm()
                ->hideOnIndex(),
            AssociationField::new('ville_depart'),
            DateTimeField::new('heure_depart'),
            AssociationField::new('ville_arrive'),
            DateTimeField::new('heure_arrive'),
            AssociationField::new('vehicule'),
            AssociationField::new('user'),
            IntegerField::new('nb_place'),
            TextField::new('description'),
            IntegerField::new('prix'),
            DateTimeField::new('created_at')
                ->hideOnForm(),
        ];
    }
    
}
