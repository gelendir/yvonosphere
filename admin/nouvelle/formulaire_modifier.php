<h1>Modification d'une nouvelle</h1>
<a href="<?php echo url("admin/nouvelle/") ?>">Retourner à la liste des nouvelles</a>
<br/>
<br/>

<form method="post" action="modifier.php">
	<input type="hidden" name="id" value="<?php echo $nouvelle['id']; ?>" />
	
	<fieldset class="form">
		<div class='clearfix'>
			<label for="titre"><span>Titre</span></label>
			<div class="input"><input name="titre" type="text" maxlength="255" value="<?php echo htmlspecialchars($nouvelle['nom']); ?>"/></div>
		</div>

		<div class='clearfix'>
			<label for="texte"><span>Texte</span></label>
			<div class="input"><textarea name="texte" rows="10" style="width: 370px;"><?php
				echo htmlspecialchars($nouvelle['contenu']);
			?></textarea></div>
		</div>

		<div class='clearfix'>
			<label for="categorie"><span>Catégorie</span></label>
			<div class="input"><select name="categorie">
				<option value=""></option>
			<?php foreach(getCategories() as $categorie) {
				if($categorie['id'] == $nouvelle['categorie_id']) {
					echo "\t\t\t".'<option value="'.$categorie['id'].'" selected="selected">'.htmlspecialchars($categorie['nom']).'</option>'."\n";
				}
				else {
					echo "\t\t\t".'<option value="'.$categorie['id'].'" >'.htmlspecialchars($categorie['nom']).'</option>'."\n";
				}
			}
			?>
			</select></div>
		</div>
	
		<div class="actions">
			<input class="btn primary" type="submit" value="Modifier la nouvelle" />
		</div>
	</fieldset>
</form>
