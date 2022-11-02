<?php

namespace Practice\Blog\Controller\Post;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Practice\Blog\Model\ResourceModel\BlogRepository;
use Magento\Framework\Controller\Result\JsonFactory;
use Practice\Blog\Model\ResourceModel\CommentRepository;
use Magento\Customer\Model\SessionFactory;
use Practice\Blog\Constant\Constant;

class RecentComment extends Action
{
    const GET_BLOG_RECENTLY_COMMENT_QUANTITY = 5;

    protected $blogRepository;
    protected $resultJson;
    protected $commentRepository;
    protected $customerSession;

    public function __construct(
        Context $context,
        BlogRepository $blogRepository,
        CommentRepository $commentRepository,
        JsonFactory $jsonFactory,
        SessionFactory $sessionFactory
    ) {
        parent::__construct($context);

        $this->blogRepository = $blogRepository;
        $this->resultJson = $jsonFactory->create();
        $this->commentRepository = $commentRepository;
        $this->customerSession = $sessionFactory->create();
    }

    public function execute()
    {
        if($this->customerSession->isLoggedIn()){
            $customerId = $this->customerSession->getId();
            $currentBlogId = 0;

            if($this->getRequest()->getParam(Constant::ID_PARAM)){
                $currentBlogId = $this->getRequest()->getParam(Constant::ID_PARAM);
            }
            $blogIdCommentedCollection = $this->commentRepository->getAllBlogIdCustomerCommented($customerId, $currentBlogId);

            $blogIdArr = [];
            foreach($blogIdCommentedCollection as $blog){
                $blogIdArr[] = $blog->getBlogEntityId();
            }
            $uniqueBlogIdArr = array_unique($blogIdArr);

            $blogIdRecentlyCommentArr = array_slice($uniqueBlogIdArr, 0, self::GET_BLOG_RECENTLY_COMMENT_QUANTITY, true);

            $blogRecentComment = $this->blogRepository->getBlogTitleByIdArr($blogIdRecentlyCommentArr);

          $this->resultJson->setData($blogRecentComment->getData());

          return $this->resultJson;
        }else{
            return $this->_redirect('/');
        }
    }
}
