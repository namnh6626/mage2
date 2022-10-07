<?php
namespace Practice\Blog\Block;

use Magento\Framework\View\Element\Template\Context;
use Magento\Framework\View\Element\Template;
use Practice\Blog\Model\ResourceModel\BlogNotificationRepository;
use Magento\Customer\Model\Session;

class Notification extends Template
{
    protected $blogNotificationRepository;
    protected $customerSession;



    public function __construct(
        Context $context,
        array $data = [],
        BlogNotificationRepository $blogNotificationRepository,
        Session $customerSession
        ) {
            $this->blogNotificationRepository = $blogNotificationRepository;
            $this->customerSession = $customerSession;

            parent::__construct($context, $data);
    }


    public function getNotification(){

        $customerId = 0;
        if($this->customerSession->isLoggedIn()){
            return $this->blogNotificationRepository->getList($this->customerSession->getId());
        }
        return $this->blogNotificationRepository->getList($customerId);

    }
}
