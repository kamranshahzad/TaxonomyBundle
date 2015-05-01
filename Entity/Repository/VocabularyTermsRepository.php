<?php

namespace Kamran\TaxonomyBundle\Entity\Repository;

use Doctrine\ORM\EntityRepository;


class VocabularyTermsRepository extends EntityRepository
{



    public function findByVocabularyTerms($vid){

        $dql = "SELECT t FROM \Kamran\TaxonomyBundle\Entity\VocabularyTerms t LEFT JOIN t.vid v LEFT JOIN t.parents c WHERE v.id = ?1 ";
        $query = $this->getEntityManager()->createQuery($dql)->setParameter( 1 , $vid);
        $result = $query->getResult(); 
        $categories = array();
        foreach ($result as $term) {
           $parent = 0;
           foreach($term->getParents() as $child){
               $parent = $child->getId();
           }
           $categories[ $term->getId() ] = array('name'=>$term->getName(),'description'=>$term->getDescription(),'parent'=>$parent);
        }
        //return $result;
        return $categories;
    }

    

    /*
    public function get_raw_term($vid){
        $dql = "SELECT t FROM \Kamran\TaxonomyBundle\Entity\Terms t LEFT JOIN t.vocabulary v LEFT JOIN t.parents c WHERE v.id = ?1 ";
        $query = $this->getEntityManager()->createQuery($dql)->setParameter( 1 , $vid);
        $result = $query->getResult(); 
        return $result;
    }


    public function get_term_nested(){
                //$dql = "SELECT t FROM \Taxonomy\Entity\Terms t LEFT JOIN t.categories v WHERE t.id = ?1 ORDER BY t.weight ASC, t.name ASC";
        //$dql = "SELECT t FROM \Taxonomy\Entity\Terms t JOIN t.vocabulary v JOIN t.childrens c WHERE t.vocabulary = ?1 ORDER BY t.weight ASC, t.name ASC";
        $dql = "SELECT t FROM \Kamran\TaxonomyBundle\Entity\Terms t LEFT JOIN t.vocabulary v LEFT JOIN t.parents c WHERE c.id = ?1 ";
        $query = $this->getEntityManager()->createQuery($dql)->setParameter( 1 , $vid);
        //$query = $this->getEntityManager()->createQuery($dql);
        return $query->getResult();

    }*/





    /*
    public function getRolesArray($number = 30)
    {
//        $dql = "SELECT b, e, r, p FROM \CsnCms\Entity\User b JOIN b.engineer e ".
//               "JOIN b.reporter r JOIN b.products p ORDER BY b.created DESC";
//        $query = $this->getEntityManager()->createQuery($dql);
//        $query->setMaxResults($number);
//        return $query->getArrayResult();
		return array();
    }

    public function getCommentForEdit($artcId)
    {
//        $dql = "SELECT b, e, r FROM \Application\Entity\Bug b JOIN b.engineer e JOIN b.reporter r ".
//               "WHERE b.status = 'OPEN' AND e.id = ?1 OR r.id = ?1 ORDER BY b.created DESC";
		$dql = "SELECT c, u, l, a FROM CsnCms\Entity\Comment c LEFT JOIN c.author u LEFT JOIN c.language l LEFT JOIN c.article a WHERE c.id = ?1"; 

        $comments = $this->getEntityManager()->createQuery($dql)
                             ->setParameter(1, $artcId)
//                             ->setMaxResults($number)
                             ->getResult();
							 // ->getScalarResult();
							 // ->getArrayResult();
		return $comments[0];
    }

	//  There are already findBy or findOneBy!
/*
    public function getRecentBugs($number = 30)
    {
        $dql = "SELECT b, e, r FROM \Application\Entity\Bug b JOIN b.engineer e JOIN b.reporter r ORDER BY b.created DESC";

        $query = $this->getEntityManager()->createQuery($dql);
        $query->setMaxResults($number);
        return $query->getResult();
    }

	//  findBy or findOneBy!
    public function findByRecentBugs($number = 30)
    {
        $dql = "SELECT b, e, r FROM \Application\Entity\Bug b JOIN b.engineer e JOIN b.reporter r ORDER BY b.created DESC";

        $query = $this->getEntityManager()->createQuery($dql);
        $query->setMaxResults($number);
        return $query->getResult();
    }
	
    public function getRecentBugsArray($number = 30)
    {
        $dql = "SELECT b, e, r, p FROM \Application\Entity\Bug b JOIN b.engineer e ".
               "JOIN b.reporter r JOIN b.products p ORDER BY b.created DESC";
        $query = $this->getEntityManager()->createQuery($dql);
        $query->setMaxResults($number);
        return $query->getArrayResult();
    }

    public function getUsersBugs($userId, $number = 15)
    {
        $dql = "SELECT b, e, r FROM \Application\Entity\Bug b JOIN b.engineer e JOIN b.reporter r ".
               "WHERE b.status = 'OPEN' AND e.id = ?1 OR r.id = ?1 ORDER BY b.created DESC";

        return $this->getEntityManager()->createQuery($dql)
                             ->setParameter(1, $userId)
                             ->setMaxResults($number)
                             ->getResult();
    }

    public function getOpenBugsByProduct()
    {
        $dql = "SELECT p.id, p.name, count(b.id) AS openBugs FROM \Application\Entity\Bug b ".
               "JOIN b.products p WHERE b.status = 'OPEN' GROUP BY p.id";
        return $this->getEntityManager()->createQuery($dql)->getScalarResult();
    }
*/
}

