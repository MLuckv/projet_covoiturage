<?php

namespace App\Controller\Admin;

use App\Entity\Images;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class ImagesCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Images::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id'),
            ImageField::new('name')
                ->setLabel("Image")
                ->setBasePath('uploads/') //chemin où les images sont stockées
                ->setUploadDir('public/uploads/') // répertoire de téléchargement
                //->setUploadedFileNamePattern(md5(uniqid()) . '.[extension]'), //modèle de nom de fichier //provoque une fatal error
                ,
            TextField::new('name')
                ->hideOnForm()
                ->setLabel("Nom Fichier")
        ];
    }
    
}
