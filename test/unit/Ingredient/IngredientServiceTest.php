<?php
namespace Ingredient;

use PDO;
use PHPUnit\Framework\TestCase;

class IngredientServiceTest extends TestCase
{
    /**
     * @test
     */
    public function filterWhenAvailable()
    {
        $ingredient = new Ingredient();
        $ingredient->setId(1)
                    ->setLabel('test')
                    ->setAvailable(true)
                    ->setPrice(2.00)
                    ->setImageLink('./helloWorld.png');
        
        $ingredient2 = new Ingredient();
        $ingredient2->setId(2)
                    ->setLabel('test2')
                    ->setAvailable(false)
                    ->setPrice(2.00)
                    ->setImageLink('./helloWorld.png');

        $ingredients = [];
        $ingredients[] = $ingredient;
        $ingredients[] = $ingredient2;

        /** @var IngredientRepository&\PHPUnit\Framework\MockObject\MockObject $mockedRepository */
        $mockedRepository = $this->getMockBuilder('Ingredient\IngredientRepository')
            ->disableOriginalConstructor()
            ->setMethods(['fetchAll'])
            ->getMock();

        $mockedRepository
            ->method('fetchAll')
            ->willReturn($ingredients);

        $service = new IngredientService($mockedRepository);

        self::assertSame(1, count($service->getAvailableIngredients()));
        self::assertSame(1, $service->getAvailableIngredients()[0]->getId());
    }

    /**
    * @test
    */
    public function getByIdWhenIdExists()
    {
        $ingredient = new Ingredient();
        $ingredient->setId(1)
                    ->setLabel('test')
                    ->setAvailable(true)
                    ->setPrice(2.00)
                    ->setImageLink('./helloWorld.png');

        /** @var IngredientRepository&\PHPUnit\Framework\MockObject\MockObject $mockedRepository */
        $mockedRepository = $this->getMockBuilder('Ingredient\IngredientRepository')
            ->disableOriginalConstructor()
            ->setMethods(['findOneById'])
            ->getMock();

        $mockedRepository
            ->method('findOneById')
            ->willReturn($ingredient);

        $service = new IngredientService($mockedRepository);

        self::assertSame($ingredient, $service->getIngredientById(1));
    }

    /**
    * @test
    */
    public function getByIdWhenIdNotExists()
    {
        /** @var IngredientRepository&\PHPUnit\Framework\MockObject\MockObject $mockedRepository */
        $mockedRepository = $this->getMockBuilder('Ingredient\IngredientRepository')
            ->disableOriginalConstructor()
            ->setMethods(['findOneById'])
            ->getMock();

        $mockedRepository
            ->method('findOneById')
            ->willReturn(null);

        $service = new IngredientService($mockedRepository);

        self::assertSame(null, $service->getIngredientById(2));
        self::assertSame('Ingredient id ' . 2 . ' doesn\'t exists.', $service->getErrors()['id']);
    }

    /**
     * @test
     */
    public function getByIdWhenIdNull()
    {
        /** @var IngredientRepository&\PHPUnit\Framework\MockObject\MockObject $mockedRepository */
        $mockedRepository = $this->getMockBuilder('Ingredient\IngredientRepository')
            ->disableOriginalConstructor()
            ->setMethods(['findOneById'])
            ->getMock();

        $mockedRepository
            ->method('findOneById')
            ->willReturn(null);

        $service = new IngredientService($mockedRepository);

        self::assertNull($service->getIngredientById(null));
        self::assertSame('Ingredient id shouldn\'t be null.', $service->getErrors()['id']);
    }

    /**
     * @test
     */
    public function getByIdWhenIdLessThanZero()
    {
        /** @var IngredientRepository&\PHPUnit\Framework\MockObject\MockObject $mockedRepository */
        $mockedRepository = $this->getMockBuilder('Ingredient\IngredientRepository')
            ->disableOriginalConstructor()
            ->setMethods(['findOneById'])
            ->getMock();

        $mockedRepository
            ->method('findOneById')
            ->willReturn(null);

        $service = new IngredientService($mockedRepository);

        self::assertNull($service->getIngredientById(-1));
        self::assertSame('Ingredient id can\'t be inferior to zero.', $service->getErrors()['id']);
    }

    /**
    * @test
    */
    public function saveIngredientWhenIdNull()
    {
        $ingredient = new Ingredient();
        $ingredient->setId(null)
                    ->setLabel('test')
                    ->setAvailable(true)
                    ->setPrice(2.00)
                    ->setImageLink('./helloWorld.png');

        /** @var IngredientRepository&\PHPUnit\Framework\MockObject\MockObject $mockedRepository */
        $mockedRepository = $this->getMockBuilder('Ingredient\IngredientRepository')
            ->disableOriginalConstructor()
            ->setMethods(['createIngredient', 'findOneByLabel'])
            ->getMock();

        $expectedIngredient = new Ingredient();
        $expectedIngredient->setId(1)
            ->setLabel('test')
            ->setAvailable(true)
            ->setPrice(2.00)
            ->setImageLink('./helloWorld.png');

        $mockedRepository
            ->method('createIngredient')
            ->willReturn($expectedIngredient);

        $mockedRepository
            ->method('findOneByLabel')
            ->willReturn(null);

        $service = new IngredientService($mockedRepository);

        self::assertEquals($expectedIngredient, $service->saveIngredient($ingredient));
    }

    /**
    * @test
    */
    public function saveIngredientWhenIdNotNull()
    {
        $ingredient = new Ingredient();
        $ingredient->setId(1)
                    ->setLabel('test')
                    ->setAvailable(true)
                    ->setPrice(2.00)
                    ->setImageLink('./helloWorld.png');

        /** @var IngredientRepository&\PHPUnit\Framework\MockObject\MockObject $mockedRepository */
        $mockedRepository = $this->getMockBuilder('Ingredient\IngredientRepository')
            ->disableOriginalConstructor()
            ->setMethods(['updateIngredient', 'findOneByLabel'])
            ->getMock();

        $expectedIngredient = new Ingredient();
        $expectedIngredient->setId(1)
                        ->setLabel('test')
                        ->setAvailable(true)
                        ->setPrice(2.00)
                        ->setImageLink('./helloWorld.png');

        $mockedRepository
            ->method('updateIngredient')
            ->willReturn($expectedIngredient);

        $mockedRepository
            ->method('findOneByLabel')
            ->willReturn(null);

        $service = new IngredientService($mockedRepository);

        self::assertEquals($expectedIngredient, $service->saveIngredient($ingredient));
    }

    /**
    * @test
    */
    public function saveIngredientWhenLabelEmpty()
    {
        $ingredient = new Ingredient();
        $ingredient->setId(1)
                    ->setLabel('')
                    ->setAvailable(true)
                    ->setPrice(2.00)
                    ->setImageLink('./helloWorld.png');

        /** @var IngredientRepository&\PHPUnit\Framework\MockObject\MockObject $mockedRepository */
        $mockedRepository = $this->getMockBuilder('Ingredient\IngredientRepository')
            ->disableOriginalConstructor()
            ->getMock();

        $service = new IngredientService($mockedRepository);

        self::assertEquals($ingredient, $service->saveIngredient($ingredient));
        self::assertSame('Label is mandatory.', $service->getErrors()['label']);
    }

    /**
    * @test
    */
    public function saveIngredientWhenLabelExistsAndIdNull()
    {
        $ingredient = new Ingredient();
        $ingredient->setId(null)
                    ->setLabel('my_label')
                    ->setAvailable(true)
                    ->setPrice(2.00)
                    ->setImageLink('./helloWorld.png');

        /** @var IngredientRepository&\PHPUnit\Framework\MockObject\MockObject $mockedRepository */
        $mockedRepository = $this->getMockBuilder('Ingredient\IngredientRepository')
            ->disableOriginalConstructor()
            ->setMethods(['findOneByLabel'])
            ->getMock();

        $otherIngredientWithSameLabel = new Ingredient();
        $otherIngredientWithSameLabel->setId(2)
                                    ->setLabel('my_label')
                                    ->setAvailable(true)
                                    ->setPrice(3.00)
                                    ->setImageLink('./helloWorld.png');

        $mockedRepository
            ->method('findOneByLabel')
            ->willReturn($otherIngredientWithSameLabel);

        $service = new IngredientService($mockedRepository);

        self::assertEquals($ingredient, $service->saveIngredient($ingredient));
        self::assertSame('This label already exists for an ingredient.', $service->getErrors()['label']);
    }

    /**
    * @test
    */
    public function saveIngredientWhenLabelExistsAndIdNotNull()
    {
        $ingredient = new Ingredient();
        $ingredient->setId(1)
                    ->setLabel('my_label')
                    ->setAvailable(true)
                    ->setPrice(2.00)
                    ->setImageLink('./helloWorld.png');

        /** @var IngredientRepository&\PHPUnit\Framework\MockObject\MockObject $mockedRepository */
        $mockedRepository = $this->getMockBuilder('Ingredient\IngredientRepository')
            ->disableOriginalConstructor()
            ->setMethods(['findOneByLabel'])
            ->getMock();

        $otherIngredientWithSameLabel = new Ingredient();
        $otherIngredientWithSameLabel->setId(2)
                                    ->setLabel('my_label')
                                    ->setAvailable(true)
                                    ->setPrice(3.00)
                                    ->setImageLink('./helloWorld.png');

        $mockedRepository
            ->method('findOneByLabel')
            ->willReturn($otherIngredientWithSameLabel);

        $service = new IngredientService($mockedRepository);

        self::assertEquals($ingredient, $service->saveIngredient($ingredient));
        self::assertSame('This label already exists for an ingredient.', $service->getErrors()['label']);
    }

    /**
    * @test
    */
    public function saveIngredientWhenPriceNull()
    {
        $ingredient = new Ingredient();
        $ingredient->setId(1)
                    ->setLabel('my_label')
                    ->setAvailable(true)
                    ->setPrice(null)
                    ->setImageLink('./helloWorld.png');

        /** @var IngredientRepository&\PHPUnit\Framework\MockObject\MockObject $mockedRepository */
        $mockedRepository = $this->getMockBuilder('Ingredient\IngredientRepository')
            ->disableOriginalConstructor()
            ->setMethods(['findOneByLabel'])
            ->getMock();

        $mockedRepository
            ->method('findOneByLabel')
            ->willReturn(null);

        $service = new IngredientService($mockedRepository);

        self::assertEquals($ingredient, $service->saveIngredient($ingredient));
        self::assertSame('Price is mandatory.', $service->getErrors()['price']);
    }

    /**
    * @test
    */
    public function saveIngredientWhenPriceNegative()
    {
        $ingredient = new Ingredient();
        $ingredient->setId(1)
                    ->setLabel('my_label')
                    ->setAvailable(true)
                    ->setPrice(-1)
                    ->setImageLink('./helloWorld.png');

        /** @var IngredientRepository&\PHPUnit\Framework\MockObject\MockObject $mockedRepository */
        $mockedRepository = $this->getMockBuilder('Ingredient\IngredientRepository')
            ->disableOriginalConstructor()
            ->setMethods(['findOneByLabel'])
            ->getMock();

        $mockedRepository
            ->method('findOneByLabel')
            ->willReturn(null);

        $service = new IngredientService($mockedRepository);

        self::assertEquals($ingredient, $service->saveIngredient($ingredient));
        self::assertSame('Price must be superior to zero.', $service->getErrors()['price']);
    }


    /**
    * @test
    */
    public function deleteIngredientWhenIdNull()
    {
        $ingredient = new Ingredient();
        $ingredient->setId(null)
                    ->setLabel('my_label')
                    ->setAvailable(true)
                    ->setPrice(1)
                    ->setImageLink('./helloWorld.png');

        /** @var IngredientRepository&\PHPUnit\Framework\MockObject\MockObject $mockedRepository */
        $mockedRepository = $this->getMockBuilder('Ingredient\IngredientRepository')
            ->disableOriginalConstructor()
            ->getMock();

        $service = new IngredientService($mockedRepository);

        self::assertSame(false, $service->deleteIngredient($ingredient));
        self::assertSame('Ingredient id shouldn\'t be null.', $service->getErrors()['id']);
    }

    /**
    * @test
    */
    public function deleteIngredientWhenIdNotNull()
    {
        $ingredient = new Ingredient();
        $ingredient->setId(1)
                    ->setLabel('my_label')
                    ->setAvailable(true)
                    ->setPrice(1)
                    ->setImageLink('./helloWorld.png');

        /** @var IngredientRepository&\PHPUnit\Framework\MockObject\MockObject $mockedRepository */
        $mockedRepository = $this->getMockBuilder('Ingredient\IngredientRepository')
            ->disableOriginalConstructor()
            ->setMethods(['deleteIngredient'])
            ->getMock();

        $mockedRepository
            ->method('deleteIngredient')
            ->willReturn(true);
        
        $service = new IngredientService($mockedRepository);

        self::assertSame(true, $service->deleteIngredient($ingredient));
    }
}
