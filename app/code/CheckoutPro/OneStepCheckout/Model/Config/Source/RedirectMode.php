<?php

declare(strict_types=1);

namespace CheckoutPro\OneStepCheckout\Model\Config\Source;

use Magento\Framework\Data\OptionSourceInterface;

class RedirectMode implements OptionSourceInterface
{
    public const KEEP_DEFAULT = 'keep_default';
    public const DEFAULT_TO_ONE_STEP = 'default_to_one_step';

    public function toOptionArray(): array
    {
        return [
            ['value' => self::KEEP_DEFAULT, 'label' => __('Keep Magento default checkout')],
            ['value' => self::DEFAULT_TO_ONE_STEP, 'label' => __('Redirect default checkout to One-Step Checkout Pro')]
        ];
    }
}
