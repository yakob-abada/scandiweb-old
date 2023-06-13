<?php

namespace Controller;

use Repository\ProductRepository;
use Service\JsonRequest;
use Service\JsonResponse;
use Service\ProductMapper;
use Service\ProductValidatorFactory;

class ProductController 
{
    /**
     * @var ProductRepository
     */
    private $repository;
    /**
     * @var ProductValidatorFactory
     */
    private $productValidatorFactory;
    /**
     * @var ProductMapper
     */
    private  $productMapper;
    /**
     * @var JsonRequest
     */
    private $jsonRequest;


    public function __construct(
        ProductRepository $repository,
        ProductValidatorFactory $productValidatorFactory,
        ProductMapper $productMapper,
        JsonRequest $jsonRequest
    ) {
        $this->repository = $repository;
        $this->productValidatorFactory = $productValidatorFactory;
        $this->productMapper = $productMapper;
        $this->jsonRequest = $jsonRequest;
    }

    public function getAction() 
    {
        $sku = $_REQUEST['sku'] ?? '';
        $result = $this->repository->findbySku($sku);

        if (null === $result) {
            return JsonResponse::generate(['messages' => 'product not found'], 404);
        }

        return JsonResponse::generate($result);
    }

    public function getAllAction()
    {
        $result = $this->repository->findAll();

        return JsonResponse::generate($result);
    }

    public function saveAction()
    {
        $json = $this->jsonRequest->get();
        $data = json_decode($json, true);

        $product = $this->productMapper->convertToObject($data);
        $validator = $this->productValidatorFactory->create($product);
        $isValid = $validator->validate($product);

        if (!$isValid) {
            return JsonResponse::generate(['messages' => $validator->getErrorMessages()], 400);
        }

        $this->repository->persist($product);
        return JsonResponse::generate(['message' => 'created successfully'], 201);
    }
	
	public function deleteAction()
	{
        $sku = $_REQUEST['sku'] ?? '';
        $result = $this->repository->deleteBySku($sku);
		
		return JsonResponse::generate(['message' => 'deleted successfully'], 200);
	}
}
