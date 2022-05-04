<?php
namespace MagePlaza\HelloWorld\Api;
 
interface PostManagementInterface {


	/**
        * Get Post
        *
        * @return string
        */
	
	public function getPost();
        
        /**
        * Get Customers
        *
        * @return string
        */
        public function getCustomers();
        
        /**
        * Get Post By Id
        *
        * @param int $param
        * @return int|string|bool|float Scalar or array of scalars 
        */
        public function getPostById($param);
}
