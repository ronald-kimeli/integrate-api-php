<html>

<head>
    <!-- The meta viewport will scale my content to any device width -->
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Save-Database</title>
        <!-- Link to my stylesheet -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="styles.css"> 
    
</head>

<body>
    <div class="container">
        <h3 align="center">Load API Data into Database</h3><br />
        
        <?php
        session_start();
        $connect = mysqli_connect("localhost", "root", "kimeli@2022", "test"); //Connect PHP to MySQL Database
        $query = '';
        $table_data = '';
     
        $curl = curl_init();
        curl_setopt ($curl, CURLOPT_URL, "https://www.datim.org/api/sqlViews/fgUtV6e9YIX/data.json");
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);

        $result = curl_exec ($curl);
        // curl_close ($curl);
        // print $result;
        $products =  json_decode($result,true);

        if(count($products) >=0 ){
                foreach((array)$products as $object):{
                    foreach((array)$object as $grenade):{
			if(is_array($grenade)){
                        foreach((array)$grenade as $base):{
                            if(isset($base[0]) || isset($base[1]) || isset($base[2]) || isset($base[3]) 
                                || isset($base[4]) || isset($base[5]) || isset($base[6]) || isset($base[7]) 
                                || isset($base[8])) //Extract the Array Values by using Foreach Loop
                                 {
                                    $checkmechanism = "SELECT mechanism FROM api_datas WHERE mechanism = '$base[0]'";
                                    $checkmechanism_run = mysqli_query($connect,$checkmechanism);
                            
                                    if(mysqli_num_rows($checkmechanism_run) > 0)
                                    {            
                                       $_SESSION['message'] = "Data Already Exists!!";
                                       header("Location: new3.php");
                                       exit(0); 
                                    }
                                else{
                                $query .= "INSERT INTO api_datas(mechanism,code,uid,partner,primeid,agency,ou,startdate,enddate) VALUES ('" . $base[0] . "', '" . $base[1] . "', '" . $base[2] . "', '" . $base[3] . "', '" . $base[4] . "', '" . $base[5] . "', '" . $base[6] . "', '" . $base[7]. "', '" . $base[8]. "'); ";  // Make Multiple Insert Query 
                                $table_data .= '<tr>
                                    <td>' . $base[0] . '</td>
                                    <td>' . $base[1] . '</td>
                                    <td>' . $base[2] . '</td>
                                    <td>' . $base[3] . '</td>
                                    <td>' . $base[4] . '</td>
                                    <td>' . $base[5] . '</td>
                                    <td>' . $base[6] . '</td>
                                    <td>' . $base[7] . '</td>
                                    <td>' . $base[8] . '</td>
                                </tr>'; //Data for display on Web page
                               }
                            }
                          
                    }
                endforeach;
		}		
            }
        endforeach;  
        }
    endforeach;
    }

if (mysqli_multi_query($connect, $query)) //Run Mutliple Insert Query
        {
            echo '<h3 class="alert alert-success">Data Saved To Database Successfully!</h3><br />';
            echo '
            <table class="table table-bordered">
                <tr>
                    <th>Mechanism</th>
                    <th>Code</th>
                    <th>uid</th>
                    <th>Partner</th>
                    <th>primeid</th>
                    <th>Agency</th>
                    <th>ou</th>
                    <th>startdate</th>
                    <th>enddate</th>
                </tr>
                ';
            echo $table_data;
            echo '</table>';
        }
 
    curl_close($curl);

        ?>
        <br />
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
   <!-- JavaScript Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
