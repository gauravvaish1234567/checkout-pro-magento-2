<?php
namespace CheckoutPro\Marketplace\Api;

interface CommissionManagementInterface
{
    public function calculate(int $vendorId, int $productId, float $rowTotal): array;
}
