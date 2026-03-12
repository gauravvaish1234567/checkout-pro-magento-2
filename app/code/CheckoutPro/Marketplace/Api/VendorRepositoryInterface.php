<?php
namespace CheckoutPro\Marketplace\Api;

use CheckoutPro\Marketplace\Api\Data\VendorInterface;

interface VendorRepositoryInterface
{
    public function save(VendorInterface $vendor): VendorInterface;
    public function getById(int $vendorId): VendorInterface;
    public function approve(int $vendorId): bool;
    public function disable(int $vendorId): bool;
}
