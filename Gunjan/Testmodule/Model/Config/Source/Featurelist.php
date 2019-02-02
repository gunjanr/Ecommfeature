<?php declare(strict_types=1);


namespace Gunjan\Testmodule\Model\Config\Source;

use Magento\Framework\App\Config\Value;

/**
 * Class Featurelist
 * @package Gunjan\Testmodule\Model\Config\Form
 */
class Featurelist extends Value implements \Magento\Framework\Option\ArrayInterface
{
    /** @var string */
    protected $_configPath = 'ecomm/features';

    /** @var string */
    protected $storeScope = \Magento\Store\Model\ScopeInterface::SCOPE_STORE;

    /**
     * Returns options for form multiselect
     *
     * @return array
     */
    public function toOptionArray(): array
    {
        $optionArray = [];
        $backendConfig = $this->_config->getValue($this->_configPath);
        if ($backendConfig) {
            foreach ($backendConfig as $featureName => $featureConfig) {
                if (!empty($featureConfig['label'])) {
                    $optionArray[] = ['label' => $featureConfig['label'], 'value' => $featureName];
                }
            }
        }
        return $optionArray;
    }
}