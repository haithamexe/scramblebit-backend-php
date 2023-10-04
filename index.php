<?php
  include_once 'db_connect.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="css/style.css">
  <script
			  src="https://code.jquery.com/jquery-3.7.1.min.js"
			  integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo="
			  crossorigin="anonymous"></script>
  <title>Todo App</title>
</head>
<body>
  <div class="main-section">
    <div class="add-section">
      <form action="app/add.php" method="POST" autocomplete="off">
        <?php if(isset($_GET['mess']) && $_GET['mess'] == 'error') { ?>
          <input type="text" 
                 name="title" 
                 style="border-color: #ff6666"
                 placeholder="This field is required" />
          <button type="submit"> Add &nbsp; <span> &#43; </span> </button>
        <?php }else { ?>

          <input type="text" name="title" placeholder="What do you need to do" required />
          <button type="submit"> Add &nbsp; <span> &#43; </span> </button>
        <?php  } ?>
      </form> 
    </div>
    <div class="show-todo-section">
      <?php
        $todos = mysqli_query($conn, "SELECT * FROM todos ORDER BY id DESC");
        ?>
        <?php if(mysqli_num_rows($todos) <= 0) { ?>
          <div class="todo-item">
            <div class="empty">
              <img src="img/f.png" width="100%" />
              <img src="img/Ellipsis.gif" width="80px" />
            </div>
          </div>
        <?php } ?>

        <?php while($todo = mysqli_fetch_array($todos)) { ?>
          <div class="todo-item">
                    <span id="<?php echo $todo['id']; ?>"
                          class="remove-to-do">x</span>
                    <?php if($todo['checked']){ ?> 
                        <input type="checkbox"
                               class="check-box"
                               data-todo-id ="<?php echo $todo['id']; ?>"
                               checked />
                        <h2 class="checked"><?php echo $todo['title'] ?></h2>
                    <?php }else { ?>
                        <input type="checkbox"
                               data-todo-id ="<?php echo $todo['id']; ?>"
                               class="check-box" />
                        <h2><?php echo $todo['title'] ?></h2>
                    <?php } ?>
                    <br>
                    <small>created: <?php echo $todo['date'] ?></small> 
                </div>
        <?php } ?>

        <!-- <div class="todo-item">
          <input type="checkbox" />
          <h1>Learn PHP</h1>
          <small>created: </small>
        </div> -->
        

      <!-- <div class="todo-item">
        <input type="checkbox" />
        <h1>Learn PHP</h1>
        <small>created: </small>
      </div> -->
    </div>
  </div>
  
  <script src="js/script.js"></script>
</body>
</html>