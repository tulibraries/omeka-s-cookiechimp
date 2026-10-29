<?php

namespace CookieChimp;

use Laminas\EventManager\Event;
use Laminas\EventManager\SharedEventManagerInterface;
use Omeka\Module\AbstractModule;

class Module extends AbstractModule
{
    public function addCookieChimp(Event $event)
    {
        $services = $this->getServiceLocator();
        $status = $services->get('Omeka\Status');

        if (!$status->isSiteRequest() && $status->getRouteMatch()?->getMatchedRouteName() !== 'top') {
            return;
        }

        $view = $event->getTarget();
        $view->headScript()->prependFile('https://cookiechimp.com/widget/a2ZtgNB.js');
    }

    public function attachListeners(SharedEventManagerInterface $sharedEventManager)
    {
        $sharedEventManager->attach('*', 'view.layout', [$this, 'addCookieChimp']);
    }
}
