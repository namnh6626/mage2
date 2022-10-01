<?php

namespace Practice\Blog\Controller\Comment;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Psr\Log\LoggerInterface;
use Practice\Blog\Model\Comment;
use Magento\Framework\Controller\Result\JsonFactory;
use Magento\Customer\Model\Session;



class Save extends Action
{
    protected $pageFactory;
    protected $jsonFactory;
    protected $logger;
    protected $comment;
    protected $customerSession;
    protected $customerLogin;
    protected $urlInterface;


    public function __construct(
        Context $context,
        LoggerInterface $logger,
        Comment $comment,
        JsonFactory $jsonFactory,
        Session $customerSession
    ) {
        $this->jsonFactory = $jsonFactory;
        $this->comment = $comment;
        $this->logger = $logger;
        $this->customerSession = $customerSession;

        parent::__construct($context);
    }

    public function execute()
    {
        $commentContent = $this->getRequest()->getParam('content');
        $customerId = $this->customerSession->getCustomer()->getId();
        try {
            $createdAt = date('Y-m-d H:i:s', time());

            $resultJsonFactory = $this->jsonFactory->create();
            $comment = $this->comment;
            $comment->setData('content', $commentContent);
            $comment->setData('blog_entity_id', 1);
            $comment->setData('comment_status_id', 2);
            $comment->setData('customer_id', $customerId);
            $comment->setData('created_at', $createdAt);
            $comment->save();

            $comment->setData('firstname', strval($this->customerSession->getCustomer()->getFirstname()));
            $comment->setData('middlename', strval($this->customerSession->getCustomer()->getMiddlename()));
            $comment->setData('lastname', strval($this->customerSession->getCustomer()->getLastname()));
            $comment->setData('email', $this->customerSession->getCustomer()->getEmail());
            $comment->setData('created_at', date('d/m/Y H:i:s', strtotime($createdAt)));

            $resultJsonFactory->setData($comment->getData());
        } catch (\Exception $e) {
            $this->logger->critical($e->getMessage());
        }

        $this->_eventManager->dispatch('customer_comment_success');

        return $resultJsonFactory;
    }
}
