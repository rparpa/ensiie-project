<?php
namespace Sandwich;

use Ingredient\Ingredient;
use PHPUnit\Framework\TestCase;

class SandwichTest extends TestCase
{
    /**
     * @test
     */
    public function propertiesWhenFilled()
    {
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

        $sandwich = new Sandwich();
        $sandwich->setId(1)
                    ->setLabel('test_sandwich')
                    ->setIngredients($ingredients);
                    
        self::assertSame(1, $sandwich->getId()); 
        self::assertSame('test_sandwich', $sandwich->getLabel());
        self::assertSame($ingredients, $sandwich->getIngredients());
    }

}
