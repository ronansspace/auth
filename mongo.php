<?php
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
    header('Content-type: application/json');
    $m = new MongoClient( "mongodb://109.228.54.159:27017" ); // connect to a remote host at a given port 
    $db = $m->selectDB("curvemarket");
    
    print json_encode("Hi");
    /*
    $collections = $db->listCollections(); // Tables  : marketData, tradeableSecurity, tradeReport, priceUpdate, strategy      
    foreach ($collections as $collection) {
        echo "amount of documents in $collection: <br>";
        echo $collection->count(), "<br><br>";
    }
    */        
    
    // select a database
    // $db = $m->mydb;
    // echo "Database mydb selected";
    // echo "Collection selected succsessfully";
    // iterate cursor to display title of documents       
    // var_dump($collection->count());
    // exit;
    // print $date;
    
    //$date = date('d-m-Y H:i');
    
    // DEFAULT VALUE 
    //$date = date('20-05-2016 11:43');
    //$date1 = date('10-05-2016');    
    //$date = new MongoDate(strtotime("$date"));
    //$date1 = new MongoDate(strtotime("$date1"));
    
    if(isset($_GET['show_what']) && $_GET['show_what'] == 2 && isset($_GET['moption']) && $_GET['moption'] == 2){
        
        $dt_1 = $_GET['start_date']; 
        $dt_2 = $_GET['end_date']; 
        
        $dt1 = date("$dt_1 00:01");
        $dt2 = date("$dt_2 23:59");
    
    }else{
    
        //$dt1 = date('17-05-2016 00:01');
        //$dt2 = date('18-05-2016 23:59');
        $dt1 = date('17-05-2016 00:01');
        $dt2 = date('18-05-2016 23:59');
        
    }
    $date_start_val =  new MongoDate(strtotime($dt1));
    $date_end_val =  new MongoDate(strtotime($dt2));
    
    
    
    // print $date;     
    // exit;
    
    $collection = $db->tradeReport;
                                           
    // $today = array('tradetime' => $date);    
    // $cursor = $collection->find($today);
    
    $cursor = $collection->find(array("tradetime" => array('$gt' => $date_start_val, '$lt' => $date_end_val)));
    $cursor->limit(200);   
     
    //print $collection->count(); // TOTAL RECORDS
    //print " <br><br> ";
    //print $collection->count(array("tradetime" => array('$gt' => $date_start_val, '$lt' => $date_end_val))); // QUERY RECORDS
    //exit;
    // exit;
    // $cursor->limit(50);   
    // $cursor->limit(50); 
    /*
    $products = array(
        // product abbreviation, product name, unit price          
        array( 
            'key'=>'Theoretical Profit',
            'values'=>array(array('x'=>'2016-01-4 20:10','y'=>8),array('x'=>'2016-01-4 21:20','y'=>4),array('x'=>'2016-01-4 22:30','y'=>12),
             array('x'=>'2016-01-4 23:20','y'=>6),array('x'=>'2016-01-4 23:30','y'=>20),array('x'=>'2016-01-4 23:40','y'=>17))
        )          
    );*/
    
    $deep_in = array();
    // $products[] = "Theoretical Profit";
    $i = 0;
    foreach ($cursor as $document) {
      
      // $products["values"][$i]["x"] = $document->tradetime[0];
      // foreach($document['tradetime'] as $items)
      // {
      // $products["values"][$i]["x"] =  $items[0];
      // $items['sec'];
      // }  
      
      // RIGHT FORMAT - Jul 08 2013 10:00
      $h = rand(1,10);
      
      //if(isset($_GET['show_what']) && $_GET['show_what'] == 2 && isset($_GET['moption']) && $_GET['moption'] == 2){
            
      //      $deep_in[$i]["x"] = date("M d Y $h:i",$document["tradetime"]->sec);
      //      $deep_in[$i]["y"] = $h = rand(40000,45000);; //rand(2,40); //$document["totalProfit"];
            
      //}else{
            
            $deep_in[$i]["x"] = date("M d Y $h:i",$document["tradetime"]->sec);
            $deep_in[$i]["y"] = $document["totalProfit"]; //rand(2,40); //$document["totalProfit"];
            
      //}
      
      $i = $i+1; 
      
      //var_dump($document);
      // print "<br><br>";
      // print $document["tradetime"]->sec;
      // print($document["tradetime"]." - ".$document["totalProfit"]);
      // print "<br><br>";
      
    }
    // exit;   
    
    $products = array(array("key" => "Theoretical Profit", "values" => $deep_in));
    echo json_encode($products);
    exit;

?>