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
    protected $filename = 'document.pdf';

    /**
     * @var string
     */
    protected $dest = 'I';

    /**
     * @var array
     */
    protected $html2PdfOptions = [];

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

    /**
     * @return array
     */
    public function getHtml2PdfOptions()
    {
        return $this->html2PdfOptions;
    }

    /**
     * It can include all of the following values:
     *  <ul>
     *      <li>
     *          <strong>'orientation'</strong>: page orientation, same as TCPDF
     *      </li>
     *      <li>
     *          <strong>'format'</strong>: The format used for pages, same as TCPDF
     *      </li>
     *      <li>
     *          <strong>'lang'</strong>: Lang : fr, en, it...
     *      </li>
     *      <li>
     *          <strong>'unicode'</strong>:  TRUE means that the input text is unicode (default = true)
     *      </li>
     *      <li>
     *          <strong>'encoding'</strong>: charset encoding; default is UTF-8
     *      </li>
     *      <li>
     *          <strong>'margins'</strong>: Default margins (left, top, right, bottom)
     *      </li>
     *  </ul>
     *
     * @param array $html2PdfOptions
     */
    public function setHtml2PdfOptions(array $html2PdfOptions)
    {
        $this->html2PdfOptions = $html2PdfOptions;
    }
}
