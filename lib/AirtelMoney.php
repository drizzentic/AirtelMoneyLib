<?php
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

	public function processMerchantQuery($username,$password,$REFERENCE_ID,$MSISDN,$request_type,$timeTo,$timeFrom){
		
		$params = array(			
			//'processCheckOutRequest'=>array(
	            'userName'=>$username,
	            'passWord'=>$password,
	            'referenceId'=>$REFERENCE_ID,
	          	'msisdn'=>$MSISDN,
	          	/*
	          	Optional fields when checking by tranaction id. And note that the time interval should not exceed 24hrs
	          	 */
	          	// Time should be in this format and within the last 24 hrs 20160115050700
	          	
	           	'timeFrom'=>$timeFrom,
	            'timeTo'=>$timeTo,
			//	)
            
            );
		//For Debug purposes. Remove in production
		
		print_r('Requesting....');
		$soap = new SOAPClient(URL,array("trace"  => 0, "exceptions" => 0,
			"stream_context" => stream_context_create(
			        array(
			            'ssl' => array(
			                'verify_peer'       => false,
			                'verify_peer_name'  => false,
			                'ciphers'=>'RC4-SHA',
            		)
       
        			)
    			),'location'=>URL,'soap_version'=> SOAP_1_2,
			'compression' => SOAP_COMPRESSION_ACCEPT | SOAP_COMPRESSION_GZIP
			));
		

	      $response=$soap->__call($request_type,array($params));
		//For Debug purposes. Remove in production
		  print_r( $this->processResponse($response)."\n");
		

	}

	function processResponse($responseData){
		//Process database response. Insert Items into the database
		
		return json_encode($responseData);
	}

	
	
}
?>
