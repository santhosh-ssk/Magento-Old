<?php

namespace Zilker\RabbitMQ\Consumer;

class CustomerOrderProducts
{
    /**
    * @var \Zend\Log\Logger
    */
    private $logger;

    /**
    * @var string
    */
    private $logFileName = 'costumer-order-products.log';

    /**
    * @var \Magento\Framework\App\Filesystem\DirectoryList
    */
    private $directoryList;


    /**
    * DeleteConsumer constructor.
    * @param \Magento\Framework\App\Filesystem\DirectoryList $directoryList
    * @throws \Magento\Framework\Exception\FileSystemException
    */
    public function __construct(
    \Magento\Framework\App\Filesystem\DirectoryList $directoryList
    ) {
    $this->directoryList = $directoryList;


    $logDir = $directoryList->getPath('log');
    $writer = new \Zend\Log\Writer\Stream($logDir . DIRECTORY_SEPARATOR . $this->logFileName);
    $logger = new \Zend\Log\Logger();
    $logger->addWriter($writer);
    $this->logger = $logger;
    }

    /**
    * @throws \Magento\Framework\Exception\LocalizedException
    * @return void
    */
    public function processMessage($data)
        {
        $this->logger->info("Customer-order-products: ".$data);
        }
}