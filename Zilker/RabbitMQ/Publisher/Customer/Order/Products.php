<?php
namespace Zilker\RabbitMQ\Publisher\Customer\Order;
class Products
{
    const TOPIC_NAME = "customer-order-products-topic";

    /**
     * @var PublisherInterface
     */
    protected $publisher;

    /**
     * TestPublisher constructor.
     * @param   \Magento\Framework\MessageQueue\PublisherInterface  $publisher
     */
    public function __construct(
        \Magento\Framework\MessageQueue\PublisherInterface $publisher
    ) {
        $this->publisher = $publisher;
    }

    /**
     * Build and publishes message to RabbitMQ.
     * @param   string   $xml_data
     * @return  void
     */
    public function publish(string $xml_data)
    {
        $this->publisher->publish(self::TOPIC_NAME, $xml_data);
    }
}