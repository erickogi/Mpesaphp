<?php
@require_once('DbConnect.php');

/**
 * Created by PhpStorm.
 * User: Eric
 * Date: 2/15/2018
 * Time: 6:47 PM
 */
class Operations{
    private $conn;
   
    /**
     * DbHandler constructor.
     */
    function __construct()
    {
        require_once dirname(__FILE__) . '/DbConnect.php';
       
        
        // opening db connection
        $db = new DbConnect();
        $this->conn = $db->connect();
        
    }
    
    
   
    
    
   public function insert($response){



       $stmt = $this->conn->prepare("INSERT INTO mpesa_callback (response)  VALUES(?)");
       $stmt->bind_param("s", $response);

        $stmt->execute();



       $stmt->close();


       
   }







}


