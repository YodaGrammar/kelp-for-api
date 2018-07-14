Feature: I want to see the homepage

  Scenario: I want to see the homepage
    When I am on "/"
    Then the response status code should be 200
