<?php

namespace InfoBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ArticleType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title')
            ->add('description')
            ->add('body')
            //->add('createdAt', \Symfony\Component\Form\Extension\Core\Type\DateType::class)
            //->add('slug')
            ->add('createdBy')
        ;
    }
    
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'InfoBundle\Entity\Article',
            'csrf_protection' => false,
        ));
    }
    
    
    /**
     * @return string
     */
    public function getName()
    {
        return 'article';
    }
}
