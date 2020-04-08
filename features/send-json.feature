Feature: send-json-as-web-service
#  In order to send a json data to the ngix server
#  With Question id equals "1"
#  I need to get response an empty array or array containing error information
  Scenario: Update a question
    Given I a am a Question with id equals "1"
    And Question have One answer with id equals "1"
    And Question title's to update with value "behatValue"
    And Question Status to update with value "draft"
    When I send the data
    Then I the response has field "title" with value "behatValue"
    Then I the response has field "status" with value "draft"

  Scenario: Get a success response
    Given request question with id "1"
    Then I the response has field "title" with value "behatValue"
    Then I the response has field "status" with value "draft"

