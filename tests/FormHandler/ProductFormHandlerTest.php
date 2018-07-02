<?php

namespace App\Tests\FormHandler;

use App\DTO\ProductDTO;
use App\FormHandler\ProductFormHandler;
use App\Repository\ProductRepository;
use Prophecy\Argument;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\Request;
use PHPUnit\Framework\TestCase;

class ProductFormHandlerTest extends TestCase
{
    private $requestProphecy;
    private $formProphecy;
    private $formFactoryProphecy;
    private $repositoryProphecy;
    private $productFormHandler;

    public function setUp()
    {
        $this->requestProphecy = $this->prophesize(Request::class);
        $this->formProphecy = $this->prophesize(FormInterface::class);
        $this->formFactoryProphecy = $this->prophesize(FormFactoryInterface::class);
        $this->repositoryProphecy = $this->prophesize(ProductRepository::class);

        $this->formFactoryProphecy
            ->createNamed(Argument::any(), Argument::any())
            ->willReturn($this->formProphecy->reveal());

        $this->productFormHandler = new ProductFormHandler(
            $this->formFactoryProphecy->reveal(),
            $this->repositoryProphecy->reveal()
        );
    }

    public function testShouldReturnFormWhenGetFormCalled()
    {
        $this->assertInstanceOf(FormInterface::class, $this->productFormHandler->getForm());
    }

    public function testShouldCallsAddIfFormIsValid()
    {
        $this->formProphecy->setData(Argument::any())->shouldBeCalled();
        $this->formProphecy->handleRequest(Argument::type(Request::class))->shouldBeCalled();

        $this->formProphecy->isValid()->willReturn(true);
        $this->formProphecy->isSubmitted()->willReturn(true);

        $this->repositoryProphecy->add(Argument::type(ProductDTO::class))->shouldBeCalled();

        $result = $this->productFormHandler->process($this->requestProphecy->reveal(), new ProductDTO());

        $this->assertTrue($result);
    }

    public function testShouldCallsEditIfFormIsValid()
    {
        $this->formProphecy->setData(Argument::any())->shouldBeCalled();
        $this->formProphecy->handleRequest(Argument::type(Request::class))->shouldBeCalled();

        $this->formProphecy->isValid()->willReturn(true);
        $this->formProphecy->isSubmitted()->willReturn(true);

        $this->repositoryProphecy->edit(Argument::type(ProductDTO::class))->shouldBeCalled();

        $storage = new ProductDTO();
        $storage->id = 123;

        $result = $this->productFormHandler->process($this->requestProphecy->reveal(), $storage);

        $this->assertTrue($result);
    }

    public function testShouldReturnFalseIfFormIsInvalid()
    {
        $this->formProphecy->isValid()->willReturn(false);
        $this->formProphecy->isSubmitted()->willReturn(true);

        $this->formProphecy->setData(Argument::any())->shouldBeCalled();
        $this->formProphecy->handleRequest(Argument::type(Request::class))->shouldBeCalled();

        $result = $this->productFormHandler->process($this->requestProphecy->reveal(), new ProductDTO());

        $this->assertFalse($result);
    }

    public function testShouldReturnFalseIfFormIsNotSubmitted()
    {
        $this->formProphecy->isValid()->willReturn(true);
        $this->formProphecy->isSubmitted()->willReturn(false);

        $this->formProphecy->setData(Argument::any())->shouldBeCalled();
        $this->formProphecy->handleRequest(Argument::type(Request::class))->shouldBeCalled();

        $result = $this->productFormHandler->process($this->requestProphecy->reveal(), new ProductDTO());

        $this->assertFalse($result);
    }
}
