<?php
require_once('rb.php');
ini_set("soap.wsdl_cache_enabled", "0");
/**
 * Airtel API powerengine
 * 
 * @author Derrick Rono <derrickrono@gmail.com,Joseph Mokaya <jsphmk14@gmail.com>
 * 
 * This Class to allow access to Airtel money merchant queries
 */

class AirtelMoney
{

	public function processMerchantQuery($username,$password,$REFERENCE_ID,$MSISDN,$request_type){
	/**
	 * Initialize redbean library
	 */
	//To connect to real db 
	

		$params = array(			
	            'userName'=>$username,
	            'passWord'=>$password,
	            'referenceId'=>$REFERENCE_ID,
	          	'msisdn'=>$MSISDN,
	          	/*
	          	Optional fields when checking by tranaction id. And note that the time interval should not exceed 24hrs
	          	 */
	           	'timeFrom'=>'20160115050700', 
	            'timeTo'=>'20160115110700',
            
            );
		try {
			$soap = new SOAPClient(dirname(__FILE__)."/MERCHANT_QUERY.wsdl",array("trace"  => 0, "exceptions" => 1,
			"stream_context" => stream_context_create(
			        array(
			            'ssl' => array(
			                'verify_peer'       => false,
			                'verify_peer_name'  => false,
            		)
       
        			)
    			),'location'=>URL,'soap_version'=> SOAP_1_2,
			'compression' => SOAP_COMPRESSION_ACCEPT | SOAP_COMPRESSION_GZIP
			));

	     $response=$soap->__call($request_type,array($params));
	    
	     $amount=$response->RequestTransactionResult->Amount;
	     $firstname=$response->RequestTransactionResult->FirstName;
	     $lastname=$response->RequestTransactionResult->LastName;
	     $message=$response->RequestTransactionResult->Message;
	     $msisdn=$response->RequestTransactionResult->Msisdn;
	     $referenceId=$response->RequestTransactionResult->Referenceld;
	     $status=$response->RequestTransactionResult->Status;
	     $transactionId=$response->RequestTransactionResult->TransactionId;

	     $transaction = array(
	     	'amount' =>$amount , 
	     	'firstname' => $firstname, 
	     	'lastname' => $lastname, 
	     	'message' => $message, 
	     	'msisdn' => $msisdn, 
	     	'referenceId' => $referenceId, 
	     	'status' => $status, 
	     	'transactionId' => $transactionId, 
	     	);

	     
	     if($transaction["amount"]!="" || $transaction["amount"] !=null){
	     	//Insert values to the database of choice
	     	
	     	/**
	     	 * Db connection setup with RB ORM
	     	 */
	     	//Create a database name called m_payment_transaction and redbean will handle the rest
	     	//Also make sure you change the username and password
	     	R::setup( 'mysql:host=localhost;dbname=m_payment_transaction',
       		 'username', 'password' ); 

	     	/**
	     	 * Store the data received back from the API
	     	 * @var [type]
	     	 */
       		$trans=R::dispense('airtel');
       		$trans->amount=$transaction["amount"];			
       		$trans->firstname=$transaction["firstname"];			
       		$trans->lastname=$transaction["lastname"];			
       		$trans->message=$transaction["message"];			
       		$trans->msisdn=$transaction["msisdn"];			
       		$trans->referenceId=$transaction["referenceId"];			
       		$trans->status=$transaction["status"];			
       		$trans->transactionId=$transaction["transactionId"];			
			$trans=R::store( $trans );

	     	var_dump($trans);
	     }
	     else{
	     	echo "no data received";
	     	$response=$soap->__call($request_type,array($params));
	     	
	     }
	     
	    	

		} catch (Exception $e) {
			echo $e;
		}	

	}
	
	
}
?>
