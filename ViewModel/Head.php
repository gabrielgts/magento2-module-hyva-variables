<?php
/** Copyright © Gtstudio X. All rights reserved. */

declare(strict_types=1);

namespace Gtstudio\HyvaThemeVariables\ViewModel;

use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Store\Model\ScopeInterface;
use Magento\Framework\View\Element\Block\ArgumentInterface;
use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Framework\Serialize\SerializerInterface;
use Magento\Store\Model\StoreManagerInterface;
use Psr\Log\LoggerInterface;

class Head implements ArgumentInterface
{
    /**
     * @param ScopeConfigInterface $scopeConfig
     * @param SerializerInterface $serializer
     * @param StoreManagerInterface $storeManager
     * @param LoggerInterface $logger
     */
    public function __construct(
        private ScopeConfigInterface $scopeConfig,
        private SerializerInterface $serializer,
        private StoreManagerInterface $storeManager,
        private LoggerInterface $logger
    ){}

    /**
     * @param string $field
     * @return array|string|null
     * @throws NoSuchEntityException
     */
    public function getConfig(string $field = '') : array|string|null
    {
        return $this->scopeConfig->getValue(
            rtrim("design/variables/$field", '/'),
            ScopeInterface::SCOPE_STORE,
            $this->storeManager->getStore()->getId()
        );
    }

    /**
     * Get additional Variables
     *
     * @return string
     */
    public function getAdditionalVariables() : string
    {
        $parsedCssVars = '';

        $variables = $this->serializer
            ->unserialize(
                $this->getConfig('variables_additional_custom')
            );
        foreach ($variables as $variable) {
            if (empty($variable['key']) || empty($variable['value'])){
                continue;
            }

            $varName = '--' . str_replace(' ', '-', $variable['key']);
            $parsedCssVars .= "$varName: {$variable['value']};" . PHP_EOL;
        }

        return $parsedCssVars;
    }

    /**
     * Get CSS variables
     *
     * @return string
     */
    public function getCssVariables() : string
    {
        $parsedCssVars = '';

        try {
            $variables = $this->getConfig();
            foreach ($variables as $key => $variable) {
                if (empty($variable) || $key == 'variables_additional_custom'){
                    continue;
                }

                $varName = '--' . str_replace(' ', '-', $key);
                $parsedCssVars .= "$varName: {$variable};" . PHP_EOL;
            }

            $parsedCssVars = $parsedCssVars . $this->getAdditionalVariables();
        } catch (\Throwable|LocalizedException $exception) {
            $this->logger->error(
                __('Could not resolve css variables. Original message: {message}'),
                [
                    'message' => $exception->getMessage(),
                    'exception' => $exception,
                    'trace' => $exception->getTraceAsString()
                ]
            );
        }

        return $parsedCssVars;
    }
}
