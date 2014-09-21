<?php

// src/Acme/HelloBundle/DataFixtures/ORM/LoadUserData.php

namespace healthlife\UserBunle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use healthlife\UserBundle\Entity\HealthCondition;

class LoadHealthConditionData implements FixtureInterface
{
    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        $condition1 = new HealthCondition();
        $condition1->setName('Asthma'); 
        $condition1->setSymptomId(1);
        $manager->persist($condition1);
        ############
        $condition2 = new HealthCondition();
        $condition2->setName('Asthma');
        $condition2->setSymptomId(2);     
        $manager->persist($condition2);
        ############
        $condition3 = new HealthCondition();
        $condition3->setName('Diabetes');
        $condition3->setSymptomId(3);     
        $manager->persist($condition3);
        ############
        $condition4 = new HealthCondition();
        $condition4->setName('Diabetes');
        $condition4->setSymptomId(4);     
        $manager->persist($condition4);

        
        $manager->flush();
    }
}
?>