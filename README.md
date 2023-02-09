# README #

A modified and optimized Slim4 framework for building API.   
# Folder Structure #
📦slim4     
 ┣ 📂src    
 ┃ ┣ 📂app  
 ┃ ┃ ┣ 📜App.php    
 ┃ ┃ ┗ 📜Model.php  
 ┃ ┣ 📂constant     
 ┃ ┃ ┗ 📜Constant.php   
 ┃ ┣ 📂controller   
 ┃ ┃ ┗ 📜DemoController.php     
 ┃ ┣ 📂helper   
 ┃ ┃ ┣ 📜CryptUtilService.php   
 ┃ ┃ ┣ 📜DBManager.php  
 ┃ ┃ ┣ 📜Jwt.php    
 ┃ ┃ ┗ 📜StringUtilService.php  
 ┃ ┣ 📂http     
 ┃ ┃ ┗ 📜Web.php        
 ┃ ┣ 📂model    
 ┃ ┃ ┣ 📜DemoModel.php  
 ┃ ┃ ┗ 📜DemoModelForm.php  
 ┃ ┗ 📂service  
 ┃ ┃ ┣ 📂abstracts  
 ┃ ┃ ┃ ┗ 📜AppService.php   
 ┃ ┃ ┗ 📜DemoService.php    
 ┣ 📂swagger    
 ┃ ┣ 📂swagger  
 ┃ ┣ 📜api.php  
 ┃ ┗ 📜index.php    
 ┣ 📜.env.sample    
 ┣ 📜.gitignore     
 ┣ 📜composer.json  
 ┣ 📜composer.lock  
 ┣ 📜index.php  
 ┗ 📜README.md  

 ##
## Guide ##

* ### Usage  
    * Controller - HTTP Routing and Conditions
    * Model - Direct table schema or Object Model and Queries
    * Service - Create methods and functionality using the Model

* ### Configuration 
    * `composer install` to install all dependencies    
    * copy `.env.sample` and rename to `.env` and change database values

* ### Deployment instructions   
    * Copy and paste the root directory to root folder of the server