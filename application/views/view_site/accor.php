<div class="span3">

	<aside class="left-sidebar">

		<div class="widget">
		<form>
			<div class="input-append">
			<input class="span2" id="appendedInputButton" type="text" placeholder="Type here">
			<button class="btn btn-theme" type="submit">Search</button>
			</div>
		</form>
		</div>

		<div class="widget">

			<h5 class="widgetheading">Categories</h5>

			<ul class="cat">
				<?php
				$r=$model->get_menu('04');
				
				foreach ( $r as $row)// $rac_result
				{
					$model->buildParent($row->code, $row->description, 'ar', true, $row->nom_table);
				}
				?>
			</ul>
		</div>

	</aside>
</div>

<div class="span9"> 

