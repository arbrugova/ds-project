<?php
session_start();

require_once "db_conn.php";

if (!isset($_SESSION['user_id'])) {
  header('Location: login.php');
  exit;
}

$seller_id = $_SESSION['user_id'];

$query = $db->prepare('SELECT * FROM seller WHERE id = :seller_id');

$query->bindParam(':seller_id', $seller_id);


$query->execute();


$result = $query->fetch(PDO::FETCH_ASSOC);

if ($result) {
  echo '<table>
    <tr>
      <th>ID</th>
      <th>Position</th>
      <th>Education</th>
      <th>Degree</th>
      <th>Rate</th>
    </tr>
    <tr>
      <td>' . $result['id'] . '</td>
      <td>' . $result['position'] . '</td>
      <td>' . $result['education'] . '</td>
      <td>' . $result['degree'] . '</td>
      <td>' . $result['rate'] . '</td>
    </tr>
  </table>';
} else {
  echo '<table>
    <tr>
      <td colspan="5">No data found</td>
    </tr>
  </table>';
}

?>
