<?php

namespace Practice\Blog\Cron;

use Psr\Log\LoggerInterface;
use Practice\Blog\Helper\Email;
use Practice\Blog\Constant\Constant;

class EmailRemindApproveComment
{
    protected $logger;
    protected $helperEmail;

    public function __construct(LoggerInterface $logger, Email $helperEmail)
    {
        $this->logger = $logger;
        $this->helperEmail = $helperEmail;
    }

    /**
     * Write to system.log
     *
     * @return void
     */
    public function execute()
    {
        $emailSender = Constant::EMAIL_SENDER_COMMENT_SUCCESS;
        $nameSender = Constant::NAME_SENDER_COMMENT_SUCCESS;
        $addToEmail = Constant::ADMIN_EMAIL;
        $this->helperEmail->sendEmail($nameSender, $emailSender, $addToEmail);
        return $this->logger->info('Email was sent');
    }
}
