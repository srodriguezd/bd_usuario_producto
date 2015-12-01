<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 27/11/15
 * Time: 2:35
 */

namespace AppBundle\Service;
use Symfony\Component\HttpFoundation\Session;



class UserService
{
    private $user;
    private $password;
    public function newUser($user, $password){
        $this->user = $user;
        $this->password = $password;
    }

}