<?php

namespace Practice\Blog\Block;

use Practice\Blog\Model\Blog;
use Magento\Framework\View\Element\Template;
use Magento\Framework\View\Element\Template\Context;
use Practice\Blog\Constant\Constant;


class BlogContent extends Template
{

    // const ID_PARAM = 'id';
    protected $blog;
    protected $constant;
    // protected $comments;

    public function __construct(Context $context, Blog $blog, array $data = [], Constant $constant)
    {
        $this->blog = $blog;
        // $this->comments = $comments;
        $this->constant = $constant;
        parent::__construct($context, $data);
    }

    public function getBlogContent()
    {
        $blogId = $this->getRequest()->getParam($this->constant::ID_PARAM);

        $blog = $this->blog->load($blogId, 'blog_entity_id');

        // var_dump($blog->getData());
        // die();
        return $blog;
    }

    public function getAllComments()
    {

    }
}
