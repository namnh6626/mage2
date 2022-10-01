<?php
namespace Practice\Blog\Block\Adminhtml;

use Magento\Framework\View\Element\Template;
use Magento\Framework\View\Element\Template\Context;
use Practice\Blog\Model\ResourceModel\Blog\CollectionFactory as BlogCollectionFactory;

class AllBlog extends Template {
    protected $blogCollectionFactory;
    public function __construct(Context $context, array $data = [], BlogCollectionFactory $blogCollectionFactory)
    {
        $this->blogCollectionFactory = $blogCollectionFactory;
        parent::__construct($context, $data);
    }

    public function getAllBlog(){
        $blogCollection = $this->blogCollectionFactory->create();
        $blogCollection->getSelect()
            ->join('admin_user', 'admin_user.user_id=main_table.user_id', ['main_table.user_id'=>'author_id', 'firstname', 'lastname']);
        return $blogCollection;
    }

    public function getAll(){
        $blogCollection = $this->blogCollectionFactory->create();

        return $blogCollection;
    }
}
