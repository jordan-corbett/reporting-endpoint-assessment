## Resolution Types Endpoint


### Overview

This is my implementation of a reporting endpoint that returns resolution types used by work tasks within a given date range.

The goal was to demonstrate effective use of the Eloquent ORM to model databases and perform queries.


### Installation

Clone the repository and install dependencies:

```$ composer install```

Create your environment file:

```$ cp .env.example .env```

Generate the application key:

```$ php artisan key:generate```

Run the migrations and seed the database:

```$ php artisan migrate --seed```

Run the development server:

```$ php artisan serve```


### API Endpoint

``` GET /api/reports/work-tasks/resolutions ```

Parameters:
from - date, required
to - date, required

Example request:
```GET /api/reports/work-tasks/resolutions?from=2026-03-01&to=2026-03-10```

Example response:
```
{ "resolution_types": [
  { "id": 20,
    "name": "Fix Complete - Parts Collection Required",
    "description": "Parts to be collected from site", "count": 9
  },
  {
    "id": 25,
    "name": "Awaiting Purchase Order from Customer",
    "description": "Awaiting purchase order",
    "count": 4
  }
]}
```


### Architecture

The controller is intentially kept lean. Function logic was placed in a Service class, WorkTaskService, so the controller could simply validate the request parameters, and then call the service to run the logic before returning the response.

Relationships are defined using Eloquent:

Call -> HasOne WorkTask
WorkTask -> BelongsTo Call
WorkTask -> BelongsTo ResolutionType
ResolutionType -> HasMany WorkTasks


### Factories and Seeding

Factories and seeders have been created to generate data for testing and demo purposes. Factories can generate calls with varying states, and work tasks with realistic creation times.


### Testing

Feature tests have been created for this system. The tests cover:

- Accessing the endpoint
- Exclusion of draft and archived calls
- Exclusion of work tasks with no resolution type (ResolutionType = null)
- Filtering by tasks within a given date range
- Counting of resolutions types

Run tests using one of these commands:

```$ php artisan test```

```$ vendor/bin/phpunit```


### Code Improvements and Assumptions

One consideration while this system was in development:

- It was assumed that ResolutionTypes were not limited to a specified set of values. If they were, I would store these values in an Enum, and use this when creating the migration for the ResolutionTypes table. This ensures that only the values in the Enum could be inserted into the database, preventing unwanted values being stored. It also promotes clean code by storing the list of acceptable values in a separate Enum.


### Summary

This implementation focuses on:
- Clear separation of responsibilities (e.g. use of Services)
- Awareness of clean code and clean architecture standards
- Efficient use of the Eloquent ORM
- Maintainable feature tests