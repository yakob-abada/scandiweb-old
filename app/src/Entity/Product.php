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

	/**
	 * @var string | null
	 */
    protected  $sku = null;

	/**
	 * @var string | null
	 */
    protected $name = null;

	/**
	 * @var int | null
	 */
    protected $price = null;

	/**
	 * @var string | null
	 */	
    protected $productType = null; 

	/**
	 * @var int | null
	 */	
    protected $size = null;

	/**
	 * @var int | null
	 */	
    protected $weight = null;

	/**
	 * @var int | null
	 */		
	protected $height = null;

	/**
	 * @var int | null
	 */		
    protected $length = null;

	/**
	 * @var int | null
	 */		
    protected $width = null;

    public function setSku($sku): Product
    {
        $this->sku = $sku;
        return $this;
    }

    public function getSku()
    {
        return $this->sku;
    }

    public function setName($name): Product
    {
        $this->name = $name;
        return $this;
    }

    public function getName()
    {
        return $this->name;
    }

	public function getPrice()
	{
		return $this->price;
	}

	public function setPrice($price): self 
	{
		$this->price = $price;
		return $this;
	}

	public function getProductType()
	{
		return $this->productType;
	}

	public function setProductType($productType): Product 
    {
		$this->productType = $productType;
		return $this;
	}

	public function getSize()
    {
		return $this->size;
	}

	public function setSize($size): Product 
    {
		$this->size = $size;
		return $this;
	}

	public function getWeight()
    {
		return $this->weight;
	}

	public function setWeight($weight): Product 
    {
		$this->weight = $weight;
		return $this;
	}

	public function getHeight()
    {
		return $this->height;
	}

	public function setHeight($height): Product 
    {
		$this->height = $height;
		return $this;
	}
	
	public function getLength()
	{
		return $this->length;
	}

	public function setLength($length): Product 
    {
		$this->length = $length;
		return $this;
	}

	public function getWidth()
	{
		return $this->width;
	}

	public function setWidth($width): Product 
    {
		$this->width = $width;
		return $this;
	}
}