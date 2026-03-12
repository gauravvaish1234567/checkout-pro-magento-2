<?php
namespace CheckoutPro\Marketplace\Api;

interface PayoutManagementInterface
{
    public function requestPayout(int $vendorId, float $amount, string $notes = ''): array;
    public function approvePayout(int $payoutId, string $transactionReference = ''): bool;
}
