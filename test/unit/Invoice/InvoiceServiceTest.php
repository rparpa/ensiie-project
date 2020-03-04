<?php

namespace Invoice;
use DateTimeImmutable;
use Order\Order;
use Order\OrderRepository;
use Invoice\InvoiceRepository;
use PDO;
use PHPUnit\Framework\TestCase;

class InvoiceServiceTest extends TestCase
{
    /**
     * @test
     */
    public function getByIdWhenIdExists()
    {
        $order = new Order();

        $invoice = new Invoice();
        $invoice->setId(1);
        $invoice->setOrder($order);
        $invoice->setValidator("test");
        $invoice->setClient("test");
        $invoice->setOrderNumber(1);
        $invoice->setDate(new DateTimeImmutable('2020-01-01'));
        $invoice->setOrderPrice(1.3);
        $invoice->setOrderDetail("test");

        $expectedInvoice = new Invoice();
        $expectedInvoice->setId(1);
        $expectedInvoice->setOrder($order);
        $expectedInvoice->setValidator("test");
        $expectedInvoice->setClient("test");
        $expectedInvoice->setOrderNumber(1);
        $expectedInvoice->setDate(new DateTimeImmutable('2020-01-01'));
        $expectedInvoice->setOrderPrice(1.3);
        $expectedInvoice->setOrderDetail("test");

        /** @var OrderRepository&\PHPUnit\Framework\MockObject\MockObject $mockedRepository */
        $mockedOrderRepository = $this->getMockBuilder('Order\OrderRepository')
            ->disableOriginalConstructor()
            ->getMock();

        /** @var InvoiceRepository&\PHPUnit\Framework\MockObject\MockObject $mockedRepository */
        $mockedRepository = $this->getMockBuilder('Invoice\InvoiceRepository')
            ->disableOriginalConstructor()
            ->setMethods(['findOneById'])
            ->getMock();

        $mockedRepository
            ->method('findOneById')
            ->willReturn($invoice);

        $service = new InvoiceService($mockedOrderRepository ,$mockedRepository);

        self::assertEquals($expectedInvoice, $service->getInvoiceById(1));
    }

    /**
     * @test
     */
    public function getByIdWhenIdDoesNotExists()
    {
        $order = new Order();

        $invoice = new Invoice();
        $invoice->setId(null);
        $invoice->setOrder($order);
        $invoice->setValidator("test");
        $invoice->setClient("test");
        $invoice->setOrderNumber(1);
        $invoice->setDate(new DateTimeImmutable('2020-01-01'));
        $invoice->setOrderPrice(1.3);
        $invoice->setOrderDetail("test");


        /** @var OrderRepository&\PHPUnit\Framework\MockObject\MockObject $mockedRepository */
        $mockedOrderRepository = $this->getMockBuilder('Order\OrderRepository')
            ->disableOriginalConstructor()
            ->getMock();

        /** @var InvoiceRepository&\PHPUnit\Framework\MockObject\MockObject $mockedRepository */
        $mockedRepository = $this->getMockBuilder('Invoice\InvoiceRepository')
            ->disableOriginalConstructor()
            ->setMethods(['findOneById'])
            ->getMock();

        $mockedRepository
            ->method('findOneById')
            ->willReturn(null);

        $service = new InvoiceService($mockedOrderRepository ,$mockedRepository);

        self::assertEquals(null, $service->getInvoiceById(1));
        self::assertSame('Invoice id ' . 1 . ' doesn\'t exists.', $service->getErrors()['id']);
    }


    /**
     * @test
     */
    public function getByIdWhenIdNull()
    {
        $order = new Order();

        $invoice = new Invoice();
        $invoice->setId(null);
        $invoice->setOrder($order);
        $invoice->setValidator("test");
        $invoice->setClient("test");
        $invoice->setOrderNumber(1);
        $invoice->setDate(new DateTimeImmutable('2020-01-01'));
        $invoice->setOrderPrice(1.3);
        $invoice->setOrderDetail("test");


        /** @var OrderRepository&\PHPUnit\Framework\MockObject\MockObject $mockedRepository */
        $mockedOrderRepository = $this->getMockBuilder('Order\OrderRepository')
            ->disableOriginalConstructor()
            ->getMock();

        /** @var InvoiceRepository&\PHPUnit\Framework\MockObject\MockObject $mockedRepository */
        $mockedRepository = $this->getMockBuilder('Invoice\InvoiceRepository')
            ->disableOriginalConstructor()
            ->setMethods(['findOneById'])
            ->getMock();

        $mockedRepository
            ->method('findOneById')
            ->willReturn(null);

        $service = new InvoiceService($mockedOrderRepository ,$mockedRepository);

        self::assertEquals(null, $service->getInvoiceById($invoice->getId()));
        self::assertSame('Invoice id shouldn\'t be null.', $service->getErrors()['id']);
    }

    /**
     * @test
     */
    public function getByIdWhenIdLessThanZero()
    {
        $order = new Order();

        $invoice = new Invoice();
        $invoice->setId(-1);
        $invoice->setOrder($order);
        $invoice->setValidator("test");
        $invoice->setClient("test");
        $invoice->setOrderNumber(1);
        $invoice->setDate(new DateTimeImmutable('2020-01-01'));
        $invoice->setOrderPrice(1.3);
        $invoice->setOrderDetail("test");


        /** @var OrderRepository&\PHPUnit\Framework\MockObject\MockObject $mockedRepository */
        $mockedOrderRepository = $this->getMockBuilder('Order\OrderRepository')
            ->disableOriginalConstructor()
            ->getMock();

        /** @var InvoiceRepository&\PHPUnit\Framework\MockObject\MockObject $mockedRepository */
        $mockedRepository = $this->getMockBuilder('Invoice\InvoiceRepository')
            ->disableOriginalConstructor()
            ->setMethods(['findOneById'])
            ->getMock();

        $mockedRepository
            ->method('findOneById')
            ->willReturn(null);

        $service = new InvoiceService($mockedOrderRepository ,$mockedRepository);

        self::assertEquals(null, $service->getInvoiceById($invoice->getId()));
        self::assertSame('Invoice id can\'t be inferior to zero.', $service->getErrors()['id']);
    }
}