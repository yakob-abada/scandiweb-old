<?php

namespace Entity;

class Product 
{
	const PRODUCT_TYPE_BOOK = 'book';
	const PRODUCT_TYPE_DVD = 'dvd';
	const PRODUCT_TYPE_FURNITURE = 'furniture';

	const PRODUCT_TYPE_VALUES = [
		Product::PRODUCT_TYPE_BOOK,
		Product::PRODUCT_TYPE_DVD,
		Product::PRODUCT_TYPE_FURNITURE
	];

    protected string | null $sku = null;

    protected string | null $name = null;

    protected int | null $price = null;

    protected string | null $productType = null; 

    protected int | null $size = null;

    protected int | null $weight = null;

    protected int | null $height = null;

    protected int | null $length = null;

    protected int | null $width = null;

    public function setSku(string $sku): Product
    {
        $this->sku = $sku;
        return $this;
    }

    public function getSku(): string | null
    {
        return $this->sku;
    }

    public function setName(string $name): Product
    {
        $this->name = $name;
        return $this;
    }

    public function getName(): string | null
    {
        return $this->name;
    }

	public function getPrice(): int | null
	{
		return $this->price;
	}

	public function setPrice(int $price): self 
	{
		$this->price = $price;
		return $this;
	}

	public function getProductType(): string | null
	{
		return $this->productType;
	}

	public function setProductType(string $productType): Product 
    {
		$this->productType = $productType;
		return $this;
	}

	public function getSize(): int | null 
    {
		return $this->size;
	}

	public function setSize(int $size): Product 
    {
		$this->size = $size;
		return $this;
	}

	public function getWeight(): int | null 
    {
		return $this->weight;
	}

	public function setWeight(int $weight): Product 
    {
		$this->weight = $weight;
		return $this;
	}

	public function getHeight(): int | null 
    {
		return $this->height;
	}

	public function setHeight(int $height): Product 
    {
		$this->height = $height;
		return $this;
	}
	
	public function getLength(): int | null 
	{
		return $this->length;
	}

	public function setLength(int $length): Product 
    {
		$this->length = $length;
		return $this;
	}

	public function getWidth(): int | null 
	{
		return $this->width;
	}

	public function setWidth(int $width): Product 
    {
		$this->width = $width;
		return $this;
	}
}