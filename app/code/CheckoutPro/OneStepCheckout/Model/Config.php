<?php

declare(strict_types=1);

namespace CheckoutPro\OneStepCheckout\Model;

use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Store\Model\ScopeInterface;

class Config
{
    private const XML_PATH_ENABLED = 'checkoutpro_onestepcheckout/general/enabled';
    private const XML_PATH_REDIRECT_MODE = 'checkoutpro_onestepcheckout/general/redirect_mode';

    public function __construct(private readonly ScopeConfigInterface $scopeConfig)
    {
    }

    public function isEnabled(?int $storeId = null): bool
    {
        return $this->scopeConfig->isSetFlag(self::XML_PATH_ENABLED, ScopeInterface::SCOPE_STORE, $storeId);
    }

    public function getRedirectMode(?int $storeId = null): string
    {
        return (string) $this->scopeConfig->getValue(self::XML_PATH_REDIRECT_MODE, ScopeInterface::SCOPE_STORE, $storeId);
    }

    public function shouldRedirectFromDefaultCheckout(?int $storeId = null): bool
    {
        return $this->getRedirectMode($storeId) === Config\Source\RedirectMode::DEFAULT_TO_ONE_STEP;
    }
}
