<?php
/**
 * Bake Template for Controller action generation.
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
 * @package       Cake.Console.Templates.default.actions
 * @since         CakePHP(tm) v 1.3
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */
?>	
		/**
		 * index method
		 *
		 * @return void
		 * @throws exception
		 */
		public function index($id = null) {
			switch ($this->request->method()) {
				case 'GET':
					if (!$id) {
						$<?php echo $pluralName; ?> = $this-><?php echo $currentModelName; ?>->find('all', array('recursive' => 0));
						$this->set(compact('<?php echo $pluralName; ?>','id'));
					} elseif(!$this-><?php echo $currentModelName; ?>->exists($id)){
						$error = $this->Cakeular->error('failure','<?php echo ucfirst(strtolower($singularHumanName)); ?> was not found');
						$<?php echo $singularName; ?> = array(
							'<?php echo ucfirst(strtolower($singularHumanName)); ?>' => $error
						);
						$this->set(compact('<?php echo $singularName; ?>','id'));
					} else {
						$<?php echo $singularName; ?> = $this-><?php echo $currentModelName; ?>->find('first', array('conditions' => array('<?php echo $currentModelName; ?>.' . $this-><?php echo $currentModelName; ?>->primaryKey => $id)));
						$this->set(compact('<?php echo $singularName; ?>','id'));
					}
					break;
				case 'POST':
					$this-><?php echo $currentModelName; ?>->create();
					if ($this-><?php echo $currentModelName; ?>->save(json_decode($this->request->data['body'], true))) {
						$this->redirect(array('action' => 'index', $this-><?php echo $currentModelName; ?>->id));
					} else {
						$error = $this->Cakeular->error('failure','<?php echo ucfirst(strtolower($singularHumanName)); ?> was not saved');
						$<?php echo $pluralName; ?> = array(
							'<?php echo ucfirst(strtolower($singularHumanName)); ?>' => $error
						);
						$this->set(compact('<?php echo $pluralName; ?>'));
					}
					break;
				case 'PUT':
					if(!$id){
						$error = $this->Cakeular->error('failure','ID parameter missing');
						$<?php echo $pluralName; ?> = array(
							'<?php echo ucfirst(strtolower($singularHumanName)); ?>' => $error
						);
						$this->set(compact('<?php echo $pluralName; ?>'));
						break;
					}
					if ($this-><?php echo $currentModelName; ?>->save(json_decode($this->request->data['body'], true))) {
						$this->redirect(array('action' => 'index', $this-><?php echo $currentModelName; ?>->id));
					} else {
						$error = $this->Cakeular->error('failure','<?php echo ucfirst(strtolower($singularHumanName)); ?> was not saved');
						$<?php echo $singularName; ?> = array(
							'<?php echo ucfirst(strtolower($singularHumanName)); ?>' => $error
						);
						$this->set(compact('<?php echo $singularName; ?>','id'));
					}
					break;
				case 'DELETE':
					if(!$id){
						$error = $this->Cakeular->error('failure','ID parameter missing');
						$<?php echo $pluralName; ?> = array(
							'<?php echo ucfirst(strtolower($singularHumanName)); ?>' => $error
						);
						$this->set(compact('<?php echo $pluralName; ?>'));
						break;
					}
					$this-><?php echo $currentModelName; ?>->id = $id;
					if ($this-><?php echo $currentModelName; ?>->delete()) {
						$message = $this->Cakeular->message('success','<?php echo ucfirst(strtolower($singularHumanName)); ?> was deleted');
						$<?php echo $singularName; ?> = array(
							'<?php echo ucfirst(strtolower($singularHumanName)); ?>' => $message
						);
					} else {
						$error = $this->Cakeular->error('failure','<?php echo ucfirst(strtolower($singularHumanName)); ?> was not deleted');
						$<?php echo $singularName; ?> = array(
							'<?php echo ucfirst(strtolower($singularHumanName)); ?>' => $error
						);
					}
					$this->set(compact('<?php echo $singularName; ?>','id'));
					break;
				default:
					$error = $this->Cakeular->error('failure','Invalid Request Method');
					$<?php echo $singularName; ?> = array(
						'<?php echo ucfirst(strtolower($singularHumanName)); ?>' => $error
					);
					$this->set(compact('<?php echo $singularName; ?>'));
					break;
			}
			$this->layout = 'ajax';
		}

