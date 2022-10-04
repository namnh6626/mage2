<?php

namespace Practice\Blog\Api\Data;

use Magento\Framework\Api\ExtensibleDataInterface;

interface BlogInterface extends ExtensibleDataInterface
{
    CONST BLOG_ENTITY_ID = 'blog_entity_id';
    CONST BLOG_CONTENT = 'content';
    CONST BLOG_TITLE = 'title';
    CONST BLOG_USER_ID = 'user_id';
    CONST BLOG_AVATAR = 'blog_avatar_link';
    CONST BLOG_CREATED_AT = 'created_at';


    // public function getBlogEntityId();

    // public function setBlogEntityId($id);

    public function getTitle();

    public function setTitle($title);

    public function getContent();

    public function setContent($content);

    public function getUserId();

    public function setUserId($userId);

    public function getBlogAvatarLink();

    public function setBlogAvatarLink($link);

}
