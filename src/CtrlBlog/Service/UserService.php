<?php

namespace CtrlBlog\Service;

use CtrlBlog\Domain;
use CtrlBlog\Domain\Article;
use Ctrl\Form\Form;
use Zend\InputFilter\Factory as FilterFactory;
use Zend\InputFilter\InputFilter;
use Ctrl\Form\Element\Text as TextInput;
use Ctrl\Form\Element\Textarea as TextareaInput;
use Ctrl\Form\Element\Select as SelectInput;
use CtrlAuth\Domain\User as AuthUser;

class UserService extends \Ctrl\Service\AbstractDomainModelService
{
    protected $entity = 'CtrlBlog\Domain\User';

    /**
     * @param AuthUser $authUser
     * @return PersistableModel
     * @throws Exception
     */
    public function getByAuthUser(AuthUser $authUser)
    {
        $entities = $this->getEntityManager()
            ->createQuery('SELECT e FROM '.$this->entity.' e JOIN e.authUser u WHERE u.id = :id')
            ->setParameter('id', $authUser->getId())
            ->getResult();
        if (!count($entities)) {
            throw new Exception($this->entity.' not found with for authUser with id: '.$authUser->getId());
        }
        return $entities[0];
    }
}
