<?php

namespace Practice\Blog\Model;

use Magento\Framework\Model\AbstractExtensibleModel;
use Magento\Framework\Model\AbstractModel;
use Practice\Blog\Api\Data\CommentInterface;

class Comment extends AbstractExtensibleModel implements CommentInterface
{
    public function _construct()
    {
        $this->_init('Practice\Blog\Model\ResourceModel\Comment');
    }

    public function getContent(){
        return $this->_getData(self::COMMENT_CONTENT);
    }

    public function setContent($content){
        return $this->setData(self::COMMENT_CONTENT, $content);
    }

    public function getCommentBlogId(){
        return $this->_getData(self::COMMENT_BLOG_ID);
    }

    public function setCommentBlogId($blogId){
        return $this->setData(self::COMMENT_BLOG_ID, $blogId);
    }

    public function getCommentCustomerId(){
        return $this->_getData(self::COMMENT_CUSTOMER_ID);
    }

    public function setCommentCustomerId($id){
        return $this->setData(self::COMMENT_CUSTOMER_ID, $id);
    }

    public function getCommentStatusId(){
        return $this->_getData(self::COMMENT_STATUS_ID);
    }

    public function setCommentStatusId($id){
        return $this->setData(self::COMMENT_STATUS_ID, $id);
    }

    public function getCommentCreatedAt(){
        return $this->_getData(self::COMMENT_CREATED_AT);
    }

    public function setCommentCreatedAt($createdAt){
        return $this->setData(self::COMMENT_CREATED_AT, $createdAt);
    }

    public function joinTable(){

    }
}
