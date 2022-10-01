<?php

namespace Practice\Blog\Model\ResourceModel\Comment;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class Collection extends AbstractCollection{
    public function _construct(){
        $this->_init('Practice\Blog\Model\Comment', 'Practice\Blog\Model\ResourceModel\Comment');
    }


}
