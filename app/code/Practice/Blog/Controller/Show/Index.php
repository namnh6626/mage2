<?php

namespace Practice\Blog\Controller\Show;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;
use Practice\Blog\Model\ResourceModel\BlogRepository;


class Index extends Action
{
    protected $pageFactory;
    protected $blogRepository;


    public function __construct(
        Context $context,
        PageFactory $pageFactory,
        BlogRepository $blogRepository
    ) {
        parent::__construct($context);

        $this->pageFactory = $pageFactory;
        $this->blogRepository = $blogRepository;

    }

    public function execute()
    {
        $page = $this->pageFactory->create();

        return $page;
    }
}
