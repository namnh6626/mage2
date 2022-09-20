<?php
namespace Practice\Blog\Block;

use Magento\Framework\View\Element\Template;
use Magento\Framework\View\Element\Template\Context;
use Magento\Catalog\Model\ResourceModel\Product\Collection;

class ListBlog extends Template {
    public function __construct(Context $context, Collection $collectionFactory)
    {
        parent::_construct($context);
    }

    public function getBlog(){

    }
}
