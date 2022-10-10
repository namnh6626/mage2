<?php

namespace Practice\Blog\Block;

use Magento\Framework\View\Element\Template\Context;
use Magento\Framework\View\Element\Template;
use Practice\Blog\Model\ResourceModel\BlogNotificationRepository;
use Magento\Customer\Model\Session;
use Magento\Framework\Message\ManagerInterface;

class Notification extends Template
{
    protected $messageManagerInterface;
    protected $blogNotificationRepository;
    protected $customerSession;



    public function __construct(
        Context $context,
        array $data = [],
        BlogNotificationRepository $blogNotificationRepository,
        Session $customerSession,
        ManagerInterface $messageManagerInterface
    ) {
        $this->messageManagerInterface = $messageManagerInterface;
        $this->blogNotificationRepository = $blogNotificationRepository;
        $this->customerSession = $customerSession;

        parent::__construct($context, $data);
    }

    public function getListNotification()
    {
        $customerId = 0;
        if ($this->customerSession->isLoggedIn()) {
            $notificationCollection = $this->blogNotificationRepository->getList($this->customerSession->getId());

            return $notificationCollection;
        }
        return $this->blogNotificationRepository->getList($customerId);
    }

    public function getNotificationMessage()
    {
        if ($this->customerSession->isLoggedIn()) {
            $notificationCollection = $this->blogNotificationRepository->getList($this->customerSession->getId());

            $countNotifications = count($notificationCollection);

            $notificationUrl = $this->getUrl('blog/notification/index');

            if ($countNotifications > 0) {
                $message = __('You have new <a href="%1">notifications</a>.', $notificationUrl);
                $this->messageManagerInterface->addNotice($message);
            }

        }
        // else{
        //     $this->messageManagerInterface->addError( __('List notifications are not available. Please <a href="/customer/account/login/referer/aHR0cDovL21hZ2VudG8yLnRlc3Q6ODEvYmxvZy9ub3RpZmljYXRpb24vaW5kZXgv/">Login</a>'));
        // }
    }
}
