Feature: send-json-as-web-service
  In order to send a json data to the ngix server
  With Question id equals "1"
  I need to get response an empty array or array containing error information
  Scenario: Get a succes response
    Given I a am a Question with id equals "1"
    And Question have One answer with id equals "1"
    And Question title's to update with value "title=behatValue"
    And Question Status to update with value "status=draft"
    When I send the data
    Then I get response as an empty array

