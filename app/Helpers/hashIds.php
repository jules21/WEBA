<?php

if (! function_exists('encryptId')) {
    /**
     * function to encrypt id
     */
    function encryptId($id): string
    {
        $hashids = new Hashids\Hashids('', 32, 'abcdefghijklmnopqrstuvwxyz-ABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890');

       return $hashids->encode($id);
    }
}

if (! function_exists('decryptId')) {
    /**
     * function to decrypt id
     */
    function decryptId($id): int
    {
        try {
            $hashids = new Hashids\Hashids('', 32, 'abcdefghijklmnopqrstuvwxyz-ABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890');

            return $hashids->decode($id)[0];
        } catch (Exception $exception) {
         return -1;
        }

    }
}
