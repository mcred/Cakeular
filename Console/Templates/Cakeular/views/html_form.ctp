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
		<h2>Add <?php echo $singularHumanName; ?> </h2> 
		<form novalidate role="form">
<?php foreach ($fields as $field): ?>
			<div class="form-group">
				<label for="<?php echo $field ?>">House:</label>
				<input ng-model="<?php echo $singularVar; ?>.<?php echo $field ?>" type="text" class="form-control" id="<?php echo $field ?>">
			</div>
<?php endforeach; ?>
			<button ng-click="add()" type="submit" class="btn btn-default">Submit</button>
		</form>
	</div>	
</div>