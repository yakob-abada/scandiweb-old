<?php

namespace Entity;

class Product 
{

    protected string $sku;

    protected string $name;

    protected int $price;

    protected string $productType;

    protected int $size;

    protected int $weight;

    protected int $heigth;

    protected int $length;

    protected int $width;

    public function setSku(string $sku): Product
    {
        $this->sku = $sku;
        return $this;
    }

    public function getSku(): string
    {
        return $this->sku;
    }

    public function setName(string $name): Product
    {
        $this->name = $name;
        return $this;
    }

    public function getName(): string
    {
        return $this->name;
    }

	public function getPrice(): int {
		return $this->price;
	}

	public function setPrice(int $price): self {
		$this->price = $price;
		return $this;
	}

	public function getProductType(): string {
		return $this->productType;
	}

	public function setProductType(string $productType): Product 
    {
		$this->productType = $productType;
		return $this;
	}

	public function getSize(): int 
    {
		return $this->size;
	}

	public function setSize(int $size): Product 
    {
		$this->size = $size;
		return $this;
	}

	public function getWeight(): int 
    {
		return $this->weight;
	}

	public function setWeight(int $weight): Product 
    {
		$this->weight = $weight;
		return $this;
	}

	public function getHeigth(): int 
    {
		return $this->heigth;
	}

	public function setHeigth(int $heigth): Product 
    {
		$this->heigth = $heigth;
		return $this;
	}
	
	public function getLength(): int {
		return $this->length;
	}

	public function setLength(int $length): Product 
    {
		$this->length = $length;
		return $this;
	}
}