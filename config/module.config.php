<?php

namespace CtrlBlog;

return array(
    'controllers' => array(
        'invokables' => array(
            'CtrlBlog\Controller\Index' => 'CtrlBlog\Controller\IndexController',
            'CtrlBlog\Controller\Article' => 'CtrlBlog\Controller\ArticleController',
        ),
    ),
    'domain_services' => array(
        'invokables' => array(
            'CtrlBlogArticle' => 'CtrlBlog\Service\ArticleService',
            'CtrlBlogUser' => 'CtrlBlog\Service\UserService',
        ),
    ),
    'view_manager' => array(
        'display_not_found_reason' => true,
        'display_exceptions'       => true,
        'doctype'                  => 'HTML5',
        'template_path_stack' => array(
            __DIR__ . '/../view',
        ),
    ),
    'acl' => array(
        'resources' => array(
            'CtrlBlogResources' => 'CtrlBlog\Permissions\Resources'
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
                    'CtrlBlog\Domain' => 'ctrl-blog_driver'
                )
            )
        ),
    ),
    'navigation' => array(
        'ctrl_blog' => array(
            array(
                'label' => 'articles',
                'route' => 'ctrl_blog/default',
                'type' => 'Ctrl\Navigation\Page\Mvc',
                'resource' => 'menu.CtrlBlog',
            ),
            array(
                'label' => 'manage articles',
                'route' => 'ctrl_blog/default',
                'type' => 'Ctrl\Navigation\Page\Mvc',
                'resource' => 'menu.CtrlBlog.Article.manage',
                'params' => array(
                    'controller' => 'article'
                ),
            ),
        )
    )
);
