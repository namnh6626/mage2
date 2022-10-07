<?php
namespace Practice\Blog\Model;
use Magento\Framework\Model\AbstractModel;
use Practice\Blog\Api\Data\BlogNotificationInterface;

class BlogNotification extends AbstractModel implements BlogNotificationInterface{

    public function _construct()
    {
        $this->_init('\Practice\Blog\Model\ResourceModel\BlogNotification');

    }

    public function getBlogNotificationId(){
        return $this->_getData(self::BLOG_NOTIFICATION_ID);
    }

    public function setBlogNotificationId($notificationId){
        $this->setData(self::BLOG_NOTIFICATION_ID, $notificationId);
    }

    public function getTitle(){
        return $this->_getData(self::BLOG_NOTIFICATION_TITLE);
    }

    public function setTitle($text){
        $this->setData(self::BLOG_NOTIFICATION_TITLE, $text);
    }

    public function getDescription(){
        return $this->_getData(self::BLOG_NOTIFICATION_DES);
    }

    public function setDescription($text){
        $this->setData(self::BLOG_NOTIFICATION_DES, $text);
    }

    public function getIsRead(){
        return $this->_getData(self::BLOG_NOTIFICATION_IS_READ);
    }

    public function setIsRead($isRead){
        $this->setData(self::BLOG_NOTIFICATION_IS_READ, $isRead);
    }

    public function getCreatedAt(){
        return $this->_getData(self::BLOG_NOTIFICATION_CREATED_AT);
    }

    public function setCreatedAt($datetime){
        $this->setData(self::BLOG_NOTIFICATION_CREATED_AT, $datetime);
    }

    public function getCommentId(){
        return $this->_getData(self::BLOG_NOTIFICATION_COMMENT_ID);
    }

    public function setCommentId($commentId){
        $this->setData(self::BLOG_NOTIFICATION_COMMENT_ID, $commentId);
    }
}
