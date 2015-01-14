<?php

class CakeularComponent extends Component {

	public function error($type, $message, $code = null, $param = null){
		$error = array(
			'type' => $type,
			'message' => $message
		);
		if($code){
			$error['code'] = $code;
		}
		if($param){
			$error['param'] = $param;
		}
		return $error;
	}

	public function message($type, $message, $code = null, $param = null){
		$message = array(
			'type' => $type,
			'message' => $message
		);
		if($code){
			$message['code'] = $code;
		}
		if($param){
			$message['param'] = $param;
		}
		return $message;
	}

}