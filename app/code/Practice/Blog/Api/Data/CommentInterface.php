<?php
namespace Practice\Blog\Api\Data;

use Magento\Framework\Api\ExtensibleDataInterface;

interface CommentInterface extends ExtensibleDataInterface {
    CONST COMMENT_ENTITY_ID = 'comment_entity_id';
    CONST COMMENT_CONTENT = 'content';
    CONST COMMENT_BLOG_ID = 'blog_entity_id';
    CONST COMMENT_CUSTOMER_ID = 'customer_id';
    CONST COMMENT_STATUS_ID = 'comment_status_id';
    CONST COMMENT_CREATED_AT = 'created_at';

    public function getContent();

    public function setContent($content);

    public function getCommentBlogId();

    public function setCommentBlogId($blogId);

    public function getCommentCustomerId();

    public function setCommentCustomerId($id);

    public function getCommentStatusId();

    public function setCommentStatusId($id);

    public function getCommentCreatedAt();

    public function setCommentCreatedAt($createdAt);
}
