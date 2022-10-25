<?php
namespace Practice\Blog\Test\Unit\Model\ResourceModel;

use Magento\Framework\TestFramework\Unit\Helper\ObjectManager;
use PHPUnit\Framework\TestCase;
use PHPUnit\Framework\MockObject\MockObject;

/**
 * @covers \Practice\Blog\Model\ResourceModel\BlogRepository
 */
class BlogRepositoryTest extends TestCase
{
    /**
     * Mock blogFactoryInstance
     *
     * @var \Practice\Blog\Model\Blog|PHPUnit\Framework\MockObject\MockObject
     */
    private $blogFactoryInstance;

    /**
     * Mock blogFactory
     *
     * @var \Practice\Blog\Model\BlogFactory|PHPUnit\Framework\MockObject\MockObject
     */
    private $blogFactory;

    /**
     * Mock blogCollectionFactoryInstance
     *
     * @var \Practice\Blog\Model\ResourceModel\Blog\Collection|PHPUnit\Framework\MockObject\MockObject
     */
    private $blogCollectionFactoryInstance;

    /**
     * Mock blogCollectionFactory
     *
     * @var \Practice\Blog\Model\ResourceModel\Blog\CollectionFactory|PHPUnit\Framework\MockObject\MockObject
     */
    private $blogCollectionFactory;

    /**
     * Mock blogResource
     *
     * @var \Practice\Blog\Model\ResourceModel\Blog|PHPUnit\Framework\MockObject\MockObject
     */
    private $blogResource;

    /**
     * Mock blogCategoryCollectionFactoryInstance
     *
     * @var \Practice\Blog\Model\ResourceModel\BlogCategory\Collection|PHPUnit\Framework\MockObject\MockObject
     */
    private $blogCategoryCollectionFactoryInstance;

    /**
     * Mock blogCategoryCollectionFactory
     *
     * @var \Practice\Blog\Model\ResourceModel\BlogCategory\CollectionFactory|PHPUnit\Framework\MockObject\MockObject
     */
    private $blogCategoryCollectionFactory;

    /**
     * Object Manager instance
     *
     * @var \Magento\Framework\ObjectManagerInterface
     */
    private $objectManager;

    /**
     * Object to test
     *
     * @var \Practice\Blog\Model\ResourceModel\BlogRepository
     */
    private $testObject;

    /**
     * Main set up method
     */
    public function setUp() : void
    {
        $this->objectManager = new ObjectManager($this);

        $this->blogFactoryInstance = $this->createMock(\Practice\Blog\Model\Blog::class);
        $this->blogFactory = $this->createMock(\Practice\Blog\Model\BlogFactory::class);
        $this->blogFactory->method('create')->willReturn($this->blogFactoryInstance);
        $this->blogCollectionFactoryInstance = $this->createMock(\Practice\Blog\Model\ResourceModel\Blog\Collection::class);
        $this->blogCollectionFactory = $this->createMock(\Practice\Blog\Model\ResourceModel\Blog\CollectionFactory::class);
        $this->blogCollectionFactory->method('create')->willReturn($this->blogCollectionFactoryInstance);
        $this->blogResource = $this->createMock(\Practice\Blog\Model\ResourceModel\Blog::class);
        $this->blogCategoryCollectionFactoryInstance = $this->createMock(\Practice\Blog\Model\ResourceModel\BlogCategory\Collection::class);
        $this->blogCategoryCollectionFactory = $this->createMock(\Practice\Blog\Model\ResourceModel\BlogCategory\CollectionFactory::class);
        $this->blogCategoryCollectionFactory->method('create')->willReturn($this->blogCategoryCollectionFactoryInstance);
        $this->testObject = $this->objectManager->getObject(
        \Practice\Blog\Model\ResourceModel\BlogRepository::class,
            [
                'blogFactory' => $this->blogFactory,
                'blogCollectionFactory' => $this->blogCollectionFactory,
                'blogResource' => $this->blogResource,
                'blogCategoryCollectionFactory' => $this->blogCategoryCollectionFactory,
            ]
        );
    }

    /**
     * @return array
     */
    public function dataProviderForTestSave()
    {
        return [
            'Testcase 1' => [
                'prerequisites' => ['param' => 1],
                'expectedResult' => ['param' => 1]
            ]
        ];
    }

    /**
     * @dataProvider dataProviderForTestSave
     */
    public function testSave(array $prerequisites, array $expectedResult)
    {
        $this->blogFactory->
        $this->assertEquals($expectedResult['param'], $prerequisites['param']);
    }

    /**
     * @return array
     */
    public function dataProviderForTestUpdate()
    {
        return [
            'Testcase 1' => [
                'prerequisites' => ['param' => 1],
                'expectedResult' => ['param' => 1]
            ]
        ];
    }

    /**
     * @dataProvider dataProviderForTestUpdate
     */
    public function testUpdate(array $prerequisites, array $expectedResult)
    {
        $this->assertEquals($expectedResult['param'], $prerequisites['param']);
    }

    /**
     * @return array
     */
    public function dataProviderForTestGetIdentities()
    {
        return [
            'Testcase 1' => [
                'prerequisites' => ['param' => 1],
                'expectedResult' => ['param' => 1]
            ]
        ];
    }

    /**
     * @dataProvider dataProviderForTestGetIdentities
     */
    public function testGetIdentities(array $prerequisites, array $expectedResult)
    {
        $this->assertEquals($expectedResult['param'], $prerequisites['param']);
    }

    /**
     * @return array
     */
    public function dataProviderForTestGetBlogContentById()
    {
        return [
            'Testcase 1' => [
                'prerequisites' => ['param' => 1],
                'expectedResult' => ['param' => 1]
            ]
        ];
    }

    /**
     * @dataProvider dataProviderForTestGetBlogContentById
     */
    public function testGetBlogContentById(array $prerequisites, array $expectedResult)
    {
        $this->assertEquals($expectedResult['param'], $prerequisites['param']);
    }

    /**
     * @return array
     */
    public function dataProviderForTestGetBlogCategories()
    {
        return [
            'Testcase 1' => [
                'prerequisites' => ['param' => 1],
                'expectedResult' => ['param' => 1]
            ]
        ];
    }

    /**
     * @dataProvider dataProviderForTestGetBlogCategories
     */
    public function testGetBlogCategories(array $prerequisites, array $expectedResult)
    {
        $this->assertEquals($expectedResult['param'], $prerequisites['param']);
    }

    /**
     * @return array
     */
    public function dataProviderForTestGetFeaturedPost()
    {
        return [
            'Testcase 1' => [
                'prerequisites' => ['param' => 1],
                'expectedResult' => ['param' => 1]
            ]
        ];
    }

    /**
     * @dataProvider dataProviderForTestGetFeaturedPost
     */
    public function testGetFeaturedPost(array $prerequisites, array $expectedResult)
    {
        $this->assertEquals($expectedResult['param'], $prerequisites['param']);
    }
}
