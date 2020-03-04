<?php


namespace Invoice;


use Invoice\InvoiceRepository;
use Order\OrderRepository;

class InvoiceService
{
    private OrderRepository $orderRepository;
    private InvoiceRepository $invoiceRepository;

    private ?array $errors = [];

    public function __construct(OrderRepository $orderRepository, InvoiceRepository $invoiceRepository)
    {
        $this->orderRepository = $orderRepository;
        $this->invoiceRepository = $invoiceRepository;
    }

    public function getErrors() {
        return $this->errors;
    }

    public function getAllInvoice()
    {
        $this->resetErrors();
        $invoices = [];
        $invoices = $this->invoiceRepository->getAll();
        return $invoices;
    }

    public function getInvoiceById($invoiceId)
    {
        $this->resetErrors();
        $invoice = null;

        if($invoiceId == null)
            $this->errors['id'] = 'Invoice id shouldn\'t be null.';
        else if($invoiceId < 0)
            $this->errors['id'] = 'Invoice id can\'t be inferior to zero.';
        else
        {
            $invoice = $this->invoiceRepository->findOneById($invoiceId);
            if ($invoice == null)
                $this->errors['id'] = 'Invoice id ' . $invoiceId . ' doesn\'t exists.';
        }
        return $invoice;
    }

    private function resetErrors() {
        $this->errors = [];
    }
}