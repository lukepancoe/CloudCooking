<html><body>
<div style="text-align: right;">
	<form method="link" style="display:inline;" action="SearchRecipes.html">
		<input type="submit" value="Search Recipes">
	</form>
	<form method="link" style="display:inline" action="filter_ingredients.php">
		<input type="submit" value="Create Recipe">
	</form>
	<form method="link" style="display:inline;" action="add_ingredient.php">
		<input type="submit" value="Add Ingredient">
	</form>
</div>

<?php
	if(isset($_REQUEST['add_ingredient_submit']))
		{
			$host = "localhost";
			$user = "gsparks";
			$pass = "gsparks1234";
			$db = "gsparks";
			mysql_connect($host, $user, $pass);
			mysql_select_db($db);
			$ingredient = $_POST['add_ingredient_field'];
			$safe_ingredient = mysql_real_escape_string($ingredient);
			$lower_case_ingredient = strtolower($safe_ingredient);
			//echo $lower_case_ingredient;
			$sql = "INSERT INTO Ingredients(name) VALUES( '" . $lower_case_ingredient . "');";
			$result = mysql_query($sql);
			if(!$result)
			 echo "Invalid Query";
		}	
	?>

<h1 style="text-align: center;">Add Ingredient</h1>
<form method="POST" action="add_ingredient.php">
<div style="text-align: center;">
		<input name="add_ingredient_field" placeholder="Ingredient Name" type="text">
		<input value="Add" name="add_ingredient_submit" type="submit">
	</form>
</div>
<div style="text-align: center;">
	<select multiple style="width:375px" size="8">
		<?php
			$host = "localhost";
			$user = "gsparks";
			$pass = "gsparks1234";
			$db = "gsparks";
			mysql_connect($host, $user, $pass);
			mysql_select_db($db);
			$stmt = "SELECT name FROM Ingredients;";
			$result = mysql_query($stmt);
			$num_rows = mysql_num_rows($result);
			while($row = mysql_fetch_row($result)) 
			{
				list($name) = $row;
				echo '<option>' . $name . '</option>';
			}
		?>
		</select>
	</div>
<div style="text-align: center;">
	<form method="link" style="display:inline" action="CreateRecipe.html">
		<input type="submit" value="Create Recipe">
	</form>
	<form method="link" style="display:inline;" action="SearchRecipes.html">
		<input type="submit" value="Search Recipes">
	</form>
</div>
</body></html>