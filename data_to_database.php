<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Link to my stylesheet -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href=" https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css" rel="stylesheet">

    <title>Quiz[1]->API</title>
</head>

<body data-bs-theme="dark">
    <div class="main py-4 d-flex justify-contents-center">
        <div class="container">
            <div class="row">
                <div class="col-md-12">

                    <div class="card mb-2 text-primary-emphasis border-primary-subtle">
                        <div class="card-body rounded">
                            <h4 class="text-center text-uppercase bold contentT">Folder Section
                            </h4>
                        </div>
                    </div>
                    <div class="card mt-2 border-primary-subtle">
                        <div class="card-content collapse show">
                            <div class="card-body card-dashboard">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="card shadow border-primary-subtle text-info-emphasis">
                                            <div class="card-header">
                                                <h4 class="card-title" style="text-transform:capitalize;">
                                                    <!-- Card Title contents here -->
                                                    Umbrella
                                                    <a href="database_new3.php" class="btn btn-info float-end">Add
                                                        To
                                                        Database</a>
                                                </h4>
                                            </div>
                                            <div class="card-body p-2 text-danger-emphasis">
                                                <div class="table-responsive">
                                                    <!-- Table contents here  -->
                                                    <?php
                                                    session_start();
                                                    $connect = mysqli_connect("localhost", "username", "password", "database"); //Connect PHP to MySQL Database
                                                    $query = '';
                                                    $table_data = '';

                                                    $curl = curl_init();
                                                    curl_setopt($curl, CURLOPT_URL, "https://www.datim.org/api/sqlViews/fgUtV6e9YIX/data.json");
                                                    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);

                                                    $result = curl_exec($curl);
                                                    curl_close($curl);
                                                    $products =  json_decode($result, true);

                                                    if (count($products) >= 0) {
                                                        foreach ((array)$products as $object) : {
                                                                foreach ((array)$object as $grenade) : {
                                                                        if (is_array($grenade)) {
                                                                            foreach ((array)$grenade as $base) : {
                                                                                    if (
                                                                                        isset($base[0]) || isset($base[1]) || isset($base[2]) || isset($base[3])
                                                                                        || isset($base[4]) || isset($base[5]) || isset($base[6]) || isset($base[7])
                                                                                        || isset($base[8])
                                                                                    ) //Extract the Array Values by using Foreach Loop
                                                                                    {
                                                                                        $checkmechanism = "SELECT mechanism FROM api_datas WHERE mechanism = '$base[0]'";
                                                                                        $checkmechanism_run = mysqli_query($connect, $checkmechanism);

                                                                                        if (mysqli_num_rows($checkmechanism_run) > 0) {
                                                                                            $_SESSION['message'] = "Data Already Exists!!";
                                                                                            header("Location: /");
                                                                                            exit(0);
                                                                                        } else {
                                                                                            $query .= "INSERT INTO api_datas(mechanism,code,uid,partner,primeid,agency,ou,startdate,enddate) VALUES ('" . $base[0] . "', '" . $base[1] . "', '" . $base[2] . "', '" . $base[3] . "', '" . $base[4] . "', '" . $base[5] . "', '" . $base[6] . "', '" . $base[7] . "', '" . $base[8] . "'); ";  // Make Multiple Insert Query 
                                                                                            $table_data .= '<tr>
                                                                                                            <td class="text-primary-emphasis">' . $base[0] . '</td>
                                                                                                            <td class="text-primary-emphasis">' . $base[1] . '</td>
                                                                                                            <td class="text-primary-emphasis">' . $base[2] . '</td>
                                                                                                            <td class="text-primary-emphasis">' . $base[3] . '</td>
                                                                                                            <td class="text-primary-emphasis">' . $base[4] . '</td>
                                                                                                            <td class="text-primary-emphasis">' . $base[5] . '</td>
                                                                                                            <td class="text-primary-emphasis">' . $base[6] . '</td>
                                                                                                            <td class="text-primary-emphasis">' . $base[7] . '</td>
                                                                                                            <td class="text-primary-emphasis">' . $base[8] . '</td>
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
                                                        echo '<table id="example"
                                                                    class="table table-bordered table-striped border-primary-subtle"
                                                                    style="width:100%">
                                                                    <tr>
                                                                        <th class="text-danger-emphasis">Mechanism</th>
                                                                        <th class="text-danger-emphasis">Code</th>
                                                                        <th class="text-danger-emphasis">uid</th>
                                                                        <th class="text-danger-emphasis">Partner</th>
                                                                        <th class="text-danger-emphasis">primeid</th>
                                                                        <th class="text-danger-emphasis">Agency</th>
                                                                        <th class="text-danger-emphasis">ou</th>
                                                                        <th class="text-danger-emphasis">startdate</th>
                                                                        <th class="text-danger-emphasis">enddate</th>
                                                                    </tr>';
                                                        echo $table_data;
                                                        echo '</table>';
                                                    }
                                                    ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="src/index.js" type="text/javascript"></script>
</body>

</html>