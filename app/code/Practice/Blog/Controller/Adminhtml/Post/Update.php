<?php

namespace Practice\Blog\Controller\Adminhtml\Post;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;
use Practice\Blog\Model\Blog;
use Practice\Blog\Constant\Constant;
use Magento\Framework\App\ResourceConnection;
use Magento\Backend\Model\Auth\Session;
use Practice\Blog\Model\ResourceModel\BlogRepository;
use Practice\Blog\Api\Data\BlogInterface;

class Update extends Action
{
    protected $pageFactory;
    protected $blog;
    protected $resourceConnection;
    protected $authSession;
    protected $blogRepository;
    protected $blogInterface;

    public function __construct(
        Context $context,
        PageFactory $pageFactory,
        Blog $blog,
        ResourceConnection $resourceConnection,
        Session $authSession,
        BlogRepository $blogRepository,
        BlogInterface $blogInterface
    ) {
        $this->blog = $blog;
        $this->pageFactory = $pageFactory;
        $this->resourceConnection = $resourceConnection;
        $this->authSession = $authSession;
        $this->blogRepository = $blogRepository;
        $this->blogInterface = $blogInterface;

        parent::__construct($context);
    }

    public function execute()
    {
        $params = $this->getRequest()->getParams();

        $blogCategories = [];
        $blogTitle = $params['title'];
        $blogContent = $params['content'];
        if (isset($params['category'])) {
            $blogCategories = $params['category'];
        }
        $blogAvatar = $params['blog_avatar_link'];
        $blogId = $params['blog_entity_id'];

        $blog = $this->blogRepository->getById($blogId);

        $this->blogInterface->setTitle($blogTitle);
        $this->blogInterface->setContent($blogContent);
        $this->blogInterface->setBlogAvatarLink($blogAvatar);
        $this->blogInterface->setUserId($this->authSession->getUser()->getId());

        try {
            $this->blogRepository->update($this->blogInterface, $blog);

            $connection = $this->resourceConnection->getConnection();
            if (count($blogCategories) > 0) {

                $sql = "DELETE FROM blog_category_value WHERE blog_entity_id = ${blogId}";

                $connection->query($sql);

                foreach ($blogCategories as $category) {

                    $sql = "INSERT INTO blog_category_value (blog_entity_id, blog_category_id) VALUES (${blogId}, ${category})";

                    $connection->query($sql);
                }
            }

            $typeCacheCode = $this->blogRepository->getIdentities();

            $this->_eventManager->dispatch('invalidate_page', ['type_code'=>$typeCacheCode]);

        } catch (\Exception $e) {

        }
        return $this->_redirect('blog/post');
    }
}
