<?php

namespace Practice\Blog\Model\ResourceModel\CommentStatus;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class Collection extends AbstractCollection{
    public function _construct(){
        $this->_init('Practice\Blog\Model\CommentStatus', 'Practice\Blog\Model\ResourceModel\CommentStatus');
    }
}
