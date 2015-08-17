<?php
include 'includes/config.php';
include 'includes/functions.php';


// set null for variables
$d = $abandon_date = $callerid = $tmpDate1 = $tmpCallerid1 = "";

if(isset($_POST['tmpSubmit1'])){
    
    // check variables
    $tmpDate1 = test_input($_POST['tmpDate1']);
    $tmpCallerid1 = test_input($_POST['tmpCallerid1']);
    
    if($tmpDate1 == ""){
        $d = strtotime("yesterday");// echo $d; // value: 1438120800
        $abandon_date = date("Y-m-d", $d); // echo $abandon_date; // value: 2015-07-29
    } else {
        //$d = $_POST['tmpDate1']; // value: 07/31/2015        
        //$abandon_date = trim(substr($d,6,4).'-'.substr($d,0,2).'-'.substr($d,3,2)); // echo $abandon_date; // value: 2015-07-29 
        
        // define function to use
        $abandon_date = convertDateAsterisk($tmpDate1); // echo $abandon_date; //test
    }
    
    $callerid = $tmpCallerid1; // echo $callerid; //test
}
?>
<div class="row">
  <div class="col-md-12">            
    <div class="table-responsive">
      <table class="table table-hover">
        <thread>
          <tr>
            <th>calldate</th>
            <th>src</th>
            <th>dst</th>
            <th>channel</th>
            <th>dstchannel</th>
            <th>lastapp</th>
            <th>lastdata</th>
            <th>duration</th>
            <th>billsec</th>
            <th>disposition</th>
          </tr>
        </thread>
        <tbody>            
            <?php 

            // create connection
            //$conn = new mysqli(db_host, db_user, db_pass, db1); //echo "connect succesful";
            $conn = mysqli_connect(db_host, db_user, db_pass, db1);

            // check connection
            if(mysqli_connect_error()) {
                die("Database connection fail : ".mysqli_connect_error());
            } else {
                //echo "<td>connect</td>";             
            }

            // declare mysql statement, compare date, can use DATE(caldate) LIKE '$abandon_date' | calldate LIKE '$abandon_date %'
            $sql="
                SELECT calldate, src, dst, channel, dstchannel, lastapp, lastdata, duration, billsec, disposition FROM cdr
                WHERE DATE(calldate)='$abandon_date' AND src='$callerid'
            ";

            // query result
            if($result = mysqli_query($conn, $sql)) {
                while($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>";
                    echo "<td>".$row["calldate"]."</td>";
                    echo "<td>".$row["src"]."</td>";
                    echo "<td>".$row["dst"]."</td>";
                    echo "<td>".$row["channel"]."</td>";
                    echo "<td>".$row["dstchannel"]."</td>";
                    echo "<td>".$row["lastapp"]."</td>";
                    echo "<td>".$row["lastdata"]."</td>";
                    echo "<td>".$row["duration"]."</td>";
                    echo "<td>".$row["billsec"]."</td>";
                    echo "<td>".$row["disposition"]."</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr>";
                echo "<td>Lorem Ipsum</td>";
                echo "<td>Lorem Ipsum</td>";
                echo "<td>Lorem Ipsum</td>";
                echo "<td>Lorem Ipsum</td>";
                echo "<td>Lorem Ipsum</td>";
                echo "<td>Lorem Ipsum</td>";
                echo "<td>Lorem Ipsum</td>";
                echo "<td>Lorem Ipsum</td>";
                echo "<td>Lorem Ipsum</td>";
                echo "<td>Lorem Ipsum</td>";
                echo "</tr>";
            }

            mysqli_free_result($result);
            mysqli_close($conn);

            unset($d, $abandon_date, $callerid, $tmpDate1, $tmpCallerid1);
            ?>
                
        </tbody>
      </table>
    </div>
  </div>
</div><!-- end div row table -->