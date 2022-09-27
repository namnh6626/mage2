<?php

namespace Practice\Blog\Block\Adminhtml;

use Magento\Framework\View\Result\PageFactory;
use Magento\Framework\View\Element\Template;
use Magento\Framework\View\Element\Template\Context;

class AddBlog extends Template
{
    protected $pageFactory;

    public function __construct(Context $context, PageFactory $pageFactory, array $data = [])
    {
        $this->pageFactory = $pageFactory;
        parent::__construct($context, $data);
    }

    public function addBlog()
    {

    }
}
