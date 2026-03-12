<?php

declare(strict_types=1);

namespace CheckoutPro\OneStepCheckout\Controller\Index;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\Controller\Result\Page;
use Magento\Framework\Controller\Result\PageFactory;

class Index extends Action
{
    public function __construct(
        Context $context,
        private readonly PageFactory $pageFactory
    ) {
        parent::__construct($context);
    }

    public function execute(): Page
    {
        $page = $this->pageFactory->create();
        $page->getConfig()->getTitle()->set(__('One-Step Checkout Pro'));

        return $page;
    }
}
