<?php

namespace Practice\Blog\Test\Unit\Block;

use Magento\Framework\TestFramework\Unit\Helper\ObjectManager;
use PHPUnit\Framework\TestCase;
use PHPUnit\Framework\MockObject\MockObject;
use Magento\Framework\View\Element\Template\Context;
use Practice\Blog\Model\ResourceModel\Blog\Collection;
use Practice\Blog\Model\ResourceModel\Blog\CollectionFactory;
use Practice\Blog\Model\ResourceModel\BlogRepository;
use Practice\Blog\Api\Data\BlogInterface;


/**
 * @covers \Practice\Blog\Block\AllBlog
 */
class AllBlogTest extends TestCase
{

    /**
     * Mock blogCollectionFactory
     *
     * @var CollectionFactory|MockObject
     */
    private $blogCollectionFactory;


    /**
     * Mock constant
     *
     * @var Constant|MockObject
     */
    private $constant;

    /**
     * Mock blogRepository
     *
     * @var BlogRepository|MockObject
     */
    private $blogRepository;

    /**
     * Mock blogInterface
     *
     * @var BlogInterface|MockObject
     */
    private $blogInterface;

    /**
     * Object Manager instance
     *
     * @var \Magento\Framework\ObjectManagerInterface
     */
    private $objectManager;

    /**
     * Object to test
     *
     * @var \Practice\Blog\Block\AllBlog
     */
    private $block;

    /**
     * Main set up method
     */
    public function setUp(): void
    {
        $this->objectManager = new ObjectManager($this);
        $this->context = $this->createMock(\Magento\Framework\View\Element\Template\Context::class);

        $this->blogCollectionFactory =
            $this->createPartialMock(CollectionFactory::class, ['create']);

        $this->constant = $this->createMock(\Practice\Blog\Constant\Constant::class);

        $this->blogRepository =
            $this->createMock(\Practice\Blog\Model\ResourceModel\BlogRepository::class);

        $this->blogInterface = $this->getMockForAbstractClass(BlogInterface::class);
        $this->block = $this->objectManager->getObject(
            \Practice\Blog\Block\AllBlog::class,
            [
                'blogCollectionFactory' => $this->blogCollectionFactory,
                'blogRepository' => $this->blogRepository,
                'blogInterface' => $this->blogInterface,
            ]
        );
    }

    public function testGetBlogPaginate()
    {
        $blogCollection = $this->createMock(Collection::class);

        $result = $this->blogRepository->expects($this->any())->method('getList')->with($this->blogInterface)->willReturn($blogCollection);
        return $this->assertIsObject($result);
    }

    public function testGetTotalPage()
    {
        // $blogCollectionFactory = $this->getMockBuilder(CollectionFactory::class)->disableOriginalConstructor()->setMethods(['create', 'count'])->getMock();
        $collection = $this->createMock(CollectionFactory::class)->expects($this->once())->method('count')->willReturn(600);

        return $this->assertEquals(10, $collection);
    }
}
