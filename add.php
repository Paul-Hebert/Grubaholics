<?php include 'header.php';?>
		<form name="input" method="post" action="insert.php" id="content" enctype="multipart/form-data" onsubmit="return validation(this)">
			<h2>Enter your recipe below:</h2>
			<hr /><hr />
			<div class="row">
				<h2 class="col-3 stretch-6">Name:</h2>
				<input type="text" name="foodname" class="col-9 stretch-6" value=" e.g. Lasagna" onclick="inputSelect(this.id,' e.g. Lasagna');" id="foodname"/>
			</div>
			<div class="row">
				<h2 class="col-3 stretch-6">Description:</h2>
				<input type="text" name="description"  class="col-9 stretch-6" id="description" value=" My own take on a classic." onclick="inputSelect(this.id,' My own take on a classic.')"/>
			</div>
			<div class="row">
			<h2 class="col-3 stretch-6">Servings:</h2>
					<input type="text" name="servings" class="col-9 stretch-6" value=" 8" onclick="inputSelect(this.id,' 8');" id="servings"/>
			</div>
			<hr />

			<h2 class="col-8">Ingredients:</h2><h2 class="col-3">Amount:</h2>
			<span id="ingredients">
				<input type="text" name="ingredientnumber" id="ingredientnumber" class="hidden" value="1"/>
				<input type="text" name="ingredient1" id="ingredient1" class="col-8" value=" Garlic" onclick="inputSelect(this.id,' Garlic')"/>
				<input type="text" name="ingredient_amount1" id="ingedient_amount1" class="col-3" value=" 2 cloves" onclick="inputSelect(this.id,' 2 cloves')"/>
				<br/>
			</span>
			<br /> <br/><br />
				<button type="button" class="col-6" onclick="add_field('ingredient','amount')">Add another ingredient.</button>
				<hr />

			<h2 class="col-8">Instructions:</h2><h2 class="col-3">Time (mins):</h2>
			<span id="instructions" class="row">
				<input type="text" name="instructionnumber" id="instructionnumber" class="hidden" value="1"/>
				<input type="text" name="instruction1" id="instruction1"  class="col-8"/ value=" Preheat the oven to 350 degrees." onclick="inputSelect(this.id,' Preheat the oven to 350 degrees.')">
				<input type="number" name="instruction_step1" id="instruction_step1"  class="col-3" value="10" onclick="inputSelect(this.id,'10')"/>
				<br/>
			</span>
			<br /> <br/><br />
				<button type="button" class="col-6" onclick="add_field('instruction','step')">Add another step.</button>
				<hr />


			<div class="row">
			<input type="button" class="col-6 submit" value="Upload a photo" onclick="upload();">
			<input type="text" class="col-5" id="filename" name="filename" readonly onclick="upload();">
			<input type="file" class="hidden" multiple id="uploader" onChange="writeFileName();" name="file">
			</div>
			<br />
			<div id="valid_msg"></div>
			<hr/>
			<div class="row">
				<div class="col-4"><input type="checkbox" name="vegetarian">&nbsp; Vegetarian</div>
				<div class="col-4"><input type="checkbox" name="vegan">&nbsp; Vegan</div>
				<div class="col-4"><input type="checkbox" name="gf">&nbsp;Gluten Free</div>			
			</div>
			<hr />
			<hr />
			<input type="submit" value="Upload" class="submit col-12"><br>

		</form>

<?php include('footer.php')?>