<?php

namespace Practice\Blog\Controller\Post;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Practice\Blog\Model\ResourceModel\BlogRepository;
use Magento\Framework\Controller\Result\JsonFactory;

class Featured extends Action
{
    protected $blogRepository;
    protected $resultJson;

    public function __construct(
        Context $context,
        BlogRepository $blogRepository,
        JsonFactory $jsonFactory
    ) {
        parent::__construct($context);

        $this->blogRepository = $blogRepository;
        $this->resultJson = $jsonFactory->create();
    }

    public function execute()
    {
        $result = $this->blogRepository->getFeaturedPost();
        $this->resultJson->setData($result->getData());

        return $this->resultJson;
    }
}
