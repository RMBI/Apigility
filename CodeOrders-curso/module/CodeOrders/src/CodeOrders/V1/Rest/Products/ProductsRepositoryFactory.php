<?php
namespace CodeOrders\V1\Rest\Products;


use Zend\Db\ResultSet\HydratingResultSet;
use Zend\Db\TableGateway\TableGateway;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Zend\Stdlib\Hydrator\ClassMethods;

class ProductsRepositoryFactory implements FactoryInterface
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

        $productsEntity = new ProductsEntity();
        //$productsMapper = new ProductsMapper();
        $hydrator = new HydratingResultSet(new ClassMethods(), $productsEntity);

        $tableGateway = new TableGateway('products',$adapter,null,$hydrator);

        $productsRepository = new ProductsRepository($tableGateway);

        return $productsRepository;

    }
}