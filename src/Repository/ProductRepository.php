<?php

namespace Repository;

use Entity\Product;

class ProductRepository extends AbstractRepository
{
    private string $_tableName = 'product';

    public function persist(Product $product): void 
    {
        $query = sprintf(
            "insert into %s (sku, name, price, product_type, size, weight, height, length, width) values ('%s', '%s', %s, '%s', %s, %s, %s, %s, %s) ",
            $this->_tableName,
            $this->prepareValue($product->getSku()),
            $this->prepareValue($product->getName()),
            $this->prepareValue($product->getPrice()),
            $this->prepareValue($product->getProductType()),
            $this->prepareValue($product->getSize()),
            $this->prepareValue($product->getWeight()),
            $this->prepareValue($product->getHeight()),
            $this->prepareValue($product->getLength()),
            $this->prepareValue($product->getWeight()),
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
            $this->prepareValue($sku),
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

    public function findAll(): array
    {
        $query = sprintf(
            "SELECT * FROM %s",
            $this->_tableName
        );

        $result = $this->mysqli->query($query);
        $rows = $result->fetch_all(MYSQLI_ASSOC);
        $result->free_result();
          
        $this->mysqli->close();

        return $rows;
    }

    private function prepareValue($value)
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