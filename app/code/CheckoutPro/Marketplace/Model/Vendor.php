<?php
namespace CheckoutPro\Marketplace\Model;

use CheckoutPro\Marketplace\Api\Data\VendorInterface;
use Magento\Framework\Model\AbstractModel;

class Vendor extends AbstractModel implements VendorInterface
{
    protected function _construct(): void
    {
        $this->_init(\CheckoutPro\Marketplace\Model\ResourceModel\Vendor::class);
    }

    public function getVendorId(): ?int { return $this->getData(self::VENDOR_ID) ? (int)$this->getData(self::VENDOR_ID) : null; }
    public function setVendorId(int $vendorId): VendorInterface { return $this->setData(self::VENDOR_ID, $vendorId); }
    public function getCustomerId(): int { return (int)$this->getData(self::CUSTOMER_ID); }
    public function setCustomerId(int $customerId): VendorInterface { return $this->setData(self::CUSTOMER_ID, $customerId); }
    public function getShopName(): string { return (string)$this->getData(self::SHOP_NAME); }
    public function setShopName(string $shopName): VendorInterface { return $this->setData(self::SHOP_NAME, $shopName); }
    public function getStatus(): string { return (string)$this->getData(self::STATUS); }
    public function setStatus(string $status): VendorInterface { return $this->setData(self::STATUS, $status); }
    public function getCommissionRate(): ?float { return $this->getData(self::COMMISSION_RATE) !== null ? (float)$this->getData(self::COMMISSION_RATE) : null; }
    public function setCommissionRate(?float $rate): VendorInterface { return $this->setData(self::COMMISSION_RATE, $rate); }
    public function getCustomFields(): ?string { return $this->getData(self::CUSTOM_FIELDS); }
    public function setCustomFields(?string $customFields): VendorInterface { return $this->setData(self::CUSTOM_FIELDS, $customFields); }
}
