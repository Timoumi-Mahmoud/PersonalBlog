<?php

namespace App\Form;

use App\Entity\Artical;
use Doctrine\DBAL\Types\DateTimeType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ArticalType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title')
            ->add('content', TextareaType::class, array('attr' => array('rows' => '40','cols' => '5')) )
            ->add('datePublish', \Symfony\Component\Form\Extension\Core\Type\DateTimeType::class, array(
                'data' => new \DateTime(),
                'attr' => ['hidden' => true]
            ))
            ->add('category')
            ->add('image', FileType::class , ["attr"=> array(),'data_class' => null, 'required' => false,'label'=>"Image de l'evenement :" ])


        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Artical::class,
        ]);
    }
}
