<?php


namespace Anax\Controller;

class IpCheck
{



    /**

     * Validate the ip address

     */

    public function validateIp($ip)
    {
        if (filter_var($ip, FILTER_VALIDATE_IP)) {
            return true;
        }
        return false;
    }


    /**

     * Validate domains

     */

    public function validateDomain($ip)
    {

        if ($this->validateIp($ip)) {
            if ($ip != gethostbyaddr($ip)) {
                return gethostbyaddr($ip);
            } else {
                return "Not found";
            }
        }
        return "Not found";
    }
}
