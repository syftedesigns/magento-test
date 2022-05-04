<?php

namespace MagePlaza\HelloWorld\Controller\Index;

class Display extends \Magento\Framework\App\Action\Action {

    protected $_pageFactory;
    protected $_postFactory;


    public function __construct(
            \Magento\Framework\App\Action\Context $context,
            \Magento\Framework\View\Result\PageFactory $pageFactory,
            \Mageplaza\HelloWorld\Model\PostFactory $postFactory
            ) {
        $this->_pageFactory = $pageFactory;
        $this->_postFactory = $postFactory;
        return parent::__construct($context);
    }

    public function getJokeCollection() {
        $post = $this->_postFactory->create();
        return $post->getCollection();
    }
     
    public function getJokeDeleteActionUrl() {

        return "/helloworld/index/delete";
    }

    public function getJokeActionUrl() {

        return "/helloworld/index/create";
    }

    public function execute() {
        return $this->_pageFactory->create();
    }

}
