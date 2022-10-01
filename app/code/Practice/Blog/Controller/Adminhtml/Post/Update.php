<?php

namespace Practice\Blog\Controller\Adminhtml\Post;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;
use Practice\Blog\Model\Blog;
use Practice\Blog\Constant\Constant;
use Magento\Framework\App\ResourceConnection;
use Magento\Backend\Model\Auth\Session;

class Update extends Action
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
        if (isset($params['category'])) {
            $blogCategories = $params['category'];
        }
        $blogAvatar = $params['blog_avatar_link'];
        $blogId = $params['blog_entity_id'];



        $blog = $this->blog->load($blogId, 'blog_entity_id');

        $blog->setData('title', $blogTitle);
        $blog->setData('content', $blogContent);
        $blog->setData('blog_avatar_link', $blogAvatar);
        $blog->setData('user_id', $this->authSession->getUser()->getId());

        $blog->save();


        $connection = $this->resourceConnection->getConnection();
        if (count($blogCategories) > 0) {

            $sql = "DELETE FROM blog_category_value WHERE blog_entity_id = ${blogId}";

            $connection->query($sql);

            foreach ($blogCategories as $category) {

                $sql = "INSERT INTO blog_category_value (blog_entity_id, blog_category_id) VALUES (${blogId}, ${category})";

                $connection->query($sql);
            }
        }
        return $this->_redirect('blog/post');
    }
}
