# WebServiceForTechnicalTest
Consolidate data then send it to a given url 

## With docker

- To Get all the questions from the forein server: 
 >  make console-get-all

- To Get the question with id = 1 
 >  make console-get-id-1 

- To Update the question with id = 1 
 >  make console-update-id-1 

#### behat init 
 >  docker exec -ti php-console bin/behat --int
#### behat run test 
 >  docker exec -ti php-console bin/behat 


## Without docker

set base url under Config/config.php
  
Under terminal execute
 > composer install



To Get all the questions from the forein server: 
 > php main.php GET

- To Get the question with id = 1 
 > php main.php GET --id-question=1 

- To Update the question with id = 1 
 >  php main.php UPDATE  --id=1

#### behat test 
 > bin/behat --int
 >
 > bin/behat 


## Notes

* the batch works with the question entity with the id =1 and answer entity with id= 1 
* channel_1: mean that the field channem of the answer with id = 1 
* status value accepts 3 possibilities: draft, published or randomValue
* channel value accepts 3 possibilities: bot, faq or randomValue

