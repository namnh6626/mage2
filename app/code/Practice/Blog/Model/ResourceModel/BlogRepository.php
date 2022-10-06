<?php

namespace Practice\Blog\Model\ResourceModel;

use Magento\Framework\Api\SearchCriteria;
use Magento\Framework\Api\SearchCriteriaBuilder;
use Magento\Framework\Api\SearchCriteriaInterface;
use Magento\Framework\Exception\NoSuchEntityException;
use Practice\Blog\Api\BlogRepositoryInterface;
use Practice\Blog\Api\Data\BlogInterface;
use Practice\Blog\Model\BlogFactory;
use Practice\Blog\Model\Blog;

use Practice\Blog\Model\ResourceModel\Blog as BlogResource;
use Practice\Blog\Model\ResourceModel\Blog\CollectionFactory as BlogCollectionFactory;
use Practice\Blog\Model\ResourceModel\BlogCategory\CollectionFactory as BlogCategoryCollectionFactory;
use Practice\Blog\Model\ResourceModel\Comment\CollectionFactory as CommentCollectionFactory;
use Practice\Blog\Constant\Constant;
use Magento\Framework\Api\Search\SearchResultFactory;
use Magento\Framework\Api\SearchCriteria\CollectionProcessor;

class BlogRepository implements BlogRepositoryInterface
{
    protected $blogFactory;
    protected $blogResource;
    protected $blogCollectionFactory;
    protected $filterBuilder;
    protected $blogRepositoryInterface;
    protected $searchCriteriaBuilder;
    protected $blogCategoryCollectionFactory;
    protected $commentCollectionFactory;
    protected $searchResultsFactory;
    protected $collectionProcessor;
    protected $blog;


    public function __construct(
        BlogFactory $blogFactory,
        BlogCollectionFactory $blogCollectionFactory,
        BlogResource $blogResource,
        BlogCategoryCollectionFactory $blogCategoryCollectionFactory,
        CommentCollectionFactory $commentCollectionFactory,
        SearchCriteriaBuilder $searchCriteriaBuilder,
        SearchResultFactory $searchResultsFactory,
        CollectionProcessor $collectionProcessor,
        Blog $blog

    ) {
        $this->blogFactory = $blogFactory;
        $this->blogResource = $blogResource;
        $this->blogCollectionFactory = $blogCollectionFactory;
        $this->blogCategoryCollectionFactory = $blogCategoryCollectionFactory;
        $this->commentCollectionFactory = $commentCollectionFactory;
        $this->searchCriteriaBuilder = $searchCriteriaBuilder;
        $this->searchResultsFactory = $searchResultsFactory;
        $this->collectionProcessor = $collectionProcessor;
        $this->blog = $blog;
    }

    public function save(BlogInterface $blogInterface)
    {
        $blog = $this->blogFactory->create();

        $blog->setTitle($blogInterface->getTitle());
        $blog->setContent($blogInterface->getContent());
        $blog->setBlogAvatarLink($blogInterface->getBlogAvatarLink());
        $blog->setUserId($blogInterface->getUserId());

        $this->blogResource->save($blog);

        $blogInterface->setBlogEntityId($blog->getBlogEntityId());
    }

    public function update(BlogInterface $blogInterface, $blog){

        $blog->setTitle($blogInterface->getTitle());
        $blog->setContent($blogInterface->getContent());
        $blog->setBlogAvatarLink($blogInterface->getBlogAvatarLink());
        $blog->setUserId($blogInterface->getUserId());

        $this->blogResource->save($blog);

    }

    public function getById($blogId)
    {
        $blog = $this->blogFactory->create();
        $this->blogResource->load($blog, $blogId);
        return $blog;
    }

    public function getList(SearchCriteriaInterface $searchCriteria)
    {

        // $searchResult = $this->searchResultsFactory->create();
        // $this->collectionProcessor->process($searchCriteria, $collection);
        // $searchResult->setItems($collection->getItems());
        // $searchResult->setTotalCount($collection->getSize());

        // var_dump(($collection->getData()));

        // die();
        $collection = $this->blogCollectionFactory->create();
        return $collection;
    }

    public function getBlogContentById($blogId)
    {
        $collection = $this->blogCollectionFactory->create();
        $collection->getSelect()->joinLeft(['user_table' => $collection->getTable('admin_user')], 'user_table.user_id = main_table.user_id', ['*'])
            ->where('main_table.blog_entity_id = ' . $blogId);
        return $collection;
    }

    public function getBlogCategories($blogId)
    {
        $collection = $this->blogCategoryCollectionFactory->create();
        $collection
            ->getSelect()
            ->joinLeft(
                ['category_value_table' => $collection->getTable('blog_category_value')],
                'category_value_table.blog_category_id = main_table.blog_category_id'
            )
            ->joinLeft(
                ['blog_table' => $collection->getTable('blog_entity')],
                'blog_table.blog_entity_id = category_value_table.blog_entity_id',
                ['']
            )
            ->where('blog_table.blog_entity_id = ' . $blogId);
        return $collection;
    }

    public function getBlogComments($blogId, $customerId)
    {
        $collection = $this->commentCollectionFactory->create();

        $collection->getSelect()
            ->joinLeft(
                ['blog_table' => $collection->getTable('blog_entity')],
                'blog_table.blog_entity_id = main_table.blog_entity_id',
                ['']
            )
            ->joinLeft(
                ['cmt_status_table' => $collection->getTable('comment_status')],
                'cmt_status_table.comment_status_id = main_table.comment_status_id',
                ['cmt_status_table.comment_status_name']
            )
            ->joinLeft(
                ['customer_table' => $collection->getTable('customer_entity')],
                'main_table.customer_id = customer_table.entity_id',
                ['email', 'firstname', 'middlename', 'lastname']
            )
            ->where('main_table.blog_entity_id = ' . $blogId)
            ->where('main_table.comment_status_id = ' . Constant::APPROVED_STATUS_ID)

            ->orWhere('main_table.customer_id = ' . $customerId)
            ->where('main_table.blog_entity_id = ' . $blogId)

            ->order('created_at DESC');
        // echo $collection->getSelect();
        // die();

        return $collection;
    }
}
