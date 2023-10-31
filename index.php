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
                            <h4 class="text-center text-uppercase bold contentT">View of mechanisms, partners, agencies,
                                OUs and start and end dates for each mechanism.
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
                                                    Data
                                                    <a href="data_to_database.php" class="btn btn-info float-end">Add
                                                        To
                                                        Database</a>
                                                </h4>
                                            </div>
                                            <div class="card-body p-2 text-danger-emphasis">
                                                <?php
                                                session_start();
                                                include('message.php');
                                                ?>
                                                <div class="table-responsive">
                                                    <!-- Table contents here  -->
                                                    <table id="example"
                                                        class="table table-bordered table-striped border-primary-subtle"
                                                        style="width:100%">
                                                        <!--Table header -->
                                                        <thead>
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
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <!--End of Table Heading-->
                                                            <?php
                                                            $curl = curl_init();
                                                            curl_setopt($curl, CURLOPT_URL, "https://www.datim.org/api/sqlViews/fgUtV6e9YIX/data.json");
                                                            curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);

                                                            $result = curl_exec($curl);
                                                            curl_close($curl);

                                                            $decs =  json_decode($result, true);

                                                            if ($e = curl_error($curl)) {
                                                                echo $e;
                                                            } elseif (count($decs) != 0) {
                                                                foreach ($decs as $ma) : {
                                                                        foreach ($ma as $m) : {
                                                                                if (is_array($m)) {
                                                                                    foreach ((array)$m as $relate) : {
                                                                                            if (
                                                                                                isset($relate[0]) || isset($relate[1]) || isset($relate[2]) || isset($relate[3])
                                                                                                || isset($relate[4]) || isset($relate[5]) || isset($relate[6]) || isset($relate[7])
                                                                                                || isset($relate[8])
                                                                                            ) {
                                                            ?>
                                                            <tr>
                                                                <td class="text-primary-emphasis"><?= $relate[0] ?>
                                                                </td>
                                                                <td class="text-primary-emphasis"><?= $relate[1] ?>
                                                                </td>
                                                                <td class="text-primary-emphasis"><?= $relate[2] ?>
                                                                </td>
                                                                <td class="text-primary-emphasis"><?= $relate[3] ?>
                                                                </td>
                                                                <td class="text-primary-emphasis"><?= $relate[4] ?>
                                                                </td>
                                                                <td class="text-primary-emphasis"><?= $relate[5] ?>
                                                                </td>
                                                                <td class="text-primary-emphasis"><?= $relate[6] ?>
                                                                </td>
                                                                <td class="text-primary-emphasis"><?= $relate[7] ?>
                                                                </td>
                                                                <td class="text-primary-emphasis"><?= $relate[8] ?>
                                                                </td>
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
                                                        <tbody>
                                                    </table>
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