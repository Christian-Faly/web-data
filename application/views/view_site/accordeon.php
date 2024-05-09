	<div  style="width:21%;float:left">
		<div id="debug">
			<img id="loading" src="<?php echo base_url();?>img/ajax-loading.gif"/>
		</div>
		<table>
			<thead>
				<tr>
					<th class='accordth'><h2 id="titre_b" >Enquête</h2></th>
				</tr>
			</thead>

			<tbody>
				<tr>
					<td>
						<div id="accordeon">
						<?php 
							$i=1;
							foreach($menu_accord as $row){
								if ((strlen($row->code)>5) and  (strlen($row->code)<9)){
									if  (strlen($row->code)<7){
										if  ($i>1){
											echo "</div>";
										}
										echo "<h6 style='font-size: 20px;color: #da6219;margin:10;' id ='".$row->code."' alt='".$row->nom_table."'>".$row->description."</h6>";
										echo "<div>";
									}else{
										echo "<p id = '".$row->code."' alt='".$row->nom_table."'>".$row->description."</p>";
									}
								}
								$i++;
							}
							echo "</div>";							
						?>					
						</div>
					</td>
				</tr>
		</table>
	</div>