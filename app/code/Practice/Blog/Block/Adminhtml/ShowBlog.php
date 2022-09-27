<?php

namespace Practice\Blog\Block\Adminhtml;

use Magento\Framework\View\Element\Template;
use Magento\Framework\View\Element\Template\Context;
use Practice\Blog\Model\ResourceModel\Blog\CollectionFactory as BlogCollectionFactory;
use Practice\Blog\Model\ResourceModel\BlogCategory\CollectionFactory as BlogCategoryCollectionFactory;
use Practice\Blog\Constant\Constant;
use Practice\Blog\Model\ResourceModel\Comment\CollectionFactory as CommentCollectionFactory;


class ShowBlog extends Template
{
    protected $blogCollectionFactory;
    protected $constant;
    protected $blogCategoryCollectionFactory;
    protected $commentCollectionFactory;

    public function __construct(
        Context $context,
        array $data = [],
        BlogCollectionFactory $blogCollectionFactory,
        Constant $constant,
        BlogCategoryCollectionFactory $blogCategoryCollectionFactory,
        CommentCollectionFactory $commentCollectionFactory
    ) {
        $this->constant = $constant;
        $this->blogCategoryCollectionFactory = $blogCategoryCollectionFactory;
        $this->blogCollectionFactory = $blogCollectionFactory;
        $this->commentCollectionFactory = $commentCollectionFactory;
        parent::__construct($context, $data);
    }

    public function showBlog()
    {
        $blogId = $this->getRequest()->getParam($this->constant::ID_PARAM);

        $blogCollection = $this->blogCollectionFactory->create();
        $blogCollection->getSelect()
            ->join('admin_user', 'admin_user.user_id=main_table.user_id', ['admin_user.firstname', 'admin_user.lastname', 'admin_user.email'])
            ->where('main_table.blog_entity_id = ' . $blogId);


        return $blogCollection;
    }

    public function getBlogCategory()
    {
        $blogId = $this->getRequest()->getParam($this->constant::ID_PARAM);

        $blogCategories = $this->blogCategoryCollectionFactory->create();
        $blogCategories->getSelect()
            ->join('blog_category_value', 'blog_category_value.blog_category_id = main_table.blog_category_id')
            ->join('blog_entity', 'blog_entity.blog_entity_id = blog_category_value.blog_entity_id', [''])
            ->where('blog_entity.blog_entity_id = ' . $blogId);

        // echo $blogCategories->getSelect();
        // die();
        return $blogCategories;
    }

    public function getBlogComments()
    {
        $blogId = $this->getRequest()->getParam($this->constant::ID_PARAM);

        $blogComments = $this->commentCollectionFactory->create();
        $blogComments->getSelect()
            ->join('blog_entity', 'blog_entity.blog_entity_id = main_table.blog_entity_id', [''])
            ->join('comment_status', 'comment_status.comment_status_id = main_table.comment_status_id', ['comment_status.comment_status_name'])
            ->join('customer_entity', 'main_table.customer_id = customer_entity.entity_id', ['email', 'firstname', 'middlename', 'lastname'])
            ->where('main_table.blog_entity_id = ' . $blogId)
            ->where('main_table.comment_status_id = ' . $this->constant::COMMENT_APPROVED_STATUS_ID);

        return $blogComments;
    }
}
