<?php

namespace MagePlaza\HelloWorld\Controller\Index;

use \Mageplaza\HelloWorld\Model\PostFactory;
use \Magento\Framework\App\RequestInterface;
use Magento\Framework\HTTP\Client\Curl;

class Create extends \Magento\Framework\App\Action\Action {

    protected $_postFactory;
    protected $_curl;
    protected $_request;
    private $jokeEndpoint = "https://api.chucknorris.io/jokes/random";

    public function __construct(\Magento\Framework\App\Action\Context $context,
            PostFactory $postFactory, RequestInterface $request,
            Curl $curl) {
        $this->_postFactory = $postFactory;
        $this->_request = $request;
        $this->_curl = $curl;
        return parent::__construct($context);
    }

    /**
     * Booking action
     *
     * @return void
     */
    public function execute() {
        // 1 Hacemos la peticion curl al api
        $res = array();
        try {
            $this->_curl->get($this->jokeEndpoint);
            $result = json_decode($this->_curl->getBody());
            $this->_postFactory->create()->setData([
                'id' => $result->id,
                'icon_url' => $result->icon_url,
                'url' => $result->url,
                'value' => $result->value,
                'categories' => json_encode($result->categories)
            ])->save();
            $res["status"] = 200;
            $res["data"] = $result;
            $res["operation"] = "success";
            echo json_encode($res);
            //print_r($res);
            //return $res;
        } catch (Exception $ex) {
            throw new Exception($ex);
        }
    }

}
