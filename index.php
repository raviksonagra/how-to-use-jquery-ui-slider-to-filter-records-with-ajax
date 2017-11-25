<?php 
include "config.php";
?>

<!doctype html>
<html>
    <head>
        <title>How to use jQuery UI slider to filter records with AJAX</title>
        <!-- CSS -->
        <link href='jquery-ui.min.css' rel='stylesheet' type='text/css'>

        <!-- Script -->
        <script src='jquery-3.1.1.min.js' type='text/javascript'></script>
        <script src='jquery-ui.min.js' type='text/javascript'></script>

        
        <script type='text/javascript'>
        $(document).ready(function(){

            // Initializing slider
            $( "#slider" ).slider({
                range: true,
                min: 20000,
                max: 80000,
                values: [ 22000, 25000 ],
                slide: function( event, ui ) {

                    // Get values
                    var min = ui.values[0];
                    var max = ui.values[1];
                    $('#range').text(min+' - ' + max);
                    
                    // AJAX request
                    $.ajax({
                        url: 'getData.php',
                        type: 'post',
                        data: {min:min,max:max},
                        success: function(response){

                            // Updating table data
                            $('#emp_table tr:not(:first)').remove();
                            $('#emp_table').append(response);    
                        }      
                    });
                }
            });
        });
        </script>
    </head>
    <body >
        <div class="container" >
            <!-- slider --> 
            <div id="slider"></div><br/>
            Range: <span id='range'></span>

            <table id='emp_table' width='100%' border='1' style='border-collapse: collapse;'>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Salary</th>
                    <th>City</th>
                </tr>
                <?php 
                $query = 'select * from employee order by emp_name asc';
                $result = mysql_query($query);
                while($row = mysql_fetch_array($result)){
                    $emp_name = $row['emp_name'];
                    $email = $row['email'];
                    $salary = $row['salary'];
                    $city = $row['city'];
                ?>
                    <tr>
                        <td><?php echo $emp_name; ?></td>
                        <td><?php echo $email; ?></td>
                        <td><?php echo $salary; ?></td>
                        <td><?php echo $city; ?></td>
                    </tr>
                <?php    
                }
                ?>
            </table>
        </div>
    </body>
</html>