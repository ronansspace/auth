<?php
session_start();
require_once('../inc/def.php');

$conn = new mysqli(DBHOST, DBUSER, DBPASS, DBNAME);

if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
} 

if(!tdrLoggedIn()){	

}else{

        $fl_attach = 0;        
        $id_trades = $_GET['id_trades'];
                
        $sql = "SELECT * FROM contract where id_contract in($id_trades) order by id_contract desc";
      	$result = $conn->query($sql);
        
        $sql_mark_trade = "update contract set client_email = '1' where id_contract in($id_trades) order by id_contract";
      	$result_mark_trade = $conn->query($sql_mark_trade);
        
        $report_date = date('d/m/Y');
      
        while($fetch = $result->fetch_assoc())
        {
                        
                        $buy_sell = $fetch["buy_sell"];
                        
                        if($buy_sell == "B"){
                            $buy_sell = "BUY";
                        }else{
                            $buy_sell = "SELL";
                        }
                        
                        $result_pair = substr_replace($fetch["ccy_pair"], "/", 3, 0);
                        
                        $rest_pair = substr($fetch["ccy_pair"],0 , 3);
                        
                        $notional =  number_format($fetch["Notional"], 2, '.', ',');
                        $counter_amts =  number_format($fetch["counter_amt"], 2, '.', ',');
                        
                       
                        $client_id = $fetch["client"];
                        
                        $sql2 = "select * from clients where id = $client_id";
                        $result2 = $conn->query($sql2);                       
                        $fetch2 = $result2->fetch_array();
                        
                        if($fetch2['name'] <> ""){  
                           
                          $client_name = $fetch2['name'];
                          $client_email = $fetch2['email'];
                          
                        }
                        
                        $message = "                        
                        <table width='100%'>
                            <tr>
                                <td width='30%'> <b>Client Name :</b>          </td>
                                <td>".$client_name."</td>
                            </tr>
                            <tr>
                                <td> <b>Counter Party :</b>          </td>
                                <td> Curve Markets (RBS)</td>
                            </tr>
                            <tr>
                                <td> <b>Currency Pair :</b>       </td>
                                <td>".$result_pair."</td>
                            </tr>
                            <tr>
                                <td> <b>Amount :</b>              </td>
                                <td>".$notional."</td>
                            </tr>
                            <tr>
                                <td> <b>Contra Amount :</b>       </td>
                                <td>".$counter_amts."</td>                        
                            </tr>
                            <tr>
                                <td> <b>Dealt Currency :</b>      </td>
                                <td> ".$rest_pair."</td>
                            </tr>
                            <tr>
                                <td> <b>Client buys/sells :</b>   </td>
                                <td>".$buy_sell."</td>
                            </tr>
                            <tr>
                                <td> <b>Spot Rate :</b>           </td>
                                <td>".$fetch["rate"]."</td>
                            </tr>
                            <tr>
                                <td> <b>Value Date :</b>          </td>
                                <td>".$fetch["value_date"]."</td>
                            </tr>
                            <tr>
                                <td> <b>Trade Date :</b>           </td>
                                <td>".$fetch["trade_date"]."</td>
                            </tr>
                        </table>";
                      
        }
        
        
          ////EMAIL DATA /////
        
          $sql2 = "select * from email_settings";
          $result2 = $conn->query($sql2);                       
          $fetch2 = $result2->fetch_array();
          
                                                                           
          $email_to = $client_email; //"craig.davis@curvemarkets.com";
        
          //$email_cc = "";            
          
          $email_from = $fetch2['email_from']; //"fxconfirmations@curvemarkets.com"; // Who the email is from
          $email_subject =   $client_name.": ".$fetch2['client_subject']; //"Curvemarkets Trades"; // The Subject of the email
          
          $email_message = nl2br($fetch2['client_body']);
          $email_message .= "<br><br>".$message;
          $email_message .= "<br><br>".nl2br($fetch2['email_footer']);
          /*$email_message .= "<br><br><img src='http://www.curvemarkets.com/auth/admin/images/logo.jpg' width='150px' />";*/ 
          
          $email_message .= "<br><br><br><font size='2'>".nl2br($fetch2['email_disclaimer'])."</font>";
          
          
      
          $headers = 'From: '.$email_from."\r\n";
          
          //if($email_cc != ""){
          //    $headers .= "\nCc: ".$email_cc;
          //}
    
          
          $headers .= 'Content-type: text/html;charset=iso-8859-1\r\n'.
          'MIME-Version: 1.0\r\n'.
          'Reply-To: '.$email_from."\r\n" .
          'X-Mailer: PHP/' . phpversion();    
                             
          $ok = @mail($email_to, $email_subject, $email_message, $headers);        
       
          // now we just send the message
          
          if($ok) {                             
            echo "sent";              
          } else {                         
            echo "error";           
          }
    
          exit;
      
}
?>   
  