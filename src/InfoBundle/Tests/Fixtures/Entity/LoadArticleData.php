<?php

namespace InfoBundle\Fixtures\Entity;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use InfoBundle\Entity\Article;

class LoadArticleData implements FixtureInterface
{
    public function load(ObjectManager $manager) {
        /*
        $article = new Article();
        
        $article1 = new Article();
        
        $manager->persist($article);
        $manager->persist($article1);
        */
        $manager->flush();
    }

}
