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
use Practice\Blog\Model\ResourceModel\BlogRepository;


class Decline extends Action
{
    protected $pageFactory;
    protected $commentCollectionFactory;
    protected $filter;
    protected $logger;
    protected $blogRepository;

    public function __construct(
        Context $context,
        PageFactory $pageFactory,
        CollectionFactory $commentCollectionFactory,
        Filter $filter,
        LoggerInterface $logger,
        BlogRepository $blogRepository
    ) {
        $this->logger = $logger;
        $this->filter = $filter;
        $this->commentCollectionFactory = $commentCollectionFactory;
        $this->pageFactory = $pageFactory;
        $this->blogRepository = $blogRepository;

        parent::__construct($context);
    }

    public function execute()
    {
        try {
            $collection = $this->filter->getCollection($this->commentCollectionFactory->create());

            foreach ($collection as $comment) {
                $comment->setData('comment_status_id', Constant::DECLINED_STATUS_ID);
                $comment->save();
            }
            $typeCacheCode = $this->blogRepository->getIdentities();

            $this->_eventManager->dispatch('invalidate_page', ['type_code' => $typeCacheCode]);
        } catch (\Exception $e) {
            $this->logger->critical($e->getMessage());
        }

        return $this->_redirect($this->_redirect->getRefererUrl());
    }
}
