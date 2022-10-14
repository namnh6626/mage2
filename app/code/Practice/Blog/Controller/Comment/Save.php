<?php

namespace Practice\Blog\Controller\Comment;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Psr\Log\LoggerInterface;
use Practice\Blog\Model\Comment;
use Magento\Framework\Controller\Result\JsonFactory;
use Magento\Customer\Model\SessionFactory;
use Practice\Blog\Constant\Constant;
use Magento\Framework\App\CsrfAwareActionInterface;
use Magento\Framework\App\Request\InvalidRequestException;
use Magento\Framework\App\RequestInterface;
use Magento\Framework\Phrase;
use Practice\Blog\Model\ResourceModel\BlogRepository;

class Save extends Action implements CsrfAwareActionInterface
{
    protected $pageFactory;
    protected $jsonFactory;
    protected $logger;
    protected $comment;
    protected $customerSession;
    protected $customerLogin;
    protected $urlInterface;
    protected $messageManagerInterface;
    protected $blogRepository;

    public function __construct(
        Context $context,
        LoggerInterface $logger,
        Comment $comment,
        JsonFactory $jsonFactory,
        SessionFactory $customerSession,
        BlogRepository $blogRepository
    ) {
        $this->jsonFactory = $jsonFactory;
        $this->comment = $comment;
        $this->logger = $logger;
        $this->customerSession = $customerSession;
        $this->blogRepository = $blogRepository;

        parent::__construct($context);
    }

    public function execute()
    {
        $customerSession = $this->customerSession->create();
        $commentContent = $this->getRequest()->getParam('content');
        $blogId = $this->getRequest()->getParam('blog_id');
        $customerId = $customerSession->getId();
        try {
            $createdAt = date('Y-m-d H:i:s', time());

            $resultJsonFactory = $this->jsonFactory->create();
            $comment = $this->comment;
            $comment->setData('content', $commentContent);
            $comment->setData('blog_entity_id', $blogId);
            $comment->setData('comment_status_id', Constant::PENDING_STATUS_ID);
            $comment->setData('customer_id', $customerId);
            $comment->setData('created_at', $createdAt);
            $comment->save();

            $comment->setData('firstname', strval($customerSession->getCustomer()->getFirstname()));
            $comment->setData('middlename', strval($customerSession->getCustomer()->getMiddlename()));
            $comment->setData('lastname', strval($customerSession->getCustomer()->getLastname()));
            $comment->setData('email', $customerSession->getCustomer()->getEmail());
            $comment->setData('created_at', date('d/m/Y H:i', strtotime($createdAt)));

            $resultJsonFactory->setData($comment->getData());

            $typeCacheCode = $this->blogRepository->getIdentities();

            $this->_eventManager->dispatch('invalidate_page', ['type_code'=>$typeCacheCode]);
            $this->_eventManager->dispatch('customer_comment_success');

        } catch (\Exception $e) {
            $this->logger->critical($e->getMessage());
        }


        return $resultJsonFactory;
    }

    public function createCsrfValidationException(RequestInterface $request): ?InvalidRequestException
    {
        return new InvalidRequestException(
            $this->response,
            [new Phrase($this->message)]
        );
    }

    public function validateForCsrf(RequestInterface $request): ?bool
    {
        return true;
    }

    protected function _isAllowed()
    {
        return true;
    }
}
