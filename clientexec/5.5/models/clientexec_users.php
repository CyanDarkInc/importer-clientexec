<?php
/**
 * Generic Clientexec Users Migrator
 *
 * @package blesta
 * @subpackage blesta.plugins.import_manager.components.migrators.clientexec
 * @copyright Copyright (c) 2010, Phillips Data, Inc.
 * @license http://www.blesta.com/license/ The Blesta License Agreement
 * @link http://www.blesta.com/ Blesta
 */
class ClientexecUsers
{
    /**
     * ClientexecUsers constructor.
     *
     * @param Record $remote
     */
    public function __construct(Record $remote)
    {
        $this->remote = $remote;
    }

    /**
     * Get all users.
     *
     * @return mixed The result of the sql transaction
     */
    public function get()
    {
        return $this->remote->select()->from('users')->getStatement()->fetchAll();
    }

    /**
     * Get all users groups.
     *
     * @return mixed The result of the sql transaction
     */
    public function getAllUsersGroups()
    {
        return $this->remote->select()->from('groups')->getStatement()->fetchAll();
    }

    /**
     * Get an specific user group.
     *
     * @return mixed The result of the sql transaction
     */
    public function getUserGroup($group_id)
    {
        return $this->remote->select()->from('groups')->where('id', '=', $group_id)->getStatement()->fetch();
    }

    /**
     * Get user custom fields.
     *
     * @param $user_id The user id
     * @return array An array containing the user fields
     */
    public function getCustomFields($user_id)
    {
        $fields = $this->remote->select()->from('user_customuserfields')->where('userid', '=', $user_id)->getStatement()->fetchAll();

        $custom_fields = [];
        foreach ($fields as $key => $value) {
            $field = $this->remote->select()->from('customuserfields')->where('id', '=', $value->customid)->getStatement()->fetch();
            $key = strtolower(str_replace(' ', '_', $field->name));
            $custom_fields[$key] = $value;
        }

        return $custom_fields;
    }
}
