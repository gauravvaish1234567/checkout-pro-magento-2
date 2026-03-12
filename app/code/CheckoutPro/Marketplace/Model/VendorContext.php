<?php
namespace CheckoutPro\Marketplace\Model;

use CheckoutPro\Marketplace\Model\ResourceModel\Vendor\CollectionFactory;
use Magento\Customer\Model\Session as CustomerSession;

class VendorContext
{
    public function __construct(private readonly CustomerSession $customerSession, private readonly CollectionFactory $vendorCollectionFactory) {}

    public function getCurrentVendorId(): ?int
    {
        if (!$this->customerSession->isLoggedIn()) {
            return null;
        }

        $collection = $this->vendorCollectionFactory->create();
        $collection->addFieldToFilter('customer_id', (int)$this->customerSession->getCustomerId());
        $collection->addFieldToFilter('status', 'approved');
        $vendor = $collection->getFirstItem();

        return $vendor->getId() ? (int)$vendor->getId() : null;
    }
}
