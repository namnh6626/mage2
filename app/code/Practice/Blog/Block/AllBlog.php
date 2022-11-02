<?php

namespace Practice\Blog\Block;

use Magento\Framework\Api\SearchCriteriaInterface;
use Magento\Framework\View\Element\Template;
use Magento\Framework\View\Element\Template\Context;
use Practice\Blog\Api\Data\BlogInterface;
use Practice\Blog\Model\ResourceModel\Blog\CollectionFactory;
use Practice\Blog\Constant\Constant;
use Practice\Blog\Model\ResourceModel\BlogRepository;
use Magento\Framework\Api\SearchCriteriaBuilder;

class AllBlog extends Template
{
    protected $blogs;
    protected $constant;
    protected $pageSize;
    protected $blogRepository;
    protected $blogInterface;
    protected $searchCriteriaInterface;
    protected $searchCriteriaBuilder;

    public function __construct(
        Context $context,
        CollectionFactory $blogs,
        array $data = [],
        Constant $constant,
        BlogRepository $blogRepository,
        BlogInterface $blogInterface,
        SearchCriteriaInterface $searchCriteriaInterface,
        SearchCriteriaBuilder $searchCriteriaBuilder
    ) {
        $this->blogs = $blogs;
        $this->constant = $constant;
        $this->pageSize = $constant::PAGE_SIZE;
        $this->blogRepository = $blogRepository;
        $this->blogInterface = $blogInterface;
        $this->searchCriteriaInterface = $searchCriteriaInterface;
        $this->searchCriteriaBuilder = $searchCriteriaBuilder;

        parent::__construct($context, $data);
    }

    public function getBlogPaginate()
    {
        $currentPage = $this->getRequest()->getParam($this->constant::PAGE_PARAM);
        if ($currentPage == null) {
            $currentPage = 1;
        }

        // $collection = $this->blogs->create();

        // $collectionPaginate = $collection->setPageSize($this->pageSize)->setCurPage($currentPage);

        // return $collectionPaginate;
        // $searchCriteria = $this->searchCriteriaBuilder->create();


        $collection = $this->blogRepository->getList($this->blogInterface);
        $collectionPaginate = $collection->setPageSize($this->pageSize)->setCurPage($currentPage);


        var_dump($collectionPaginate->getData());
        die();
        // return $collectionPaginate;
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

    public function getTotalPage()
    {
        $countBlogs = $this->blogs->create()->count();
        return ceil($countBlogs / $this->pageSize);
    }
}
