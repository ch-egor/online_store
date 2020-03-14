<?php

namespace App\Form;

use App\Entity\Article;
use App\Entity\Category;
use Cocur\Slugify\SlugifyInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ArticleType extends AbstractType
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
                'attr' => [
                    'placeholder' => 'Optional',
                ],
            ])
            ->add('description', Type\TextareaType::class)
            ->add('inStock', Type\CheckboxType::class)
            ->add('category', EntityType::class, [
                'class' => Category::class,
                'choice_label' => 'title',
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
            'data_class' => Article::class,
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
