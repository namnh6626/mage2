<?php

namespace Practice\Blog\Model;

use Magento\Framework\Model\AbstractExtensibleModel;
use Magento\Framework\Model\AbstractModel;
use Practice\Blog\Api\Data\CommentInterface;
use Magento\Framework\DataObject\IdentityInterface;
use Practice\Blog\Model\Blog;

class Comment extends AbstractModel implements CommentInterface, IdentityInterface
{
    const CACHE_TAG = 'comment_entity';

    const CACHE_COMMENT_BLOG_TAG = 'comment_ent_blog_ent';

    public function _construct()
    {
        $this->_init('Practice\Blog\Model\ResourceModel\Comment');
    }

    public function getIdentities()
    {
        $identities = [self::CACHE_TAG . '_' . $this->getId()];

        if ($this->hasDataChanges()) {
            $identities[] = Blog::CACHE_BLOG_COMMENT_TAG . '_' . $this->getId();
        }

        return array_unique($identities);
    }

    public function getContent()
    {
        return $this->_getData(self::COMMENT_CONTENT);
    }

    public function setContent($content)
    {
        return $this->setData(self::COMMENT_CONTENT, $content);
    }

    public function getCommentBlogId()
    {
        return $this->_getData(self::COMMENT_BLOG_ID);
    }

    public function setCommentBlogId($blogId)
    {
        return $this->setData(self::COMMENT_BLOG_ID, $blogId);
    }

    public function getCommentCustomerId()
    {
        return $this->_getData(self::COMMENT_CUSTOMER_ID);
    }

    public function setCommentCustomerId($id)
    {
        return $this->setData(self::COMMENT_CUSTOMER_ID, $id);
    }

    public function getCommentStatusId()
    {
        return $this->_getData(self::COMMENT_STATUS_ID);
    }

    public function setCommentStatusId($id)
    {
        return $this->setData(self::COMMENT_STATUS_ID, $id);
    }

    public function getCommentCreatedAt()
    {
        return $this->_getData(self::COMMENT_CREATED_AT);
    }

    public function setCommentCreatedAt($createdAt)
    {
        return $this->setData(self::COMMENT_CREATED_AT, $createdAt);
    }
}
