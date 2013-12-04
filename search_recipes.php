<html>
	<body>
		<?php 
			$search_value = $_POST['search_field'];
			/* echo '<p>Searched for: ' . $search_value . '</p>';*/
			// connection params
			$host = 'localhost';
			$user = 'gsparks';
			$pass = 'gsparks1234';
			$db = 'gsparks';
			// connect to db
			mysql_connect($host, $user, $pass);
			mysql_select_db($db);
		
			$safe_search = mysql_real_escape_string($search_value);
		?>
		
		<?php
			$lower_case_search = strtolower($safe_search);
			$sql_stmt = 'SELECT r.name FROM Recipes r WHERE LOWER(r.name) LIKE "%' . $lower_case_search . '%"';
			/* echo $sql_stmt; */
			$result = mysql_query($sql_stmt);
		?>
		
		<table border="1" style="width:200px; margin: 10px auto;">
		<?php
			while($row = mysql_fetch_row($result)) {
				list($name) = $row;
				echo '<tr>';
				echo '<td>' . $name . '</td>';
				echo '</tr>';
			}
			mysql_close();
		?>
		</table>

	</body>
</html>