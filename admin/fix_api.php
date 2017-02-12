<?php

$host = "212.118.233.228";
$port = "51007";

$fixv = "8=FIX.4.4";
$clid = "FIXUAT6-ORD";
$tid = "TTUAT-ORD";

$fp = fsockopen($host, $port, $errno, $errstr, 30);

if (!$fp) {
    
    echo "$errstr ($errno)<br />\n";
    
} else {
    
    echo "No error";
    $out = "$fixv|9=70|35=A|49=$clid|56=$tid|34=1|52=20130801-00:05:11.69|98=0|108=30|10=185|";
    echo "\n".$out."\n";
    
    // 34=1 MsgSeqNum      
    // 52= SendingTime
    // 98=0 Encrypt Method - Always 0    
    // 108= Timout 
    // 10= CheckSum
    
    // A = LOGON
    // 1 = TEST REQUEST
    
    fwrite($fp, $out);       
    while (!feof($fp)) {
        echo ".";
        echo fgets($fp, 1024);
    }
    
    fclose($fp);
    
    
    
}

?>