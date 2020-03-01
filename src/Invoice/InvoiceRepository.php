<?php
namespace Order;

use FPDF;

class InvoiceRepository
{
    private PDO $connection;

    public function __construct(PDO $connection)
    {
        $this->connection = $connection;
    }

    public function testPDF()
    {
        
    }
}