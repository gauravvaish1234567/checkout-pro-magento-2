<?php
namespace CheckoutPro\Marketplace\Observer;

use CheckoutPro\Marketplace\Model\VendorFactory;
use CheckoutPro\Marketplace\Model\ResourceModel\Vendor as VendorResource;
use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;

class RegisterVendorFromCustomer implements ObserverInterface
{
    private const XML_PATH_AUTO_APPROVE = 'checkoutpro_marketplace/general/auto_approve_vendor';

    public function __construct(
        private readonly VendorFactory $vendorFactory,
        private readonly VendorResource $vendorResource,
        private readonly ScopeConfigInterface $scopeConfig
    ) {}

    public function execute(Observer $observer): void
    {
        $customer = $observer->getEvent()->getCustomer();
        $request = $observer->getEvent()->getAccountController()->getRequest();

        if (!$request->getParam('is_vendor')) {
            return;
        }

        $vendor = $this->vendorFactory->create();
        $vendor->setData([
            'customer_id' => (int)$customer->getId(),
            'shop_name' => (string)$request->getParam('shop_name', $customer->getFirstname() . ' Store'),
            'status' => $this->scopeConfig->isSetFlag(self::XML_PATH_AUTO_APPROVE) ? 'approved' : 'pending',
            'custom_fields' => json_encode([
                'business_license' => (string)$request->getParam('business_license'),
                'tax_number' => (string)$request->getParam('tax_number')
            ])
        ]);

        $this->vendorResource->save($vendor);
    }
}
