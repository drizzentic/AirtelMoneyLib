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

	public function processMerchantQuery($username,$password,$REFERENCE_ID,$MSISDN,$request_type){
		
		$params = array(			
			//'processCheckOutRequest'=>array(
	            'userName'=>$username,
	            'passWord'=>$password,
	            'referenceId'=>$REFERENCE_ID,
	          	'msisdn'=>$MSISDN,
	          	/*
	          	Optional fields when checking by tranaction id. And note that the time interval should not exceed 24hrs
	          	 */
	           	'timeFrom'=>'20160115050700', 
	            'timeTo'=>'20160115110700',
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

		return json_encode($responseData);
	}

	
	
}
?>
