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
/**
* @ORM\Entity
* @ORM\Table(name="health_condition")
*/
class HealthCondition
{
    
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
    
    /**
    * 
    * //@ORM\Column(type="integer")
    * //@ORM\OneToMany(targetEntity="Symptom", mappedBy="condition")
    * @ORM\ManyToOne(targetEntity="Symptom", inversedBy="healthconditions")
    * @ORM\JoinColumn(name="symptomId", referencedColumnName="id")
    * 
    */
    protected $symptom;


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
     * @return Condition
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
     * Set symptomId
     *
     * @param integer $symptomId
     * @return Condition
     */
    public function setSymptomId($symptomId)
    {
        $this->symptomId = $symptomId;

        return $this;
    }

    /**
     * Get symptomId
     *
     * @return integer 
     */
    public function getSymptomId()
    {
        return $this->symptomId;
    }

    /**
     * Set symptom
     *
     * @param integer $symptom
     * @return Condition
     */
    public function setSymptom($symptom)
    {
        $this->symptom = $symptom;

        return $this;
    }

    /**
     * Get symptom
     *
     * @return integer 
     */
    public function getSymptom()
    {
        return $this->symptom;
    }
    public function __toString()
{
    return $this->symptom;
}
}
