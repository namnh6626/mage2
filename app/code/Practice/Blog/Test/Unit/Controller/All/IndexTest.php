<?php

namespace Practice\Blog\Test\Unit\Controller\All;

use Magento\Framework\TestFramework\Unit\Helper\ObjectManager;
use PHPUnit\Framework\TestCase;
use PHPUnit\Framework\MockObject\MockObject;
use Magento\Framework\App\Action\Context;


/**
 * @covers \Practice\Blog\Controller\All\Index
 */
class IndexTest extends TestCase
{
    /**
     * Mock context
     *
     * @var \Magento\Framework\App\Action\Context|PHPUnit\Framework\MockObject\MockObject
     */
    private $context;

    /**
     * Mock pageFactoryInstance
     *
     * @var \Magento\Framework\View\Result\Page|PHPUnit\Framework\MockObject\MockObject
     */
    private $pageFactoryInstance;

    /**
     * Mock pageFactory
     *
     * @var \Magento\Framework\View\Result\PageFactory|PHPUnit\Framework\MockObject\MockObject
     */
    private $pageFactory;

    /**
     * Mock blog
     *
     * @var \Practice\Blog\Model\Blog|PHPUnit\Framework\MockObject\MockObject
     */
    private $blog;

    /**
     * Mock commentInterface
     *
     * @var \Practice\Blog\Api\Data\CommentInterface|PHPUnit\Framework\MockObject\MockObject
     */
    private $commentInterface;

    /**
     * Mock commentRepository
     *
     * @var \Practice\Blog\Model\ResourceModel\CommentRepository|PHPUnit\Framework\MockObject\MockObject
     */
    private $commentRepository;

    /**
     * Object Manager instance
     *
     * @var \Magento\Framework\ObjectManagerInterface
     */
    private $objectManager;

    /**
     * Object to test
     *
     * @var \Practice\Blog\Controller\All\Index
     */
    private $action;

    /**
     * Main set up method
     */
    public function setUp(): void
    {
        $this->objectManager = new ObjectManager($this);

        $this->context =  $this->getMockBuilder(Context::class)
        ->disableOriginalConstructor()
        ->getMock();

        $this->pageFactoryInstance = $this->createMock(\Magento\Framework\View\Result\Page::class);
        $this->pageFactory = $this->createMock(\Magento\Framework\View\Result\PageFactory::class);
        $this->pageFactory->method('create')->willReturn($this->pageFactoryInstance);
        $this->blog = $this->createMock(\Practice\Blog\Model\Blog::class);
        $this->commentInterface = $this->createMock(\Practice\Blog\Api\Data\CommentInterface::class);
        $this->commentRepository = $this->createMock(\Practice\Blog\Model\ResourceModel\CommentRepository::class);

        $this->action = $this->objectManager->getObject(
            \Practice\Blog\Controller\All\Index::class,
            [
                'context' => $this->context,
                'pageFactory' => $this->pageFactory,
                'blog' => $this->blog,
                'commentInterface' => $this->commentInterface,
                'commentRepository' => $this->commentRepository,
            ]
        );
    }

    public function testExecute()
    {

    }


}
