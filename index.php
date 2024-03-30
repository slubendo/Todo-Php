<?php
require_once './Services/DBService.php';
use Services\DBService;

$connected = DBService::connect();
$todos = DBService::all('todo');
// var_dump($todos)
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<ul>
	<li>
	  <form action="/Routes/create.php" method="POST">
	   <input type="text" name="value" placeholder="Add new Todo"></input>
	   <button>Create</button>
	  </form>
	</li>
	<?php
	foreach ($todos as $todo) {
			echo "<li>{$todo['value']}
			<form action='/Routes/delete.php' method='POST'>
			<input type='hidden' name='id' value='{$todo["todo_id"]}'>
			<button>Done</button>
			</form>
			</li>";
		}
	?>
</ul>
</body>
</html>
