<div class="row">
	<div class="col-md-3 sidebar">
		<div class="panel panel-default">
			<div class="panel-heading"></div>
			<div class="list-group">
				<a href="/<?php echo $pluralVar ;?>/#/" class="list-group-item active">List <?php echo $pluralHumanName ;?></a>
				<a href="/<?php echo $pluralVar; ?>/#/add" class="list-group-item" >Add <?php echo $singularHumanName; ?></a>
			</div>
		</div>
	</div>
	<div class="col-md-9 content">
		<h2><?php echo $pluralHumanName ;?></h2>
		<div class="table-responsive">
			<table class="table table-striped table-bordered">
				<tr>
<?php foreach ($fields as $field): ?>
					<th><a href="" ng-click="predicate = '<?php echo $singularHumanName ;?>.<?php echo $field; ?>'; reverse=!reverse"><?php echo Inflector::humanize($field); ?></a></th>
<?php endforeach; ?>
					<th class="actions"><a href="">Actions</a></th>
				</tr>
				<tr ng-repeat="<?php echo $singularVar ;?> in <?php echo $pluralVar ;?> | orderBy:predicate:reverse | offset: currentPage*itemsPerPage | limitTo:itemsPerPage">
<?php foreach ($fields as $field): ?>
	<?php if($field == 'id'){ ?>
					<td><a href="/<?php echo $pluralVar ;?>/#/view/{{<?php echo $singularVar ;?>.<?php echo $singularHumanName ;?>.id}}">{{<?php echo $singularVar ;?>.<?php echo $singularHumanName ;?>.<?php echo $field ;?>}}</a></td>
	<?php } else { ?>
					<td>{{<?php echo $singularVar ;?>.<?php echo $singularHumanName ;?>.<?php echo $field ;?>}}</td>
	<?php } ?>					
<?php endforeach; ?>
					<td class="actions">
						<div class="btn-group">
							<a href="/<?php echo $pluralVar ;?>/#/view/{{<?php echo $singularVar ;?>.<?php echo $singularHumanName ;?>.id}}" class="btn btn-default btn-xs">
								<span class="glyphicon glyphicon-eye-open"></span>
							</a>
							<a href="/<?php echo $pluralVar ;?>/#/edit/{{<?php echo $singularVar ;?>.<?php echo $singularHumanName ;?>.id}}" class="btn btn-default btn-xs">
								<span class="glyphicon glyphicon-pencil"></span>
							</a>
							<a href="/<?php echo $pluralVar ;?>/#/delete/{{<?php echo $singularVar ;?>.<?php echo $singularHumanName ;?>.id}}" class="btn btn-default btn-xs">
								<span class="glyphicon glyphicon-trash"></span>
							</a>
						</div>
					</td>
				</tr>
			</table>
	    	<div class="pull-right">
				<ul class="pagination">
					<li ng-class="prevPageDisabled()">
						<a href ng-click="prevPage()">« Prev</a>
					</li>
					<li ng-repeat="n in range()" ng-class="{active: n == currentPage}">
						<a href ng-click="setPage(n)">{{n+1}}</a>
					</li>
					<li ng-class="nextPageDisabled()">
						<a href ng-click="nextPage()">Next »</a>
					</li>
				</ul>
			</div>
		</div>
	</div>	
</div>