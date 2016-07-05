<?php
namespace FreshmanGuide\Exceptions;

class AdminException extends \Exception {

    public function __construct($message, $code = 500, \Exception $previous = null) {
        parent::__construct($message, $code, $previous);
    }

    public function getArray() {
        return [
            'error' => $this->message,
            'code' => $this->code,
        ];
    }

}