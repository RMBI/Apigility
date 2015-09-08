<?php
/**
 * Created by PhpStorm.
 * User: Ramon
 * Date: 07/09/2015
 * Time: 06:32
 */

namespace CodeOrders\V1\Rest\Users;


use Zend\Db\ResultSet\HydratingResultSet;
use Zend\Db\TableGateway\TableGateway;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Zend\Stdlib\Hydrator\ClassMethods;

class UserRepositoryFactory implements FactoryInterface
{

    /**
     * Create service
     *
     * @param ServiceLocatorInterface $serviceLocator
     * @return mixed
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $adapter = $serviceLocator->get('DbAdapter');

        $usersEntity = new UsersEntity();
        $usersMapper = new UserMapper();

        //new ClassMethods()
        $hydrator = new HydratingResultSet($usersMapper, $usersEntity);

        $tableGateway = new TableGateway('oauth_users',$adapter,null,$hydrator);

        $usersRepository = new UsersRepository($tableGateway);

        return $usersRepository;

    }
}