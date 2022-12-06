<?php declare(strict_types=1);

namespace App\Controllers;

use App\Redirect;
use App\Services\ChangePasswordService;
use App\Services\ChangePasswordServiceRequest;

class ChangePasswordController
{

    public function changePassword(): Redirect
    {
        $userInfo= new ChangePasswordServiceRequest( $_POST["oldPassword"],
            $_POST["newPassword"],
            $_POST["reNewPassword"],
            $_SESSION["id"]
        );
        new ChangePasswordService($userInfo);
        return new Redirect("/login");
    }
}