<?php

namespace CodeOrders\V1\Rest\Products;

use Zend\Db\TableGateway\TableGatewayInterface;
use Zend\Paginator\Adapter\DbTableGateway;

class ProductsRepository
{

    /**
     * @var TableGatewayInterface
     */
    private $tableGateway;

    public function __construct(TableGatewayInterface $tableGateway){

        $this->tableGateway = $tableGateway;
    }

    public function findAll(){
        $tableGateway = $this->tableGateway;
        $paginatorAdapter = new DbTableGateway($tableGateway);

        return new ProductsCollection($paginatorAdapter);
    }

    public function find($id){
        $resultSet = $this->tableGateway->select(['id' => (int)$id]);

        return $resultSet->current();
    }

    public function insert($data)
    {
        $insertData = [
            'name' => $data->name,
            'description' => $data->description,
            'price' => $data->price
        ];
        return $this->tableGateway->insert($insertData);
    }

    public function update($id, $data)
    {
        $updateData = [
            'name' => $data->name,
            'description' => $data->description,
            'price' => $data->price
        ];
        return $this->tableGateway->update($updateData, ['id' => (int)$id]);
    }

    public function patch($id, $data)
    {
        $updateData = [
            'name' => $data->name,
            'description' => $data->description,
            'price' => $data->price
        ];
        return $this->tableGateway->update($updateData, ['id' => (int)$id]);
    }


    public function delete($id){
        $this->tableGateway->delete(['id' => (int)$id]);
        return $id;

    }

}