<?php

namespace Practice\Blog\Block;

use Magento\Framework\View\Element\Template;
use Magento\Framework\View\Element\Template\Context;
use Magento\Framework\DataObject\IdentityInterface;
use Magento\PageCache\Model\Cache\Type as CacheType;
use Practice\Blog\Model\ResourceModel\CommentRepository;
use Practice\Blog\Api\Data\CommentInterface;
use Magento\Customer\Model\SessionFactory;
use Practice\Blog\Model\Comment;
use Practice\Blog\Constant\Constant;

class BlogComment extends Template implements IdentityInterface
{
    protected $commentRepository;
    protected $commentInterface;
    protected $customerSession;
    protected $comment;

    public function __construct(
        Context $context,
        array $data = [],
        CommentRepository $commentRepository,
        CommentInterface $commentInterface,
        SessionFactory $sessionFactory,
        Comment $comment
    ) {
        parent::__construct($context, $data);

        $this->commentRepository = $commentRepository;
        $this->commentInterface = $commentInterface;
        $this->customerSession = $sessionFactory->create();
        $this->comment = $comment;
    }

    public function getIdentities()
    {
        return $this->comment->getIdentities();
        // return [CacheType::TYPE_IDENTIFIER];
    }

    public function getBlogComment(){
        $blogId = $this->getRequest()->getParam('id');
        $customerId = 0;
        if($this->customerSession->isLoggedIn()){
            $customerId = $this->customerSession->getCustomer()->getId();
        }

        $comments = $this->commentRepository->getCommentsByBlogId($blogId, $customerId);

        // var_dump($comments);
        // die();
        return $comments;
    }

    public function checkIsLogin()
    {
        $customer = $this->customerSession;
        if ($customer->isLoggedIn()) {
            return 'true';
        }
        return 'false';
    }

    public function getBlogId(){
        $blogId = $this->getRequest()->getParam('id');
        return $blogId;
    }

    public function getApprovedStatusId(){
        return Constant::APPROVED_STATUS_ID;
    }
}
