<?php
Configure::load('cakeular');
class CakeularComponent extends Component
{
    /**
     * authorized method
     *
     * @param headers Array
     * @return bool
     *
     * Validate incoming signature request and authorize
     * Uses Host, Date and Authorization headers to create Signature
     */
    public function authorized($headers, $controller)
    {
        $date = strtotime(gmdate("Ymd H:i", time() - 5 * 60));

        if (!isset($headers['Authorization'])):
            return false;
        endif;
        if (!isset($headers['Date'])):
            return false;
        endif;

        $sig = base64_encode(hash_hmac('sha256', $controller . $headers['Date'], Configure::read('Cakeular.salt'), true));

        if ((!($sig === $headers['Authorization'])) || (strtotime($headers['Date']) === -1) || (strtotime($headers['Date']) < $date) || (strtotime($headers['Date']) > ($date + 60 * 10))):
            return false;
        else:
            return true;
        endif;
    }

    public function error($type, $message, $code = null, $param = null)
    {
        $error = array(
            'type' => $type,
            'message' => $message,
        );
        if ($code) {
            $error['code'] = $code;
        }
        if ($param) {
            $error['param'] = $param;
        }
        return $error;
    }

    public function message($type, $message, $code = null, $param = null)
    {
        $message = array(
            'type' => $type,
            'message' => $message,
        );
        if ($code) {
            $message['code'] = $code;
        }
        if ($param) {
            $message['param'] = $param;
        }
        return $message;
    }

}
