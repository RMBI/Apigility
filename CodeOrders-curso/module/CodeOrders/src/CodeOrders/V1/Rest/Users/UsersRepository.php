<?php
/**
 * Created by PhpStorm.
 * User: Ramon
 * Date: 07/09/2015
 * Time: 06:26
 */

namespace CodeOrders\V1\Rest\Users;

use Zend\Db\TableGateway\TableGatewayInterface;
use Zend\Paginator\Adapter\DbTableGateway;


class UsersRepository
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

        return new UsersCollection($paginatorAdapter);
    }

    public function find($id){
        $resultSet = $this->tableGateway->select(['id' => (int)$id]);

        return $resultSet->current();
    }

    /**
     * @param $data
     * @return mixed
     */
    public function insert($data)
    {

        $insertData = $this->setTratarData($data);
        return $this->tableGateway->insert($insertData);
    }

    public function update($id, $data)
    {
         $updateData = $this->setTratarData($data);
         return $this->tableGateway->update($updateData, ['id' => (int)$id]);
    }

    public function patch($id, $data)
    {
        $updateData = $this->setTratarData($data);
        return $this->tableGateway->update($updateData, ['id' => (int)$id]);
    }


    public function delete($id){
        if($this->find($id)){
            return $this->tableGateway->delete(['id' => (int)$id]);
        }
        return false;
    }

    /**
     * @param $password
     * @return Bcrypt
     */
    public function BcryptPassword($password){
        return md5($password);
    }

    public function setTratarData($data){
        return [
            'username' => $data->username,
            'password' => $this->BcryptPassword($data->password),
            'first_name' => $data->first_name,
            'last_name' => $data->username,
            'role' => $data->role
        ];
    }


}