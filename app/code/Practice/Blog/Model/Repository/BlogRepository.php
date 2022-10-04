<?php

namespace Practice\Blog\Model\Repository;

use Magento\Customer\Api\Data\CustomerInterface;
use Magento\Framework\Exception\NoSuchEntityException;
use Practice\Blog\Api\BlogRepositoryInterface;
use Practice\Blog\Api\Data\BlogInterface;
use Practice\Blog\Model\BlogFactory;
use Practice\Blog\Model\ResourceModel\Blog as BlogResource;
use Practice\Blog\Model\ResourceModel\Blog\CollectionFactory as BlogCollectionFactory;
use Magento\Framework\Api\SearchCriteriaBuilder;
use Magento\Framework\Api\ExtensionAttribute\JoinProcessorInterface;
use Magento\Framework\Api\ExtensionAttribute\JoinDataInterfaceFactory;
use Magento\Framework\Api\FilterBuilder;
use Magento\Framework\Api\SearchCriteria\CollectionProcessor\JoinProcessor\CustomJoinInterface;
use Magento\Framework\Data\Collection\AbstractDb;
use Practice\Blog\Api\Data\CommentInterface;

class BlogRepository implements BlogRepositoryInterface, CustomJoinInterface
{
    protected $blogFactory;
    protected $blogResource;
    protected $blogCollectionFactory;
    protected $searchCriteriaBuilder;
    protected $joinDataFactory;
    protected $joinProcessor;
    protected $filterBuilder;


    public function __construct(
        BlogFactory $blogFactory,
        BlogCollectionFactory $blogCollectionFactory,
        BlogResource $blogResource,
        SearchCriteriaBuilder $searchCriteriaBuilder,
        JoinDataInterfaceFactory $joinDataFactory,
        JoinProcessorInterface $joinProcessor,
        FilterBuilder $filterBuilder
    ) {
        $this->blogFactory = $blogFactory;
        $this->blogResource = $blogResource;
        $this->blogCollectionFactory = $blogCollectionFactory;
        $this->searchCriteriaBuilder = $searchCriteriaBuilder;
        $this->joinDataFactory = $joinDataFactory;
        $this->joinProcessor = $joinProcessor;
        $this->filterBuilder = $filterBuilder;
    }

    public function apply(AbstractDb $collection)
    {
        $joinData = $this->joinDataFactory->create();
        $joinData->setJoinField(BlogInterface::BLOG_ENTITY_ID)
            ->setReferenceTable('customer_entity')
            ->setReferenceField(CustomerInterface::ID)
            // ->setReferenceTableAlias('transaction')
            ->setSelectFields([]);
        $collection->joinExtensionAttribute($joinData, $this->joinProcessor);

    }

    public function save(BlogInterface $blogInterface)
    {
        $this->blogResource->save($blogInterface);
    }

    public function getList(BlogInterface $blogInterface)
    {
        // $blogCollection = $this->blogCollectionFactory->create();
        // return $blogCollection;


    }

    public function getBlogContentById($blogId){
        $blog = $this->blogFactory->create();
        $blog->
        $this->blogResource->load($blog, $blogId);
        if (!$blog->getBlogEntityId()) {
            throw new NoSuchEntityException(__('Unable to find blog with ID "%1"', $blogId));
        }
        return $blog;
    }

    public function getBlogCategory($blogId){
        $blog = $this->blogFactory->create();

    }


}
