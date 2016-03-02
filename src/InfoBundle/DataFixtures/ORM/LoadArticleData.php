<?php

namespace InfoBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use InfoBundle\Entity\Article;

class LoadArticleData implements FixtureInterface
{
    public function load(ObjectManager $manager) {
        
        $article = new Article();
        $article->setTitle('Api Suite of test');
        $article->setBody('My second test of creating Api');
        $article->setDescription('App Restfull');
        $article->setSlug('restfull');
        $article->setCreatedAt(new \DateTime());
        $article->setCreatedBy('Keni');
        
        $article1 = new Article();
        $article1->setTitle('Mon test d\'Api');
        $article1->setBody('Je fais des test de création d\'Api');
        $article1->setDescription('Création Api');
        $article1->setSlug('Api rest');
        $article1->setCreatedAt(new \DateTime());
        $article1->setCreatedBy('Franck');
        
        $manager->persist($article);
        $manager->persist($article1);
        
        $manager->flush();
    }

}
