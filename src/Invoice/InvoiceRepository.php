<?php
namespace Invoice;

use Exception;
use FPDF;
use Order\Order;
use Order\OrderRepository;
use DateTimeImmutable;
use PDO;

try
{
    require ("../src/Fpdf/fpdf.php");
}
catch(Exception $e) {
}


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
        $pdf->Cell(30,10,'SandwicherIIE - Commande #'. $invoice->getOrderNumber(),0,0,'C');
        // Saut de ligne
        $pdf->Ln(20);
        // Décalage à droite
        $pdf->Cell(80);
        $pdf->Cell(30,10,'Date de la commande : '. $invoice->getDate()->format("d/m/Y"),0,0,'C');
        $pdf->Ln(20);

        $pdf->Cell(80);
        $pdf->Cell(30,10,'Client : '. $invoice->getClient(),0,0,'C');
        $pdf->Ln(20);

        $pdf->Cell(80);
        $pdf->Cell(30,10,'Validee par : '. $invoice->getValidator(),0,0,'C');
        $pdf->Ln(20);

        $pdf->Cell(80);
        $pdf->Cell(30,10,'Liste des sandwichs',0,0,'C');
        $pdf->Ln(20);
        $pdf->SetFont('Arial','',10);

        $pdf->Cell(5);
        $pdf->Cell(30,10, $invoice->getOrderDetail(),0,0,'C');
        $pdf->Ln(5);

        $pdf->SetFont('Arial','B',15);
        $pdf->Ln(20);
        $pdf->Cell(80);
        $pdf->Cell(30,10,'Prix total de la commande : '. $invoice->getOrderPrice(). ' euros',0,0,'C');
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
            $invoice->setOrderDetail($row->order_detail);
            $invoice->setOrderPrice($row->total_price);
            $invoice->setOrderNumber($row->order_number);
            $invoice->setDate(new DateTimeImmutable($row->order_date));
            $invoice->setClient($row->client_name);
            $invoice->setValidator($row->validator_name);

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
            $invoice->setOrderDetail($row['order_detail']);
            $invoice->setOrderPrice($row['total_price']);
            $invoice->setOrderNumber($row['order_number']);
            $invoice->setDate(new DateTimeImmutable($row['order_date']));
            $invoice->setClient($row['client_name']);
            $invoice->setValidator($row['validator_name']);
        } else {
            $order = null;
        }

        return $invoice;
    }

    public function createInvoice(Invoice $invoice)
    {
       $invoice->setDate($invoice->getOrder()->getDate());
       $invoice->setClient($invoice->getOrder()->getClient()->getPseudo());
       $invoice->setValidator($invoice->getOrder()->getValidator()->getPseudo());
       $invoice->setOrderNumber($invoice->getOrder()->getId());
       $invoice->setOrderPrice($invoice->getOrder()->getTotalPrice());
       $invoice->setOrderDetail($this->writeOrderDetail($invoice->getOrder()));

        $query = $this->connection->prepare(
            'INSERT INTO "invoice"(order_id, order_date, order_number, client_name, validator_name, order_detail, total_price) 
            VALUES (:order_id, :order_date, :order_number, :client_name, :validator_name, :order_detail, :total_price)');

        $query->bindValue(':order_id', $invoice->getOrder()->getId());

        $query->bindValue(':order_date', $invoice->getDate()->format("Y-m-d"));
        $query->bindValue(':order_number', $invoice->getOrderNumber());
        $query->bindValue(':client_name', $invoice->getClient());
        $query->bindValue(':validator_name', $invoice->getValidator());
        $query->bindValue(':order_detail', $invoice->getOrderDetail());
        $query->bindValue(':total_price', $invoice->getOrderPrice());

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

    private function writeOrderDetail(Order $order)
    {
        $result = "";
        foreach ($order->getSandwichs() as $sandwich)
        {
            $result .= 'Sandwich : '. $sandwich->getLabel(). ' (';
            if ($sandwich->getIngredients() != null)
            {
                foreach ($sandwich->getIngredients() as $ingredient)
                {
                   $result .= $ingredient->getLabel(). ' ';
                }
            }
            $result .= ') ';
        }
        return $result;
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