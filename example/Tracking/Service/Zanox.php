<?php
/**
 * Class Tracking_Service_Zanox
 */
class Tracking_Service_Zanox extends Tracking_Service_ServiceAbstract
{
    protected $_map = array(
        'CustomerID' => 'email'
    );
    protected $_javaScript = '';
    protected $_noScript = '';
    protected $_dbValues = array();

    /**
     * @param null|string $page
     * @return string
     */
    public function generate($page = null) {
        $this->_javaScript = '';
        $this->_noScript = '';
        $protocol = 'https://ad.zanox.com/';
        $this->_dbValues = $this->_getValuesFromDb($page);
        $this->_javaScript .= '<script type="text/javascript" src="' . $protocol;
        foreach ($this->_getNeededParamsFromDb($page) as $parameter) {
            $this->_addToString($this->_getTrackingData($parameter));
        }
        $this->_cleanUpStrings();
        return $this->_generateString();
    }

    /**
     * @param string $parameter
     * @return string
     */
    protected function _getTrackingData($parameter) {
        switch($parameter) {
            case 'route':
                $value = array_key_exists('route', $this->_dbValues) ? $this->_dbValues['route'][0] . '/?' : '';
                break;
            case 'ZanoxId':
                $value = array_key_exists('ZanoxId', $this->_dbValues) ? $this->_dbValues['ZanoxId'][0] . '&'  : '';
                break;
            case 'mode':
                $value = 'mode=[[1]]&';
                break;
            case 'CID':
                $value = 'CID=[[';
                $value .= array_key_exists('CID', $this->_dbValues) ? $this->_dbValues['CID'][0] : '';
                $value .= ']]&';
                break;
            case 'ReviewNote':
                $value = 'ReviewNote[[';
                $value .= $this->_getData()->getReviewNote($this->getAdditionalParameters()->zanoxReview);
                $value .= ']]&';
                break;
            default:
                $getter = 'get' . ucfirst($this->_map[$parameter]);
                $value = $parameter . '=[[' . $this->_getData()->$getter() . ']]&';
                break;
        }
        return (string)$value;
    }

    /**
     * @param string $string
     * @return Tracking_Service_Zanox
     */
    protected function _addToString($string)
    {
        $this->_javaScript .= $string;
        $this->_noScript .= $string;
        return $this;
    }

    /**
     * @return Tracking_Service_zanox
     */
    protected function _cleanUpStrings()
    {
        $this->_javaScript = substr($this->_javaScript, 0, -1);
        $this->_noScript = substr($this->_noScript, 0, -1);
        return $this;
    }

    /**
     * @return string
     */
    protected function _generateString()
    {
        $zanoxString = '<!-- BEGINN des zanox-affiliate HTML-Code -->' . PHP_EOL
                . '<!-- (Der HTML-Code darf im Sinne der einwandfreien Funktionalität nicht verändert werden!) -->'
                . PHP_EOL
                . $this->_javaScript
                . '"></script>'
                .PHP_EOL
                . '<noscript><img src="'
                . $this->_noScript
                . '" width="1" height="1" /></noscript>'
                . PHP_EOL
                . '<!-- ENDE des zanox-affiliate HTML-Code -->';
        return $zanoxString;
    }
}