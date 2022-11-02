<?php

namespace Practice\Blog\Block;

use Magento\Framework\View\Element\Template;
use Magento\Framework\View\Element\Template\Context;
use Practice\Blog\Constant\Constant;
use Practice\Blog\Api\Data\BlogInterface;
use Practice\Blog\Model\ResourceModel\BlogRepository;
use Magento\Customer\Model\SessionFactory;
use Magento\Framework\DataObject\IdentityInterface;
use Practice\Blog\Model\Blog;
use Practice\Blog\Model\BlogCategoryValue;
use Practice\Blog\Model\Comment;

class BlogContent extends Template implements IdentityInterface
{

    protected $customerSession;
    protected $blogRepository;
    protected $blogInterface;
    protected $httpContext;
    protected $blog;
    protected $comment;

    public function __construct(
        Context $context,
        array $data = [],
        SessionFactory $customerSession,
        BlogRepository $blogRepository,
        BlogInterface $blogInterface,
        Blog $blog,
        Comment $comment
    ) {
        $this->customerSession = $customerSession;
        $this->blogRepository = $blogRepository;
        $this->blogInterface = $blogInterface;
        $this->blog = $blog;
        $this->comment = $comment;

        parent::__construct($context, $data);
    }

    public function getIdentities()
    {
        $blogId = $this->getRequest()->getParam(Constant::ID_PARAM);
        $identities = array_merge($this->blog->getIdentities(), $this->comment->getIdentities());

        return array_unique($identities);

        // return $this->blog->getIdentities();

    }

    public function getBlogContent()
    {
        $blogId = $this->getRequest()->getParam(Constant::ID_PARAM);
        $result = $this->blogRepository->getBlogContentById($blogId);

        // var_dump($result->getData());
        // die();
        return $result;
    }

    public function getBlogCategory()
    {
        $blogId = $this->getRequest()->getParam(Constant::ID_PARAM);
        $blogCategories = $this->blogRepository->getBlogCategories($blogId);
        return $blogCategories;
    }


    public function checkIsLogin()
    {
        $customer = $this->customerSession->create();
        if ($customer->isLoggedIn()) {
            return 'true';
        }
        return 'false';
    }

    public function getCountApprovedComments()
    {
        $blogId = $this->getRequest()->getParam(Constant::ID_PARAM);

        $count = $this->blogRepository->getCountBlogApprovedComments($blogId)[0]['count_comment'];

        if ($count < 1) {
            $result = $count . ' comment';
        } else {
            $result = $count . ' comments';
        }
        return $result;
        // var_dump($result->getData());
        // die();
    }
}
