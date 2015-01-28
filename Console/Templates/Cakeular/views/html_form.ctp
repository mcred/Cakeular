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
			<div class="panel-heading"></div>
			<div class="list-group">
				<a class="list-group-item" href="/<?php echo $pluralVar; ?>"/#/>List <?php echo $pluralHumanName; ?></a>
			</div>
		</div>
	</div>
	<div class="col-md-9 content">
		<h2><?php echo Inflector::humanize(explode('_', $action)[1]); ?> <?php echo $singularHumanName ; ?></h2>
		<form novalidate role="form">
			<fieldset>
				<legend><?php echo $singularHumanName; ?> Information</legend>
<?php foreach ($fields as $field): ?>
<?php if (strpos($action, 'html_add') !== false && $field == $primaryKey): ?>
<?php continue; ?>
<?php elseif (!in_array($field, array('created', 'modified', 'updated'))): 
	$belongCheck = array();?>
	<?php if (!empty($associations['belongsTo'])):
	foreach ($associations['belongsTo'] as $alias => $details): 
		if($details['foreignKey'] == $field): ?>
			<div class="form-group">
					<label for="<?php echo $details['foreignKey']; ?>"><?php echo $alias; ?>:</label>
					<select ng-model="<?php echo $pluralVar; ?>.<?php echo Inflector::humanize($singularVar); ?>.<?php echo $details['foreignKey']; ?>" id="<?php echo $details['foreignKey']; ?>" class="form-control">
				        <option ng-repeat="<?php echo strtolower($alias); ?> in <?php echo $details['controller']; ?>" value="{{ <?php echo strtolower($alias); ?>.<?php echo $alias; ?>.id }}">{{ <?php echo strtolower($alias); ?>.<?php echo $alias; ?>.<?php echo $details['displayField']; ?> }}</option>
				    </select>
				</div>
<?php	$belongCheck[] = $details['foreignKey'];
		endif;
	endforeach;
	endif;
if(!in_array($field, $belongCheck)): ?>
			<div class="form-group">
					<label for="<?php echo $field ?>"><?php echo Inflector::humanize($field) ?>:</label>
					<input ng-model="<?php echo $pluralVar; ?>.<?php echo Inflector::humanize($singularVar); ?>.<?php echo $field ?>" type="text" class="form-control" id="<?php echo $field ?>">
				</div>
<?php endif; ?>
<?php endif; ?>
<?php endforeach; ?>
<?php //if (!empty($associations['hasAndBelongsToMany'])): ?>
<?php //foreach ($associations['hasAndBelongsToMany'] as $assocName => $assocData): ?>
<?php /* echo "<?php echo \$this->Form->input('{$assocName}');?>\n"; ) */ ?>
<?php //endforeach; ?>
<?php //endif; ?>
			</fieldset>
		<button ng-click="send()" type="submit" class="btn btn-default">Submit</button>
	</div>
</div>