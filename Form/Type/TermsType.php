<?php

namespace Kamran\TaxonomyBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Doctrine\ORM\EntityManager;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\FormView;


use Kamran\TaxonomyBundle\Form\Transformer\TaxonomyTransformer;
use Kamran\DebugBundle\Classes\Debug;
use Kamran\TaxonomyBundle\Form\Type\ChoiceList\ParentChoiceList;


class TermsType extends AbstractType
{

    private $vocabuary_id;
    private $em;


    public function __construct($vocabulary, EntityManager $em  )
    {
        $this->vocabuary_id = $vocabulary;
        $this->em           = $em;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {


        $builder->add('name', 'text', array('required' => false));
        $builder->add('description', 'textarea', array('required' => false));

        $builder->add('parents', 'choice',array(
            'multiple' => true,
            //'mapped' => false,
            'choices'  => self::getJobTypes(),
            //'choice_list' => new ParentChoiceList(),
        ));

    }

    public static function getJobTypes()
    {
        $data = new \Doctrine\Common\Collections\ArrayCollection();
        $data->set(1, 'Test 1');
        $data->set(2, 'Test 2');
        $data->set(3, 'Test 3');
        return $data;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(
            array(
            )
        );
    }



    public function getName()
    {
        return 'terms_form';
    }



}