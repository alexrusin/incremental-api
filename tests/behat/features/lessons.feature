Feature: Lessons

Scenario: Returning a collection of lessons
    When I request "GET /api/v1/lessons"
    Then I get a "200" response
    And scope into the first "data" property
        And the properties exist:
            """
            title
            body
            active
            """
        And the active property is boolean