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
            "insert into %s (sku, name, price, product_type, size, weight, height, length, width) values ('%s', '%s', %s, '%s', %s, %s, %s, %s, %s) ",
            $this->_tableName,
            $this->escapeString($product->getSku()),
            $this->escapeString($product->getName()),
            $this->escapeString($product->getPrice()),
            $this->escapeString($product->getProductType()),
            $this->escapeString($product->getSize()),
            $this->escapeString($product->getWeight()),
            $this->escapeString($product->getHeight()),
            $this->escapeString($product->getLength()),
            $this->escapeString($product->getWeight()),
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
            $this->escapeString($sku),
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

    private function escapeString($value)
    {
        if (is_string($value)) {
            return $this->mysqli->real_escape_string($value);
        }

        if (null === $value) {
            return 'NULL';
        }

        return $value;
    }
}