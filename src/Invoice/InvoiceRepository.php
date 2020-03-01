<?php
namespace Invoice;

use FPDF;
use Order\Order;
use Order\OrderRepository;
use PDO;
require ("../src/Fpdf/fpdf.php");

class InvoiceRepository
{
    private PDO $connection;

    public function __construct(PDO $connection)
    {
        $this->connection = $connection;
    }

    public function writeInvoice(Invoice $invoice)
    {
        /////////////HEADER/////////////
        $pdf = new FPDF();
        $pdf->AddPage();
        // Logo
        $pdf->Image('images/logo.png',30,6,30);
        // Police Arial gras 15
        $pdf->SetFont('Arial','B',15);
        // Décalage à droite
        $pdf->Cell(80);
        // Titre
        $pdf->Cell(30,10,'SandwicherIIE - Commande #'. $invoice->getOrder()->getId(),0,0,'C');
        // Saut de ligne
        $pdf->Ln(20);
        // Décalage à droite
        $pdf->Cell(80);
        $pdf->Cell(30,10,'Date de la commande : '. $invoice->getOrder()->getDate()->format("d/m/Y"),0,0,'C');
        $pdf->Ln(20);
        $pdf->Cell(80);
        $pdf->Cell(30,10,'Liste des sandwichs',0,0,'C');
        $pdf->Ln(20);
        $pdf->SetFont('Arial','',10);
        foreach ($invoice->getOrder()->getSandwichs() as $sandwich)
        {
            $pdf->Cell(10);
            $pdf->Cell(30,10, '- '. $sandwich->getLabel(),0,0,'C');
            $pdf->Ln(5);
            foreach ($sandwich->getIngredients() as $ingredient)
            {
                $pdf->Cell(20);
                $pdf->Cell(30,10, '- '. $ingredient->getLabel(),0,0,'C');
                $pdf->Ln(5);
            }
        }
        $pdf->SetFont('Arial','B',15);
        $pdf->Ln(20);
        $pdf->Cell(80);
        $pdf->Cell(30,10,'Prix total de la commande : '. $invoice->getOrder()->getTotalPrice(). ' euros',0,0,'C');
        $pdf->Ln(20);
        $pdf->Cell(50);

        $pdf->Output();
    }

    public function getAll()
    {
        $rows = $this->connection->query(
            'SELECT * FROM "invoice"')->fetchAll(PDO::FETCH_OBJ);

        $invoices = [];
        foreach ($rows as $row)
        {
            $invoice = new Invoice();
            $invoice
                ->setId($row->id);

            $invoices[] = $invoice;
        }

        foreach ($invoices as $invoice)
        {
            $invoice->setOrder($this->fetchOrder($invoice->getId()));
        }


        return $invoices;
    }

    public function findOneById($invoiceId)
    {
        $query = $this->connection->prepare(
            'SELECT * FROM "invoice" WHERE id = :id');

        $query->bindValue(':id', $invoiceId, PDO::PARAM_INT);
        $query->execute();
        $row = $query->fetch();
        $invoice = new Invoice();

        if($row) {
            $invoice->setId($row['id']);
            $invoice->setOrder($this->fetchOrder($row['order_id']));
        } else {
            $order = null;
        }

        return $invoice;
    }

    public function createInvoice(Invoice $invoice)
    {
        $query = $this->connection->prepare(
            'INSERT INTO "invoice"(order_id) VALUES (:order_id)');

        $query->bindValue(':order_id', $invoice->getOrder()->getId());

        $result = $query->execute();
        if ($result == false)
        {
            $query->errorInfo();
        }
        else
        {
            $invoice->setId($this->connection->lastInsertId());
        }
        return $invoice;
    }

    public function deleteInvoice(Invoice $invoice)
    {
        $query = $this->connection->prepare('DELETE FROM "invoice" WHERE id = :id');

        $query->bindValue(':id', $invoice->getId());

        $result = $query->execute();
        if ($result == false)
        {
            $query->errorInfo();
        }
        return $result;
    }


    private function fetchOrder($invoiceId)
    {
        $query = $this->connection->prepare(
            'SELECT id
            FROM "order"
            WHERE id = :invoiceId');

        $query->bindValue(':invoiceId', $invoiceId, PDO::PARAM_INT);
        $query->execute();
        $row = $query->fetch(PDO::FETCH_OBJ);

        $orderRepository = new OrderRepository($this->connection);

        $order = null;
        $row ? $order = $orderRepository->findOneById($row->id):null;

        return $order;
    }
}