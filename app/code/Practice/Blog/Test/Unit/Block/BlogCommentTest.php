<?php
namespace Practice\Blog\Test\Unit\Block;

use Magento\Framework\TestFramework\Unit\Helper\ObjectManager;
use PHPUnit\Framework\TestCase;
use PHPUnit\Framework\MockObject\MockObject;

/**
 * @covers \Practice\Blog\Block\BlogComment
 */
class BlogCommentTest extends TestCase
{

    /**
     * Mock commentRepository
     *
     * @var \Practice\Blog\Model\ResourceModel\CommentRepository|PHPUnit\Framework\MockObject\MockObject
     */
    private $commentRepository;

    /**
     * Mock commentInterface
     *
     * @var \Practice\Blog\Api\Data\CommentInterface|PHPUnit\Framework\MockObject\MockObject
     */
    private $commentInterface;

    /**
     * Mock sessionFactoryInstance
     *
     * @var \Magento\Customer\Model\Session|PHPUnit\Framework\MockObject\MockObject
     */
    private $sessionFactoryInstance;

    /**
     * Mock sessionFactory
     *
     * @var \Magento\Customer\Model\SessionFactory|PHPUnit\Framework\MockObject\MockObject
     */
    private $sessionFactory;

    /**
     * Object Manager instance
     *
     * @var \Magento\Framework\ObjectManagerInterface
     */
    private $objectManager;

    /**
     * Object to test
     *
     * @var \Practice\Blog\Block\BlogComment
     */
    private $block;

    /**
     * Main set up method
     */
    public function setUp() : void
    {
        $this->objectManager = new ObjectManager($this);

        $this->commentRepository = $this->createMock(\Practice\Blog\Model\ResourceModel\CommentRepository::class);
        $this->commentInterface = $this->getMockForAbstractClass(\Practice\Blog\Api\Data\CommentInterface::class);


        $this->sessionFactoryInstance = $this->createMock(\Magento\Customer\Model\Session::class);
        $this->sessionFactory = $this->createMock(\Magento\Customer\Model\SessionFactory::class);
        $this->sessionFactory->method('create')->willReturn($this->sessionFactoryInstance);

        $this->block = $this->objectManager->getObject(
        \Practice\Blog\Block\BlogComment::class,
            [
                'commentRepository' => $this->commentRepository,
                'commentInterface' => $this->commentInterface,
                'sessionFactory' => $this->sessionFactory,
            ]
        );
    }

    public function testGetIdentities()
    {

    }


    public function testGetBlogComment()
    {
    }


    public function testCheckIsLogin()
    {

    }


    public function testGetBlogId()
    {

    }



}
