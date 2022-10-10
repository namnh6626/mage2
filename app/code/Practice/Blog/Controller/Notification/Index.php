<?php

namespace Practice\Blog\Controller\Notification;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Practice\Blog\Api\Data\BlogNotificationInterface;
use Practice\Blog\Model\ResourceModel\BlogNotificationRepository;
use Magento\Framework\View\Result\PageFactory;

class Index extends Action {
    protected $blogNotificationRepository;
    protected $blogNotificationInterface;
    protected $pageFactory;

    public function __construct(
        Context $context,
        PageFactory $pageFactory,
        BlogNotificationInterface $blogNotificationInterface,
        BlogNotificationRepository $blogNotificationRepository
    )
    {
        parent::__construct($context);

        $this->pageFactory = $pageFactory;
        $this->blogNotificationInterface = $blogNotificationInterface;
        $this->blogNotificationRepository = $blogNotificationRepository;
    }

    public function execute()
    {
        return $this->pageFactory->create();
    }
}
