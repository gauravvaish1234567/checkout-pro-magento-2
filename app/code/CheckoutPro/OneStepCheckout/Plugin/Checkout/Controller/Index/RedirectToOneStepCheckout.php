<?php

declare(strict_types=1);

namespace CheckoutPro\OneStepCheckout\Plugin\Checkout\Controller\Index;

use CheckoutPro\OneStepCheckout\Model\Config;
use Magento\Checkout\Controller\Index\Index;
use Magento\Framework\App\Action\Context;
use Magento\Framework\Controller\Result\RedirectFactory;
use Magento\Framework\Controller\ResultInterface;

class RedirectToOneStepCheckout
{
    public function __construct(
        private readonly Config $config,
        private readonly RedirectFactory $redirectFactory,
        private readonly Context $context
    ) {
    }

    public function aroundExecute(Index $subject, callable $proceed): ResultInterface
    {
        if (!$this->config->isEnabled() || !$this->config->shouldRedirectFromDefaultCheckout()) {
            return $proceed();
        }

        $resultRedirect = $this->redirectFactory->create();
        $resultRedirect->setPath('onestepcheckout/index/index');

        return $resultRedirect;
    }
}
