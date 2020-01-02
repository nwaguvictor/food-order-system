<?php 
    require_once("../admin_partials/db.php");
    
    if (isset($_POST['action']) && $_POST['action'] == 'view_all_users'){
        $output = '';
        $cnt = 1;
        $query = $conn->query("SELECT * FROM users ORDER BY user_id DESC") or die("Error Displaying users");

        if ($query->num_rows > 0){
            $output = '<table id="users-table" class="table table-sm table-hover table-striped table-bordered">
            <thead>
                <tr class="text-center">
                    <th>S/N</th>
                    <th>E-MAIL</th>
                    <th>PHONE</th>
                    <th>ROLE</th>
                    <th>JOINED ON</th>
                    <th>ACTION</th>
                </tr>
            </thead>

            <tbody>';

            while ($row = $query->fetch_assoc()){
                $output .= '<tr class="text-center">
                    <td>'.$cnt.'</td>
                    <td>'.$row['email'].'</td>
                    <td>'.$row['phone'].'</td>
                    <td>'.$row['role'].'</td>
                    <td>'.$row['created_at'].'</td>
                    <td>
                        <a class="btn btn-success btn-sm viewBtn" href="" id="'.$row['user_id'].'"><i class="fa fa-fw fa-info-circle fa-lg"></i>More Details</a>
                    </td>
                </tr>';

                $cnt++;
            }

            $output .= '</tbody>
                </table>';

            echo $output;
        }
        else {
            echo '<h3 class="text-center text-danger">No Record Found in the user Table</h3>';
        }
    }


?>