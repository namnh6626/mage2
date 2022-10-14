<?php

namespace Practice\Blog\Controller\Adminhtml\Comment;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;
use Practice\Blog\Model\ResourceModel\Comment\CollectionFactory;
use Magento\Ui\Component\MassAction\Filter;
use Psr\Log\LoggerInterface;
use Practice\Blog\Constant\Constant;
use Practice\Blog\Model\ResourceModel\BlogNotificationRepository;
use Practice\Blog\Api\Data\BlogNotificationInterface;
use Practice\Blog\Model\ResourceModel\BlogRepository;
use Magento\Cms\Block\Page;

class Approve extends Action
{
    protected $pageFactory;
    protected $commentCollectionFactory;
    protected $filter;
    protected $logger;
    protected $blogNotificationRepository;
    protected $blogNotificationInterface;
    protected $blogRepository;

    public function __construct(
        Context $context,
        PageFactory $pageFactory,
        CollectionFactory $commentCollectionFactory,
        Filter $filter,
        LoggerInterface $logger,
        BlogNotificationRepository $blogNotificationRepository,
        BlogNotificationInterface $blogNotificationInterface,
        BlogRepository $blogRepository
    ) {
        parent::__construct($context);
        $this->logger = $logger;
        $this->filter = $filter;
        $this->commentCollectionFactory = $commentCollectionFactory;
        $this->pageFactory = $pageFactory;
        $this->blogNotificationRepository = $blogNotificationRepository;
        $this->blogNotificationInterface = $blogNotificationInterface;
        $this->blogRepository = $blogRepository;
    }

    public function execute()
    {
        try {
            $collection = $this->filter->getCollection($this->commentCollectionFactory->create());

            foreach ($collection as $comment) {
                $comment->setData('comment_status_id', Constant::APPROVED_STATUS_ID);
                $comment->save();

                $this->blogNotificationInterface->setTitle('Comment approved');
                $this->blogNotificationInterface->setDescription('Your comment has been published');
                $this->blogNotificationInterface->setCreatedAt(date('Y-m-d H:i:s', time()));
                $this->blogNotificationInterface->setCommentId($comment->getCommentEntityId());
                $this->blogNotificationInterface->setIsRead(0);

                $this->blogNotificationRepository->save($this->blogNotificationInterface);

                $this->_eventManager->dispatch('comment_approved_notification');
            }

            $typeCacheCode = $this->blogRepository->getIdentities();

            $this->_eventManager->dispatch('invalidate_page', ['type_code'=>$typeCacheCode]);
        } catch (\Exception $e) {
            $this->logger->critical($e->getMessage());
        }

        return $this->_redirect($this->_redirect->getRefererUrl());
    }
}
