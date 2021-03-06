<?php

namespace FacturaScripts\Core\Base;

/**
 * Generated by PHPUnit_SkeletonGenerator on 2017-07-24 at 16:46:47.
 */
class DefaultItemsTest extends \PHPUnit_Framework_TestCase {

    /**
     * @var DefaultItems
     */
    protected $object;

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp() {
        $this->object = new DefaultItems;
    }

    /**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     */
    protected function tearDown() {
        
    }

    /**
     * @covers FacturaScripts\Core\Base\DefaultItems::codEjercicio
     * @todo   Implement testCodEjercicio().
     */
    public function testCodEjercicio() {
        // Remove the following lines when you implement this test.
        $this->object->setCodEjercicio(1);
        $data = $this->object->codEjercicio();
        $this->assertEquals(1, $data);
    }


    /**
     * @covers FacturaScripts\Core\Base\DefaultItems::codAlmacen
     * @todo   Implement testCodAlmacen().
     */
    public function testCodAlmacen() {
        // Remove the following lines when you implement this test.
        $this->object->setCodAlmacen(1);
        $data = $this->object->codAlmacen();
        $this->assertEquals(1, $data);
    }


    /**
     * @covers FacturaScripts\Core\Base\DefaultItems::codDivisa
     * @todo   Implement testCodDivisa().
     */
    public function testCodDivisa() {
        // Remove the following lines when you implement this test.
        $this->object->setCodDivisa(1);
        $data = $this->object->codDivisa();
        $this->assertEquals(1, $data);
    }


    /**
     * @covers FacturaScripts\Core\Base\DefaultItems::codPago
     * @todo   Implement testCodPago().
     */
    public function testCodPago() {
        // Remove the following lines when you implement this test.
        $this->object->setCodPago(1);
        $data = $this->object->codPago();
        $this->assertEquals(1, $data);
    }


    /**
     * @covers FacturaScripts\Core\Base\DefaultItems::codImpuesto
     * @todo   Implement testCodImpuesto().
     */
    public function testCodImpuesto() {
        // Remove the following lines when you implement this test.
        $this->object->setCodImpuesto(1);
        $data = $this->object->codImpuesto();
        $this->assertEquals(1, $data);
    }


    /**
     * @covers FacturaScripts\Core\Base\DefaultItems::codPais
     * @todo   Implement testCodPais().
     */
    public function testCodPais() {
        // Remove the following lines when you implement this test.
        $this->object->setCodPais(1);
        $data = $this->object->codPais();
        $this->assertEquals(1, $data);
    }


    /**
     * @covers FacturaScripts\Core\Base\DefaultItems::codSerie
     * @todo   Implement testCodSerie().
     */
    public function testCodSerie() {
        // Remove the following lines when you implement this test.
        $this->object->setCodSerie(1);
        $data = $this->object->codSerie();
        $this->assertEquals(1, $data);
    }



    /**
     * @covers FacturaScripts\Core\Base\DefaultItems::defaultPage
     * @todo   Implement testDefaultPage().
     */
    public function testDefaultPage() {
        // Remove the following lines when you implement this test.
        $this->object->setDefaultPage('principal');
        $data = $this->object->defaultPage();
        $this->assertEquals('principal', $data);
    }



    /**
     * @covers FacturaScripts\Core\Base\DefaultItems::showingPage
     * @todo   Implement testShowingPage().
     */
    public function testShowingPage() {
        // Remove the following lines when you implement this test.
        $this->object->setShowingPage('default');
        $data = $this->object->showingPage();
        $this->assertEquals('default', $data);
    }



}
