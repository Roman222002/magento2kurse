<?php


namespace Roma\Game\ViewModel;

use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Framework\View\Element\Block\ArgumentInterface;
use Magento\Store\Model\ScopeInterface;

class GetConfig implements ArgumentInterface
{
    const PRINT_CUSTOMER = 'game_shop_customer_config/settings_output/how_customer_print';

    /**
     * @var ScopeConfigInterface
     */
    private $scopeConfig;

    /**
     * @param ScopeConfigInterface $scopeConfig
     */
    public function __construct(
        ScopeConfigInterface $scopeConfig
    ) {
        $this->scopeConfig = $scopeConfig;
    }


    public function getCustomersPrintValue()
    {
        $result = 1;
        try {
            $result = $this->scopeConfig->getValue(
                self::PRINT_CUSTOMER,
                ScopeInterface::SCOPE_STORES
            );
        } catch (\Exception $exception) {
            // logger->debug();
        }
        return (int)$result;
    }
}