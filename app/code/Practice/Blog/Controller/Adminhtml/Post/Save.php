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
use Magento\Framework\Message\ManagerInterface;




class Save extends Action
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
        BlogInterface $blogInterface,
        ManagerInterface $messageManagerInterface
    ) {
        parent::__construct($context);
        $this->blog = $blog;
        $this->pageFactory = $pageFactory;
        $this->resourceConnection = $resourceConnection;
        $this->authSession = $authSession;
        $this->blogRepository = $blogRepository;
        $this->blogInterface = $blogInterface;
        $this->messageManagerInterface = $messageManagerInterface;
    }

    /**
     * execute
     *
     * @return void
     */
    public function execute()
    {
        $params = $this->getRequest()->getParams();

        $blogTitle = $params['title'];

        $blogContent = $params['content'];
        $blogCategories = [];
        if(isset($params['category'])){
            $blogCategories = $params['category'];
        }
        $blogAvatar = $params['blog_avatar_link'];

        try {
            $this->blogInterface->setTitle($blogTitle);
            $this->blogInterface->setContent($blogContent);
            $this->blogInterface->setBlogAvatarLink($blogAvatar);
            $this->blogInterface->setUserId($this->authSession->getUser()->getId());
            $this->blogInterface->setBlogStatusId(Constant::APPROVED_STATUS_ID);

            $this->blogRepository->save($this->blogInterface);

            $blogId = $this->blogInterface->getBlogEntityId();

            $connection = $this->resourceConnection->getConnection();
            if(count($blogCategories) > 0){
                foreach ($blogCategories as $category) {

                    $sql = "INSERT INTO blog_category_value (blog_entity_id, blog_category_id) VALUES (${blogId}, ${category})";

                    $connection->query($sql);
                }
            }
            $this->messageManagerInterface->addSuccessMessage('Add Blog successfully');
        } catch (\Exception $e) {

            $this->messageManagerInterface->addErrorMessage('Add Blog failed');

        }

        return $this->_redirect('blog/post');
    }


}
