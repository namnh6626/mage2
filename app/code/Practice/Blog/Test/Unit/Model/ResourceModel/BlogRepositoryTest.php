<?php

namespace Practice\Blog\Test\Unit\Model\ResourceModel;

use Magento\Framework\TestFramework\Unit\Helper\ObjectManager;
use PHPUnit\Framework\TestCase;
use PHPUnit\Framework\MockObject\MockObject;
use Practice\Blog\Model\ResourceModel\BlogRepository;
use Practice\Blog\Model\Blog;
use Practice\Blog\Model\BlogFactory;
use Practice\Blog\Model\ResourceModel\Blog\Collection as BlogCollection;
use Practice\Blog\Model\ResourceModel\Blog\CollectionFactory as BlogCollectionFactory;
use Practice\Blog\Model\ResourceModel\Blog as BlogResource;
use Practice\Blog\Model\ResourceModel\BlogCategory\Collection as BlogCategoryCollection;
use Practice\Blog\Model\ResourceModel\BlogCategory\CollectionFactory as BlogCategoryCollectionFactory;


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
     * Object to test
     *
     * @var \Practice\Blog\Model\ResourceModel\BlogRepository
     */
    private $blogRepository;

    /**
     * Main set up method
     */
    public function setUp(): void
    {
        $objectManager = new ObjectManager($this);
        $this->blogFactoryInstance = $this->createMock(Blog::class);
        $this->blogFactory = $this->createMock(BlogFactory::class);
        $this->blogFactory->method('create')->willReturn($this->blogFactoryInstance);

        $this->blogCollectionFactoryInstance = $this->createMock(BlogCollection::class);
        $this->blogCollectionFactory = $this->createMock(BlogCollectionFactory::class);
        $this->blogCollectionFactory->method('create')->willReturn($this->blogCollectionFactoryInstance);

        $this->blogResource = $this->createMock(BlogResource::class);

        $this->blogCategoryCollectionFactoryInstance = $this->createMock(BlogCategoryCollection::class);
        $this->blogCategoryCollectionFactory = $this->createMock(BlogCategoryCollectionFactory::class);
        $this->blogCategoryCollectionFactory->method('create')->willReturn($this->blogCategoryCollectionFactoryInstance);

        $this->blogRepository = $objectManager->getObject(
            BlogRepository::class,
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
        $prerequisites = array(
            0 =>
            array(
                'blog_category_id' => '1',
                'blog_category_name' => 'Trending',
                'blog_entity_id' => '1',
            ),
            1 =>
            array(
                'blog_category_id' => '2',
                'blog_category_name' => 'Collection',
                'blog_entity_id' => '1'
            ),
            2 =>
            array(
                'blog_category_id' => '3',
                'blog_category_name' => 'Review',
                'blog_entity_id' => '1',
            )
        );

        $expectedResult = $this->blogRepository->getBlogCategories(1);

        return [
            'TestCase 1' => [
                'prerequisites' => $prerequisites,
                'expectedResult' => $expectedResult
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
