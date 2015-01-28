<?php
/**
 *
 * PHP 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       Cake.Console.Templates.default.views
 * @since         CakePHP(tm) v 1.2.0.5234
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */
?>
<div class="row">
	<div class="col-md-3 sidebar">
		<div class="panel panel-default">
			<div class="panel-heading">Actions</div>
			<div class="list-group">
				<a class="list-group-item" href="/<?php echo $pluralVar; ?>/#/">List <?php echo $pluralHumanName; ?></a>
				<a class="list-group-item" href="/<?php echo $pluralVar; ?>/#/add">Add <?php echo $singularHumanName; ?></a>
			</div>
		</div>
		<div class="panel panel-default">
			<div class="panel-heading"><?php echo $singularHumanName; ?> Actions</div>
			<div class="list-group">
				<a class="list-group-item active" href="/<?php echo $pluralVar; ?>/#/view/{{ <?php echo $pluralVar.".".$singularHumanName.".id"; ?> }}">View <?php echo $singularHumanName; ?></a>
				<a class="list-group-item" href="/<?php echo $pluralVar; ?>/#/edit/{{ <?php echo $pluralVar.".".$singularHumanName.".id"; ?> }}">Edit <?php echo $singularHumanName; ?></a>
				<a class="list-group-item" href="/<?php echo $pluralVar; ?>/#/delete/{{ <?php echo $pluralVar.".".$singularHumanName.".id"; ?> }}">Delete <?php echo $singularHumanName; ?></a>
			</div>
		</div>
	</div>
	<div class="col-md-9 content">
		<h2>View <?php echo $singularHumanName; ?></h2>
		<dl class="dl-horizontal">
<?php foreach ($fields as $field): ?>
<?php $isKey = false; ?>
<?php if (!empty($associations['belongsTo'])): ?>
<?php foreach ($associations['belongsTo'] as $alias => $details): ?>
<?php if ($field === $details['foreignKey']): ?>
<?php $isKey = true; ?>
			<dt title="<?php echo Inflector::humanize(Inflector::underscore($alias)); ?>"><?php echo Inflector::humanize(Inflector::underscore($alias)); ?></dt>
			<dd><a href="/<?php echo strtolower($alias)?>s/#/view/{{<?php echo $pluralVar .".".$alias.".id"; ?>}}">{{ <?php echo $pluralVar .".".$alias.".".$details['displayField']; ?>}}</a></dd>
<?php break; ?>
<?php endif; ?>
<?php endforeach; ?>
<?php endif; ?>
<?php if ($isKey !== true): ?>
			<dt title="<?php echo Inflector::humanize($field); ?>"><?php echo Inflector::humanize($field); ?></dt>
<?php if ($field === 'created' || $field === 'modified'): ?>
			<dd>{{ <?php echo $pluralVar. "." . $singularHumanName . "." . $field; ?> | date:'medium' }}</dd>
<?php else: ?>
			<dd>{{ <?php echo $pluralVar. "." . $singularHumanName . "." . $field; ?> }}</dd>
<?php endif; ?>
<?php endif; ?>
<?php endforeach; ?>
		</dl>
<?php if (!empty($associations['hasOne'])): ?>
<?php foreach ($associations['hasOne'] as $alias => $details): ?>
		<div class="related">
			<h3>Related <?php echo Inflector::humanize($details['controller']); ?></h3>
			<dl class="dl-horizontal">
<?php foreach ($details['fields'] as $field): ?>
				<dt title="<?php echo Inflector::humanize($field); ?>"><?php echo Inflector::humanize($field); ?></dt>
				<dd>{{ <?php echo $pluralVar. "." . $singularHumanName . "." . $field; ?> }}</dd>
<?php endforeach; ?>
			</dl>
			<?php echo "<?php endif; ?>\n"; ?>
			<div class="actions">
				<div class="btn-group">
					<a class="btn btn-default btn-xs" href="/<?php echo $details['controller']; ?>/#/view/{{ <?php echo $otherSingularVar . '.id'; ?> }}"><span class="glyphicon glyphicon-list-alt"></span></a>
					<a class="btn btn-default btn-xs" href="/<?php echo $details['controller']; ?>/#/edit/{{ <?php echo $otherSingularVar . '.id'; ?> }}"><span class="glyphicon glyphicon-pencil"></span></a>
					<a class="btn btn-default btn-xs" href="/<?php echo $details['controller']; ?>/#/delete/{{ <?php echo $otherSingularVar . '.id'; ?> }}"><span class="glyphicon glyphicon-trash"></span></a>
				</div>
			</div>
		</div>
<?php endforeach; ?>
<?php endif; ?>
<?php if (empty($associations['hasMany'])): ?>
<?php $associations['hasMany'] = array(); ?>
<?php endif; ?>
<?php if (empty($associations['hasAndBelongsToMany'])): ?>
<?php $associations['hasAndBelongsToMany'] = array(); ?>
<?php endif; ?>
<?php $relations = array_merge($associations['hasMany'], $associations['hasAndBelongsToMany']); ?>
<?php foreach ($relations as $alias => $details): ?>
<?php $otherSingularVar = Inflector::variable($alias); ?>
<?php $otherPluralHumanName = Inflector::humanize($details['controller']); ?>
		<div class="related">
			<h3>Related <?php echo $otherPluralHumanName; ?></h3>
			<div class="table-responsive">
				<table class="table table-striped table-bordered">
					<tr>
<?php foreach ($details['fields'] as $field): ?>
						<th><?php echo Inflector::humanize($field); ?></th>
<?php endforeach; ?>
						<th class="actions">Actions</th>
					</tr>
					<tr ng-repeat="<?php echo $otherSingularVar; ?> in <?php echo $pluralVar; ?>.<?php echo ucfirst($otherSingularVar); ?>">

<?php foreach ($details['fields'] as $field): ?>
						<td>{{ <?php echo $otherSingularVar . '.' . $field; ?> }}</td>
<?php endforeach; ?>
						<td class="actions">
							<div class="btn-group">
								<a class="btn btn-default btn-xs" href="/<?php echo $details['controller']; ?>/#/view/{{ <?php echo $otherSingularVar . '.id'; ?> }}"><span class="glyphicon glyphicon-list-alt"></span></a>
								<a class="btn btn-default btn-xs" href="/<?php echo $details['controller']; ?>/#/edit/{{ <?php echo $otherSingularVar . '.id'; ?> }}"><span class="glyphicon glyphicon-pencil"></span></a>
								<a class="btn btn-default btn-xs" href="/<?php echo $details['controller']; ?>/#/delete/{{ <?php echo $otherSingularVar . '.id'; ?> }}"><span class="glyphicon glyphicon-trash"></span></a>
							</div>
						</td>
					</tr>
				</table>
			</div>

			<div class="actions">
				<a class="btn btn-default" href="/<?php echo $details['controller']; ?>/#/add">Add <?php echo Inflector::humanize(Inflector::underscore($alias)); ?></a>
			</div>
		</div>
<?php endforeach; ?>
	</div>
</div>