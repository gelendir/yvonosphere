<h1>Ajout d'une nouvelle</h1>

<a href="<?php echo url("admin/nouvelle/") ?>">Retourner à la liste des nouvelles</a>
<br/>
<br/>

<form method="post" action="#">
	<fieldset class="form">
	
		<div class='clearfix'>
			<label for="titre"><span>Titre</span></label>
			<div class="input"><input name="titre" type="text" maxlength="255" value=""/></div>
		</div>

		<div class='clearfix'>
			<label for="texte"><span>Texte</span></label>
			<div class="input"><textarea name="texte" rows="10" style="width: 370px;"></textarea></div>
		</div>

		<div class='clearfix'>
			<label for="categorie"><span>Catégorie</span></label>
			<div class="input"><select name="categorie">
				<option value="" selected="selected"></option>
			<?php foreach(getCategories() as $nouvelle) { 
				echo "\t\t\t\t".'<option value="'.$nouvelle['id'].'" >'.htmlspecialchars($nouvelle['nom']).'</option>'."\n";
			}
			?>
			</select></div>
		</div>
		
		<div class="actions">
			<input class="btn primary" type="submit" value="Ajouter la nouvelle" />
		</div>

	</fieldset>
</form>
