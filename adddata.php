<?php

session_start();

$errors="";
//connect to database
$db=mysqli_connect('localhost','root','','addlist');

if(isset($_POST['submit'])){
  $task=$_POST['task'];
  if(empty($task)){
    echo"You must fill the data in the box";

  }else{
    mysqli_query($db, "INSERT into phpproject(task)value('$task')");
  header('localhost:adddata.php');

  }
}
    // delete task
    if(isset($_GET['del_task'])){
    $id=$_GET['del_task'];
    mysqli_query($db, "DELETE from phpproject where id=$id");
    header('localhost:adddata.php');
 }
  $task=mysqli_query($db,"SELECT *from phpproject");


?>

<!DOCTYPE html>
<html>
<head>
<title>Django To Do List App</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" type="text/css" href="style.css">

</head>
<body>

<div id="myDIV" class="header">
  <h2 style="margin:5px"> To Do List Application with PHP and MySQL</h2>
  <form action="adddata.php" method="POST">
  <?php if(isset($errors)){ ?>
     <p><?php echo "You must fill the data in the box"; ?></p>
 <?php } ?>
    <input type="text" name="task" class="task-input">
    <button type="submit" class="addBtn" name="submit">Add</button>
  </form>

</div>

<table border="1">
  <thead>
    <tr>
      <th>SN</th>
      <th>Task</th>
      <th>Action</th>
    </tr>
  </thead>
  <tbody>
  <?php $i=1;while($row=mysqli_fetch_array($task)){ ?>

 
    <tr>
      <td><?php echo $i; ?></td>
      <td class="task"><?php echo $row['task']; ?></td>
      <td class="delete">
        <a href="adddata.php?del_task=<?php echo $row['id']; ?>">Detete</a>

      </td>
    </tr>
    <?php $i++;}?>
  </tbody>
</table>
</body>
</html>


