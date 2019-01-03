<?php

require_once __DIR__ . '/../vendor/autoload.php';

use Gumacahin\IntToFilipino as IntToFilipino;


class IntToFilipinoTest extends PHPUnit\Framework\TestCase {

    /**
     * @test
     */
    function it_can_be_instantiated()
    {
        $intToFil = new IntToFilipino();
        $this->assertInstanceOf(IntToFilipino::class, $intToFil);

    }

    /**
     * @test
     */
    function it_cant_accept_values_below_min()
    {
        $intToFil = new IntToFilipino();

        $this->expectException(Exception::class);
        $intToFil->say(IntToFilipino::MIN - 1);
    }

    /**
     * @test
     */
    function it_cant_accept_values_above_max()
    {
        $intToFil = new IntToFilipino();

        $this->expectException(Exception::class);
        $intToFil->say(IntToFilipino::MAX + 1);
    }

    /**
     * @test
     */
    function it_cant_accept_non_integers()
    {
        $intToFil = new IntToFilipino();

        $this->expectException(Exception::class);
        $intToFil->say(1.5);
    }

    /**
     * @test
     */
    function it_can_say_zero()
    {
        $intToFil = new IntToFilipino();
        $this->assertEquals('zero', $intToFil->say(0));
    }


    /**
     * @test
     */
    function it_can_say_100()
    {
        $intToFil = new IntToFilipino();
        $this->assertEquals('sandaan', $intToFil->say(100));
    }

    /**
     * @test
     */
    function it_can_say_501()
    {
        $intToFil = new IntToFilipino();
        $this->assertEquals('limandaan at isa', $intToFil->say(501));
    }

    /**
     * @test
     */
    function it_can_say_999()
    {
        $intToFil = new IntToFilipino();
        $this->assertEquals($intToFil->say(999), 'siyamnaraan, siyamnapu at siyam');
    }

    /**
     * @test
     */
    function it_can_say_isa()
    {
        $intToFil = new IntToFilipino();
        $this->assertEquals('isa', $intToFil->say(1));
    }

    /**
     * @test
     */
    function it_can_say_siyam()
    {
        $intToFil = new IntToFilipino();
        $this->assertEquals('siyam', $intToFil->say(9));
    }

    /**
     * @test
     */
    function it_can_say_sampu()
    {
        $intToFil = new IntToFilipino();
        $this->assertEquals('sampu', $intToFil->say(10));
    }

    /**
     * @test
     */
    function it_can_count_from_zero_to_19()
    {
        $intToFil = new IntToFilipino();
        for ($i = 0; $i < 19; $i++) {
            $this->assertEquals(IntToFilipino::TO_19[$i], $intToFil->say($i));
        }
    }

    /**
     * @test
     */
    function it_can_count_from_20_to_99()
    {
        $intToFil = new IntToFilipino();
        $this->assertEquals($intToFil->say(21), "dalawampu at isa");

        $this->assertEquals($intToFil->say(20), "dalawampu");

        $this->assertEquals($intToFil->say(30), "tatlumpu");

        $this->assertEquals($intToFil->say(40), "apatnapu");

        $this->assertEquals($intToFil->say(45), "apatnapu at lima");

        $this->assertEquals($intToFil->say(99), "siyamnapu at siyam");

        $this->assertEquals($intToFil->say(25), "dalawampu at lima");

        //$intToFil->setLongForm(false);

        //$this->assertEquals($intToFil->say(25), "dalawampu't lima");

        //$this->assertEquals($intToFil->say(99), "siyamnapu't siyam");
    }

    /**
     * @test
     */
    function it_can_count_from_100_to_999()
    {
        $intToFil = new IntToFilipino();

        $this->assertEquals($intToFil->say(100), 'sandaan');

        $this->assertEquals($intToFil->say(101), 'sandaan at isa');

        $this->assertEquals($intToFil->say(110), 'sandaan at sampu');

        $this->assertEquals($intToFil->say(111), 'sandaan at labing-isa');

        $this->assertEquals($intToFil->say(121), 'sandaan, dalawampu at isa');

        $this->assertEquals($intToFil->say(900), 'siyamnaraan');

        $this->assertEquals($intToFil->say(800), 'walundaan');

        $this->assertEquals($intToFil->say(850), 'walundaan at limampu');

        $this->assertEquals($intToFil->say(199), 'sandaan, siyamnapu at siyam');
    }

    /**
     * @test
     */
    function it_can_say_1999()
    {

        $intToFil = new IntToFilipino();

        $this->assertEquals($intToFil->say(1999), 'isang libo, siyamnaraan, siyamnapu at siyam');
    }

    /**
     * @test
     */
    function it_can_say_1919()
    {

        $intToFil = new IntToFilipino();

        $this->assertEquals($intToFil->say(1999), 'isang libo, siyamnaraan, siyamnapu at siyam');
    }

}
