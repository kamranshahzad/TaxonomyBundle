<?php

namespace Kamran\TaxonomyBundle\Commons;

use RecursiveArrayIterator;
use RecursiveIteratorIterator;
use Doctrine\Common\Collections\ArrayCollection;

class TaxonomyHlp
{
    public function isTaxonomyExist($title,$entityManager = null){
        if(!empty($title)){

        }
    }

    public static function taxonomyMachineName($title){
        if(!empty($title)){
            return strtolower(str_replace(' ', '_', $title));
        }
    }


    public static function buildTreeArray($source , $targetVid = null){
        $outputArray = array();
        foreach ($source as $vid => $array) {
            if($array['parent'] == $targetVid){

                //$outputArray[$vid] =  array('vid' => $vid , 'name'=>$array['name']);
                $outputArray[$vid] =  array($vid=>$array['name']);
                $children = self::buildTreeArray($source,$vid);
                if($children){
                    $outputArray[$vid]['children'] = $children;
                }

            }
        }
        return $outputArray;
    }

    public static function buildTreeOptions($treeArray){

        $arrayiter = new RecursiveArrayIterator($treeArray);
        $iteriter = new RecursiveIteratorIterator($arrayiter );


        $options = array();
        foreach ($iteriter as $key => $value) {
            $d = $iteriter->getDepth();
            //echo "depth=$d <br/>";
            $options[$key] = str_repeat('-',$d-1).$value;
            //echo "depth=$d k=$key v=$value <br/>";
        }

        return $options;
    }



     public static function buildTreeOptionsTest($treeArray){

        $arrayiter = new RecursiveArrayIterator($treeArray);
        $iteriter = new RecursiveIteratorIterator($arrayiter );


        //$options = array();
        $options = new ArrayCollection();
        foreach ($iteriter as $key => $value) {
            $d = $iteriter->getDepth();
            //echo "depth=$d <br/>";
            $options->set($key,str_repeat('-',$d-1).$value);
            //$options[$key] = str_repeat('-',$d-1).$value;
            //echo "depth=$d k=$key v=$value <br/>";
        }

        return $options;
    }

}


