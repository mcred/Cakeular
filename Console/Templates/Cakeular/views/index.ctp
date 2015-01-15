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
			<div class="panel-heading"><?php echo "<?php echo __('Actions'); ?>"; ?></div>
			<div class="list-group">
				<?php echo "<?php echo \$this->Html->link(__('List {$pluralHumanName}'), array('action' => 'index'), array('class' => 'list-group-item active')); ?>\n"; ?>
				<?php echo "<?php echo \$this->Html->link(__('Add {$singularHumanName}'), array('action' => 'add'), array('class' => 'list-group-item')); ?>\n"; ?>
			</div>
		</div>
	</div>
	<div class="col-md-9 content">
		<h2><?php echo $pluralHumanName; ?></h2>
		<div class="table-responsive">
			<table class="table table-striped table-bordered" ng-controller="<?php echo $pluralHumanName; ?>IndexCtrl">
				<tr>
<?php foreach ($fields as $field): ?>
					<th><?php echo "{$field}"; ?></th>
<?php endforeach; ?>
				</tr>
				<tr ng-repeat="<?php echo $singularVar; ?> in <?php echo $pluralVar; ?>">
<?php foreach ($fields as $field): ?>
					<td>{{<?php echo $singularVar . '.' . $singularHumanName . '.' . $field; ?>}}</td>
<?php endforeach; ?>
				</tr>
			</table>
		</div>
	</div>
</div>
<?php echo "<?php\n"; ?>
$angscript = '
		(function(){
			var app = angular.module(\'app\', []);

			app.controller("<?php echo $pluralHumanName; ?>IndexCtrl", function($scope, $http) {
				$scope.<?php echo $pluralVar; ?> = [];
				$http.get(\'/<?php echo $pluralVar; ?>/api/\').success(function(data) {
			        $scope.<?php echo $pluralVar; ?> = data;
			    });
			});

		})();
';
echo $this->Html->scriptBlock(
    $angscript,
    array('inline' => false)
);
<?php echo "?>"; ?>