<!DOCTYPE html>
<html lang="fr">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>Photo</title>
		<link rel="stylesheet" href="style.css">
	</head>
	<body>
		<h1>Images</h1>
		<section class="box">
			<h2>Tables</h2>
			<div class="group">
				<!--<?php foreach($tables as $k => $v) { ?>-->
					<!--<?php $tv = ['table' => $k]; ?>-->
					<a class="btn" href="?<?=http_build_query($tv + $_GET)?>"><?=$v[0]?></a>
					<!--<?php unset($tv); ?>-->
				<!--<?php } ?>-->
			</div>
			<!--<?php if(isset($lignes) && isset($entête)) { ?>-->
				<table>
					<thead>
						<tr>
							<!--<?php foreach($entête as $k => $v) { ?>-->
								<!--<?php if(!is_int($v)) { ?>-->
									<th><?=$v?></th>
								<!--<?php } ?>-->
							<!--<?php } ?>-->
						</tr>
					</thead>
					<tbody>
						<!--<?php foreach($lignes as $k => $v) {?>-->
							<tr>
								<!--<?php foreach($v as $k => $v) { ?>-->
									<!--<?php if(is_int($k)) {?>-->
										<td><?=$v?></td>
									<!--<?php } ?>-->
								<!--<?php } ?>-->
							</tr>
						<!--<?php } ?>-->
					</tbody>
				</table>
				<div class="group">
					<!--<?php $tv = ['table' => 'hide']; ?>-->
					<a class="btn" href="?<?=http_build_query($tv + $_GET)?>">hide</a>
					<!--<?php unset($tv); ?>-->
				</div>
			<!--<?php } ?>-->
		</section>
		<section class="box">
			<h2>Filtre</h2>
			<form class="group">
				<!--<?php if(!is_null($tid) && isset($tables[$tid])) { ?>-->
					<input type="hidden" name="table" value="<?=$tid?>">
				<!--<?php } ?>-->
				<div class="group">
					<label for="show">Catégories :</label>
					<select name="show" id="show">
						<option value="">Catégories</option>
						<!--<?php foreach($catégories as $k => $v) { ?>-->
							<!--<?php $selected = ($sid == $v['id']) ? ' selected' : ''; ?>-->
								<option value="<?=$v['id']?>"<?=$selected?>><?=$v['categorie']?></option>
							<!--<?php unset($selected); ?>-->
						<!--<?php } ?>-->
					</select>
				</div>
				<div class="group">
					<label for="date">Date :</label>
					<!--<?php $value = (!is_null($date)) ? ' value="' . $date . '"' : ''; ?>-->
					<input type="date" name="date" id="date"<?=$value?>>
					<!--<?php unset($value); ?>-->
				</div>
				<div class="group">
					<label for="date">Tags :</label>
					<!--<?php $value = (!is_null($tags)) ? ' value="' . $tags . '"' : ''; ?>-->
					<input type="text" name="tags" id="tags"<?=$value?>>
					<!--<?php unset($value); ?>-->
				</div>
				<div class="group">
					<button data-reset="date" class="btn">Supprimer la date</button>
					<button class="btn">Afficher</button>
				</div>
			</form>
		</section>
		<!--<?php if(isset($images)) { ?>-->
			<section class="images">
				<!--<?php foreach($images as $k => $v) { ?>-->
					<!--<?php $source = $catégories[$v['categorie']-1]['chemin'] . $v['nom_photo']; ?>-->
					<a class="img" href="<?=$source?>">
						<img src="<?=$source?>" alt="<?=$v['titre']?>">
						<div class="hover">
							<p>Tags : <?=$v['liste_mots']?></p>
							<p>Date : <?=$v['date']?></p>
						</div>
					</a>
					<!--<?php unset($source); ?>-->
				<!--<?php } ?>-->
			</section>
		<!--<?php } ?>-->
		<script src="script.js"></script>
	</body>
</html>