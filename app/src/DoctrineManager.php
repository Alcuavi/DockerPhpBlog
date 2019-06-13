<?php
namespace App;
use DI\Container;
use App\config\Config;
use Doctrine\ORM\Tools\Setup;
use Doctrine\ORM\EntityManager;
use Doctrine\Common\Annotations\AnnotationRegistry;
use Kint;

class DoctrineManager{

    private $container;
    public $em;

    public function __construct(Container $container)
    {
        $this->container = $container;
        $dbconfig= Config::getDB();
        $paths=[
            dirname(__DIR__).'/models/entities',
            dirname(__DIR__).'/models/repositories'
        ];
        $isDevMode=true;
        $config=
        Setup::createAnnotationMetadataConfiguration($paths,$isDevMode,null,null,false);
        AnnotationRegistry::registerLoader('class_exists');
        $this->em=EntityManager::create($dbconfig, $config);

    }

}