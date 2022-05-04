<?php

namespace MagePlaza\HelloWorld\Block;

class Display extends \Magento\Framework\View\Element\Template {

    protected $_postFactory;


    public function __construct(
            \Magento\Framework\View\Element\Template\Context $context,
            \Mageplaza\HelloWorld\Model\PostFactory $postFactory
    ) {
        $this->_postFactory = $postFactory;
        parent::__construct($context);
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

}
