<?php

namespace Practice\Blog\Controller\Comment;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;
use Practice\Blog\Model\Blog;
use Practice\Blog\Api\Data\CommentInterface;
use Practice\Blog\Model\ResourceModel\CommentRepository;



class Recent extends Action
{
    private $pageFactory;
    protected $blog;

    public function __construct(
        Context $context,
        PageFactory $pageFactory,
        Blog $blog,
        CommentInterface $commentInterface,
        CommentRepository $commentRepository
        )
    {
        $this->commentRepository = $commentRepository;
        $this->commentInterface = $commentInterface;
        $this->blog = $blog;
        $this->pageFactory = $pageFactory;
        parent::__construct($context);
    }

    public function execute()
    {
        return ($this->pageFactory->create());
    }
}
