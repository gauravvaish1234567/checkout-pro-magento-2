<?php
namespace CheckoutPro\Marketplace\Api\Data;

interface VendorInterface
{
    public const VENDOR_ID = 'vendor_id';
    public const CUSTOMER_ID = 'customer_id';
    public const SHOP_NAME = 'shop_name';
    public const STATUS = 'status';
    public const COMMISSION_RATE = 'commission_rate';
    public const CUSTOM_FIELDS = 'custom_fields';

    public function getVendorId(): ?int;
    public function setVendorId(int $vendorId): self;
    public function getCustomerId(): int;
    public function setCustomerId(int $customerId): self;
    public function getShopName(): string;
    public function setShopName(string $shopName): self;
    public function getStatus(): string;
    public function setStatus(string $status): self;
    public function getCommissionRate(): ?float;
    public function setCommissionRate(?float $rate): self;
    public function getCustomFields(): ?string;
    public function setCustomFields(?string $customFields): self;
}
