<tbody id="tb">
	<tr class="titleTr">
		<td style="text-align:left;font-family:Calibri;">>REQUETES PREDEFINIES</td>
		<!--<td style="text-align:left;font-family:Calibri;"><a href="<?php echo base_url(); ?>index.php/assist_requete/tables?type=ar"><span style="color:rgb(220,220,220)">REQUETES ENREGISTREES</span></a></td>
		<td style="text-align:right;font-family:Calibri;">
			<span style="position:relative;top:5px;">Rechercher:</span>
			<span id="b_rech" style="font-size:13px;font-family:Calibri;line-height:12px;float:right;margin-right:20px;margin-left:5px;height:25px" class="btn btn-primary btnxs">OK</span>
			<input id="c_rech" type="text" style="font-weight:normal;font-size:13px;font-family:Calibri;float:right;width:25%;height:25px;margin-left:10px;" class="input-sm form-control" placeholder="Recherche">
		</td>-->
	</tr>
	<tr class="headingTr">
		<?php if(isset($desc)){
		?><td colspan="3" id="t_ta" style="text-align:left;width:50%;">Liste de toutes les requetes dans "<?php echo $desc;?>"</td><?php
		} else{
		?><td colspan="3" id="t_ta" style="text-align:left;width:50%;">Liste de toutes les requetes predefinies</td><?php
		}?>
	</tr>
</tbody>
