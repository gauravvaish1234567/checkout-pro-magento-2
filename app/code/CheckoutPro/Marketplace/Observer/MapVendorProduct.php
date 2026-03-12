<?php
namespace CheckoutPro\Marketplace\Observer;

use CheckoutPro\Marketplace\Model\VendorContext;
use Magento\Framework\App\ResourceConnection;
use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;

class MapVendorProduct implements ObserverInterface
{
    public function __construct(private readonly VendorContext $vendorContext, private readonly ResourceConnection $resourceConnection) {}

    public function execute(Observer $observer): void
    {
        $vendorId = $this->vendorContext->getCurrentVendorId();
        if (!$vendorId) {
            return;
        }

        $product = $observer->getEvent()->getProduct();
        $connection = $this->resourceConnection->getConnection();
        $table = $this->resourceConnection->getTableName('checkoutpro_marketplace_product');

        $connection->insertOnDuplicate($table, [
            'vendor_id' => $vendorId,
            'product_id' => (int)$product->getId(),
            'custom_fields' => json_encode($product->getData('marketplace_custom_fields') ?: []),
            'shipping_rate' => (float)$product->getData('vendor_shipping_rate')
        ], ['custom_fields', 'shipping_rate']);
    }
}
