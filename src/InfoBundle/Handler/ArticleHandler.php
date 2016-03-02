<?php

namespace InfoBundle\Handler;

use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Form\FormFactoryInterface;
use InfoBundle\Model\ArticleInterface;
use InfoBundle\Form\ArticleType;

use InfoBundle\Exception\InvalidFormException;

class ArticleHandler implements ArticleHandlerInterface
{
    private $om;
    private $entityClass;
    private $repository;
    private $formFactory;
    
    public function __construct(ObjectManager $om, $entityClass, FormFactoryInterface $formFactory) 
    {
        $this->om = $om;
        $this->entityClass = $entityClass;
        $this->repository = $this->om->getRepository($this->entityClass);
        $this->formFactory = $formFactory;
    }

    public function all($limit = 5, $offset = 0) 
    {
        return $this->repository->findBy(array(), null, $limit, $offset);
    }

    public function get($id) 
    {
        return $this->repository->find($id);
    }
    

    /**
     * Create a new Article.
     *
     * @param array $parameters
     *
     * @return ArticleInterface
     */
    public function post(array $parameters)
    {
        $article = $this->createArticle();
        return $this->processForm($article, $parameters, 'POST');
    }
    
    
    /**
     * Delete an Article.
     *
     * @param ArticleInterface $article
     *
     * 
     */
    public function delete($article)
    {   
        $this->om->remove($article);
        $this->om->flush();
    }
    
    
    /**
     * Processes the form.
     *
     * @param ArticleInterface $article
     * @param array         $parameters
     * @param String        $method
     *
     * @return ArticleInterface
     *
     * @throws InfoBundle\Exception\InvalidFormException
     */
    private function processForm(ArticleInterface $article, array $parameters, $method = "PUT")
    {
        $form = $this->formFactory->create(ArticleType::class, $article, array('method' => $method));
        
        $form->submit($parameters, 'PATCH' !== $method);
        
        if ($form->isValid()) { 
            $article = $form->getData();
            $this->om->persist($article);
            $this->om->flush($article);
            return $article;
        }
        throw new InvalidFormException('Invalid submitted data', $form);
    }
    
    private function createArticle()
    {
        return new $this->entityClass();
    }

}
