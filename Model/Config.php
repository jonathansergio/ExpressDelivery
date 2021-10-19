<?php

namespace Js\ExpressDelivery\Model;

use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\UrlInterface;
use Magento\Store\Model\ScopeInterface;
use Magento\Store\Model\StoreManagerInterface;

class Config
{
    const XML_PATH_ORDER_STATUS = 'carriers/expressdelivery/order_status_to_email';
    const XML_PATH_STORE_NAME = 'carriers/expressdelivery/store_name';
    const XML_PATH_STORE_SENDER_EMAIL = 'carriers/expressdelivery/store_sender_email';
    protected $_code = 'expressdelivery';
    private $scopeConfig;
    private $storeManager;
    protected $urlInterface;

    public function __construct(
        ScopeConfigInterface $scopeConfig,
        StoreManagerInterface $storeManager,
        UrlInterface $urlInterface
    ) {
        $this->scopeConfig = $scopeConfig;
        $this->storeManager = $storeManager;
        $this->urlInterface = $urlInterface;
    }

    public function getOrderStatus()
    {
        $orderStatus = $this->getConfig(self::XML_PATH_ORDER_STATUS);
        return $orderStatus;
    }

    public function getStoreName()
    {
        $orderStatus = $this->getConfig(self::XML_PATH_STORE_NAME);
        return $orderStatus;
    }

    public function getStoreSenderEmail()
    {
        $orderStatus = $this->getConfig(self::XML_PATH_STORE_SENDER_EMAIL);
        return $orderStatus;
    }

    private function getConfig($xmlPath)
    {
        return $this->scopeConfig->getValue($xmlPath,
            ScopeInterface::SCOPE_STORE,
            $this->storeManager->getStore());
    }
}
