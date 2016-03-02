<?php

namespace InfoBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

use InfoBundle\Form\ArticleType;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Request\ParamFetcherInterface;
use FOS\RestBundle\Controller\Annotations;
use FOS\RestBundle\View\View;
use FOS\RestBundle\Util\Codes;

use InfoBundle\Exception\InvalidFormException;

class ArticleController extends FOSRestController
{
    /**
     * @Annotations\QueryParam(name="offset", requirements="\d+", nullable=true, description="Le nom de l auteur")
     * @Annotations\QueryParam(name="limit", requirements="\d+", default="5", description="Le nombre d'article à retourner")
     * 
     *
     *
     *
     * @param Request               $request      the request object
     * @param ParamFetcherInterface $paramFetcher param fetcher service
     *
     * @return array
     */
    public function getArticlesAction(Request $request, ParamFetcherInterface $paramFetcher)
    {
        $offset = $paramFetcher->get('offset');
        $offset = null == $offset ? 0 : $offset;
        
        $limit = $paramFetcher->get('limit');
        
        return $this->get('info.article.handler')->all($limit, $offset);
   
    }
    
    /**
     * @Annotations\QueryParam(name="createdBy", description="Le nom de l auteur")
     * @Annotations\QueryParam(name="slug", description="Un slug indicatif")
     */
    public function getArticlesFiltreAction(ParamFetcherInterface $ParamFetcher)
    {
        $em = $this->getDoctrine()->getManager();
        
        //$createdBy = $ParamFetcher->get('createdBy');
        //$slug = $ParamFetcher->get('slug');
        
        foreach ($ParamFetcher->all() as $k => $v)
        {
            if(null !== $v)
            {
                return array(
                    "entities" => $em->getRepository('InfoBundle:Article')->findBy(array($k => $v))
                );
            }
        }


    }
    
    /**
     * 
     * @Annotations\View(templateVar="article")
     *
     * @param int     $id      the article id
     *
     * @return array
     *
     * @throws NotFoundHttpException when article not exist
     */
    public function getArticleAction($id)
    {
        return $this->getOr404($id);
    }
    
    
    /*     
     *
     * @Annotations\View(
     *  templateVar = "form"
     * )
     *
     * @return FormTypeInterface
     */
    public function newArticleAction()
    {
        return $this->createForm(ArticleType::class);
    }
    
    /*
     * @Annotations\View(
     *  template = "InfoBundle:Article:newPage.html.twig",
     *  statusCode = Codes::HTTP_BAD_REQUEST,
     *  templateVar = "form"
     * )
     *
     * @param Request $request the request object
     *
     * @return FormTypeInterface|View
     */
    public function postArticleAction(Request $request)
    {
        try {
            $newArticle = $this->get('info.article.handler')->post(
                $request->request->all()
            );
            $routeOptions = array(
                'id' => $newArticle->getId(),
                '_format' => $request->get('_format')
            );
            return $this->routeRedirectView('api_1_get_article', $routeOptions, Codes::HTTP_CREATED);
        } catch (InvalidFormException $exception) {
            return $exception->getForm();
        }
    }
    
    
    /**
     * 
     */
    public function putArticleAction()
    {
        
    }
    
    /**
     * Delete an article
     * @var integer $id Id of the entity
     * @return View
     */
    public function deleteArticleAction($id)
    {
        //$this->get('info.article.handler')->delete($id);
        
        $article = $this->getOr404($id);
        $this->get('info.article.handler')->delete($article);
        
        return $this->view(null, Codes::HTTP_NO_CONTENT);
    }
    
    /**
     * Fetch an Article or throw an 404 Exception.
     *
     * @param mixed $id
     *
     * @return ArticleInterface
     *
     * @throws NotFoundHttpException
     */
    protected function getOr404($id)
    {
        if (!($article = $this->get('info.article.handler')->get($id))) 
        {
            throw new NotFoundHttpException(sprintf('The resource \'%s\' was not found.',$id));
        }
        return $article;
    }
}
