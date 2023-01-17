<?php

class ProductsGateway
{
    public PDO $connection;
    
    public function __construct(Database $db)
    {
        $this->connection = $db->connect();
    }

    public function getProducts(): array
    {
        $sqlQuery = "SELECT * FROM `products`";

        $statement = $this->connection->query($sqlQuery);

        $data = [];

        while ($row = $statement->fetch(PDO::FETCH_ASSOC)){
            $data[] = $row;
        }

        return $data;
    }

    public function addProduct(array $data)
    {
        $sqlQuery = "INSERT INTO `products` (sku, name, price, description)
                     VALUES (:sku, :name, :price, :description)"; //placeholders to avoid injection
        
        $statement = $this->connection->prepare($sqlQuery);

        $statement->bindValue(":sku", $data['sku'], PDO::PARAM_STR);
        $statement->bindValue(":name", $data['name'], PDO::PARAM_STR);
        $statement->bindValue(":price", $data['price'], PDO::PARAM_STR);
        $statement->bindValue(":description", $data['description'], PDO::PARAM_STR);

        $statement->execute();

        return "Product {$data['sku']} Added Successfully";
    }

    public function massDelete(array $ids)
    {
        $qMarks = str_repeat('?,', count($ids) - 1) . '?';
        $sqlQuery = "DELETE FROM `products` WHERE sku IN ($qMarks)";
        $statement = $this->connection->prepare($sqlQuery);

        foreach($ids as $k => $id){
            $statement->bindValue(($k+1), $id);
        }
        
        $statement->execute();

        return "Deleted Successfully";
    }

}

?>