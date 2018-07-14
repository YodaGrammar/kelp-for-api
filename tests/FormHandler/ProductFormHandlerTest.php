<?php

namespace App\Tests\FormHandler;

use App\Entity\Product;
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

    /**
     * @throws \Prophecy\Exception\Doubler\ClassNotFoundException
     * @throws \Prophecy\Exception\Doubler\DoubleException
     * @throws \Prophecy\Exception\Doubler\InterfaceNotFoundException
     * @throws \Prophecy\Exception\Prophecy\ObjectProphecyException
     * @throws \Symfony\Component\OptionsResolver\Exception\InvalidOptionsException
     */
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

    /**
     * @throws \PHPUnit\Framework\ExpectationFailedException
     * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
     */
    public function testShouldReturnFormWhenGetFormCalled(): void
    {
        $this->assertInstanceOf(FormInterface::class, $this->productFormHandler->getForm());
    }

    /**
     * @throws \PHPUnit\Framework\ExpectationFailedException
     * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
     */
    public function testShouldCallsAddIfFormIsValid()
    {
        $this->formProphecy->setData(Argument::any())->shouldBeCalled();
        $this->formProphecy->handleRequest(Argument::type(Request::class))->shouldBeCalled();

        $this->formProphecy->isValid()->willReturn(true);
        $this->formProphecy->isSubmitted()->willReturn(true);

        $this->repositoryProphecy->createOrUpdate(Argument::type(Product::class), Argument::any())->shouldBeCalled();

        $result = $this->productFormHandler->process($this->requestProphecy->reveal(), new Product());

        $this->assertTrue($result);
    }

    /**
     * @throws \PHPUnit\Framework\ExpectationFailedException
     * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
     */
    public function testShouldCallsEditIfFormIsValid(): void
    {
        $this->formProphecy->setData(Argument::any())->shouldBeCalled();
        $this->formProphecy->handleRequest(Argument::type(Request::class))->shouldBeCalled();

        $this->formProphecy->isValid()->willReturn(true);
        $this->formProphecy->isSubmitted()->willReturn(true);

        $this->repositoryProphecy->createOrUpdate(Argument::type(Product::class), Argument::any())->shouldBeCalled();

        $product = new Product();

        $result = $this->productFormHandler->process($this->requestProphecy->reveal(), $product);

        $this->assertTrue($result);
    }

    /**
     * @throws \PHPUnit\Framework\ExpectationFailedException
     * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
     */
    public function testShouldReturnFalseIfFormIsInvalid(): void
    {
        $this->formProphecy->isValid()->willReturn(false);
        $this->formProphecy->isSubmitted()->willReturn(true);

        $this->formProphecy->setData(Argument::any())->shouldBeCalled();
        $this->formProphecy->handleRequest(Argument::type(Request::class))->shouldBeCalled();

        $result = $this->productFormHandler->process($this->requestProphecy->reveal(), new Product());

        $this->assertFalse($result);
    }

    /**
     * @throws \PHPUnit\Framework\ExpectationFailedException
     * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
     */
    public function testShouldReturnFalseIfFormIsNotSubmitted(): void
    {
        $this->formProphecy->isValid()->willReturn(true);
        $this->formProphecy->isSubmitted()->willReturn(false);

        $this->formProphecy->setData(Argument::any())->shouldBeCalled();
        $this->formProphecy->handleRequest(Argument::type(Request::class))->shouldBeCalled();

        $result = $this->productFormHandler->process($this->requestProphecy->reveal(), new Product());

        $this->assertFalse($result);
    }
}
