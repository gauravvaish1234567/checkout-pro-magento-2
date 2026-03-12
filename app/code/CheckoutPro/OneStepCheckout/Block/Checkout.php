<?php

declare(strict_types=1);

namespace CheckoutPro\OneStepCheckout\Block;

use CheckoutPro\OneStepCheckout\Model\Config;
use Magento\Checkout\Model\CompositeConfigProvider;
use Magento\Framework\Serialize\Serializer\Json;
use Magento\Framework\View\Element\Template;

class Checkout extends Template
{
    public function __construct(
        Template\Context $context,
        private readonly CompositeConfigProvider $compositeConfigProvider,
        private readonly Config $config,
        private readonly Json $json,
        array $data = []
    ) {
        parent::__construct($context, $data);
    }

    public function getSerializedCheckoutConfig(): string
    {
        return $this->json->serialize($this->compositeConfigProvider->getConfig());
    }

    public function isEnabled(): bool
    {
        return $this->config->isEnabled();
    }
}
