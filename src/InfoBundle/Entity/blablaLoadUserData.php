<?php

namespace AppBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use AppBundle\Entity\User;

class LoadUserData implements FixtureInterface
{
    public function load(ObjectManager $manager) {
        
        $user = new User();
        $user->setUsername("franck");
        $user->setPassword("franck");
        $user->setEmail("franck@hotmail.fr");
        
        $user1 = new User();
        $user1->setUsername("keni");
        $user1->setPassword("keni");
        $user1->setEmail("keni@gmail.fr");
        
        $manager->persist($user);
        $manager->persist($user1);
        
        $manager->flush();
    }

}
