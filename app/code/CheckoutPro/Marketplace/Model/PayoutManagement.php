<?php
namespace CheckoutPro\Marketplace\Model;

use CheckoutPro\Marketplace\Api\PayoutManagementInterface;

class PayoutManagement implements PayoutManagementInterface
{
    public function __construct(private readonly PayoutFactory $payoutFactory, private readonly ResourceModel\Payout $payoutResource) {}

    public function requestPayout(int $vendorId, float $amount, string $notes = ''): array
    {
        $payout = $this->payoutFactory->create();
        $payout->setData([
            'vendor_id' => $vendorId,
            'amount' => $amount,
            'notes' => $notes,
            'status' => 'requested'
        ]);
        $this->payoutResource->save($payout);

        return ['payout_id' => (int)$payout->getId(), 'status' => 'requested'];
    }

    public function approvePayout(int $payoutId, string $transactionReference = ''): bool
    {
        $payout = $this->payoutFactory->create();
        $this->payoutResource->load($payout, $payoutId);
        if (!$payout->getId()) {
            return false;
        }

        $payout->setData('status', 'approved');
        $payout->setData('transaction_reference', $transactionReference);
        $payout->setData('approved_at', (new \DateTimeImmutable())->format('Y-m-d H:i:s'));
        $this->payoutResource->save($payout);

        return true;
    }
}
