<?php
namespace CheckoutPro\Marketplace\Block\Vendor;

use CheckoutPro\Marketplace\Model\ResourceModel\Payout\CollectionFactory as PayoutCollectionFactory;
use CheckoutPro\Marketplace\Model\VendorContext;
use Magento\Framework\View\Element\Template;

class Dashboard extends Template
{
    public function __construct(Template\Context $context, private readonly VendorContext $vendorContext, private readonly PayoutCollectionFactory $payoutCollectionFactory, array $data = [])
    {
        parent::__construct($context, $data);
    }

    public function getVendorId(): ?int
    {
        return $this->vendorContext->getCurrentVendorId();
    }

    public function getRecentPayouts(): array
    {
        if (!$this->getVendorId()) {
            return [];
        }

        $collection = $this->payoutCollectionFactory->create();
        $collection->addFieldToFilter('vendor_id', $this->getVendorId());
        $collection->setOrder('created_at', 'DESC');
        $collection->setPageSize(5);

        return $collection->getItems();
    }
}
