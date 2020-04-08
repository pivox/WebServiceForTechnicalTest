Feature: send-json-as-web-service
#  In order to send a json data to the ngix server
#  With Question id equals "question_1"
#  I need to get response an empty array or array containing error information
  Scenario: Update a question
    Given I a am a Question with id equals "question_1"
    And Question have One answer with id equals "answer_1"
    And Question field "title" is "behatValue"
    And Question field "status" is "draft"
    When I send the data
    Then I the response has field "title" with value "behatValue"
    Then I the response has field "status" with value "draft"

  Scenario: Get a success response
    Given request question with id "question_1"
    Then I the response has field "title" with value "behatValue"
    Then I the response has field "status" with value "draft"

