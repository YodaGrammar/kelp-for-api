Feature: I want to register an account

  Scenario: I want to create an account
    When I send a POST request to "/register" with parameters:
      | key           | value         |
      | fullName      | Bob Lee       |
      | username      | Bob           |
      | email         | Bob@local.dev |
      | plainPassword | Passw@rd      |
    Then the response status code should be 200
