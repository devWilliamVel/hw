<?php
/**
 * Created by PhpStorm.
 * User: William
 * Date: 18/09/2022
 * Time: 19:08
 */

namespace App\Libraries;


class Permissions
{
    /** ################################################################################################################
     *  ##########    GUARD    #########################################################################################
     *  ##############################################################################################################*/

    const GUARD_NAME_WEB = "web";

    /** ##############################################################################################################*/

    /** ################################################################################################################
     *  ##########    PERMISSIONS    ###################################################################################
     *  ##############################################################################################################*/

    const PERM_READ_HEROES_LIST = "read heroes list";

    /** **********    PERMISSIONS    ******************************************************************************** */
    const PERM_READ_PERMISSIONS = "read permissions";
    const PERM_WRITE_PERMISSIONS = "write permissions";

    private static $permissionsList = array(
        self::PERM_READ_HEROES_LIST,
        self::PERM_READ_PERMISSIONS,
        self::PERM_WRITE_PERMISSIONS,
    );

    /** ##############################################################################################################*/


    /** ################################################################################################################
     *  ##########    ROLES    #########################################################################################
     *  ##############################################################################################################*/

    const ROLE_SUPER_ADMIN = "super-admin";
    const ROLE_ADMIN = "admin";
    const ROLE_USER = "user";

    private static $rolesList = array(
        self::ROLE_SUPER_ADMIN,
        self::ROLE_ADMIN,
        self::ROLE_USER,
    );

    /** ##############################################################################################################*/

    /**
     * @param string $permissionName
     * @return bool
     */
    public static function isPermissionManaged($permissionName)
    {
        return in_array($permissionName, self::$permissionsList);
    }

    /**
     * @return array
     */
    public static function getPermissionsListHandled()
    {
        return self::$permissionsList;
    }

    /**
     * @return array
     */
    public static function getRolesListHandled()
    {
        return self::$rolesList;
    }
}