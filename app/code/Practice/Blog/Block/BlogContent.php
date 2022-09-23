<?php

namespace Practice\Blog\Block;

use Practice\Blog\Model\Blog;
use Magento\Framework\View\Element\Template;
use Magento\Framework\View\Element\Template\Context;
use Practice\Blog\Constant\Constant;
use Practice\Blog\Model\ResourceModel\Comment\CollectionFactory as CommentCollectionFactory;
use Practice\Blog\Model\ResourceModel\Blog\CollectionFactory as BlogCollectionFactory;



class BlogContent extends Template
{

    // const ID_PARAM = 'id';
    protected $blog;
    protected $constant;
    protected $commentCollectionFactory;
    protected $blogs;

    public function __construct(
        Context $context,
        Blog $blog,
        array $data = [],
        Constant $constant,
        CommentCollectionFactory $commentCollectionFactory,
        BlogCollectionFactory $blogCollectionFactory
    ) {
        $this->blog = $blog;
        $this->blogCollectionFactory = $blogCollectionFactory;
        $this->commentCollectionFactory = $commentCollectionFactory;
        $this->constant = $constant;
        parent::__construct($context, $data);
    }

    public function getBlogContent()
    {
        $blogId = $this->getRequest()->getParam($this->constant::ID_PARAM);

        // $blog = $this->blog->load($blogId, 'blog_entity_id');

        $blogCollection = $this->blogCollectionFactory->create();
        $blogCollection->getSelect()
            ->join('admin_user', 'admin_user.user_id=main_table.user_id', ['admin_user.firstname', 'admin_user.lastname', 'admin_user.email'])
            ->where('main_table.blog_entity_id = ' . $blogId);

        return $blogCollection;
    }

    public function getBlogAttributes()
    {
        $blogId = $this->getRequest()->getParam($this->constant::ID_PARAM);

        $blogAttributes = $this->blogCollectionFactory->create();
        $blogAttributes->getSelect()

            ->join('blog_attribute_value', 'blog_attribute_value.blog_entity_id = main_table.blog_entity_id', ['attribute_value'])
            ->join('blog_attribute', 'blog_attribute.blog_attribute_id = blog_attribute_value.blog_attribute_id', ['blog_attribute_name'])
            ->where('main_table.blog_entity_id = ' . $blogId);

        return $blogAttributes;
    }



    public function getBlogComments()
    {
        $blogId = $this->getRequest()->getParam($this->constant::ID_PARAM);

        $blogComments = $this->commentCollectionFactory->create();
        $blogComments->getSelect()
            ->join('blog_entity', 'blog_entity.blog_entity_id = main_table.blog_entity_id', ['blog_entity.blog_entity_id'])
            ->join('comment_status', 'comment_status.comment_status_id = main_table.comment_status_id', ['comment_status.comment_status_name'])
            ->join('customer_entity', 'main_table.customer_id = customer_entity.entity_id', ['customer_entity.email'])
            ->where('main_table.blog_entity_id = ' . $blogId);
        // echo $blogComments->getSelect();
        // die();

        return $blogComments;
    }
}
