<?php
namespace Practice\Blog\Test\Unit\Model;

use Magento\Framework\TestFramework\Unit\Helper\ObjectManager;
use PHPUnit\Framework\TestCase;
use PHPUnit\Framework\MockObject\MockObject;
use Practice\Blog\Api\Data\BlogInterface;
use Practice\Blog\Model\Blog;

/**
 * @covers \Practice\Blog\Model\Blog
 */
class BlogTest extends TestCase
{
    /**
     * Mock context
     *
     * @var \Magento\Framework\Model\Context|PHPUnit\Framework\MockObject\MockObject
     */
    private $context;

    /**
     * Mock registry
     *
     * @var \Practice\Blog\Api\Data\BlogInterface|PHPUnit\Framework\MockObject\MockObject
     */
    private $blogInterface;


    /**
     * Mock registry
     *
     * @var \Magento\Framework\Registry|PHPUnit\Framework\MockObject\MockObject
     */
    private $registry;

    /**
     * Mock resource
     *
     * @var \Magento\Framework\Model\ResourceModel\AbstractResource|PHPUnit\Framework\MockObject\MockObject
     */
    private $resource;

    /**
     * Mock resourceCollection
     *
     * @var \Magento\Framework\Data\Collection\AbstractDb|PHPUnit\Framework\MockObject\MockObject
     */
    private $resourceCollection;


    /**
     * Object Manager instance
     *
     * @var \Magento\Framework\ObjectManagerInterface
     */
    private $objectManager;

    /**
     * Object to test
     *
     * @var \Practice\Blog\Model\Blog
     */
    private $blog;

    /**
     * Main set up method
     */
    public function setUp() : void
    {
        $this->objectManager = new ObjectManager($this);
        $this->context = $this->createMock(\Magento\Framework\Model\Context::class);

        $this->registry = $this->createMock(\Magento\Framework\Registry::class);

        $this->resource = $this->createMock(\Magento\Framework\Model\ResourceModel\AbstractResource::class);

        $this->resourceCollection = $this->createMock(\Magento\Framework\Data\Collection\AbstractDb::class);

        $this->blogInterface = $this->getMockForAbstractClass(BlogInterface::class);

        // $this->blog = $this->objectManager->getObject(
        // \Practice\Blog\Model\Blog::class,
        //     [
        //         'context' => $this->context,
        //         'registry' => $this->registry,
        //         'resource' => $this->resource,
        //         'resourceCollection' => $this->resourceCollection,
        //         'data' => [],
        //     ]
        // );
    }




    public function testGetBlogEntityId()
    {
        $expect = 1;
        $blog = $this->getMockBuilder(Blog::class)->disableOriginalConstructor()->getMock();
        $blog->expects($this->once())->method('getBlogEntityId')->willReturn($expect);

        $this->assertEquals($expect, $blog->getBlogEntityId());
    }


    public function testGetTitle()
    {

        $expect = 'Title';
        $blog = $this->getMockBuilder(Blog::class)->disableOriginalConstructor()->getMock();
        $blog->expects($this->once())->method('getTitle')->willReturn($expect);

        $this->assertEquals($expect, $blog->getTitle());
    }



    public function testGetContent()
    {

        $expect = 'Content';
        $blog = $this->getMockBuilder(Blog::class)->disableOriginalConstructor()->getMock();
        $blog->expects($this->once())->method('getContent')->willReturn($expect);

        $this->assertEquals($expect, $blog->getContent());
    }


    public function testGetUserId()
    {
        $expect = 1;
        $blog = $this->getMockBuilder(Blog::class)->disableOriginalConstructor()->getMock();
        $blog->expects($this->once())->method('getUserId')->willReturn($expect);

        $this->assertEquals($expect, $blog->getUserId());
    }


    public function testGetBlogStatusId()
    {
        $expect = 1;
        $blog = $this->getMockBuilder(Blog::class)->disableOriginalConstructor()->getMock();
        $blog->expects($this->once())->method('getBlogStatusId')->willReturn($expect);

        $this->assertEquals($expect, $blog->getBlogStatusId());
    }


    public function testGetIdentities()
    {
    }


}
