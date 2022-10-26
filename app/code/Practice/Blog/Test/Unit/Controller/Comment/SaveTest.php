<?php

namespace Practice\Blog\Test\Unit\Controller\Comment;

use Magento\Framework\TestFramework\Unit\Helper\ObjectManager;
use PHPUnit\Framework\TestCase;
use PHPUnit\Framework\MockObject\MockObject;

/**
 * @covers \Practice\Blog\Controller\Comment\Save
 */
class SaveTest extends TestCase
{
    /**
     * Mock context
     *
     * @var \Magento\Framework\App\Action\Context|PHPUnit\Framework\MockObject\MockObject
     */
    private $context;

    /**
     * Mock logger
     *
     * @var \Psr\Log\LoggerInterface|PHPUnit\Framework\MockObject\MockObject
     */
    private $logger;

    /**
     * Mock jsonFactoryInstance
     *
     * @var \Magento\Framework\Controller\Result\Json|PHPUnit\Framework\MockObject\MockObject
     */
    private $jsonFactoryInstance;

    /**
     * Mock jsonFactory
     *
     * @var \Magento\Framework\Controller\Result\JsonFactory|PHPUnit\Framework\MockObject\MockObject
     */
    private $jsonFactory;

    /**
     * Mock customerSessionInstance
     *
     * @var \Magento\Customer\Model\Session|PHPUnit\Framework\MockObject\MockObject
     */
    private $customerSessionInstance;

    /**
     * Mock customerSession
     *
     * @var \Magento\Customer\Model\SessionFactory|PHPUnit\Framework\MockObject\MockObject
     */
    private $customerSession;

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
     * Object Manager instance
     *
     * @var \Magento\Framework\ObjectManagerInterface
     */
    private $objectManager;

    /**
     * Object to test
     *
     * @var \Practice\Blog\Controller\Comment\Save
     */
    private $testObject;

    /**
     * Main set up method
     */
    public function setUp(): void
    {
        $this->objectManager = new ObjectManager($this);
        $this->context = $this->createMock(\Magento\Framework\App\Action\Context::class);
        $this->logger = $this->createMock(\Psr\Log\LoggerInterface::class);
        $this->jsonFactoryInstance = $this->createMock(\Magento\Framework\Controller\Result\Json::class);
        $this->jsonFactory = $this->createMock(\Magento\Framework\Controller\Result\JsonFactory::class);
        $this->jsonFactory->method('create')->willReturn($this->jsonFactoryInstance);
        $this->customerSessionInstance = $this->createMock(\Magento\Customer\Model\Session::class);
        $this->customerSession = $this->createMock(\Magento\Customer\Model\SessionFactory::class);
        $this->customerSession->method('create')->willReturn($this->customerSessionInstance);
        $this->commentRepository = $this->createMock(\Practice\Blog\Model\ResourceModel\CommentRepository::class);
        $this->commentInterface = $this->createMock(\Practice\Blog\Api\Data\CommentInterface::class);
        $this->testObject = $this->objectManager->getObject(
            \Practice\Blog\Controller\Comment\Save::class,
            [
                'context' => $this->context,
                'logger' => $this->logger,
                'jsonFactory' => $this->jsonFactory,
                'customerSession' => $this->customerSession,
                'commentRepository' => $this->commentRepository,
                'commentInterface' => $this->commentInterface,
            ]
        );
    }

    public function testExecute()
    {

    }
}
