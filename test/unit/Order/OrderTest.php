<?php
namespace Order;

use DateTimeImmutable;
use Ingredient\Ingredient;
use PHPUnit\Framework\TestCase;
use Sandwich\Sandwich;
use User\User;

class OrderTest extends TestCase
{
    /**
     * @test
     */
    public function filterWhenApproved()
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

        //test
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
            ->setApproval(true)
            ->setDate(new DateTimeImmutable('2020-02-01'))
            ->setSandwichs($sandwichs)
            ->setClient($user)
            ->setValidator($validator);
                    
        self::assertEquals($user, $order->getClient());
        self::assertEquals($validator, $order->getValidator()); 
        self::assertEquals($sandwich, $order->getSandwichs()[0]); 
        self::assertEquals($sandwich2, $order->getSandwichs()[1]); 
        self::assertEquals(new DateTimeImmutable('2020-02-01'), $order->getDate());

        self::assertSame(true, $order->getApproval());
    }

    /**
     * @test
     */
    public function getTotalPriceWhenFilled()
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

        //repository

        $order = new Order();
        $order
            ->setApproval(true)
            ->setDate(new DateTimeImmutable('2020-02-01'))
            ->setSandwichs($sandwichs)
            ->setClient($user)
            ->setValidator($validator);
                    
        self::assertEquals(1.2, $order->getTotalPrice());
    }

    /**
     * @test
     */
    public function getTotalPriceWhenEmpty()
    {
        $sandwichs =  [];

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
            ->setApproval(true)
            ->setDate(new DateTimeImmutable('2020-02-01'))
            ->setSandwichs($sandwichs)
            ->setClient($user)
            ->setValidator($validator);
                    
        self::assertEquals(0, $order->getTotalPrice());
    }

}
