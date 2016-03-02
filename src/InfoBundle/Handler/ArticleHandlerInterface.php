<?php

namespace InfoBundle\Handler;

interface ArticleHandlerInterface 
{
    /**
     * Get an Article given the identifier
     *
     * @api
     *
     * @param mixed $id
     *
     * @return ArticleInterface
     */
    public function get($id);
    
    /**
     * Get a list of Articles.
     *
     * @param int $limit  the limit of the result
     * @param int $offset starting from the offset
     *
     * @return array
     */
    public function all($limit = 5, $offset = 0);
    
    
    /**
     * Post Article, creates a new Article.
     *
     * @api
     *
     * @param array $parameters
     *
     * @return ArticleInterface
     */
    public function post(array $parameters);
    
    /**
     * Delete an Article.
     *
     * @param ArticleInterface $article
     *
     * 
     */
    public function delete($article);
    
}
