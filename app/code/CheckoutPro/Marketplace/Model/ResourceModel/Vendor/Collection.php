<?php
namespace CheckoutPro\Marketplace\Model\ResourceModel\Vendor;

use CheckoutPro\Marketplace\Model\Vendor;
use CheckoutPro\Marketplace\Model\ResourceModel\Vendor as VendorResource;
use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class Collection extends AbstractCollection
{
    protected function _construct(): void
    {
        $this->_init(Vendor::class, VendorResource::class);
    }
}
