<?php
/**
 * Created by PhpStorm.
 * User: Rych Emrycho
 * Date: 10/23/2018
 * Time: 6:03 PM
 */

namespace console\controllers;

use yii\console\Controller;
use Yii;


class RbacController extends Controller {

    /**
     * @throws \yii\base\Exception
     * @throws \Exception
     */
    public function actionInit() {
        $auth = Yii::$app->authManager;

        //======= PERMISSION =========||
        //++GUEST
        // add "login" permission
        $login = $auth->createPermission('login');
        $login->description = 'Login';
        $auth->add($login);

        ////////////
        // add "logout" permission
        $logout = $auth->createPermission('logout');
        $logout->description = 'Logout';
        $auth->add($logout);

        // add "create_packet" permission
        $create_packet = $auth->createPermission('create_packet');
        $create_packet->description = 'Create Packet';
        $auth->add($create_packet);

        // add "list_packet" permission
        $list_packet = $auth->createPermission('list_packet');
        $list_packet->description = 'List Packet';
        $auth->add($list_packet);

        // add "list_recipient" permission
        $list_recipient = $auth->createPermission('list_recipient');
        $list_recipient->description = 'List Recipient';
        $auth->add($list_recipient);

        // add "view_recipient" permission
        $view_recipient = $auth->createPermission('view_recipient');
        $view_recipient->description = 'View Recipient';
        $auth->add($view_recipient);

        // add "list_recipient" permission
        $update_recipient = $auth->createPermission('update_recipient');
        $update_recipient->description = 'Update Recipient';
        $auth->add($update_recipient);

        //||=============== ROLES =============||
        // add "guest" role and give this role the "index view" permission
        $guest = $auth->createRole('guest');
        $guest->description = 'Guest Role';
        $auth->add($guest);
        $auth->addChild($guest, $login);

        // add "member" role and give this role the "index view" permission
        $penerima = $auth->createRole('penerima');
        $penerima->description = 'Penerima Role';
        $auth->add($penerima);
        $auth->addChild($penerima, $list_recipient);
        $auth->addChild($penerima, $update_recipient);
        $auth->addChild($penerima, $view_recipient);
        $auth->addChild($penerima, $logout);
        $auth->addChild($penerima, $guest);

        // add "staff" role and give this role the "index view" permission
        $operator = $auth->createRole('operator');
        $operator->description = 'Operator Role';
        $auth->add($operator);
        $auth->addChild($operator, $list_packet);
        $auth->addChild($operator, $create_packet);
        $auth->addChild($operator, $penerima);
        $auth->addChild($operator, $guest);

        // add "admin" role and give this role all permission
        $admin = $auth->createRole('administrator');
        $admin->description = 'Admin role';
        $auth->add($admin);
        $auth->addChild($admin, $operator);
        $auth->addChild($admin, $penerima);
        $auth->addChild($admin, $guest);
    }

}