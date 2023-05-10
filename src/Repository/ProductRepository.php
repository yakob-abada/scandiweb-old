<?php

namespace Repository;

use Entity\Product;

class ProductRepository extends AbstractRepository
{
    private string $_tableName = 'product';

    /**
     * Save shorten url
     *
     * @return array
     */    
    public function persist(Product $product): void 
    {
        $query = sprintf(
            "insert into %s (sky, name, price, product_type, size, weight, height, length, width) values ('%s', '%s', %s, '%s', %s, %s, %s, %s, %s) ",
            $this->_tableName,
            $this->mysqli->real_escape_string($product->getSku()),
            $this->mysqli->real_escape_string($product->getName()),
            $this->mysqli->real_escape_string($product->getPrice()),
            $this->mysqli->real_escape_string($product->getProductType()),
            $this->mysqli->real_escape_string($product->getSize()),
            $this->mysqli->real_escape_string($product->getWeight()),
            $this->mysqli->real_escape_string($product->getHeigth()),
            $this->mysqli->real_escape_string($product->getLength()),
            $this->mysqli->real_escape_string($product->getWeight()),
        );

        //@todo: Needed to properly handled.
        if (!$this->mysqli->query($query)) {
            printf("%d Row inserted.\n", $this->mysqli->affected_rows);
          }
          
          $this->mysqli->close();
    }

    public function findbySku(string $sku): ?array
    {
        $query = sprintf(
            "SELECT * FROM %s WHERE sku = '%s'",
            $this->_tableName,
            $this->mysqli->real_escape_string($sku),
        );

        $this->mysqli->real_query($query);

        if ($this->mysqli->field_count) {
            $result = $this->mysqli->use_result();
            $row = $result->fetch_assoc();
            $result->free_result();
          }
          
          $this->mysqli->close();

        return $row;
    }
}