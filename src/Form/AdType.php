<?php

namespace App\Form;

use App\Entity\Ad;
use App\Form\ImageType;
use App\Form\ApplicationType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\UrlType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;

class AdType extends ApplicationType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', TextType::class, $this->getConfiguration('titre','indiquer un titre pour votre annonce'))
            ->add('slug', TextType::class, $this->getConfiguration('Adresse web','Tapez l\'adresse web (automatique)',[
                'required' => false]))
            ->add('coverImage', UrlType::class, $this->getConfiguration('url de l\'image','indiquer l\'adresse url de votre image'))
            ->add('introduction', TextType::class, $this->getConfiguration('Introduction','Donnez une description globale de l\'annonce'))
            ->add('content', TextareaType::class, $this->getConfiguration('Description détaillée','Donner une description détaillée de votre annonce'))
            ->add('rooms', IntegerType::class, $this->getConfiguration('nombre de chambres','indiquer le nombre de chambres'))
            ->add('price', MoneyType::class, $this->getConfiguration('Prix par nuit','Donner un prix pour une nuit'))
            ->add('images', CollectionType::class, [
                'entry_type' => ImageType::class,
                'allow_add' => true,
                'allow_delete' => true
                ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Ad::class,
        ]);
    }
}
