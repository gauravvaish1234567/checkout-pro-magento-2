<?php
namespace CheckoutPro\Marketplace\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

class Review extends AbstractDb
{
    protected function _construct(): void
    {
        $this->_init('checkoutpro_marketplace_review', 'review_id');
    }
}
