<?php
namespace Practice\Blog\Model\ResourceModel;

use Practice\Blog\Api\CommentRepositoryInterface;
use Practice\Blog\Api\Data\CommentInterface;
use Practice\Blog\Model\CommentFactory;
use Practice\Blog\Model\ResourceModel\Comment as CommentResource;
use Practice\Blog\Model\ResourceModel\Comment\CollectionFactory as CommentCollectionFactory;
use Magento\Framework\Api\ExtensionAttribute\JoinDataInterfaceFactory;

class CommentRepository implements CommentRepositoryInterface{

    protected $commentFactory;
    protected $commentResource;
    protected $commentCollectionFactory;

    public function __construct(
        CommentFactory $commentFactory,
        CommentResource $commentResource,
        CommentCollectionFactory $commentCollectionFactory
        )
    {
        $this->commentFactory = $commentFactory;
        $this->commentResource = $commentResource;
        $this->commentCollectionFactory = $commentCollectionFactory;
    }

    public function save(CommentInterface $commentInterface){

    }

    public function getList(CommentInterface $commentInterface)
    {
        $commentCollection = $this->commentFactory->create();
        return $commentCollection;
    }

}
