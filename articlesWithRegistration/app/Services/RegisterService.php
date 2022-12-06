<?php declare(strict_types=1);

namespace App\Services;

use App\Database;
use App\Redirect;

class RegisterService
{

    public function execute(RegisterServiceRequest $request): Redirect
    {
        $userEmail = $request->getEmail();
        $emailFrom_DB = Database::getConnection()->executeQuery("SELECT email FROM users WHERE email = '$userEmail' ")->rowCount();
        if ($emailFrom_DB == 1) {
            $_SESSION['errorMessage'] = "This email already in DB";
            return new Redirect("/registration");
        }
        $userLogin = $request->getLogin();
        $loginFrom_DB = Database::getConnection()->executeQuery("SELECT login FROM users WHERE login = '$userLogin' ")->rowCount();
        if ($loginFrom_DB == 1) {
            $_SESSION['errorMessage'] = "This login already in DB";
            return new Redirect("/registration");
        }

        Database::getConnection()->insert('users', [
            'name' => $request->getName(),
            'login' => $request->getLogin(),
            'email' => $request->getEmail(),
            'password' => md5($request->getPassword()),
            'avatar' => $request->getAvatar()
        ]);
        $registeredLogin = $request->getLogin();
        if (1 == Database::getConnection()->executeQuery("SELECT login FROM users WHERE login = '$registeredLogin' ")->rowCount()){

        $_SESSION['greetings'] = "{$request->getname()} you successfully registered.";
            return new Redirect("/registration");
    }
        return new Redirect("/registration");
    }
}
