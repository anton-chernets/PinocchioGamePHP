<?php
/**
 * Created by PhpStorm.
 * User: anton
 * Date: 19.11.16
 * Time: 14:13
 */

namespace app\components;


class Randomizer
{

    public static function emailRandom(){
        // array of possible top-level domains
        $tlds = array("com", "net", "gov", "org", "edu", "biz", "info");

// string of possible characters
        $char = "0123456789abcdefghijklmnopqrstuvwxyz";

        // choose random lengths for the username ($ulen) and the domain ($dlen)
        $ulen = mt_rand(5, 10);
        $dlen = mt_rand(7, 17);

        // reset the address
        $a = "";

        // get $ulen random entries from the list of possible characters
        // these make up the username (to the left of the @)
        for ($i = 1; $i <= $ulen; $i++) {
            $a .= substr($char, mt_rand(0, strlen($char)), 1);
        }

        // wouldn't work so well without this
        $a .= "@";

        // now get $dlen entries from the list of possible characters
        // this is the domain name (to the right of the @, excluding the tld)
        for ($i = 1; $i <= $dlen; $i++) {
            $a .= substr($char, mt_rand(0, strlen($char)), 1);
        }

        // need a dot to separate the domain from the tld
        $a .= ".";

        // finally, pick a random top-level domain and stick it on the end
        $a .= $tlds[mt_rand(0, (sizeof($tlds)-1))];

        // done - echo the address inside a link
        return $a;
//       file_put_contents('/opt/lampp/htdocs/pinokio/basic/responce.json', json_encode($a));

    }
}