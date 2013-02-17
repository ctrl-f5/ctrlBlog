<?php

namespace CtrlBlog\Permissions;

class Resources extends \Ctrl\Permissions\Resources
{
    /**
     * Sets
     */
    const SET_ACTIONS   = 'actions.CtrlBlog';

    public function getSets()
    {
        return array_merge(
            parent::getSets(),
            array(
                self::SET_ACTIONS,
            )
        );
    }

    public function getResources($set = null)
    {
        $resources = array_merge(
            parent::getResources(),
            array(
                self::SET_ROUTES => array(
                    'CtrlBlog\Controller' => array(
                        'Article',
                    ),
                ),
                self::SET_ACTIONS => array(
                    //none
                ),
                self::SET_MENU => array(
                    'CtrlBlog' => array(
                        'Article' => array(
                            'manage'
                        ),
                    )
                ),
            )
        );

        $resources = $this->assertResources($resources);

        return $resources;
    }
}
