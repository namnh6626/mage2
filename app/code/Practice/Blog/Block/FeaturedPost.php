<?php

namespace Practice\Blog\Block;

use Magento\Framework\View\Element\Template;
use Magento\Framework\View\Element\Template\Context;
use Practice\Blog\Api\Data\BlogInterface;
use Practice\Blog\Model\ResourceModel\BlogRepository;
use Magento\Customer\Model\SessionFactory;

class FeaturedPost extends Template
{
    protected $blogInterface;
    protected $blogRepository;
    protected $customerSession;

    public function __construct(
        Context $context,
        array $data = [],
        BlogInterface $blogInterface,
        BlogRepository $blogRepository,
        SessionFactory $sessionFactory
    ) {
        parent::__construct($context, $data);

        $this->blogRepository = $blogRepository;
        $this->blogInterface = $blogInterface;
        $this->customerSession = $sessionFactory->create();
        $this->_isScopePrivate = true;

    }



    public function getFeaturedBlog()
    {
        $customerId = 0;

        if ($this->customerSession->isLoggedIn()) {
            $customerId = $this->customerSession->getCustomer()->getId();
        }
        $blogs = $this->blogRepository->getFeaturedPost();
        return $blogs;
    }
}
