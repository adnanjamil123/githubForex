<?php
      class InfoSecurity {

            private $key = "W92ZB837943A711B98D35E799DFE3Z18";
            private $method;
            private $iv = /*"tuqZQhKP48e8Piuc"*/ "administratively";

            /**
             * Available OPENSSL_RAW_DATA | OPENSSL_ZERO_PADDING
             *
             * @var type $options
             */
            protected $options = 0;

            /**
             * 
             * @param type $data
             * @param type $key
             * @param type $iv
             * @param type $blockSize
             * @param type $mode
             */
            public function __construct() {
               
               $this->setMethod(256, 'CBC');
            }

			
            /**
             * CBC 128 192 256 
              CBC-HMAC-SHA1 128 256
              CBC-HMAC-SHA256 128 256
              CFB 128 192 256
              CFB1 128 192 256
              CFB8 128 192 256
              CTR 128 192 256
              ECB 128 192 256
              OFB 128 192 256
              XTS 128 256
             * @param type $blockSize
             * @param type $mode
             */
            public function setMethod($blockSize, $mode = 'CBC') {
                if($blockSize==192 && in_array('', array('CBC-HMAC-SHA1','CBC-HMAC-SHA256','XTS'))){
                    $this->method=null;
                    throw new Exception('Invalid block size and mode combination!');
                }
                $this->method = 'AES-' . $blockSize . '-' . $mode;
            }

      
            /**
             * 
             * @return boolean
             */
            public function validateParams($data) {
                if ($data != null &&
                        $this->method != null ) {
                    return true;
                } else {
                    return FALSE;
                }
            }

            //it must be the same when you encrypt and decrypt
            protected function getIV() { 
                return $this->iv;
            }

             /**
             * @return type
             * @throws Exception
             */
            public function encrypt($data) {
                if ($this->validateParams($data)) { 
                    return trim(openssl_encrypt($data, $this->method, $this->key, $this->options,$this->getIV()));
                } else {
                    throw new Exception('Invalid params!');
                }
            }

            /**
             * 
             * @return type
             * @throws Exception
             */
            public function decrypt($data) {
                if ($this->validateParams($data)) {
                   $ret=openssl_decrypt($data, $this->method, $this->key, $this->options,$this->getIV());

                   return   trim($ret); 
                } else {
                    throw new Exception('Invalid params!');
                }
            }

        }