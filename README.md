# WebServiceForTechnicalTest
Consolidate data then send it to a given url 

## With docker

- Open a terminal and execute: 
> docker exec -ti php-console php main.php title=title_1  status=draft channel_1=bot

## Without docker

set base url under Config/config.php 
Under terminal execute
php-console php main.php title=title_1  status=draft channel_1=bot

## Notes

* the batch works with the question entity with the id =1 and answer entity with id= 1 
* channel_1: mean that the field channem of the answer with id = 1 
* status value accepts 3 possibilities: draft, published or randomValue
* channel value accepts 3 possibilities: bot, faq or randomValue

