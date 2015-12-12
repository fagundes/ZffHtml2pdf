<?php
/**
 * @license http://opensource.org/licenses/MIT MIT
 * @copyright Copyright (c) 2015 Vinicius Fagundes
 */

namespace Zff\Html2Pdf\View\Model;

use Zend\View\Model\ViewModel;

/**
 * ViewModel of the Html2Pdf Module.
 */
class Html2PdfModel extends ViewModel
{
    protected $terminate = true;

    /**
     * @var string
     */
    protected $filename = 'file.pdf';

    /**
     * @var string
     */
    protected $dest = 'I';

    /**
     * Filename of the document.
     *
     * @return string
     */
    public function getFilename()
    {
        return $this->filename;
    }

    /**
     * Destination where to send the document.
     *
     * @return string
     */
    public function getDest()
    {
        return $this->dest;
    }

    /**
     * Set filename of the document.
     *
     * @param string $filename
     */
    public function setFilename($filename)
    {
        $this->filename = $filename;
    }

    /**
     * It can take one of the following values:
     *  <ul>
     *      <li>
     *          I: send the file inline to the browser (default).
     *          The plug-in is used if available. The name given by name is used
     *          when one selects the "Save as" option on the link generating the PDF.
     *      </li>
     *      <li>D: send to the browser and force a file download with the name given by name.</li>
     *      <li>F: save to a local server file with the name given by name.</li>
     *      <li>S: return the document as a string. name is ignored.</li>
     *      <li>FI: equivalent to F + I option</li>
     *      <li>FD: equivalent to F + D option</li>
     *  </ul>
     *
     * @param string $dest Destination where to send the document.
     */
    public function setDest($dest)
    {
        $this->dest = $dest;
    }
}
