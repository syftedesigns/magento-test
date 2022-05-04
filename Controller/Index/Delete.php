<?php

namespace MagePlaza\HelloWorld\Controller\Index;

use \Mageplaza\HelloWorld\Model\PostFactory;
use \Magento\Framework\App\RequestInterface;

class Delete extends \Magento\Framework\App\Action\Action {

    protected $_postFactory;
    protected $_request;

    public function __construct(\Magento\Framework\App\Action\Context $context,
            PostFactory $postFactory, RequestInterface $request) {
        $this->_postFactory = $postFactory;
        $this->_request = $request;
        return parent::__construct($context);
    }

    /**
     * Booking action
     *
     * @return void
     */
    public function execute() {
        $res = array();
        try {
            $parameters = (array) $this->_request->getParams();
            if ($parameters) {
                $schema = $this->_postFactory->create()->load($parameters["joke_id"]);
                $schema->delete();
                $res["status"] = 200;
                $res["operation"] = "success";
                echo json_encode($res);
            } else {
                throw new Exception("Parameters not found");
            }
        } catch (Exception $ex) {
            //return $this->messageManager->addError(__('please try again. Form Not Submit'));
            throw new Exception("Parameters not found");
        }
    }

}
