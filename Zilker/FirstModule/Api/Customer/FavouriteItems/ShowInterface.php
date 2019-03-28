<?php 
namespace Zilker\FirstModule\Api\Customer\FavouriteItems;
 
 
interface ShowInterface {


	/**
	 * GET for Post api
     * @param  int $customerId
	 * @return mixed
	 */
	
	public function getPost($customerId);
}
