<?php 
    namespace Zilker\FirstModule\Plugin;

    class RenderModuleName
    {
        private $logger;
        
        /**
         * * @param \Psr\Log\LoggerInterface $logger
         */

        public function __construct(\Psr\Log\LoggerInterface $logger){
            $this->logger = $logger;
        }

        public function beforeExecute(\Zilker\FirstModule\Controller\Page\Index $index)
        {
            echo "This is from module Zilker\FirstModule";
            $this->logger->info('module name');
        }
    }
?>