<?php
namespace Order;

use DateTimeImmutable;
use Ingredient\Ingredient;
use Invoice\InvoiceRepository;
use Order\Order;
use Order\OrderRepository;
use Order\OrderService;
use PHPUnit\Framework\TestCase;
use Sandwich\Sandwich;
use Sandwich\SandwichRepository;
use User\User;
use User\UserRepository;

class OrderServiceTest extends TestCase
{

    /**
     * @test
     */
    public function getApprovedOrders()
    {
        //data
        $ingredients = [];

        $ingredient1 = new Ingredient();
        $ingredient1->setId(1)
                    ->setLabel('Tomatoes')
                    ->setAvailable(true)
                    ->setPrice(0.30);
        
        $ingredient2 = new Ingredient();
        $ingredient2->setId(2)
                    ->setLabel('Cucumber')
                    ->setAvailable(true)
                    ->setPrice(0.30);

        array_push( $ingredients, $ingredient1 );
        array_push( $ingredients, $ingredient2 );

        $sandwichs =  [];

        $sandwich = new Sandwich();
        $sandwich->setId(1)
                    ->setLabel('test_sandwich')
                    ->setIngredients($ingredients);

        $sandwich2 = new Sandwich();
        $sandwich2->setId(2)
                    ->setLabel('test_sandwich2')
                    ->setIngredients($ingredients);

        array_push( $sandwichs, $sandwich );
        array_push( $sandwichs, $sandwich2 );

        $user = new User();
        $user->setFirstname('firstname');
        $user->setLastname('lastname');
        $user->setBirthday(new DateTimeImmutable('2000-02-01'));
        $user->setPseudo('my_user');
        $user->setMail('mail');
        $user->setPassword('pass');
        $user->setIsValidator(false);

        $validator = new User();
        $validator->setFirstname('firstname2');
        $validator->setLastname('lastname2');
        $validator->setBirthday(new DateTimeImmutable('2000-02-01'));
        $validator->setPseudo('my_validator');
        $validator->setMail('mail2');
        $validator->setPassword('pass2');
        $validator->setIsValidator(true);

        $order = new Order();
        $order
            ->setId(1)
            ->setApproval(true)
            ->setDate(new DateTimeImmutable('2020-02-01'))
            ->setSandwichs($sandwichs)
            ->setClient($user)
            ->setValidator($validator);

        $order2 = new Order();
        $order2
            ->setId(2)
            ->setApproval(false)
            ->setDate(new DateTimeImmutable('2020-02-01'))
            ->setSandwichs($sandwichs)
            ->setClient($user);    

        $orders = [];

        array_push( $orders, $order );
        array_push( $orders, $order2 );
        
        //repository mock

        /** @var OrderRepository&\PHPUnit\Framework\MockObject\MockObject $mockedOrderRepository */
        $mockedOrderRepository = $this->getMockBuilder('Order\OrderRepository')
            ->disableOriginalConstructor()
            ->setMethods(['getAll'])
            ->getMock();

        /** @var SandwichRepository&\PHPUnit\Framework\MockObject\MockObject $mockedSandwichRepository */
        $mockedSandwichRepository = $this->getMockBuilder('Sandwich\SandwichRepository')
            ->disableOriginalConstructor()
            ->getMock();

        /** @var UserRepository&\PHPUnit\Framework\MockObject\MockObject $mockedUserRepository */
        $mockedUserRepository = $this->getMockBuilder('User\UserRepository')
            ->disableOriginalConstructor()
            ->getMock();

        /** @var InvoiceRepository&\PHPUnit\Framework\MockObject\MockObject $mockedInvoiceRepository */
        $mockedInvoiceRepository = $this->getMockBuilder('Invoice\InvoiceRepository')
            ->disableOriginalConstructor()
            ->getMock();

        $mockedOrderRepository
            ->method('getAll')
            ->willReturn($orders);

        $service = new OrderService($mockedOrderRepository, $mockedSandwichRepository, $mockedUserRepository, $mockedInvoiceRepository);

        //test
        self::assertSame(1, count($service->getApprovedOrders()));
        self::assertEquals($order, $service->getApprovedOrders()[0]);
    }

    /**
     * @test
     */
    public function getPendingOrders()
    {
        //data
        $ingredients = [];

        $ingredient1 = new Ingredient();
        $ingredient1->setId(1)
                    ->setLabel('Tomatoes')
                    ->setAvailable(true)
                    ->setPrice(0.30);
        
        $ingredient2 = new Ingredient();
        $ingredient2->setId(2)
                    ->setLabel('Cucumber')
                    ->setAvailable(true)
                    ->setPrice(0.30);

        array_push( $ingredients, $ingredient1 );
        array_push( $ingredients, $ingredient2 );

        $sandwichs =  [];

        $sandwich = new Sandwich();
        $sandwich->setId(1)
                    ->setLabel('test_sandwich')
                    ->setIngredients($ingredients);

        $sandwich2 = new Sandwich();
        $sandwich2->setId(2)
                    ->setLabel('test_sandwich2')
                    ->setIngredients($ingredients);

        array_push( $sandwichs, $sandwich );
        array_push( $sandwichs, $sandwich2 );

        $user = new User();
        $user->setFirstname('firstname');
        $user->setLastname('lastname');
        $user->setBirthday(new DateTimeImmutable('2000-02-01'));
        $user->setPseudo('my_user');
        $user->setMail('mail');
        $user->setPassword('pass');
        $user->setIsValidator(false);

        $validator = new User();
        $validator->setFirstname('firstname2');
        $validator->setLastname('lastname2');
        $validator->setBirthday(new DateTimeImmutable('2000-02-01'));
        $validator->setPseudo('my_validator');
        $validator->setMail('mail2');
        $validator->setPassword('pass2');
        $validator->setIsValidator(true);

        $order = new Order();
        $order
            ->setId(1)
            ->setApproval(true)
            ->setDate(new DateTimeImmutable('2020-02-01'))
            ->setSandwichs($sandwichs)
            ->setClient($user)
            ->setValidator($validator);

        $order2 = new Order();
        $order2
            ->setId(2)
            ->setApproval(false)
            ->setDate(new DateTimeImmutable('2020-02-01'))
            ->setSandwichs($sandwichs)
            ->setClient($user);    

        $orders = [];

        array_push( $orders, $order );
        array_push( $orders, $order2 );
        
        //repository mock

        /** @var OrderRepository&\PHPUnit\Framework\MockObject\MockObject $mockedOrderRepository */
        $mockedOrderRepository = $this->getMockBuilder('Order\OrderRepository')
            ->disableOriginalConstructor()
            ->setMethods(['getAll'])
            ->getMock();

        /** @var SandwichRepository&\PHPUnit\Framework\MockObject\MockObject $mockedSandwichRepository */
        $mockedSandwichRepository = $this->getMockBuilder('Sandwich\SandwichRepository')
            ->disableOriginalConstructor()
            ->getMock();

        /** @var UserRepository&\PHPUnit\Framework\MockObject\MockObject $mockedUserRepository */
        $mockedUserRepository = $this->getMockBuilder('User\UserRepository')
            ->disableOriginalConstructor()
            ->getMock();

        /** @var InvoiceRepository&\PHPUnit\Framework\MockObject\MockObject $mockedInvoiceRepository */
        $mockedInvoiceRepository = $this->getMockBuilder('Invoice\InvoiceRepository')
            ->disableOriginalConstructor()
            ->getMock();

        $mockedOrderRepository
            ->method('getAll')
            ->willReturn($orders);

        $service = new OrderService($mockedOrderRepository, $mockedSandwichRepository, $mockedUserRepository, $mockedInvoiceRepository);

        //test
        self::assertSame(1, count($service->getApprovedOrders()));
        self::assertEquals($order, $service->getApprovedOrders()[0]);
    }

    /**
     * @test
     */
    public function getOrdersByClient()
    {
        //data
        $ingredients = [];

        $ingredient1 = new Ingredient();
        $ingredient1->setId(1)
                    ->setLabel('Tomatoes')
                    ->setAvailable(true)
                    ->setPrice(0.30);
        
        $ingredient2 = new Ingredient();
        $ingredient2->setId(2)
                    ->setLabel('Cucumber')
                    ->setAvailable(true)
                    ->setPrice(0.30);

        array_push( $ingredients, $ingredient1 );
        array_push( $ingredients, $ingredient2 );

        $sandwichs =  [];

        $sandwich = new Sandwich();
        $sandwich->setId(1)
                    ->setLabel('test_sandwich')
                    ->setIngredients($ingredients);

        $sandwich2 = new Sandwich();
        $sandwich2->setId(2)
                    ->setLabel('test_sandwich2')
                    ->setIngredients($ingredients);

        array_push( $sandwichs, $sandwich );
        array_push( $sandwichs, $sandwich2 );

        $user = new User();
        $user->setFirstname('firstname');
        $user->setLastname('lastname');
        $user->setBirthday(new DateTimeImmutable('2000-02-01'));
        $user->setPseudo('my_user');
        $user->setMail('mail');
        $user->setPassword('pass');
        $user->setIsValidator(false);

        $validator = new User();
        $validator->setFirstname('firstname2');
        $validator->setLastname('lastname2');
        $validator->setBirthday(new DateTimeImmutable('2000-02-01'));
        $validator->setPseudo('my_validator');
        $validator->setMail('mail2');
        $validator->setPassword('pass2');
        $validator->setIsValidator(true);

        $order = new Order();
        $order
            ->setId(1)
            ->setApproval(true)
            ->setDate(new DateTimeImmutable('2020-02-01'))
            ->setSandwichs($sandwichs)
            ->setClient($user)
            ->setValidator($validator);

        $order2 = new Order();
        $order2
            ->setId(2)
            ->setApproval(false)
            ->setDate(new DateTimeImmutable('2020-02-01'))
            ->setSandwichs($sandwichs)
            ->setClient($user);    

        $orders = [];

        array_push( $orders, $order );
        array_push( $orders, $order2 );
        
        //repository mock

        /** @var OrderRepository&\PHPUnit\Framework\MockObject\MockObject $mockedOrderRepository */
        $mockedOrderRepository = $this->getMockBuilder('Order\OrderRepository')
            ->disableOriginalConstructor()
            ->setMethods(['getAll'])
            ->getMock();

        /** @var SandwichRepository&\PHPUnit\Framework\MockObject\MockObject $mockedSandwichRepository */
        $mockedSandwichRepository = $this->getMockBuilder('Sandwich\SandwichRepository')
            ->disableOriginalConstructor()
            ->getMock();

        /** @var UserRepository&\PHPUnit\Framework\MockObject\MockObject $mockedUserRepository */
        $mockedUserRepository = $this->getMockBuilder('User\UserRepository')
            ->disableOriginalConstructor()
            ->getMock();

        /** @var InvoiceRepository&\PHPUnit\Framework\MockObject\MockObject $mockedInvoiceRepository */
        $mockedInvoiceRepository = $this->getMockBuilder('Invoice\InvoiceRepository')
            ->disableOriginalConstructor()
            ->getMock();

        $mockedOrderRepository
            ->method('getAll')
            ->willReturn($orders);

        $service = new OrderService($mockedOrderRepository, $mockedSandwichRepository, $mockedUserRepository, $mockedInvoiceRepository);

        //test
        self::assertSame(2, count($service->getOrdersByClient($user)));
    }

    /**
     * @test
     */
    public function getOrderById()
    {
        //data
        $ingredients = [];

        $ingredient1 = new Ingredient();
        $ingredient1->setId(1)
                    ->setLabel('Tomatoes')
                    ->setAvailable(true)
                    ->setPrice(0.30);
        
        $ingredient2 = new Ingredient();
        $ingredient2->setId(2)
                    ->setLabel('Cucumber')
                    ->setAvailable(true)
                    ->setPrice(0.30);

        array_push( $ingredients, $ingredient1 );
        array_push( $ingredients, $ingredient2 );

        $sandwichs =  [];

        $sandwich = new Sandwich();
        $sandwich->setId(1)
                    ->setLabel('test_sandwich')
                    ->setIngredients($ingredients);

        $sandwich2 = new Sandwich();
        $sandwich2->setId(2)
                    ->setLabel('test_sandwich2')
                    ->setIngredients($ingredients);

        array_push( $sandwichs, $sandwich );
        array_push( $sandwichs, $sandwich2 );

        $user = new User();
        $user->setFirstname('firstname');
        $user->setLastname('lastname');
        $user->setBirthday(new DateTimeImmutable('2000-02-01'));
        $user->setPseudo('my_user');
        $user->setMail('mail');
        $user->setPassword('pass');
        $user->setIsValidator(false);

        $validator = new User();
        $validator->setFirstname('firstname2');
        $validator->setLastname('lastname2');
        $validator->setBirthday(new DateTimeImmutable('2000-02-01'));
        $validator->setPseudo('my_validator');
        $validator->setMail('mail2');
        $validator->setPassword('pass2');
        $validator->setIsValidator(true);

        $order = new Order();
        $order
            ->setId(1)
            ->setApproval(true)
            ->setDate(new DateTimeImmutable('2020-02-01'))
            ->setSandwichs($sandwichs)
            ->setClient($user)
            ->setValidator($validator);
        
        //repository mock

        /** @var OrderRepository&\PHPUnit\Framework\MockObject\MockObject $mockedOrderRepository */
        $mockedOrderRepository = $this->getMockBuilder('Order\OrderRepository')
            ->disableOriginalConstructor()
            ->setMethods(['findOneById'])
            ->getMock();

        /** @var SandwichRepository&\PHPUnit\Framework\MockObject\MockObject $mockedSandwichRepository */
        $mockedSandwichRepository = $this->getMockBuilder('Sandwich\SandwichRepository')
            ->disableOriginalConstructor()
            ->getMock();

        /** @var UserRepository&\PHPUnit\Framework\MockObject\MockObject $mockedUserRepository */
        $mockedUserRepository = $this->getMockBuilder('User\UserRepository')
            ->disableOriginalConstructor()
            ->getMock();

        /** @var InvoiceRepository&\PHPUnit\Framework\MockObject\MockObject $mockedInvoiceRepository */
        $mockedInvoiceRepository = $this->getMockBuilder('Invoice\InvoiceRepository')
            ->disableOriginalConstructor()
            ->getMock();

        $mockedOrderRepository
            ->method('findOneById')
            ->willReturn($order);

        $service = new OrderService($mockedOrderRepository, $mockedSandwichRepository, $mockedUserRepository, $mockedInvoiceRepository);

        //test
        self::assertEquals($order, $service->getOrderById($order->getId()));
    }

    /**
     * @test
     */
    public function getOrderByIdNotExists()
    {
        //data
        $ingredients = [];

        $ingredient1 = new Ingredient();
        $ingredient1->setId(1)
                    ->setLabel('Tomatoes')
                    ->setAvailable(true)
                    ->setPrice(0.30);
        
        $ingredient2 = new Ingredient();
        $ingredient2->setId(2)
                    ->setLabel('Cucumber')
                    ->setAvailable(true)
                    ->setPrice(0.30);

        array_push( $ingredients, $ingredient1 );
        array_push( $ingredients, $ingredient2 );

        $sandwichs =  [];

        $sandwich = new Sandwich();
        $sandwich->setId(1)
                    ->setLabel('test_sandwich')
                    ->setIngredients($ingredients);

        $sandwich2 = new Sandwich();
        $sandwich2->setId(2)
                    ->setLabel('test_sandwich2')
                    ->setIngredients($ingredients);

        array_push( $sandwichs, $sandwich );
        array_push( $sandwichs, $sandwich2 );

        $user = new User();
        $user->setFirstname('firstname');
        $user->setLastname('lastname');
        $user->setBirthday(new DateTimeImmutable('2000-02-01'));
        $user->setPseudo('my_user');
        $user->setMail('mail');
        $user->setPassword('pass');
        $user->setIsValidator(false);

        $validator = new User();
        $validator->setFirstname('firstname2');
        $validator->setLastname('lastname2');
        $validator->setBirthday(new DateTimeImmutable('2000-02-01'));
        $validator->setPseudo('my_validator');
        $validator->setMail('mail2');
        $validator->setPassword('pass2');
        $validator->setIsValidator(true);

        $order = new Order();
        $order
            ->setId(1)
            ->setApproval(true)
            ->setDate(new DateTimeImmutable('2020-02-01'))
            ->setSandwichs($sandwichs)
            ->setClient($user)
            ->setValidator($validator);
        
        //repository mock

        /** @var OrderRepository&\PHPUnit\Framework\MockObject\MockObject $mockedOrderRepository */
        $mockedOrderRepository = $this->getMockBuilder('Order\OrderRepository')
            ->disableOriginalConstructor()
            ->setMethods(['findOneById'])
            ->getMock();

        /** @var SandwichRepository&\PHPUnit\Framework\MockObject\MockObject $mockedSandwichRepository */
        $mockedSandwichRepository = $this->getMockBuilder('Sandwich\SandwichRepository')
            ->disableOriginalConstructor()
            ->getMock();

        /** @var UserRepository&\PHPUnit\Framework\MockObject\MockObject $mockedUserRepository */
        $mockedUserRepository = $this->getMockBuilder('User\UserRepository')
            ->disableOriginalConstructor()
            ->getMock();

        /** @var InvoiceRepository&\PHPUnit\Framework\MockObject\MockObject $mockedInvoiceRepository */
        $mockedInvoiceRepository = $this->getMockBuilder('Invoice\InvoiceRepository')
            ->disableOriginalConstructor()
            ->getMock();

        $mockedOrderRepository
            ->method('findOneById')
            ->willReturn(null);

        $service = new OrderService($mockedOrderRepository, $mockedSandwichRepository, $mockedUserRepository, $mockedInvoiceRepository);

        //test
        self::assertEquals(null, $service->getOrderById(200));
        self::assertEquals('Order id ' . 200 . ' doesn\'t exists.', $service->getErrors()['id']);
    }

    /**
     * @test
     */
    public function getOrderByIdWhenNullId()
    {
        //data
        $ingredients = [];

        $ingredient1 = new Ingredient();
        $ingredient1->setId(1)
                    ->setLabel('Tomatoes')
                    ->setAvailable(true)
                    ->setPrice(0.30);
        
        $ingredient2 = new Ingredient();
        $ingredient2->setId(2)
                    ->setLabel('Cucumber')
                    ->setAvailable(true)
                    ->setPrice(0.30);

        array_push( $ingredients, $ingredient1 );
        array_push( $ingredients, $ingredient2 );

        $sandwichs =  [];

        $sandwich = new Sandwich();
        $sandwich->setId(1)
                    ->setLabel('test_sandwich')
                    ->setIngredients($ingredients);

        $sandwich2 = new Sandwich();
        $sandwich2->setId(2)
                    ->setLabel('test_sandwich2')
                    ->setIngredients($ingredients);

        array_push( $sandwichs, $sandwich );
        array_push( $sandwichs, $sandwich2 );

        $user = new User();
        $user->setFirstname('firstname');
        $user->setLastname('lastname');
        $user->setBirthday(new DateTimeImmutable('2000-02-01'));
        $user->setPseudo('my_user');
        $user->setMail('mail');
        $user->setPassword('pass');
        $user->setIsValidator(false);

        $validator = new User();
        $validator->setFirstname('firstname2');
        $validator->setLastname('lastname2');
        $validator->setBirthday(new DateTimeImmutable('2000-02-01'));
        $validator->setPseudo('my_validator');
        $validator->setMail('mail2');
        $validator->setPassword('pass2');
        $validator->setIsValidator(true);

        $order = new Order();
        $order
            ->setId(1)
            ->setApproval(true)
            ->setDate(new DateTimeImmutable('2020-02-01'))
            ->setSandwichs($sandwichs)
            ->setClient($user)
            ->setValidator($validator);
        
        //repository mock

        /** @var OrderRepository&\PHPUnit\Framework\MockObject\MockObject $mockedOrderRepository */
        $mockedOrderRepository = $this->getMockBuilder('Order\OrderRepository')
            ->disableOriginalConstructor()
            ->setMethods(['findOneById'])
            ->getMock();

        /** @var SandwichRepository&\PHPUnit\Framework\MockObject\MockObject $mockedSandwichRepository */
        $mockedSandwichRepository = $this->getMockBuilder('Sandwich\SandwichRepository')
            ->disableOriginalConstructor()
            ->getMock();

        /** @var UserRepository&\PHPUnit\Framework\MockObject\MockObject $mockedUserRepository */
        $mockedUserRepository = $this->getMockBuilder('User\UserRepository')
            ->disableOriginalConstructor()
            ->getMock();

        /** @var InvoiceRepository&\PHPUnit\Framework\MockObject\MockObject $mockedInvoiceRepository */
        $mockedInvoiceRepository = $this->getMockBuilder('Invoice\InvoiceRepository')
            ->disableOriginalConstructor()
            ->getMock();

        $mockedOrderRepository
            ->method('findOneById')
            ->willReturn(null);

        $service = new OrderService($mockedOrderRepository, $mockedSandwichRepository, $mockedUserRepository, $mockedInvoiceRepository);

        //test
        self::assertEquals(null, $service->getOrderById(null));
        self::assertEquals('Order id shouldn\'t be null.', $service->getErrors()['id']);
    }

    /**
     * @test
     */
    public function getOrderByIdWhenNegativeId()
    {
        //data
        $ingredients = [];

        $ingredient1 = new Ingredient();
        $ingredient1->setId(1)
                    ->setLabel('Tomatoes')
                    ->setAvailable(true)
                    ->setPrice(0.30);
        
        $ingredient2 = new Ingredient();
        $ingredient2->setId(2)
                    ->setLabel('Cucumber')
                    ->setAvailable(true)
                    ->setPrice(0.30);

        array_push( $ingredients, $ingredient1 );
        array_push( $ingredients, $ingredient2 );

        $sandwichs =  [];

        $sandwich = new Sandwich();
        $sandwich->setId(1)
                    ->setLabel('test_sandwich')
                    ->setIngredients($ingredients);

        $sandwich2 = new Sandwich();
        $sandwich2->setId(2)
                    ->setLabel('test_sandwich2')
                    ->setIngredients($ingredients);

        array_push( $sandwichs, $sandwich );
        array_push( $sandwichs, $sandwich2 );

        $user = new User();
        $user->setFirstname('firstname');
        $user->setLastname('lastname');
        $user->setBirthday(new DateTimeImmutable('2000-02-01'));
        $user->setPseudo('my_user');
        $user->setMail('mail');
        $user->setPassword('pass');
        $user->setIsValidator(false);

        $validator = new User();
        $validator->setFirstname('firstname2');
        $validator->setLastname('lastname2');
        $validator->setBirthday(new DateTimeImmutable('2000-02-01'));
        $validator->setPseudo('my_validator');
        $validator->setMail('mail2');
        $validator->setPassword('pass2');
        $validator->setIsValidator(true);

        $order = new Order();
        $order
            ->setId(1)
            ->setApproval(true)
            ->setDate(new DateTimeImmutable('2020-02-01'))
            ->setSandwichs($sandwichs)
            ->setClient($user)
            ->setValidator($validator);
        
        //repository mock

        /** @var OrderRepository&\PHPUnit\Framework\MockObject\MockObject $mockedOrderRepository */
        $mockedOrderRepository = $this->getMockBuilder('Order\OrderRepository')
            ->disableOriginalConstructor()
            ->setMethods(['findOneById'])
            ->getMock();

        /** @var SandwichRepository&\PHPUnit\Framework\MockObject\MockObject $mockedSandwichRepository */
        $mockedSandwichRepository = $this->getMockBuilder('Sandwich\SandwichRepository')
            ->disableOriginalConstructor()
            ->getMock();

        /** @var UserRepository&\PHPUnit\Framework\MockObject\MockObject $mockedUserRepository */
        $mockedUserRepository = $this->getMockBuilder('User\UserRepository')
            ->disableOriginalConstructor()
            ->getMock();

        /** @var InvoiceRepository&\PHPUnit\Framework\MockObject\MockObject $mockedInvoiceRepository */
        $mockedInvoiceRepository = $this->getMockBuilder('Invoice\InvoiceRepository')
            ->disableOriginalConstructor()
            ->getMock();

        $mockedOrderRepository
            ->method('findOneById')
            ->willReturn(null);

        $service = new OrderService($mockedOrderRepository, $mockedSandwichRepository, $mockedUserRepository, $mockedInvoiceRepository);

        //test
        self::assertEquals(null, $service->getOrderById(-1));
        self::assertEquals('Order id can\'t be inferior to zero.', $service->getErrors()['id']);
    }
}
