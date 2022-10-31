<?php

namespace Practice\Blog\Block;

use Magento\Framework\View\Element\Template;
use Magento\Framework\View\Element\Template\Context;

class RecentlyComment extends Template
{
    public function __construct(
        Context $context,
        array $data = []

    ) {
        parent::__construct($context, $data);
        $this->_isScopePrivate = true;
    }

    // public function enableScopePrivate(){
    //     $this->_isScopePrivate = true;
    // }

     public function disableScopePrivate(){
        $this->_isScopePrivate = false;
    }

}
