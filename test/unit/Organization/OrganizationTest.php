<?php
namespace Organization;

use PHPUnit\Framework\TestCase;

class OrganizationTest extends TestCase
{
    /**
     * @test
     */
    public function TestFictifOrganization()
    {
        $organization = new Organization();
        $organization->setName("Ile Mystérieuse");
        self::assertSame("Ile Mystérieuse", $organization->getName());
    }


}
