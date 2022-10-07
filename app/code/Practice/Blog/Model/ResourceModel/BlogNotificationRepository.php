<?php

namespace Practice\Blog\Model\ResourceModel;

use Practice\Blog\Api\BlogNotificationRepositoryInterface;
use Practice\Blog\Api\Data\BlogNotificationInterface;
use Practice\Blog\Model\ResourceModel\BlogNotification\CollectionFactory as BlogNotificationCollectionFactory;
use Practice\Blog\Model\BlogNotificationFactory;
use Practice\Blog\Model\ResourceModel\BlogNotification as BlogNotificationResource;


class BlogNotificationRepository implements BlogNotificationRepositoryInterface
{
    protected $blogNotificationCollectionFactory;
    protected $blogNotificationFactory;
    protected $blogNotificationResource;

    public function __construct(
        BlogNotificationCollectionFactory $blogNotificationCollectionFactory,
        BlogNotificationFactory $blogNotificationFactory,
        BlogNotificationResource $blogNotificationResource

    ) {
        $this->blogNotificationFactory = $blogNotificationFactory;
        $this->blogNotificationCollectionFactory = $blogNotificationCollectionFactory;
        $this->blogNotificationResource = $blogNotificationResource;
    }

    public function save(BlogNotificationInterface $blogNotificationInterface)
    {
        $blogNotification = $this->blogNotificationFactory->create();


        $blogNotification->setTitle($blogNotificationInterface->getTitle());
        $blogNotification->setDescription($blogNotificationInterface->getDescription());
        $blogNotification->setIsRead($blogNotificationInterface->getIsRead());
        $blogNotification->setCreatedAt($blogNotificationInterface->getCreatedAt());
        $blogNotification->setCommentId($blogNotificationInterface->getCommentId());

        $this->blogNotificationResource->save($blogNotification);

        $blogNotificationInterface->setBlogNotificationId($blogNotification->getBlogNotificationId());
    }

    public function update(BlogNotificationInterface $blogNotificationInterface, $blog)
    {

        // $blog->setTitle($blogInterface->getTitle());
        // $blog->setContent($blogInterface->getContent());
        // $blog->setBlogAvatarLink($blogInterface->getBlogAvatarLink());
        // $blog->setUserId($blogInterface->getUserId());

        // $this->blogResource->save($blog);
    }


    public function getList($customerId)
    {
        $collection = $this->blogNotificationCollectionFactory->create();
        $collection
            ->getSelect()
            ->joinLeft(
                ['comment_table' => $collection->getTable('comment_entity')],
                'comment_table.comment_entity_id = main_table.comment_id',
                ['*']
            )
            ->joinLeft(
                ['customer_table' => $collection->getTable('customer_entity')],
                'customer_table.entity_id = comment_table.customer_id',
                ['']
            )
            ->where('customer_table.entity_id = ' . $customerId);

         return $collection;
    }
}
