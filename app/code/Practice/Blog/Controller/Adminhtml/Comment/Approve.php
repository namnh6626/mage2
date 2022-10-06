<?php

namespace Practice\Blog\Controller\Adminhtml\Comment;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;
use Magento\Framework\Controller\ResultFactory;
use Practice\Blog\Model\ResourceModel\Comment\CollectionFactory;
use Magento\Ui\Component\MassAction\Filter;
use Psr\Log\LoggerInterface;
use Practice\Blog\Constant\Constant;

class Approve extends Action
{
    protected $pageFactory;
    protected $commentCollectionFactory;
    protected $filter;
    protected $logger;

    public function __construct(Context $context, PageFactory $pageFactory, CollectionFactory $commentCollectionFactory, Filter $filter, LoggerInterface $logger)
    {
        $this->logger = $logger;
        $this->filter = $filter;
        $this->commentCollectionFactory = $commentCollectionFactory;
        $this->pageFactory = $pageFactory;
        parent::__construct($context);
    }

    public function execute()
    {
        try {
            $collection = $this->filter->getCollection($this->commentCollectionFactory->create());
            foreach ($collection as $comment) {
                $comment->setData('comment_status_id', Constant::APPROVED_STATUS_ID);
                $comment->save();
                $this->_eventManager->dispatch('comment_approved_notification');
            }
        } catch (\Exception $e) {
            $this->logger->critical($e->getMessage());
        }
        return $this->_redirect($this->_redirect->getRefererUrl());
    }
}
