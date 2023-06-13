<?php

namespace Tests\Service;

use Controller\ProductController;
use Entity\Product;
use PHPUnit\Framework\TestCase;
use Repository\ProductRepository;
use Service\JsonRequest;
use Service\ProductMapper;
use Service\ProductValidator;
use Service\ProductValidatorFactory;

class ProductControllerTest extends TestCase
{
    public function testGetAction()
    {
        $_REQUEST['sku'] = 'Sku100';

        $result = [
            'sku' => 'SKU100',
            'name' => 'Test',
        ];
        $mockRepository = $this->createMock(ProductRepository::class);
        $mockRepository
            ->expects($this->once())
            ->method('findbySku')->with('Sku100')->willReturn($result);

        $mockFactory = $this->createMock(ProductValidatorFactory::class);

        $mockMapper = $this->createMock(ProductMapper::class);

        $mockJsonReqeust = $this->createMock(JsonRequest::class);

        $sut = new ProductController($mockRepository, $mockFactory, $mockMapper, $mockJsonReqeust);

        $this->expectOutputString(json_encode($result));
        $sut->getAction();
    }

    public function testGetAllAction()
    {
        $result = [
            [
                'sku' => 'SKU100',
                'name' => 'Test',
            ],
            [
                'sku' => 'SKU101',
                'name' => 'Test1',
            ]
        ];
        $mockRepository = $this->createMock(ProductRepository::class);
        $mockRepository
            ->expects($this->once())
            ->method('findAll')->willReturn($result);

        $mockFactory = $this->createMock(ProductValidatorFactory::class);

        $mockMapper = $this->createMock(ProductMapper::class);

        $mockJsonReqeust = $this->createMock(JsonRequest::class);

        $sut = new ProductController($mockRepository, $mockFactory, $mockMapper, $mockJsonReqeust);

        $this->expectOutputString(json_encode($result));
        $sut->getAllAction();
    }

    public function testFailedGetAction()
    {
        $_REQUEST['sku'] = 'Sku100';

        $mockRepository = $this->createMock(ProductRepository::class);
        $mockRepository
            ->expects($this->once())
            ->method('findbySku')->with('Sku100')->willReturn(null);

        $mockFactory = $this->createMock(ProductValidatorFactory::class);

        $mockMapper = $this->createMock(ProductMapper::class);

        $mockJsonReqeust = $this->createMock(JsonRequest::class);

        $sut = new ProductController($mockRepository, $mockFactory, $mockMapper, $mockJsonReqeust);

        $this->expectOutputString(json_encode(['messages' => 'product not found']));
        $sut->getAction();
    }

    public function testSaveAction()
    {
        $product = new Product();
        
        $mockRepository = $this->createMock(ProductRepository::class);
        $mockRepository
            ->expects($this->once())
            ->method('persist')->with($product);

        $mockValidator = $this->createMock(ProductValidator::class);
        $mockValidator
            ->expects($this->once())
            ->method('validate')->with($product)->willReturn(true);

        $mockFactory = $this->createMock(ProductValidatorFactory::class);
        $mockFactory
            ->expects($this->once())
            ->method('create')
            ->willReturn($mockValidator);

        $mockMapper = $this->createMock(ProductMapper::class);
        $mockMapper
            ->expects($this->once())
            ->method('convertToObject')
            ->willReturn($product);

            $mockJsonReqeust = $this->createMock(JsonRequest::class);
            $mockJsonReqeust
                ->expects($this->once())
                ->method('get')
                ->willReturn('{ "sku":"ProductSku100", "name":"ProductName", "price":100, "productType":"dvd", "size":700, "weight":null, "heigth":null, "length":null, "width":null }');

        $sut = new ProductController($mockRepository, $mockFactory, $mockMapper, $mockJsonReqeust);

        $this->expectOutputString(json_encode(['message' => 'created successfully']));
        $sut->saveAction();
    }

    public function testFailedValidationSaveAction()
    {
        $product = new Product();
        
        $mockRepository = $this->createMock(ProductRepository::class);

        $mockValidator = $this->createMock(ProductValidator::class);

        $mockValidator
            ->expects($this->once())
            ->method('validate')->with($product)->willReturn(false);

        $mockValidator
            ->expects($this->once())
            ->method('getErrorMessages')->willReturn(['Something went wrong']);

        $mockFactory = $this->createMock(ProductValidatorFactory::class);
        $mockFactory
            ->expects($this->once())
            ->method('create')
            ->willReturn($mockValidator);

        $mockMapper = $this->createMock(ProductMapper::class);
        $mockMapper
            ->expects($this->once())
            ->method('convertToObject')
            ->willReturn($product);

        $mockJsonReqeust = $this->createMock(JsonRequest::class);
        $mockJsonReqeust
        ->expects($this->once())
        ->method('get')
        ->willReturn('{ "sku":"ProductSku100"}');


        $sut = new ProductController($mockRepository, $mockFactory, $mockMapper, $mockJsonReqeust);

        $this->expectOutputString(json_encode(['messages' => ['Something went wrong']]));
        $sut->saveAction();
    }

    public function testDeleteAction()
    {
        $_REQUEST['sku'] = 'Sku100';

        $mockRepository = $this->createMock(ProductRepository::class);
        $mockRepository
            ->expects($this->once())
            ->method('deleteBySku')->with('Sku100');

        $mockFactory = $this->createMock(ProductValidatorFactory::class);

        $mockMapper = $this->createMock(ProductMapper::class);

        $mockJsonReqeust = $this->createMock(JsonRequest::class);

        $sut = new ProductController($mockRepository, $mockFactory, $mockMapper, $mockJsonReqeust);

        $this->expectOutputString(json_encode(['message' => 'deleted successfully']));
        $sut->deleteAction();
    }
}