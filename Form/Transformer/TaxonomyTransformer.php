<?php

namespace Kamran\TaxonomyBundle\Form\Transformer;

use Symfony\Component\Form\DataTransformerInterface;
use Symfony\Component\Form\Exception\TransformationFailedException;



class TaxonomyTransformer implements DataTransformerInterface
{

	public function transform($object){
		echo get_class($value);

		return $value->getName();

		//will return array
	}

	
	public function reverseTransform($array){
		//will return object
	}


}