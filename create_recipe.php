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
			$recipe_ingredients_list = $_POST['current_ingredients_select'];
			$recipe_name = $_POST['recipe_name_field'];
			$instructions = $_POST['instructions_area'];
			
			// connection params
			$host = 'localhost';
			$user = 'gsparks';
			$pass = 'gsparks1234';
			$db = 'gsparks';
			// connect to db
			mysql_connect($host, $user, $pass);
			mysql_select_db($db);
			
			$safe_name = mysql_real_escape_string($recipe_name);
			$safe_instructions = mysql_real_escape_string($instructions);
		?>
		
		<?php
			$lower_case_name = strtolower($safe_name);
			$lower_case_instructions = strtolower($safe_instructions);
			
			$sql_stmt = 'INSERT INTO Recipes (name, instructions) VALUES ("' . $lower_case_name . '", "' . $lower_case_instructions . '")';
			$result = mysql_query($sql_stmt);

			foreach ($recipe_ingredients_list as $item) {
				$ingredient = $item;
				$sql_stmt = 'INSERT INTO IngredientsInRecipes (recipe_id, ingredient_id) SELECT r.recipe_id, i.ingredient_id FROM Recipes r, Ingredients i WHERE r.name="' . $lower_case_name . '" AND i.name="' . $ingredient . '"';
				$result = mysql_query($sql_stmt);
				print '<br/>';
			}			
		?>
		
		<?php
			$lower_case_search = $lower_case_name;
			$sql_stmt = 'SELECT i.name FROM Ingredients i, Recipes r, IngredientsInRecipes ir WHERE r.name = "' . $lower_case_search . '" AND r.recipe_id = ir.recipe_id AND i.ingredient_id = ir.ingredient_id';
			$ingredients_list = mysql_query($sql_stmt);
			$num_rows = mysql_num_rows($ingredients_list);
			
			$sql_stmt = 'SELECT r.instructions FROM Recipes r WHERE r.name = "' . $lower_case_search . '"';
			$instructions = mysql_query($sql_stmt);
		?>
		
		<!-- These divs center the resulting select display on the page -->
		<h1 style="text-align: center;"><?php echo $recipe_name ?></h1>
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