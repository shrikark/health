<?php

// src/Acme/HelloBundle/DataFixtures/ORM/LoadUserData.php

namespace healthlife\UserBunle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use healthlife\UserBundle\Entity\Symptom;

class LoadSymptomData implements FixtureInterface
{
    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        $symptom1 = new Symptom();
        $symptom1->setName('coughing');  
        $manager->persist($symptom1);
        ############
        $symptom2 = new Symptom();
        $symptom2->setName('shortness of breath');     
        $manager->persist($symptom2);
        ############
        $symptom3 = new Symptom();
        $symptom3->setName('tiredness');
        $manager->persist($symptom3);
        ##############
        $symptom4 = new Symptom();
        $symptom4->setName('weight loss');
        $manager->persist($symptom4);
        
        $manager->flush();
    }
}
?>