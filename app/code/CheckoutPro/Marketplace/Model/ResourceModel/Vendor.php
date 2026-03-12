<?php
namespace CheckoutPro\Marketplace\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

class Vendor extends AbstractDb
{
    protected function _construct(): void
    {
        $this->_init('checkoutpro_marketplace_vendor', 'vendor_id');
    }
}
