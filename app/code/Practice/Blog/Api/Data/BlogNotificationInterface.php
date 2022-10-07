<?php
namespace Practice\Blog\Api\Data;

use Magento\Framework\Api\ExtensibleDataInterface;

interface BlogNotificationInterface extends ExtensibleDataInterface{
    CONST BLOG_NOTIFICATION_ID = 'blog_notification_id';
    CONST BLOG_NOTIFICATION_TITLE = 'title';
    CONST BLOG_NOTIFICATION_DES = 'description';
    CONST BLOG_NOTIFICATION_IS_READ = 'is_read';
    CONST BLOG_NOTIFICATION_CREATED_AT = 'created_at';
    CONST BLOG_NOTIFICATION_COMMENT_ID = 'comment_id';

    public function getBlogNotificationId();

    public function setBlogNotificationId($notificationId);

    public function getTitle();

    public function setTitle($text);

    public function getDescription();

    public function setDescription($text);

    public function getIsRead();

    public function setIsRead($isRead);

    public function getCreatedAt();

    public function setCreatedAt($datetime);

    public function getCommentId();

    public function setCommentId($commentId);

}
