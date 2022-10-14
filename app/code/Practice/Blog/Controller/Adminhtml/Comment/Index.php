<?php

namespace Practice\Blog\Controller\Adminhtml\Comment;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;
use Practice\Blog\Model\ResourceModel\BlogRepository;

class Index extends Action
{
    protected $blogRepository;
    protected $pageFactory;

    public function __construct(
        Context $context,
        PageFactory $pageFactory,
        BlogRepository $blogRepository
        )

    {
        $this->blogRepository = $blogRepository;
        $this->pageFactory = $pageFactory;
        parent::__construct($context);
    }

    public function execute()
    {
        return $this->pageFactory->create();
    }
}
