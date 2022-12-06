<?php

session_start();
session_destroy();
unset($_SESSION["error"]);
unset($_SESSION["message"]);
unset($_SESSION["id"]);
unset($_SESSION["login"]);
unset($_SESSION["name"]);
unset($_SESSION["email"]);
unset($_SESSION["avatar"]);
//return new Redirect("/views/registration");
