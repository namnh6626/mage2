<?php

namespace Practice\Blog\Model;

use Magento\Framework\Model\AbstractModel;
use Magento\Framework\Model\Context;
use Magento\Framework\Registry;
use Magento\Framework\Model\ResourceModel\AbstractResource;
use Magento\Framework\Data\Collection\AbstractDb;
class Comment extends AbstractModel
{
    // public function __construct(Context $context, Registry $registry, AbstractResource $resource, AbstractDb $resourceCollection, $data = [])
    // {
    //     parent::__construct($context, $registry, $resource, $resourceCollection, $data);
    // }

    public function _construct()
    {
        $this->_init('Practice\Blog\Model\ResourceModel\Comment');
    }
}
