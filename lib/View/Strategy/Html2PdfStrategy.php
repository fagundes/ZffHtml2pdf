<?php

namespace Zff\Html2Pdf\View\Strategy;

use Html2Pdf\View\Renderer\Html2PdfRenderer;
use Html2Pdf\View\Model\Html2PdfModel;
use Zend\EventManager\EventManagerInterface;
use Zend\EventManager\ListenerAggregateInterface;
use Zend\View\ViewEvent;

/**
 * 
 */
class Html2PdfStrategy implements ListenerAggregateInterface {

    /**
     * Constructor
     *
     * @param  Html2PdfRenderer $renderer
     */
    public function __construct(Html2PdfRenderer $renderer) {
        $this->renderer = $renderer;
    }

    /**
     * Attach the aggregate to the specified event manager
     *
     * @param  EventManagerInterface $events
     * @param  int $priority
     * @return void
     */
    public function attach(EventManagerInterface $events, $priority = 1) {
        $this->listeners[] = $events->attach(ViewEvent::EVENT_RENDERER, array($this, 'selectRenderer'), $priority);
        $this->listeners[] = $events->attach(ViewEvent::EVENT_RESPONSE, array($this, 'injectResponse'), $priority);
    }

    /**
     * Detect if we should use the Html2PdfRenderer based on model type and/or
     * Accept header
     *
     * @param  ViewEvent $e
     * @return null|Html2PdfRenderer
     */
    public function selectRenderer(ViewEvent $e) {
        $model = $e->getModel();

        if (!$model instanceof Html2PdfModel) {
            // no Html2PdfModel; do nothing
            return;
        }

        // Html2PdfModel found
        return $this->renderer;
    }

    /**
     * Populate the response object from the View
     *
     * Populates the content of the response object from the view rendering
     * results.
     *
     * @param ViewEvent $e
     * @return void
     */
    public function injectResponse(ViewEvent $e) {
        $renderer = $e->getRenderer();
        if ($renderer !== $this->renderer) {
            return;
        }
    }

    public function detach(EventManagerInterface $events) {
        foreach ($this->listeners as $index => $listener) {
            if ($events->detach($listener)) {
                unset($this->listeners[$index]);
            }
        }
    }

}
