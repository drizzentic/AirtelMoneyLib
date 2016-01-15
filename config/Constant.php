<?php
/**
 * 
 * @author Derrick Rono <derrickrono@gmail.com, Joseph Mokaya <jsphmk14@gmail.com>
 */

/**
 * Constants for authentication
 */
define("MERCHANT_ID",''); //Put the unique merchant ID provided by the client.
define("PASSKEY", ''); //Put the passkey provided for SAG access
define("URL", "https://41.223.56.58:44433/MerchantQueryService.asmx?wsdl"); //Put the api endpint.
define('REQUEST1','RequestTransaction');
define('REQUEST2','RequestTransactionByTimeInterval');
define('REQUEST3','RequestTransactionByTimeIntervalDetailed');
/**
 * Function to generate the password
 * 
 */
/**
* 
*/
class Constant 
{
	public function generateHash(){

	$TIMESTAMP=new DateTime();
	$datetime=$TIMESTAMP->format('YmdHis');
	$password=base64_encode(hash("sha256", MERCHANT_ID.PASSKEY.$datetime));

	return $password;
	}
}


?>
