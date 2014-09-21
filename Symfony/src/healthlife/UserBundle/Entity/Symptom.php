<?php

/*
 * This file is part of the FOSUserBundle package.
 *
 * (c) FriendsOfSymfony <http://friendsofsymfony.github.com/>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace healthlife\UserBundle\Entity;
// src/Acme/StoreBundle/Entity/Product.php
//namespace Acme\StoreBundle\Entity;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
* @ORM\Entity
* @ORM\Table(name="symptom")
*/
class Symptom
{
    /**
     * @ORM\OneToMany(targetEntity="HealthCondition", mappedBy="symptom")
     * //@ORM\ManyToOne(targetEntity="Condition", inversedBy="symptom")
     */
    protected $healthcondition;
    public function __construct()
    {
        $this->healthcondition = new ArrayCollection();
    }
    
    /**
    * @ORM\Column(type="integer")
    * @ORM\Id
    * @ORM\GeneratedValue(strategy="AUTO")
    */
    protected $id;
    /**
    * @ORM\Column(type="string", length=100)
    */
    protected $name;
    
    public function __toString()
    {
        return $this->name;
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
     * @return Symptom
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
     * Add healthcondition
     *
     * @param \healthlife\UserBundle\Entity\HealthCondition $healthcondition
     * @return Symptom
     */
    public function addHealthcondition(\healthlife\UserBundle\Entity\HealthCondition $healthcondition)
    {
        $this->healthcondition[] = $healthcondition;

        return $this;
    }

    /**
     * Remove healthcondition
     *
     * @param \healthlife\UserBundle\Entity\HealthCondition $healthcondition
     */
    public function removeHealthcondition(\healthlife\UserBundle\Entity\HealthCondition $healthcondition)
    {
        $this->healthcondition->removeElement($healthcondition);
    }

    /**
     * Get healthcondition
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getHealthcondition()
    {
        return $this->healthcondition;
    }
}
