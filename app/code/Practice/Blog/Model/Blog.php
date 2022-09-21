<?php
namespace Practice\Blog\Model;

use Magento\Framework\Model\AbstractModel;
use Magento\Framework\Registry;


class Blog extends AbstractModel {

    public function _construct(){
        $this->_init('Practice\Blog\Model\ResourceModel\Blog');
    }
}
