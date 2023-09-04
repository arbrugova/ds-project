<?php
session_start();

require_once "db_conn.php";

if (!isset($_SESSION['user_id'])) { ?>
  <button><a href="login.php">Please log in</a></button>
  <?php }else{
    
    $query = $db->prepare('SELECT * FROM job_listing');
     
    $query->execute();
    if ($query->execute()) {
    
    
    $result = $query->fetchAll(PDO::FETCH_ASSOC);
    
    if ($result) { ?>
      <table>
    <tr>
        <th>Number</th>
        <th>Title</th>
        <th>Description</th>
        <th>Location</th>
        <th>Created</th>
        <th>Ends in</th>
        <th>Salary ($)</th>
        <th>Rate</th>
        <th>Action</th>
    </tr>
    <?php
    foreach($result as $item){
    echo '<tr>';
    echo '<td>' . $item['job_id'] . '</td>';
    echo '<td>' . $item['title'] . '</td>';
    echo '<td>' . $item['description'] . '</td>';
    echo '<td>' . $item['location'] . '</td>';
    echo '<td>' . $item['created_at'] . '</td>';
    echo '<td>' . $item['deadline'] . '</td>';
    echo '<td>' . $item['salary'] . '$</td>';
    echo '<td>' . $item['status'] . '</td>';
    echo '<td><a href="application.php?job_id=' . $item['job_id'] . '">Apply</a></td>';
    echo '</tr>';
    }
    ?>
</table>



    <?php } else {
      echo '<table>
        <tr>
          <td colspan="5">No data found</td>
        </tr>
      </table>';
    }
    }else {
        echo "Query execution failed: " . $query->errorInfo()[2];
    }

  }


?>
