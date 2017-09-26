<?php
/**
 * Created by PhpStorm.
 * User: Giansalex
 * Date: 25/09/2017
 * Time: 20:36
 */

require_once(__ROOT__."/inc/db_users.php");

if (isset($_SERVER['PHP_AUTH_USER']) && isset($_SERVER['PHP_AUTH_PW'])) {
    $udb = new UserDb();
    $user = null;

    $uid = addslashes($_SERVER['PHP_AUTH_USER']);
    $pwd = md5(addslashes($_SERVER['PHP_AUTH_PW']));

    $ar = $udb->Query("(Enabled eq true) and (UserId eq '".$uid."' or Email eq '".$uid."') and (Md5Password eq '".$pwd."'");

    if(count($ar) == 1){
        return;
    }
}

header('WWW-Authenticate: Basic realm="Nuget"');
header('HTTP/1.0 401 Unauthorized');
exit();