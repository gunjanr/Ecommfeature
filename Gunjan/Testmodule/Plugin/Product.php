<?php declare(strict_types=1);


namespace Gunjan\Testmodule\Plugin;

use Magento\Framework\App\Config\ScopeConfigInterface;

/**
 * Class Product
 * @package Gunjan\Testmodule\Plugin
 */
class Product
{
    /** @var string */
    const XML_PATH_ECOMM_FEATURES = 'general/ecomm/features';

    /** @var string */
    protected $scopeConfig;

    /** @var string */
    protected $storeScope = \Magento\Store\Model\ScopeInterface::SCOPE_STORE;

    /**
     * ProductRender constructor.
     * @param ScopeConfigInterface $scopeConfig
     */
    public function __construct(
        ScopeConfigInterface $scopeConfig
    )
    {
        $this->scopeConfig = $scopeConfig;
    }

    /**
     * Function will check if product is salable based on backend ecomm feature selection
     * @param \Magento\Wishlist\Block\Customer\Wishlist\Button $subject
     * @param bool $result
     */
    public function afterIsSalable(\Magento\Catalog\Model\Product $subject, bool $result): bool
    {
        $features = $this->scopeConfig->getValue(self::XML_PATH_ECOMM_FEATURES, $this->storeScope);
        $featuresEnabled = explode(',', $features);
        if (in_array('addtocart', $featuresEnabled)) {
            return $result;
        }
        return false;
    }
}