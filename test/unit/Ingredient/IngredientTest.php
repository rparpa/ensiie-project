<?php
namespace Ingredient;

use PHPUnit\Framework\TestCase;

class IngredientTest extends TestCase
{
    /**
     * @test
     */
    public function propertiesWhenFilled()
    {
        $ingredient = new Ingredient();
        $ingredient->setId(1)
                    ->setLabel('test')
                    ->setAvailable(true)
                    ->setPrice(2.00)
                    ->setImageLink('./helloWorld.png');

        self::assertSame(1, $ingredient->getId()); 
        self::assertSame('test', $ingredient->getLabel());
        self::assertSame(true, $ingredient->getAvailable());   
        self::assertSame(2.00, $ingredient->getPrice());
        self::assertSame('./helloWorld.png', $ingredient->getImageLink());
    }

    /**
     * @test
     */
    public function priceWhenPositive()
    {
        $ingredient = new Ingredient();
        $ingredient->setPrice(2.00);
        self::assertSame(2.00, $ingredient->getPrice());
    }

    /**
     * @test
     */
    public function priceWhenNeutral()
    {
        $ingredient = new Ingredient();
        $ingredient->setPrice(0.00);
        self::assertSame(0.00, $ingredient->getPrice());
    }

    /**
     * @test
     */
    public function priceWhenNegative()
    {
        $ingredient = new Ingredient();
        $ingredient->setPrice(-2.00);
        $this->expectException(\OutOfRangeException::class);
        $ingredient->getPrice();
    }
}
