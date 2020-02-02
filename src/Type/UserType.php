<?php


namespace App\Type;


use App\Entity\Category;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $option)
    {
        $builder->add('name', TextType::class,['label'=>'Imie'])
            ->add('surname',TextType::class, ['required'=> false, 'label'=>'nazwisko'])
            ->add('iceLover',CheckboxType::class, ['label'=>'czy lubi lody'])
            ->add('category',EntityType::class,['class'=>Category::class,'choice_label'=>'name'])
            ->add('save',SubmitType::class,['label'=>'dodaj']);
    }

}