<?php

namespace Practice\Blog\Model\ResourceModel;
use Magento\Framework\Model\ResourceModel\Db\AbstractDb;
use Magento\Framework\Model\ResourceModel\Db\Context;

class Comment extends AbstractDb
{
    public function __construct(Context $context)
    {
        parent::__construct($context);
    }
    public function _construct()
    {
        $this->_init('comment_entity', 'comment_entity_id');
    }
}
