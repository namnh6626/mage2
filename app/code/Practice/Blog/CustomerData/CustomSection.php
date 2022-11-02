<?php

namespace Practice\Blog\CustomerData;

use Magento\Customer\CustomerData\SectionSourceInterface;
use Practice\Blog\Model\ResourceModel\CommentRepository;
use Magento\Customer\Model\SessionFactory;
use Magento\Store\Model\StoreManagerInterface;
use Magento\Framework\App\RequestInterface;
use Practice\Blog\Constant\Constant;
use Practice\Blog\Model\ResourceModel\BlogRepository;

class CustomSection implements SectionSourceInterface
{
    protected $commentRepository;
    protected $customerSession;
    protected $storeManager;
    protected $request;
    protected $blogRepository;

    public function __construct(
        CommentRepository $commentRepository,
        SessionFactory $sessionFactory,
        StoreManagerInterface $storeManager,
        RequestInterface $request,
        BlogRepository $blogRepository
    )
    {
        $this->commentRepository = $commentRepository;
        $this->customerSession = $sessionFactory->create();
        $this->storeManager = $storeManager;
        $this->request = $request;
        $this->blogRepository = $blogRepository;
    }

    public function getSectionData()
    {
        $customerId = $this->customerSession->getId();
        $currentBlogId = $this->request->getParam(Constant::ID_PARAM);
        if($currentBlogId == null){
            $currentBlogId = 0;
        }
        $baseUrl = $this->storeManager->getStore()->getBaseUrl();

        $blogIdsComment = $this->commentRepository->getBlogIdsCommented($customerId, $currentBlogId);

        $blogIdArr = [];
        foreach($blogIdsComment as $blog){
            $blogIdArr[] = $blog->getBlogEntityId();
        }
        $recentBlogIdCommentArr = array_slice(array_unique($blogIdArr), 0, 5, true);

        $data = [];

        foreach($recentBlogIdCommentArr as $id){
            $element = $this->blogRepository->getBlogTitleById($id)->getData()[0];
            $element['url'] = $baseUrl.'blog/show/'.Constant::ID_PARAM.'/'.$id;
            $data[] = $element;
        }

        return [
            'data' => $data,
        ];
    }
}
