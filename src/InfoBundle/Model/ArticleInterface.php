<?php

namespace InfoBundle\Model;

interface ArticleInterface 
{
    
    /**
     * Get id
     *
     * @return int
     */
    public function getId();

    /**
     * Set title
     *
     * @param string $title
     *
     * @return Article
     */
    public function setTitle($title);

    /**
     * Get title
     *
     * @return string
     */
    public function getTitle();

    /**
     * Set description
     *
     * @param string $description
     *
     * @return Article
     */
    public function setDescription($description);

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription();

    /**
     * Set body
     *
     * @param string $body
     *
     * @return Article
     */
    public function setBody($body);

    /**
     * Get body
     *
     * @return string
     */
    public function getBody();

    /**
     * Get createdAt
     *
     * @return \DateTime
     */
    public function getCreatedAt();

    /**
     * Get slug
     *
     * @return string
     */
    public function getSlug();

    /**
     * Set createdBy
     *
     * @param string $createdBy
     *
     * @return Article
     */
    public function setCreatedBy($createdBy);

    /**
     * Get createdBy
     *
     * @return string
     */
    public function getCreatedBy();
    
    /**
     * Get updateAt
     *
     * @return \DateTime
     */
    public function getUpdatedAt();
}
