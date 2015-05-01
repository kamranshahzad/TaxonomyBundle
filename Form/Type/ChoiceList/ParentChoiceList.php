<?php

namespace Kamran\TaxonomyBundle\Form\Type\ChoiceList;

use Symfony\Component\Form\Extension\Core\ChoiceList\LazyChoiceList;
use Symfony\Component\Form\Extension\Core\ChoiceList\SimpleChoiceList;


class ParentChoiceList extends LazyChoiceList
{
    public function loadChoiceList()
    {
        return new SimpleChoiceList( array(
            'Carta Documento' => 'Carta Documento',
            'Ad Hoc' => 'Ad Hoc',
            'Cédula' => 'Cédula',
            'Personal' => 'Personal',
            'Otros' => 'Otros'
        ));
    }
}