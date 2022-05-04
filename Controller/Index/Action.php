<?php

namespace MagePlaza\HelloWorld\Controller\Index;

use \Mageplaza\HelloWorld\Model\PostFactory;
use \Magento\Framework\App\RequestInterface;

class Action extends \Magento\Framework\App\Action\Action {

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
        // 1. POST request : Get Data From Javascript
        $post = (array) $this->_request->getPostValue();
        //$this->_view->loadLayout();
        //$this->_view->renderLayout();
        try {
            $schema = $this->_postFactory->create();
            $schema->setData($post);
            $schema->save();
            
        } catch (Exception $ex) {
            //return $this->messageManager->addError(__('please try again. Form Not Submit'));
        }
    }

}
