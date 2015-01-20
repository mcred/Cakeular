<div class="row">
	<div class="col-md-3 sidebar">
		<div class="panel panel-default">
			<div class="panel-heading"></div>
			<div class="list-group">
				<a href="/<?php echo $pluralVar ;?>/#/" class="list-group-item active">List <?php echo $pluralHumanName ;?></a>
			</div>
		</div>
	</div>
	<div class="col-md-9 content">
		<h2><?php echo $pluralHumanName ;?></h2>
		<div class="table-responsive">
			<table class="table table-striped table-bordered">
				<tr>
<?php foreach ($fields as $field): ?>
					<th><a href="" ng-click="predicate = '<?php echo $singularHumanName ;?>.<?php echo $field; ?>'; reverse=!reverse"><?php echo $field; ?></a></th>
<?php endforeach; ?>
				</tr>
				<tr ng-repeat="<?php echo $singularVar ;?> in <?php echo $pluralVar ;?> | orderBy:predicate:reverse">
<?php foreach ($fields as $field): ?>
	<?php if($field == 'id'){ ?>
					<td><a href="/<?php echo $pluralVar ;?>/#/view/{{<?php echo $singularVar ;?>.<?php echo $singularHumanName ;?>.id}}">{{<?php echo $singularVar ;?>.<?php echo $singularHumanName ;?>.<?php echo $field ;?>}}</a></td>
	<?php } else { ?>
					<td>{{<?php echo $singularVar ;?>.<?php echo $singularHumanName ;?>.<?php echo $field ;?>}}</td>
	<?php } ?>					
<?php endforeach; ?>
				</tr>
			</table>
		</div>
	</div>	
</div>