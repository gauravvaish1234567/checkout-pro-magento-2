<?php
namespace CheckoutPro\Marketplace\Model;

use CheckoutPro\Marketplace\Api\Data\VendorInterface;
use CheckoutPro\Marketplace\Api\VendorRepositoryInterface;
use CheckoutPro\Marketplace\Model\ResourceModel\Vendor as VendorResource;
use Magento\Framework\Exception\NoSuchEntityException;

class VendorRepository implements VendorRepositoryInterface
{
    public function __construct(private readonly VendorFactory $vendorFactory, private readonly VendorResource $vendorResource) {}

    public function save(VendorInterface $vendor): VendorInterface
    {
        $this->vendorResource->save($vendor);
        return $vendor;
    }

    public function getById(int $vendorId): VendorInterface
    {
        $vendor = $this->vendorFactory->create();
        $this->vendorResource->load($vendor, $vendorId);
        if (!$vendor->getId()) {
            throw new NoSuchEntityException(__('Vendor with id %1 not found', $vendorId));
        }
        return $vendor;
    }

    public function approve(int $vendorId): bool
    {
        $vendor = $this->getById($vendorId);
        $vendor->setStatus('approved');
        $vendor->setData('approved_at', (new \DateTimeImmutable())->format('Y-m-d H:i:s'));
        $this->vendorResource->save($vendor);
        return true;
    }

    public function disable(int $vendorId): bool
    {
        $vendor = $this->getById($vendorId);
        $vendor->setStatus('disabled');
        $this->vendorResource->save($vendor);
        return true;
    }
}
