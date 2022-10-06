<?php

namespace Practice\Blog\Model;

use Magento\Framework\Model\AbstractExtensibleModel;
use Practice\Blog\Api\Data\BlogInterface;
use Magento\Framework\Model\AbstractModel;
use Practice\Blog\Model\ResourceModel\Blog\CollectionFactory as BlogCollectionFactory;
use Magento\Framework\App\ResourceConnection;

class Blog extends AbstractModel implements BlogInterface
{

    public function _construct()
    {
        $this->_init('\Practice\Blog\Model\ResourceModel\Blog');
    }

    public function getBlogEntityId():int
    {
        return $this->_getData(self::BLOG_ENTITY_ID);
    }

    public function setBlogEntityId($id)
    {
        return $this->setData(self::BLOG_ENTITY_ID, $id);
    }

    public function getTitle()
    {
        return $this->_getData(self::BLOG_TITLE);
    }

    public function setTitle($title)
    {
        return $this->setData(self::BLOG_TITLE, $title);
    }

    public function getContent()
    {
        return $this->_getData(self::BLOG_CONTENT);
    }

    public function setContent($content)
    {
        return $this->setData(self::BLOG_CONTENT, $content);
    }

    public function getUserId():int
    {
        return $this->_getData(self::BLOG_USER_ID);
    }

    public function setUserId($userId)
    {
        return $this->setData(self::BLOG_USER_ID, $userId);
    }

    public function getBlogAvatarLink()
    {
        return $this->_getData(self::BLOG_AVATAR);
    }

    public function setBlogAvatarLink($link)
    {
        return $this->setData(self::BLOG_AVATAR, $link);
    }


}
