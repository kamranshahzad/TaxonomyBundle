<?php

namespace Kamran\TaxonomyBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections;


/**
 * Kamran\TaxonomyBundle\Entity\VocabularyTerms
 *
 * @ORM\Table(name="vocabulary_terms")
 * @ORM\Entity(repositoryClass="Kamran\TaxonomyBundle\Entity\Repository\VocabularyTermsRepository")
 */
class VocabularyTerms
{
    /**
     * @var integer $id
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string $name
     *
     * @ORM\Column(name="name", type="string", length=100)
     */
    private $name;

    /**
     * @var string $description
     *
     * @ORM\Column(name="description", type="text")
     */
    private $description;

    /**
     * @var integer
     */
    private $weight;

    /**
     * @var \Kamran\TaxonomyBundle\Entity\Vocabulary
     *
     * @ORM\ManyToOne(targetEntity="Vocabulary")
     * @ORM\JoinColumn(name="vid", referencedColumnName="id")
     */
    private $vid;

    /**
     * @var \Kamran\TaxonomyBundle\Entity\VocabularyTerms
     *
     * @ORM\ManyToMany(targetEntity="VocabularyTerms" )
     * @ORM\JoinTable(name="vocabulary_term_tree",
     *      joinColumns={@ORM\JoinColumn(name="tid", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="parent", referencedColumnName="id")}
     *      )
     */
    protected $parents;

    public function __construct()
    {
        $this->parents = new ArrayCollection();
    }

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return VocabularyTerms
     */
    public function setName($name)
    {
        $this->name = $name;
    
        return $this;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set description
     *
     * @param string $description
     * @return VocabularyTerms
     */
    public function setDescription($description)
    {
        $this->description = $description;
    
        return $this;
    }

    /**
     * Get description
     *
     * @return string 
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set weight
     *
     * @param integer $weight
     * @return VocabularyTerms
     */
    public function setWeight($weight)
    {
        $this->weight = $weight;
    
        return $this;
    }

    /**
     * Get weight
     *
     * @return integer 
     */
    public function getWeight()
    {
        return $this->weight;
    }

    /**
     * Set vid
     *
     * @param \Kamran\TaxonomyBundle\Entity\Vocabulary $vid
     * @return VocabularyTerms
     */
    public function setVid(\Kamran\TaxonomyBundle\Entity\Vocabulary $vid = null)
    {
        $this->vid = $vid;
    
        return $this;
    }

    /**
     * Get vid
     *
     * @return \Kamran\TaxonomyBundle\Entity\Vocabulary 
     */
    public function getVid()
    {
        return $this->vid;
    }



    /**
     * Add Parents
     *
     * @param \Kamran\TaxonomyBundle\Entity\VocabularyTerms $terms
     */
    public function addParents(\Kamran\TaxonomyBundle\Entity\VocabularyTerms $terms)
    {
        $this->parents[] = $terms;
    }

    /**
     * Get tags
     *
     * @return Doctrine\Common\Collections\Collection
     */
    public function getParents()
    {
        return $this->parents;
    }


    public function __toString()
    {
        return $this->name;
    }

}
