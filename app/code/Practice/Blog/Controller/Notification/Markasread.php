<?php

namespace Practice\Blog\Controller\Notification;

use Magento\Framework\App\Action\Action;
use Magento\Framework\View\Result\PageFactory;
use Magento\Framework\App\Action\Context;
use Practice\Blog\Api\Data\BlogNotificationInterface;
use Practice\Blog\Model\ResourceModel\BlogNotificationRepository;
use Magento\Framework\App\CsrfAwareActionInterface;
use Magento\Framework\App\Request\InvalidRequestException;
use Magento\Framework\App\RequestInterface;
use Magento\Framework\Phrase;
use Psr\Log\LoggerInterface;
use Magento\Framework\Controller\Result\JsonFactory;


class Markasread extends Action implements CsrfAwareActionInterface
{
    protected $pageFactory;
    protected $blogNotificationInterface;
    protected $blogNotificationRepository;
    protected $loggerInterface;
    protected $jsonFactory;

    public function __construct(
        Context $context,
        BlogNotificationInterface $blogNotificationInterface,
        BlogNotificationRepository $blogNotificationRepository,
        PageFactory $pageFactory,
        LoggerInterface $loggerInterface,
        JsonFactory $jsonFactory
    ) {
        $this->pageFactory = $pageFactory;
        $this->blogNotificationInterface = $blogNotificationInterface;
        $this->blogNotificationRepository = $blogNotificationRepository;
        $this->loggerInterface = $loggerInterface;
        $this->jsonFactory = $jsonFactory;

        parent::__construct($context);
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

    public function execute()
    {
        $notificationIds = $this->getRequest()->getParam('id');

        try{
            $resultJsonFactory = $this->jsonFactory->create();

            foreach($notificationIds as $notificationId){
                $blogNotification = $this->blogNotificationRepository->getById($notificationId);
                $this->blogNotificationRepository->markAsRead($this->blogNotificationInterface, $blogNotification);
            }
            $resultJsonFactory->setData($notificationIds);

        }catch(\Exception $e){
            $this->loggerInterface->critical($e->getMessage());
        }

        return $resultJsonFactory;
    }
}
