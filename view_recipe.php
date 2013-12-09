<html>
	<body>
		<div style="text-align: right;">
			<form method="link" style="display:inline;" action="SearchRecipes.html">
				<input type="submit" value="Search Recipes">
			</form>
			<form method="link" style="display:inline" action="CreateRecipe.html">
				<input type="submit" value="Create Recipe">
			</form>
			<form method="link" style="display:inline;" action="AddIngredient.html">
				<input type="submit" value="Add Ingredient">
			</form>
		</div>
		<?php 
			$search_value = $_POST['result_select'];
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
			$sql_stmt = 'SELECT i.name FROM Ingredients i, Recipes r, IngredientsInRecipes ir WHERE r.name = "' . $lower_case_search . '" AND r.recipe_id = ir.recipe_id AND i.ingredient_id = ir.ingredient_id';
			/* echo $sql_stmt; */
			$ingredients_list = mysql_query($sql_stmt);
			$num_rows = mysql_num_rows($ingredients_list);
			
			$sql_stmt = 'SELECT r.instructions FROM Recipes r WHERE r.name = "' . $lower_case_search . '"';
			$instructions = mysql_query($sql_stmt);
		?>
		
		<!-- These divs center the resulting select display on the page -->
		<h1 style="text-align: center;"><?php echo $search_value ?></h1>
		<div id="alignment" style="display:table; width:500px; margin: 0 auto; text-align:left">
			<div id="inner_alignment" style="display:table-cell; vertical-align:middle; height:80px;">
				<h3>Ingredients</h3>
				<?php
					while($row = mysql_fetch_row($ingredients_list)) {
						list($name) = $row;
						echo '<p>' . $name . '</p>';
					}
				?>
			</div>
			<div style="float:right;">
				<h3>Instructions</h3>
				<?php
					while($row = mysql_fetch_row($instructions)) {
						list($instructions) = $row;
						echo '<p>' . $instructions . '</p>';
					}
					mysql_close();
				?>
			</div>
		</div>
	</body>
</html>