<?php
/**
 * Generic Clientexec Invoices Migrator
 *
 * @package blesta
 * @subpackage blesta.plugins.import_manager.components.migrators.clientexec
 * @copyright Copyright (c) 2010, Phillips Data, Inc.
 * @license http://www.blesta.com/license/ The Blesta License Agreement
 * @link http://www.blesta.com/ Blesta
 */
class ClientexecInvoices
{
    /**
     * ClientexecInvoices constructor.
     *
     * @param Record $remote
     */
    public function __construct(Record $remote)
    {
        $this->remote = $remote;
    }

    /**
     * Get all invoices.
     *
     * @return mixed The result of the sql transaction
     */
    public function get()
    {
        return $this->remote->select()->from('invoice')->getStatement()->fetchAll();
    }

    /**
     * Get an specific invoice.
     *
     * @return mixed The result of the sql transaction
     */
    public function getInvoice($invoice_id)
    {
        return $this->remote->select()->from('invoice')->where('id', '=' , $invoice_id)->getStatement()->fetch();
    }

    /**
     * Get all invoice lines from an specific invoice.
     *
     * @return mixed The result of the sql transaction
     */
    public function getInvoiceLines($invoice_id)
    {
        return $this->remote->select()->from('invoiceentry')->where('invoiceid', '=', $invoice_id)->getStatement()->fetchAll();
    }

    /**
     * Get all transactions from an specific invoice.
     *
     * @return mixed The result of the sql transaction
     */
    public function getInvoiceTransactions($invoice_id)
    {
        return $this->remote->select()->from('invoicetransaction')->where('invoiceid', '=', $invoice_id)->getStatement()->fetchAll();
    }

    /**
     * Get the currency from an specific invoice.
     *
     * @return mixed The result of the sql transaction
     */
    public function getInvoiceCurrency($invoice_id)
    {
        $invoice = $this->remote->select()->from('invoice')->where('id', '=', $invoice_id)->getStatement()->fetch();
        $customer = $this->remote->select()->from('users')->where('id', '=', $invoice->customerid)->getStatement()->fetch();

        return !empty($customer->currency) ? $customer->currency : 'USD';
    }
}