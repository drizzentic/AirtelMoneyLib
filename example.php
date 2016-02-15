<?php
/**
 * 
 * @author Derrick Rono <derrickrono@gmail.com, Joseph Mokaya <jsphmk14@gmail.com>
 */
require_once('config/Constant.php');
require_once('lib/AirtelMoney.php');



$airtelclient=new AirtelMoney;

//Call the processing function with parameters as shown
//You can do a retrieval of data from a request at this point
//Not advisable to pass the username and password in request. Rather use an environment variable for the same
/**
 * $Username=$_POST['username'];
 * $password=$_POST['password'];
 * $msisdn=$_POST['msisdn'];
 * $referenceId=$_POST['referenceId'];
 * $timeFrom=$_POST['timeFrom'];
 * $timeTo=$_POST['timeTo'];
 */
$referenceId="1601056579194";
$timeTo="";
$timeFrom="";
$airtelclient->processMerchantQuery(USERNAME,PASSWORD,$referenceId,MSISDN,REQUEST1,$timeTo,$timeFrom);


?>
