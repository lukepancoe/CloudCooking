		<?php 
			$recipe_ingredients_list = $_POST['current_ingredients_select'];
			foreach ($recipe_ingredients_list as $item) {
				print $item;
			}
			/*$recipe_ingredients_list = $_POST['current_ingredients_select'];
			print('test print<br/>');
			print_r('Recipe List: ' . $recipe_ingredients_list);
			
			// connection params
			$host = 'localhost';
			$user = 'gsparks';
			$pass = 'gsparks1234';
			$db = 'gsparks';
			// connect to db
			mysql_connect($host, $user, $pass);
			mysql_select_db($db);
		
			$recipe_safe_ingredients = mysql_real_escape_string($recipe_ingredients_list);*/
		?>
		
		<?php/*
			$recipe_lower_case_search = strtolower($recipe_safe_search);
			$ingredients_lower_case_search = strtolower($ingredients_safe_search);
			
			$sql_stmt = 'SELECT DISTINCT r.name FROM Recipes r, Ingredients i, IngredientsInRecipes ir WHERE i.ingredient_id = ir.ingredient_id AND r.recipe_id = ir.recipe_id AND LOWER(r.name) LIKE "%' . $recipe_lower_case_search . '%" AND LOWER(i.name) LIKE "%' . $ingredients_lower_case_search . '%"';
			// echo $sql_stmt;
			$result = mysql_query($sql_stmt);
			$num_rows = mysql_num_rows($result);
		*/?>
		
		<!-- These divs center the resulting select display on the page -->
	<!--	<form action="view_recipe.php" method="POST">
			<div id="alignment" style="display:table; width:100%; text-align:center">
				<div id="inner_alignment" style="display:table-cell; vertical-align:middle; height:80px;">
					<select name="result_select" id="result_select" style="width:375px" size="<?php echo $num_rows; ?>">
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
		</form> -->