<?php
namespace CheckoutPro\Marketplace\Plugin;

use CheckoutPro\Marketplace\Model\VendorContext;

class FilterVendorOrderCollection
{
    public function __construct(private readonly VendorContext $vendorContext) {}

    public function beforeLoad($subject, $printQuery = false, $logQuery = false)
    {
        $vendorId = $this->vendorContext->getCurrentVendorId();
        if ($vendorId) {
            $subject->getSelect()->join(
                ['soi' => $subject->getTable('sales_order_item')],
                'main_table.entity_id = soi.order_id',
                []
            )->join(
                ['cmp' => $subject->getTable('checkoutpro_marketplace_product')],
                'soi.product_id = cmp.product_id',
                []
            )->where('cmp.vendor_id = ?', $vendorId)->group('main_table.entity_id');
        }

        return [$printQuery, $logQuery];
    }
}
