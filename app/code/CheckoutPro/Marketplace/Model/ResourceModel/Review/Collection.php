<?php
namespace CheckoutPro\Marketplace\Model\ResourceModel\Review;

use CheckoutPro\Marketplace\Model\ResourceModel\Review as ReviewResource;
use CheckoutPro\Marketplace\Model\Review;
use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class Collection extends AbstractCollection
{
    protected function _construct(): void
    {
        $this->_init(Review::class, ReviewResource::class);
    }
}
