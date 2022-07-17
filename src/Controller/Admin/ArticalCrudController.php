<?php

namespace App\Controller\Admin;

use App\Entity\Artical;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class ArticalCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Artical::class;
    }


    public function configureFields(string $pageName): iterable
    {
        return [
           # IdField::new('id'),
            TextField::new('title'),
            TextEditorField::new('content'),
            DateTimeField::new('datePublish'),
            ImageField::new('image')
                ->setBasePath('uploads/images')
                ->setUploadDir('public/uploads/images')
                ->setUploadedFileNamePattern('[randomhash].[extension]'),
            AssociationField::new('category')

            ];
    }



}
