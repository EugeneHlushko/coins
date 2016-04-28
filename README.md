# Calculate coins application

## Installation

1. clone this git repository:  
 ```
 $ git clone git@github.com:EugeneHlushko/coins-calculator.git
 $ cd coins-calculator
 ```
2. You have to download composer from [here](https://getcomposer.org/download/) after cloning the repository as
instructed on official website
3. Now run composer install:  
 ```
 $ php composer.phar install
 ```
4. Point web server to /web directory
5. Enjoy :)

## Unit testing
Run in root directory: phpunit --configuration phpunit.xml

## Contributing to Front-end
1. Do an npm install
2. run  
 ```
 grunt watch
 ```
3. modify scss and js in sources/ inner folders
4. Live reload is available.