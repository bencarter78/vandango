<?php

if ( ! function_exists('comparisonOperators')) {
    /**
     * Returns an array of PHP comparison operators
     *
     * @return array
     */
    function comparisonOperators()
    {
        return [
            '==' => 'Equal',
            '===' => 'Identical',
            '!=' => 'Not equal',
            '<>' => 'Not equal',
            '!==' => 'Not identical',
            '>' => 'Greater than',
            '<' => 'Less than',
            '>=' => 'Greater than or equal to',
            '<=' => 'Less than or equal to',
        ];
    }
}


if ( ! function_exists('cleanContactNumber')) {
    /**
     * Cleans (partially) the telephone numbers
     *
     * @param $tel
     * @return array
     */
    function cleanContactNumber($tel)
    {
        $tel = str_replace(' ', '', $tel);
        $pointer = substr($tel, 0, 1) == '0' ? 1 : 0;
        $type = substr($tel, $pointer, 1) == '7' ? 'mob' : 'tel';

        return [$type => $tel];
    }
}

if ( ! function_exists('formatTel')) {
    /**
     * @param $tel
     * @return mixed|string
     */
    function formatTel($tel)
    {
        $tel = str_replace(' ', '', $tel);

        if (substr($tel, 0, 1) != 0) {
            $tel = '0' . $tel;
        }

        return substr($tel, 0, 5) . ' ' . substr($tel, 5);
    }
}

if ( ! function_exists('splitName')) {
    /**
     * Splits a person's name into first name/surname
     *
     * @param $name
     * @return mixed
     */
    function splitName($name)
    {
        $parts = explode(" ", $name);
        $split['surname'] = array_pop($parts);
        $split['firstname'] = implode(" ", $parts);

        return $split;
    }
}

if ( ! function_exists('extractNameFromEmail')) {
    /**
     * @param $email
     * @return string
     */
    function extractNameFromEmail($email)
    {
        if ($email != '') {
            $username = str_replace('@totalpeople.co.uk', '', $email);
            $name = explode('.', $username);

            return ucwords($name[0] . ' ' . $name[1]);
        }

        return 'N/A';
    }
}

if ( ! function_exists('tidyFieldName')) {
    /**
     * @param $value
     * @return string
     */
    function tidyFieldName($value)
    {
        return ucwords(preg_replace('/_-?/', ' ', $value));
    }
}


if ( ! function_exists('getRandomString')) {
    /**
     * @param int $length
     * @return string
     */
    function getRandomString($length = 42)
    {
        // We'll check if the user has OpenSSL installed with PHP. If they do
        // we'll use a better method of getting a random string. Otherwise, we'll
        // fallback to a reasonably reliable method.
        if (function_exists('openssl_random_pseudo_bytes')) {
            // We generate twice as many bytes here because we want to ensure we have
            // enough after we base64 encode it to get the length we need because we
            // take out the "/", "+", and "=" characters.
            $bytes = openssl_random_pseudo_bytes($length * 2);

            // We want to stop execution if the key fails because, well, that is bad.
            if ($bytes === false) {
                throw new \RuntimeException('Unable to generate random string.');
            }

            return substr(str_replace(['/', '+', '='], '', base64_encode($bytes)), 0, $length);
        }

        $pool = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';

        return substr(str_shuffle(str_repeat($pool, 5)), 0, $length);
    }
}

if ( ! function_exists('firstStringFromString')) {
    /**
     * Returns the Nth element in an array once it has been exploded
     *
     * @param        $string
     * @param string $separator
     * @param int    $n
     * @return mixed
     */
    function stringFromExploder($string, $separator = ',', $n = 0)
    {
        return explode($separator, $string)[$n];
    }
}
