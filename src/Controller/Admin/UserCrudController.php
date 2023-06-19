<?php

namespace App\Controller\Admin;

use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\ArrayField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\EmailField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class UserCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return User::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')
                ->hideOnIndex()
                ->hideOnForm(),
            EmailField::new('email'),
            TextField::new('lastname')
                ->setLabel('Nom'),
            TextField::new('firstname')
                ->setLabel('Prénom'),
            TextField::new('password')
                ->setLabel('mot de passe'),
            TextField::new('num_tel')
                ->setLabel('Numéro de Téléphone'),
            
            ArrayField::new('roles')
                ->setLabel('Roles')
                ->hideOnIndex()
                ->hideOnForm(),
            DateTimeField::new('created_at')
                ->hideOnForm(),
            TextField::new('slug')
                ->hideOnIndex()
                ->hideOnForm(),
        ];
    }
}
