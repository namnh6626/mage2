<?php

namespace Practice\Blog\Model\Repository;

use Practice\Blog\Api\BlogCategoryRepositoryInterface;
use Practice\Blog\Api\Data\BlogCategoryInterface;
use Practice\Blog\Model\BlogCategoryFactory;
use Practice\Blog\Model\ResourceModel\BlogCategory;
use Practice\Blog\Model\ResourceModel\BlogCategory\CollectionFactory as BlogCategoryCollectionFactory;

class BlogCategoryRepository implements BlogCategoryRepositoryInterface
{
    protected $blogCategoryFactory;
    protected $blogCategoryResource;
    protected $blogCategoryCollectionFactory;

    public function __construct(
        BlogCategoryFactory $blogCategoryFactory,
        BlogCategory $blogCategoryResource,
        BlogCategoryCollectionFactory $blogCategoryCollectionFactory
    ) {
        $this->blogCategoryFactory = $blogCategoryFactory;
        $this->blogCategoryResource = $blogCategoryResource;
        $this->blogCategoryCollectionFactory = $blogCategoryCollectionFactory;
    }

    public function save(BlogCategoryInterface $blogCategoryInterface)
    {
    }

    public function getList(BlogCategoryInterface $blogCategoryInterface)
    {
        $blogCategory = $this->blogCategoryCollectionFactory->create();
        return $blogCategory;
    }
}
