<?php

namespace Practice\Blog\Block;

use Magento\Framework\View\Element\Template;
use Magento\Framework\View\Element\Template\Context;
use Practice\Blog\Model\ResourceModel\Blog\CollectionFactory;
use Practice\Blog\Constant\Constant;

class AllBlog extends Template
{
    protected $blogs;
    protected $constant;
    protected $pageSize;


    public function __construct(Context $context, CollectionFactory $blogs, array $data = [], Constant $constant)
    {
        $this->blogs = $blogs;
        $this->constant = $constant;
        $this->pageSize = $constant::PAGE_SIZE;
        parent::__construct($context, $data);
    }


   public function getBlogPaginate()
    {
        $currentPage = $this->getRequest()->getParam($this->constant::PAGE_PARAM);
        if ($currentPage == null) {
            $currentPage = 1;
        }
        $collection = $this->blogs->create();

        $collectionPaginate = $collection->setPageSize($this->pageSize)->setCurPage($currentPage);
        $result = $collectionPaginate->join('blog_attribute_value','blog_entity.blog_entity_id=blog_attribute_value.blog_entity_id', '*');
        return $result;
    }

    public function getCurrentPage()
    {
        $currentPage = $this->getRequest()->getParam($this->constant::PAGE_PARAM);
        if ($currentPage == null) {
            $currentPage = 1;
        }
        return $currentPage;
    }

    public function getPageParam()
    {
        return $this->constant::PAGE_PARAM;
    }

    public function getBlogIdParam()
    {
        return $this->constant::ID_PARAM;
    }

    public function getTotalPage(){
        $countBlogs = $this->blogs->create()->count();
        return ceil($countBlogs/$this->pageSize);
    }
}
