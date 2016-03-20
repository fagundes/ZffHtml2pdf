<?php
/**
 * @license http://opensource.org/licenses/MIT MIT
 * @copyright Copyright (c) 2015 Vinicius Fagundes
 */

namespace ZffTest\Html2Pdf\View\Strategy;

use PHPUnit_Framework_TestCase as TestCase;
use Zend\EventManager\EventManager;
use Zend\Http\Request as HttpRequest;
use Zend\Http\Response as HttpResponse;
use Zend\View\Model\ViewModel;
use Zend\View\ViewEvent;
use Zend\EventManager\Test\EventListenerIntrospectionTrait;
use Zff\Html2Pdf\View\Model\Html2PdfModel;
use Zff\Html2Pdf\View\Renderer\Html2PdfRenderer;
use Zff\Html2Pdf\View\Strategy\Html2PdfStrategy;

/**
 * @author Vinicius Fagundes <mvlacerda@gmail.com>
 */
class Html2PdfStrategyTest extends TestCase
{
    use EventListenerIntrospectionTrait;

    /**
     * @var Html2PdfRenderer
     */
    protected $renderer;
    /**
     * @var Html2PdfStrategy
     */
    protected $strategy;
    /**
     * @var ViewEvent
     */
    protected $event;
    /**
     * @var HttpResponse
     */
    protected $response;

    public function setUp()
    {
        $this->renderer = new Html2PdfRenderer;
        $this->strategy = new Html2PdfStrategy($this->renderer);
        $this->event = new ViewEvent();
        $this->response = new HttpResponse();
    }

    public function testHtml2PdfModelSelectsHtml2PdfStrategy()
    {
        $this->event->setModel(new Html2PdfModel());
        $result = $this->strategy->selectRenderer($this->event);
        $this->assertSame($this->renderer, $result);
    }

    public function testLackOfHtml2PdfModelDoesNotSelectHtml2PdfStrategy()
    {
        $result = $this->strategy->selectRenderer($this->event);
        $this->assertNotSame($this->renderer, $result);
        $this->assertNull($result);
    }

    protected function assertResponseNotInjected()
    {
        $content = $this->response->getContent();
        $headers = $this->response->getHeaders();
        $this->assertEmpty($content);
        $this->assertFalse($headers->has('content-type'));
    }

    public function testNonMatchingRendererDoesNotInjectResponse()
    {
        $this->event->setResponse($this->response);
        // test empty renderer
        $this->strategy->injectResponse($this->event);
        $this->assertResponseNotInjected();
        // test non-matching renderer
        $renderer = new Html2PdfRenderer();
        $this->event->setRenderer($renderer);
        $this->strategy->injectResponse($this->event);
        $this->assertResponseNotInjected();
    }

    public function testNonStringResultDoesNotInjectResponse()
    {
        $this->event->setResponse($this->response);
        $this->event->setRenderer($this->renderer);
        $this->event->setResult($this->response);
        $this->strategy->injectResponse($this->event);
        $this->assertResponseNotInjected();
    }

    public function testReturnsNullWhenCannotSelectRenderer()
    {
        $model = new ViewModel();
        $request = new HttpRequest();
        $this->event->setModel($model);
        $this->event->setRequest($request);
        $this->assertNull($this->strategy->selectRenderer($this->event));
    }

    public function testAttachesListenersAtExpectedPriorities()
    {
        $events = new EventManager();
        $this->strategy->attach($events);
        foreach (['renderer' => 'selectRenderer', 'response' => 'injectResponse'] as $event => $method) {
            $listeners = $this->getListenersForEvent($event, $events, true);
            $expectedListener = [$this->strategy, $method];
            $expectedPriority = 1;
            $found = false;
            foreach ($listeners as $priority => $listener) {
                if ($listener === $expectedListener
                    && $priority === $expectedPriority
                ) {
                    $found = true;
                    break;
                }
            }
            $this->assertTrue($found, 'Listener not found');
        }
    }

    public function testCanAttachListenersAtSpecifiedPriority()
    {
        $events = new EventManager();
        $this->strategy->attach($events, 1000);
        foreach (['renderer' => 'selectRenderer', 'response' => 'injectResponse'] as $event => $method) {
            $listeners = $this->getListenersForEvent($event, $events, true);
            $expectedListener = [$this->strategy, $method];
            $expectedPriority = 1000;
            $found = false;
            foreach ($listeners as $priority => $listener) {
                if ($listener === $expectedListener
                    && $priority === $expectedPriority
                ) {
                    $found = true;
                    break;
                }
            }
            $this->assertTrue($found, 'Listener not found');
        }
    }

    public function testDetachesListeners()
    {
        $events = new EventManager();
        $this->strategy->attach($events, 100);
        $listeners = iterator_to_array($this->getListenersForEvent('renderer', $events));
        $this->assertCount(1, $listeners);
        $listeners = iterator_to_array($this->getListenersForEvent('response', $events));
        $this->assertCount(1, $listeners);
        $this->strategy->detach($events);
        $listeners = iterator_to_array($this->getListenersForEvent('renderer', $events));
        $this->assertCount(0, $listeners);
        $listeners = iterator_to_array($this->getListenersForEvent('response', $events));
        $this->assertCount(0, $listeners);
    }
}
