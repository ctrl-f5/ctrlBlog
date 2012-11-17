<?php

namespace Ctrl\Blog;

return array(
    'router' => array(
        'routes' => array(
            'default' => array(
                'type'    => 'Segment',
                'may_terminate' => true,
                'options' => array(
                    'route'    => '/[:controller]/[:action]',
                    'constraints' => array(
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                    ),
                    'defaults' => array(
                        '__NAMESPACE__' => 'CtrlBlog\Controller',
                        'controller'    => 'index',
                        'action'        => 'index',
                        'id'            => false
                    ),
                ),
                'child_routes' => array(
                    'id' => array(
                        'type'    => 'Segment',
                        'may_terminate' => true,
                        'options' => array(
                            'route'    => '/[:id]',
                            'constraints' => array(
                                'id'     => '[0-9]+',
                            ),
                        ),
                        'child_routes' => array(
                            'query' => array(
                                'type'    => 'Query',
                                'may_terminate' => true,
                            ),
                        ),
                    ),
                    'query' => array(
                        'type'    => 'Query',
                        'may_terminate' => true,
                    ),
                ),
            ),
            'home' => array(
                'type'    => 'Segment',
                'may_terminate' => true,
                'options' => array(
                    'route'    => '/',
                    'defaults' => array(
                        '__NAMESPACE__' => 'Ctrl\Blog\Controller',
                        'controller'    => 'Index',
                        'action'        => 'index',
                    ),
                ),
            ),
        ),
    ),
    'controllers' => array(
        'invokables' => array(
            'Ctrl\Blog\Controller\Index' => 'Ctrl\Blog\Controller\IndexController',
            'Ctrl\Blog\Controller\Article' => 'Ctrl\Blog\Controller\ArticleController',
        ),
    ),
    'domain_services' => array(
        'invokables' => array(
            'Article' => 'Ctrl\Blog\Service\ArticleService',
            'User' => 'Ctrl\Blog\Service\UserService',
        ),
    ),
    'service_manager' => array(
        'factories' => array(
            //'PropertyTypeLoader'        => 'DevCtrl\Domain\Item\Property\Type\TypeLoaderFactory',
        ),
    ),
    'view_manager' => array(
        'display_not_found_reason' => true,
        'display_exceptions'       => true,
        'doctype'                  => 'HTML5',
        'not_found_template'       => 'error/404',
        'exception_template'       => 'error/index',
        'template_map' => array(
            'layout/layout'     => __DIR__ . '/../view/layout/layout.phtml',
            'error/404'         => __DIR__ . '/../view/error/404.phtml',
            'error/index'         => __DIR__ . '/../view/error/index.phtml',
            'error/index'         => __DIR__ . '/../view/error/index.phtml',
        ),
        'template_path_stack' => array(
            __DIR__ . '/../view',
        ),
    ),
    'acl' => array(
        'resources' => array(
            //'BlogResources' => 'Ctrl\Blog\Permissions\ModuleResources'
        )
    ),
    'doctrine' => array(
        'driver' => array(
            'ctrl-blog_driver' => array(
                'class' => 'Doctrine\ORM\Mapping\Driver\XmlDriver',
                    'cache' => 'array',
                    'paths' => array(__DIR__.'/../src/CtrlBlog/Domain', __DIR__.'/entities')
            ),
            'orm_default' => array(
                'drivers' => array(
                    'Ctrl\Blog\Domain' => 'ctrl-blog_driver'
                )
            )
        ),
    )

);
