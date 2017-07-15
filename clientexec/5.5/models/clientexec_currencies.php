<?php
/**
 * Generic Clientexec Currencies Migrator
 *
 * @package blesta
 * @subpackage blesta.plugins.import_manager.components.migrators.clientexec
 * @copyright Copyright (c) 2010, Phillips Data, Inc.
 * @license http://www.blesta.com/license/ The Blesta License Agreement
 * @link http://www.blesta.com/ Blesta
 */
class ClientexecCurrencies
{
    /**
     * ClientexecCurrencies constructor.
     *
     * @param Record $remote
     */
    public function __construct(Record $remote)
    {
        $this->remote = $remote;
    }

    /**
     * Get all currencies.
     *
     * @return mixed The result of the sql transaction
     */
    public function get()
    {
        return $this->remote->select()->from('currency')->getStatement()->fetchAll();
    }

    /**
     * Get all enabled currencies.
     *
     * @return mixed The result of the sql transaction
     */
    public function getEnabled()
    {
        return $this->remote->select()->from('currency')->where('enabled', '=', '1')->getStatement()->fetchAll();
    }

    /**
     * Get the default currency.
     *
     * @return mixed The result of the sql transaction
     */
    public function getDefault()
    {
        $currency = $this->remote->select()->from('setting')->where('name', '=', 'Default Currency')->getStatement()->fetch();
        return !empty($currency->value) ? $currency->value : 'USD';
    }
}
