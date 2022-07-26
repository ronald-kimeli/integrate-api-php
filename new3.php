<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<!-- Link to my stylesheet -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet">
	<link rel="stylesheet" href="styles.css"> 
	<title>Quiz[1]->API</title>
</head>
<body>

	<h2 class="danger">Display API data in an html table</h2>
    <div class="text-center">To save Api Data Click the link</div><a href="database_new3.php" class="btn btn-outline-danger float-end">Save_To_Database</a>
	<table > 
	    <div>
	      <?php 
	      session_start();
	      include('message.php'); 
	       ?>
	     </div> 
		<!-- Table header -->
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
        <!--End of Table Heading--> 
            <?php
        
                $curl = curl_init();
                curl_setopt ($curl, CURLOPT_URL, "https://www.datim.org/api/sqlViews/fgUtV6e9YIX/data.json");
                curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);

                $result = curl_exec ($curl);
                curl_close($curl);

                $decs =  json_decode($result,true);

                if($e = curl_error($curl)){
                    echo $e;
                }
                elseif(count($decs) !=0) {
                    foreach($decs as $ma):{
                        foreach($ma as $m):{
                            if(is_array($m)){
                            foreach((array)$m as $relate):{
                                if(isset($relate[0]) || isset($relate[1]) || isset($relate[2]) || isset($relate[3]) 
                                || isset($relate[4]) || isset($relate[5]) || isset($relate[6]) || isset($relate[7]) 
                                || isset($relate[8])){
                                    ?>
                                    <tr>    
                                        <td><?php print_r($relate[0] ) ?> </td>
                                        <td><?php print_r($relate[1] ) ?> </td>
                                        <td><?php print_r($relate[2] ) ?> </td>
                                        <td><?php print_r($relate[3] ) ?> </td>
                                        <td><?php print_r($relate[4] ) ?> </td>
                                        <td><?php print_r($relate[5] ) ?> </td>
                                        <td><?php print_r($relate[6] ) ?> </td>
                                        <td><?php print_r($relate[7] ) ?> </td>
                                        <td><?php print_r($relate[8] ) ?> </td>
                                    </tr> 
                                        <!--End of Table Data--> 
                                    <?php
                                        }                               
                                }
                            endforeach;  
                                } 
                            }
                    endforeach;
                    }
                endforeach;           
            }

        ?>
	</table>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
   <!-- JavaScript Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
