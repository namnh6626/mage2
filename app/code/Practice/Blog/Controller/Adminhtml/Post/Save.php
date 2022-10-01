<?php

namespace Practice\Blog\Controller\Adminhtml\Post;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;
use Practice\Blog\Model\Blog;
use Practice\Blog\Constant\Constant;
use Magento\Framework\App\ResourceConnection;
use Magento\Backend\Model\Auth\Session;

class Save extends Action
{
    protected $pageFactory;
    protected $blog;
    protected $resourceConnection;
    protected $authSession;

    public function __construct(
        Context $context,
        PageFactory $pageFactory,
        Blog $blog,
        ResourceConnection $resourceConnection,
        Session $authSession
    ) {
        $this->blog = $blog;
        $this->pageFactory = $pageFactory;
        $this->resourceConnection = $resourceConnection;
        $this->authSession = $authSession;
        parent::__construct($context);
    }

    public function execute()
    {
        $params = $this->getRequest()->getParams();

        $blogTitle = $params['title'];
        $blogContent = $params['content'];
        if(isset($params['category'])){
            $blogCategories = $params['category'];
        }
        $blogAvatar = $params['blog_avatar_link'];

        $this->blog->setData('title', $blogTitle);
        $this->blog->setData('content', $blogContent);
        $this->blog->setData('blog_avatar_link', $blogAvatar);
        $this->blog->setData('user_id', $this->authSession->getUser()->getId());

        $this->blog->save();

        $blogId = $this->blog->getData('blog_entity_id');


        $connection = $this->resourceConnection->getConnection();
        if(count($blogCategories) > 0){
            foreach ($blogCategories as $category) {

                $sql = "INSERT INTO blog_category_value (blog_entity_id, blog_category_id) VALUES (${blogId}, ${category})";

                $connection->query($sql);
            }

        }
        return $this->_redirect('blog/post');
    }
}
