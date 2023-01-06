<?php


class ProductController
{
    private ProductsGateway $gateway;
    public function __construct(ProductsGateway $gate)
    {
        $this->gateway = $gate;
    }
    public function processRequest(string $method, ?string $id): void
    {
        switch ($method){
            case "GET":
                echo json_encode($this->gateway->getProducts());
                break;

            case "POST":
                http_response_code(201);
                $data = (array) json_decode(file_get_contents("php://input"), true);
                if ($data["status"] === "delete"){
                    $status = $this->gateway->massDelete($data["ids"]);
                    var_dump($status);
                    break;
                }
                $status = $this->gateway->addProduct($data);
                echo $status;
                break;
            
            // case "DELETE":
            //     $data = (array) json_decode(file_get_contents("php://input"), true);
            //     $status = $this->gateway->massDelete($data["ids"]);
            //     var_dump($status);
            //     break;

            default:
                http_response_code(405);
                break;
        }
    }

}


?>