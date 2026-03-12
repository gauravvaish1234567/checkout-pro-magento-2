<?php
namespace CheckoutPro\Marketplace\Model\ResourceModel\Payout;

use CheckoutPro\Marketplace\Model\Payout;
use CheckoutPro\Marketplace\Model\ResourceModel\Payout as PayoutResource;
use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class Collection extends AbstractCollection
{
    protected function _construct(): void
    {
        $this->_init(Payout::class, PayoutResource::class);
    }
}
