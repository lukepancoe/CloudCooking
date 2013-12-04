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
			$num_rows = mysql_num_rows($result);
			
		?>
		
		<!-- These divs center the resulting select display on the page -->
		<div id="alignment" style="display:table; width:100%; text-align:center">
			<div id="inner_alignment" style="display:table-cell; vertical-align:middle; height:80px;">
				<select name="result_select" id="result_select" size="<?php echo $num_rows; ?>">
				<?php
					while($row = mysql_fetch_row($result)) {
						list($name) = $row;
						echo '<option>' . $name . '</option>';
					}
					mysql_close();
				?>
				</select>
			</div>
		</div>

	</body>
</html>