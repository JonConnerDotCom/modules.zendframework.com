<?php

namespace User\View\Helper;

use Zend\View\Helper\AbstractHelper;
use Zend\View\Model\ViewModel;
use Zend\ServiceManager\ServiceManagerAwareInterface;
use Zend\ServiceManager\ServiceManager;

class NewUsers extends AbstractHelper implements ServiceManagerAwareInterface
{
    /**
     * $var string template used for view
     */
    protected $viewTemplate;

        /**
     * @var ServiceManager
     */
    protected $serviceManager;

    /**
     * __invoke
     *
     * @access public
     * @return string
     */
    public function __invoke()
    {
        $sm = $this->getServiceManager();

        //need to fetch top lvl ServiceManager
        $sm = $sm->getServiceLocator();
        $mapper = $sm->get('zfcuser_user_mapper');
        $users = $mapper->findAll(16, 'created_at', 'DESC');

        $vm = new ViewModel(array(
            'users' => $users,
        ));
        $vm->setTemplate('user/helper/new-users.phtml');

        return $this->getView()->render($vm);
    }

    /**
     * @param string $viewTemplate
     * @return NewUsers
     */
    public function setViewTemplate($viewTemplate)
    {
        $this->viewTemplate = $viewTemplate;
        return $this;
    }

    /**
     * Retrieve service manager instance
     *
     * @return ServiceManager
     */
    public function getServiceManager()
    {
        return $this->serviceManager;
    }

    /**
     * Set service manager instance
     *
     * @param ServiceManager $locator
     * @return User
     */
    public function setServiceManager(ServiceManager $serviceManager)
    {
        $this->serviceManager = $serviceManager;
        return $this;
    }
}
