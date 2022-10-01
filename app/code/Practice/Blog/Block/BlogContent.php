<?php

namespace Practice\Blog\Block;

use Magento\Framework\View\Element\Template;
use Magento\Framework\View\Element\Template\Context;
use Practice\Blog\Constant\Constant;
use Practice\Blog\Model\ResourceModel\Comment\CollectionFactory as CommentCollectionFactory;
use Practice\Blog\Model\ResourceModel\Blog\CollectionFactory as BlogCollectionFactory;
use Practice\Blog\Model\Blog;
use Practice\Blog\Model\ResourceModel\BlogCategory\CollectionFactory as BlogCategoryCollectionFactory;
use Magento\Customer\Model\Session;

class BlogContent extends Template
{
    protected $commentCollectionFactory;
    protected $blogCollectionFactory;
    protected $blogCategoryCollectionFactory;
    protected $customerSession;
    protected $blog;

    public function __construct(
        Context $context,
        array $data = [],
        CommentCollectionFactory $commentCollectionFactory,
        BlogCollectionFactory $blogCollectionFactory,
        BlogCategoryCollectionFactory $blogCategoryCollectionFactory,
        Session $customerSession,
        Blog $blog
    ) {
        $this->blogCollectionFactory = $blogCollectionFactory;
        $this->commentCollectionFactory = $commentCollectionFactory;
        $this->blogCategoryCollectionFactory = $blogCategoryCollectionFactory;
        $this->customerSession = $customerSession;
        $this->blog = $blog;
        parent::__construct($context, $data);
    }

    public function getBlogContent()
    {
        $blogId = $this->getRequest()->getParam(Constant::ID_PARAM);

        // $blog = $this->blog->load($blogId, 'blog_entity_id');

        $blogCollection = $this->blogCollectionFactory->create();
        $blogCollection->getSelect()
            ->join('admin_user', 'admin_user.user_id=main_table.user_id', ['admin_user.firstname', 'admin_user.lastname', 'admin_user.email'])
            ->where('main_table.blog_entity_id = ' . $blogId);
        $blog = $this->blog->load($blogId, 'blog_entity_id');
        // ->join('admin_user', 'admin_user.user_id=main_table.user_id', ['admin_user.firstname', 'admin_user.lastname', 'admin_user.email'])
        // ->where('main_table.blog_entity_id = ' . $blogId);
        // var_dump($blog->getData());
        // die();

        return $blogCollection;
    }

    public function getBlogCategory()
    {
        $blogId = $this->getRequest()->getParam(Constant::ID_PARAM);

        $blogCategories = $this->blogCategoryCollectionFactory->create();
        $blogCategories->getSelect()
            ->join('blog_category_value', 'blog_category_value.blog_category_id = main_table.blog_category_id')
            ->join('blog_entity', 'blog_entity.blog_entity_id = blog_category_value.blog_entity_id', [''])
            ->where('blog_entity.blog_entity_id = ' . $blogId);

        // echo   $blogCategories->getSelect();
        // die();
        return $blogCategories;
    }



    public function getBlogComments()
    {
        $blogId = $this->getRequest()->getParam(Constant::ID_PARAM);
        $customerId = $this->customerSession->getCustomer()->getId();
        if($customerId == null){
            $customerId = 0;
        }

        $blogComments = $this->commentCollectionFactory->create();
        $blogComments->getSelect()
            ->join('blog_entity', 'blog_entity.blog_entity_id = main_table.blog_entity_id', [''])
            ->join('comment_status', 'comment_status.comment_status_id = main_table.comment_status_id', ['comment_status.comment_status_name'])
            ->join('customer_entity', 'main_table.customer_id = customer_entity.entity_id', ['email', 'firstname', 'middlename', 'lastname'])
            ->where('main_table.blog_entity_id = ' . $blogId)
            ->where('main_table.comment_status_id = ' . Constant::COMMENT_APPROVED_STATUS_ID)
            ->orWhere('main_table.customer_id = '.$customerId)
            ->order('created_at DESC');
        // echo $blogComments->getSelect();
        // die();
        return $blogComments;
    }



}
