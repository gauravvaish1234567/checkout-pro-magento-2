<?php
namespace CheckoutPro\Marketplace\Model\Commission;

use CheckoutPro\Marketplace\Api\CommissionManagementInterface;
use CheckoutPro\Marketplace\Api\VendorRepositoryInterface;
use Magento\Catalog\Api\ProductRepositoryInterface;
use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Store\Model\ScopeInterface;

class CommissionManagement implements CommissionManagementInterface
{
    private const XML_PATH_GLOBAL_RATE = 'checkoutpro_marketplace/commission/global_rate';
    private const XML_PATH_CATEGORY_MAP = 'checkoutpro_marketplace/commission/category_rate_map';

    public function __construct(
        private readonly VendorRepositoryInterface $vendorRepository,
        private readonly ProductRepositoryInterface $productRepository,
        private readonly ScopeConfigInterface $scopeConfig
    ) {}

    public function calculate(int $vendorId, int $productId, float $rowTotal): array
    {
        $vendor = $this->vendorRepository->getById($vendorId);
        $rate = $vendor->getCommissionRate() ?? $this->resolveCategoryRate($productId) ?? $this->getGlobalRate();

        $commission = round($rowTotal * ($rate / 100), 2);
        return [
            'vendor_id' => $vendorId,
            'product_id' => $productId,
            'rate' => $rate,
            'commission_amount' => $commission,
            'vendor_amount' => round($rowTotal - $commission, 2),
        ];
    }

    private function getGlobalRate(): float
    {
        return (float)$this->scopeConfig->getValue(self::XML_PATH_GLOBAL_RATE, ScopeInterface::SCOPE_WEBSITE) ?: 0.0;
    }

    private function resolveCategoryRate(int $productId): ?float
    {
        $product = $this->productRepository->getById($productId);
        $categoryRates = $this->parseCategoryMap((string)$this->scopeConfig->getValue(self::XML_PATH_CATEGORY_MAP, ScopeInterface::SCOPE_WEBSITE));

        foreach ($product->getCategoryIds() as $categoryId) {
            if (isset($categoryRates[(int)$categoryId])) {
                return $categoryRates[(int)$categoryId];
            }
        }

        return null;
    }

    private function parseCategoryMap(string $rawMap): array
    {
        $result = [];
        foreach (preg_split('/\R/', trim($rawMap)) as $line) {
            if (!$line || !str_contains($line, ':')) {
                continue;
            }
            [$categoryId, $rate] = array_map('trim', explode(':', $line, 2));
            $result[(int)$categoryId] = (float)$rate;
        }
        return $result;
    }
}
