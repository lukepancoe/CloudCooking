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
	
		<form action="search_recipes.php" method="POST" onsubmit="load_result_in_page(); return false">
			<h1 style="text-align: center;">Search Recipes</h1>
			<div style="text-align: center;">
				<input type="text" name="search_field[]" placeholder="Search Recipes" />
				<input type="text" name="search_field[]" placeholder="Search Ingredients" />
				<input value="Search" name="search_submit" type="submit" id="search_button" />
			</div>
		</form>

		<div id="results_field"></div>
	
		<?php 
			$recipe_search_value = ($_POST['search_field'][0]);
			$ingredients_search_value = ($_POST['search_field'][1]);
			//echo $recipe_search_value;
			//echo $ingredients_search_value;
			// connection params
			$host = 'localhost';
			$user = 'gsparks';
			$pass = 'gsparks1234';
			$db = 'gsparks';
			// connect to db
			mysql_connect($host, $user, $pass);
			mysql_select_db($db);
		
			$recipe_safe_search = mysql_real_escape_string($recipe_search_value);
			$ingredients_safe_search = mysql_real_escape_string($ingredients_search_value);
		?>
		
		<?php
			$recipe_lower_case_search = strtolower($recipe_safe_search);
			$ingredients_lower_case_search = strtolower($ingredients_safe_search);
			
			$sql_stmt = 'SELECT DISTINCT r.name FROM Recipes r, Ingredients i, IngredientsInRecipes ir WHERE i.ingredient_id = ir.ingredient_id AND r.recipe_id = ir.recipe_id AND LOWER(r.name) LIKE "%' . $recipe_lower_case_search . '%" AND LOWER(i.name) LIKE "%' . $ingredients_lower_case_search . '%"';
			// echo $sql_stmt;
			$result = mysql_query($sql_stmt);
			$num_rows = mysql_num_rows($result);
		?>
		
		<!-- These divs center the resulting select display on the page -->
		<form action="view_recipe.php" method="POST">
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
			<div style="text-align: center;">
				<input value="Show Recipe" name="show_recipe" type="submit" id="show_recipe" style="text-align: center; width=50px; position: absolute;" />
			</div>
		</form>
	</body>
</html>