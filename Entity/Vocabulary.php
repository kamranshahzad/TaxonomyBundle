<?php

namespace Kamran\TaxonomyBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="vocabulary")
 */
class Vocabulary
{

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @ORM\Column(type="text", name="name")
     */
    private $name;

    /**
     * @ORM\Column(type="text", name="machine_name")
    */
    private $machineName;

    /**
     * @ORM\Column(type="text", name="description")
     */
    private $description;

    /**
     * @ORM\Column(type="integer", name="weight")
    */
    private $weight;


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
     * @return Vocabulary
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
     * Set machineName
     *
     * @param string $machineName
     * @return Vocabulary
     */
    public function setMachineName($machineName)
    {
        $this->machineName = $machineName;
    
        return $this;
    }

    /**
     * Get machineName
     *
     * @return string 
     */
    public function getMachineName()
    {
        return $this->machineName;
    }

    /**
     * Set description
     *
     * @param string $description
     * @return Vocabulary
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
     * Set hierarchy
     *
     * @param boolean $hierarchy
     * @return Vocabulary
     */
    public function setHierarchy($hierarchy)
    {
        $this->hierarchy = $hierarchy;
    
        return $this;
    }

    /**
     * Get hierarchy
     *
     * @return boolean 
     */
    public function getHierarchy()
    {
        return $this->hierarchy;
    }

    /**
     * Set weight
     *
     * @param integer $weight
     * @return Vocabulary
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
}
