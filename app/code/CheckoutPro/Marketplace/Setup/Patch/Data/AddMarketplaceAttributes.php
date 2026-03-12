<?php
namespace CheckoutPro\Marketplace\Setup\Patch\Data;

use Magento\Catalog\Model\Product;
use Magento\Customer\Model\Customer;
use Magento\Eav\Model\Entity\Attribute\ScopedAttributeInterface;
use Magento\Eav\Setup\EavSetupFactory;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Framework\Setup\Patch\DataPatchInterface;

class AddMarketplaceAttributes implements DataPatchInterface
{
    public function __construct(private readonly ModuleDataSetupInterface $moduleDataSetup, private readonly EavSetupFactory $eavSetupFactory) {}

    public function apply(): self
    {
        $this->moduleDataSetup->getConnection()->startSetup();
        $eavSetup = $this->eavSetupFactory->create(['setup' => $this->moduleDataSetup]);

        $eavSetup->addAttribute(Customer::ENTITY, 'is_vendor', [
            'type' => 'int', 'label' => 'Register as Vendor', 'input' => 'boolean', 'required' => false, 'visible' => true,
            'system' => 0, 'position' => 999, 'user_defined' => true
        ]);
        $eavSetup->addAttribute(Product::ENTITY, 'vendor_shipping_rate', [
            'type' => 'decimal', 'label' => 'Vendor Shipping Rate', 'input' => 'price', 'required' => false,
            'global' => ScopedAttributeInterface::SCOPE_WEBSITE, 'visible' => true, 'user_defined' => true
        ]);
        $eavSetup->addAttribute(Product::ENTITY, 'marketplace_custom_fields', [
            'type' => 'text', 'label' => 'Marketplace Custom Fields', 'input' => 'textarea', 'required' => false,
            'global' => ScopedAttributeInterface::SCOPE_STORE, 'visible' => true, 'user_defined' => true
        ]);

        $this->moduleDataSetup->getConnection()->endSetup();
        return $this;
    }

    public static function getDependencies(): array { return []; }
    public function getAliases(): array { return []; }
}
