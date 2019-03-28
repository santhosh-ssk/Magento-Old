<?php
namespace Zilker\KnockoutJs\Block\Customer\Share;
use Magento\Framework\App\Filesystem\DirectoryList;

class Items extends \Magento\Framework\View\Element\Template
{
	protected $_customerSession;
	
	/**
	 * @param \Magento\Framework\View\Element\Template\Context $context
	 * @param \Magento\Customer\Model\Session $customerSession
	 */
	public function __construct(
		\Magento\Framework\View\Element\Template\Context $context,
		\Magento\Customer\Model\Session $customerSession
		
	)
	{
		$this->_customerSession = $customerSession;
		parent::__construct($context);
	}

	public function getCustomer()
	{
		if($this->_customerSession->isLoggedIn()){	
            $customer = $this->_customerSession->getCustomerData();
            $name = $customer->getFirstname().' '.$customer->getLastname();
			return __($name);
		}
		else{
			return __('Customer is not logged In');
		}
		
	}

	

}
