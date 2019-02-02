<?php declare(strict_types=1);


namespace Gunjan\Testmodule\Plugin;

use Magento\Framework\App\Config\ScopeConfigInterface;

/**
 * Class Wishlistaddtocart
 * @package Gunjan\Testmodule\Plugin
 */
class Wishlistaddtocart
{
    /** @var string */
    const XML_PATH_ECOMM_FEATURES = 'general/ecomm/features';

    /** @var string */
    protected $scopeConfig;

    /** @var string */
    protected $storeScope = \Magento\Store\Model\ScopeInterface::SCOPE_STORE;

    /**
     * Wishlistaddtocart constructor.
     * @param ScopeConfigInterface $scopeConfig
     */
    public function __construct(
        ScopeConfigInterface $scopeConfig
    )
    {
        $this->scopeConfig = $scopeConfig;
    }

    /**
     * Function will check if it can render 'Add All to Cart' based on backend ecomm feature selection
     * @param \Magento\Wishlist\Block\Customer\Wishlist\Button $subject
     * @param string $result
     * @return string
     * @see \Magento\Wishlist\Block\Customer\Wishlist\Button::toHtml()
     */
    public function afterToHtml(\Magento\Wishlist\Block\Customer\Wishlist\Button $subject, string $result): string
    {
        $blockName = $subject->getNameInLayout();
        if($blockName == 'customer.wishlist.button.toCart') {
            $features = $this->scopeConfig->getValue(self::XML_PATH_ECOMM_FEATURES, $this->storeScope);
            $featuresEnabled = explode(',', $features);
            if (in_array('price', $featuresEnabled)) {
                return $result;
            } else {
                return '';
            }
        }
        return $result;
    }
}