<?php
namespace CheckoutPro\Marketplace\Model;

use Magento\Framework\Model\AbstractModel;

class Payout extends AbstractModel
{
    protected function _construct(): void
    {
        $this->_init(\CheckoutPro\Marketplace\Model\ResourceModel\Payout::class);
    }
}
