<?php

namespace MagePlaza\HelloWorld\Model;

use \Mageplaza\HelloWorld\Model\PostFactory;
use \Magento\Customer\Model\Customer;
use \MagePlaza\HelloWorld\Api\PostManagementInterface;

class PostManagement implements PostManagementInterface {

    protected $_customers;
    protected $_postFactory;

    public function __construct(PostFactory $postFactory, Customer $customers) {
        $this->_customer = $customers;
        $this->_postFactory = $postFactory;
    }

    /**
     * {@inheritdoc}
     */
    public function getPost() {
        $post = $this->_postFactory->create();
        //return json_encode($post->getCollection());
        $success = array();
        $success['status'] = true;
        $success['data'] = $post->getCollection()
                ->load();
        return json_encode($success);
    }

    public function getCustomers() {
        $success = array();
        $success['status'] = true;
        $success['data'] = $this->_customer->getCollection()->addAttributeToSelect("*")->load();
        return json_encode($success);
    }

    public function getPostById($param) {
        return $this->_post->create()
                        ->getCollection()
                        ->addAttributeToSelect($param)
                        ->load();
    }
    
    

}
