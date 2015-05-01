<?php

namespace Kamran\TaxonomyBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\FormView;

class ParentType extends AbstractType
{

    public function buildView(FormView $view, FormInterface $form, array $options)
    {
        echo '<pre>';
        print_r(array_keys($view->vars));
        echo '</pre>';

       $view->vars = array_replace($view->vars, array(
            'choices' => array('abc','ced','fed'),
        ));

        $view->vars['separator'] = '----';
    }


    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(
            array(
                //'choices' => $this->getArrayOfTermLeveles(),
                'multiple' => true,
            )
        );
    }

    public function getParent()
    {
        return 'choice';
    }

    public function getName()
    {
        return 'parent';
    }


    private function getArrayOfTermLeveles()
    {
        $list = array();

        $list[1] = array('name'=>'Fruits');
        $list[2] = array('name'=>'Vagitable');
        $list[3] = array('name'=>'Mangoo');

        return $list;
    }

}
?>