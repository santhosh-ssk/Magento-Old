<?php
namespace Zilker\RabbitMQ\Publisher;
class Same
{
    const TOPIC_NAME = "same";

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
     * @param   array   $data
     * @return  void
     */
    public function publish(array $data)
    {
        $this->publisher->publish(self::TOPIC_NAME, json_encode($data));
    }
}