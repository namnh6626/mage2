<?php

namespace Practice\Blog\Model;

use Magento\Framework\Model\AbstractModel;
use Magento\Framework\DataObject\IdentityInterface;

class BlogCategoryValue extends AbstractModel implements IdentityInterface
{
    const CACHE_TAG = 'blog_category';


    public function _construct()
    {
        $this->_init('\Practice\Blog\Model\ResourceModel\BlogCategoryValue');
    }


    public function getIdentities()
    {
        $identities = [self::CACHE_TAG . '_' . $this->getId()];

        return array_unique($identities);
    }
}
