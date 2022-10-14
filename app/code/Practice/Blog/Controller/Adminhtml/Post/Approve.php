<?php

namespace Practice\Blog\Controller\Adminhtml\Post;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;
use Magento\Framework\Controller\ResultFactory;
use Practice\Blog\Model\ResourceModel\Blog\CollectionFactory;
use Magento\Ui\Component\MassAction\Filter;
use Psr\Log\LoggerInterface;
use Practice\Blog\Constant\Constant;
use Practice\Blog\Model\ResourceModel\BlogRepository;

class Approve extends Action
{
    protected $pageFactory;
    protected $blogCollectionFactory;
    protected $filter;
    protected $logger;
    protected $blogRepository;

    public function __construct(
        Context $context,
        PageFactory $pageFactory,
        CollectionFactory $blogCollectionFactory,
        Filter $filter,
        LoggerInterface $logger,
        BlogRepository $blogRepository
    ) {
        $this->logger = $logger;
        $this->filter = $filter;
        $this->blogCollectionFactory = $blogCollectionFactory;
        $this->pageFactory = $pageFactory;
        $this->blogRepository = $blogRepository;
        parent::__construct($context);
    }

    public function execute()
    {
        try {
            $collection = $this->filter->getCollection($this->blogCollectionFactory->create());

            foreach ($collection as $blog) {
                $blog->setData('blog_status_id', Constant::APPROVED_STATUS_ID);
                $blog->save();
            }
            $typeCacheCode = $this->blogRepository->getIdentities();

            $this->_eventManager->dispatch('invalidate_page', ['type_code' => $typeCacheCode]);

        } catch (\Exception $e) {
            $this->logger->critical($e->getMessage());
        }


        return $this->_redirect($this->_redirect->getRefererUrl());
    }
}
