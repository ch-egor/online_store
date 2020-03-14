<?php

namespace App\Form;

use App\Entity\Category;
use Cocur\Slugify\SlugifyInterface;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CategoryType extends AbstractType
{
    protected $slugify;

    public function __construct(SlugifyInterface $slugify)
    {
        $this->slugify = $slugify;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', Type\TextType::class)
            ->add('slug', Type\TextType::class, [
                'required' => false,
            ])
            ->addEventListener(
                FormEvents::PRE_SUBMIT,
                [$this, 'onPreSubmit']
            )
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Category::class,
        ]);
    }

    public function onPreSubmit(FormEvent $event)
    {
        $category = $event->getData();

        if (!$category['slug']) {
            $category['slug'] = $this->slugify->slugify($category['title']);
        }

        $event->setData($category);
    }
}
