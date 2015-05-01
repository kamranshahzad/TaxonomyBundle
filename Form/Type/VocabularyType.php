<?php

namespace Kamran\TaxonomyBundle\Type\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;



class VocabularyType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('name', 'text');
        $builder->add('machine_name', 'text');
        $builder->add('description', 'textarea', array('required' => false));
    }

    public function getDefaultOptions(array $options)
    {
        return array(
            'data_class'          => \Kamran\TaxonomyBundle\Entity\Vocabulary,
            'validation_groups'   => array('vocabulary_create'),
            'cascade_validation'  => true,
        );
    }


    public function getName()
    {
        return 'vocabulary_form';
    }
}