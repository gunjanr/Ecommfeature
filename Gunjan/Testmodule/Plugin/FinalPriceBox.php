<?php declare(strict_types=1);


namespace Gunjan\Testmodule\Plugin;

use Magento\Framework\App\Config\ScopeConfigInterface;

/**
 * Class FinalPriceBox
 * @package Gunjan\Testmodule\Plugin
 */
class FinalPriceBox
{
    /** @var string */
    const XML_PATH_ECOMM_FEATURES = 'general/ecomm/features';

    /** @var string */
    protected $scopeConfig;

    /** @var string */
    protected $storeScope = \Magento\Store\Model\ScopeInterface::SCOPE_STORE;

    /**
     * FinalPriceBox constructor.
     * @param ScopeConfigInterface $scopeConfig
     */
    public function __construct(
        ScopeConfigInterface $scopeConfig
    )
    {
        $this->scopeConfig = $scopeConfig;
    }

    /**
     * Function will check if it can render price based on backend ecomm feature selection
     * @param \Magento\Catalog\Pricing\Render\FinalPriceBox $subject
     * @param string $result
     * @return string
     * @see \Magento\Catalog\Pricing\Render\FinalPriceBox::wrapResult()
     */
    public function afterToHtml(\Magento\Catalog\Pricing\Render\FinalPriceBox $subject, string $result): string
    {
        $features = $this->scopeConfig->getValue(self::XML_PATH_ECOMM_FEATURES, $this->storeScope);
        $featuresEnabled = explode(',', $features);
        if (in_array('price', $featuresEnabled)) {
            return $result;
        }
        return '';
    }
}