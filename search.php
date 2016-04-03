<div class="row">
	<div class="col-5">
		<input type="checkbox" name="vegetarian" onclick="filterBy('vegetarian');">
		&nbsp; Vegetarian
		<br />
		<input type="checkbox" name="vegan" onclick="filterBy('vegan');">
		&nbsp; Vegan
		<br />
		<input type="checkbox" name="gf" onclick="filterBy('gf');">
		&nbsp; Gluten Free
	</div>	
	<input type="text" onKeyUp="filterBy()"  onclick="inputSelect(this.id,' Search for:')" id="searchName" class="search col-7" value=" Search for:"/> 		
</div>
<hr />
