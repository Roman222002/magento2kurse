<?php

namespace Roma\Stalker\ViewModel;

use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Framework\View\Element\Block\ArgumentInterface;
use Magento\Store\Model\ScopeInterface;

/**
 * Class ExtraInfo
 */
class TextInfo implements ArgumentInterface
{
    const MAIN_TEXT = 'roma_stalker/settings_stalker_list/display_text';

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


    public function mainText()
    {
        $result = 'simple text';
        try {
            $result = $this->scopeConfig->getValue(
                self::MAIN_TEXT,
                ScopeInterface::SCOPE_STORES
            );
        } catch (\Exception $exception) {
            // logger->debug();
        }

        return $result;
    }
}