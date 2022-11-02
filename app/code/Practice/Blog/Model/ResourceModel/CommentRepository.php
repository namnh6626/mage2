<?php

namespace Practice\Blog\Model\ResourceModel;

use Practice\Blog\Api\CommentRepositoryInterface;
use Practice\Blog\Api\Data\CommentInterface;
use Practice\Blog\Model\CommentFactory;
use Practice\Blog\Model\ResourceModel\Comment as CommentResource;
use Practice\Blog\Model\ResourceModel\Comment\CollectionFactory as CommentCollectionFactory;
use Magento\Framework\Api\ExtensionAttribute\JoinDataInterfaceFactory;
use Practice\Blog\Constant\Constant;

class CommentRepository implements CommentRepositoryInterface
{

    protected $commentFactory;
    protected $commentResource;
    protected $commentCollectionFactory;

    public function __construct(
        CommentFactory $commentFactory,
        CommentResource $commentResource,
        CommentCollectionFactory $commentCollectionFactory
    ) {
        $this->commentFactory = $commentFactory;
        $this->commentResource = $commentResource;
        $this->commentCollectionFactory = $commentCollectionFactory;
    }

    public function save(CommentInterface $commentInterface)
    {
    }

    public function getList(CommentInterface $commentInterface)
    {
        $commentCollection = $this->commentFactory->create();
        return $commentCollection;
    }

    public function getCommentsByBlogId($blogId, $customerId)
    {
        $collection = $this->commentCollectionFactory->create();
        $collection
            ->getSelect()
            ->joinLeft(
                ['blog_table' => $collection->getTable('blog_entity')],
                'blog_table.blog_entity_id = main_table.blog_entity_id',
                ['']
            )
            ->joinLeft(
                ['customer_table' => $collection->getTable('customer_entity')],
                'customer_table.entity_id = main_table.customer_id',
                ['firstname', 'middlename', 'lastname', 'email']
            )
            ->where('main_table.blog_entity_id = ' . $blogId)
            ->where('main_table.comment_status_id = ' . Constant::APPROVED_STATUS_ID)
            ->orWhere('main_table.customer_id = ' . $customerId)
            ->where('main_table.blog_entity_id = ' . $blogId)
            ->order('main_table.created_at DESC');

        return $collection;
    }


    public function getBlogIdsCommented($customerId, $currentBlogId)
    {
        $collection = $this->commentCollectionFactory->create();

        $collection
            ->addFieldToSelect(['blog_entity_id'])
            ->getSelect()
            ->where('main_table.customer_id = ' . $customerId)
            ->order('main_table.created_at DESC');

        return $collection;
    }


}
