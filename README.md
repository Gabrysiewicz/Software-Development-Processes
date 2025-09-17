# Software Development Processes

This laboratory project is based on the project from the previous semester of the course: `Cloud Application Programming`

# Env

- PHP 8.1.2-1ubuntu2.14 (cli)
- Docker version 24.0.5
- Ubuntu 22.04.3 LTS
- Composer version 2.6.5

# Install guide
1. Unpack the project

2. Navigate to the project directory:
```
cd Project/project
```

3. Install dependencies via Composer:
```
composer install
```

4. Copy content of `.env.example` to `.env`:
```
cp .env.example .env
```

5. Install and configure the Sail tool, which allows running Docker containers (select mysql [0]):
```
php artisan sail:install
```

6. Clear the application's cached data before starting the containers:
```
php artisan optimize:clear
```

7. Run the App
```
./vendor/bin/sail up -d
```
The application should be running at localhost.
The next two operations can be performed manually by navigating through the application on localhost,
or by using the commands in steps 8 and 9.

8. Clear any existing migrations
```
./vendor/bin/sail artisan migrate:fresh
```

8.5 It may be necessary to change permissions
```
chmod 777 -R *
```

9. Generate app key
```
./vendor/bin/sail artisan key:generate
```

10. Connecting storage, required for profile pictures
```
./vendor/bin/sail artisan storage:link
```

11. Closing the application (inside the project directory)
```
./vendor/bin/sail down
```

# Project Subject

The project aims to create a web application that allows users to advertise their hairdressing, barber, and cosmetic services. The application will provide hairdressers with a platform to create profiles and promote their businesses to potential clients.

### Functional Requirements
- User registration and login
- Ability to create hairdressing offers
- Ability to manage their own offers
- Search function allowing users to find hairdressers based on city

### Non-Functional Requirements
- The application should be compatible with various browsers such as Google Chrome and Firefox
- The application should work independently of the operating system
- User data should be stored securely
- The system uses a MySQL database within a Docker environment
- The system is built using Laravel technology


# Automatic Tests

Tests in Laravel are created using sail or php (sail executes the exact same commands, but directly inside the container):

Docker
```
sail artisan make:test MyTest
```

Local
```
php artisan make:test MyTest
```

By default, Laravel creates tests in `/tests/Feature` and unit tests in `/tests/Unit`.  
However, the framework emphasizes tests focused on `Features`.  

In my application, the tests cover:
- CRUD
  - `AuthTest.php`
- Routing
  - `AuthTest.php`
  - `GuestTest.php`
- Database
  - `AuthTest.php`
- Validation
  - `ValidationCreateTest.php`
  - `ValidationEditTest.php`
- Authorization
  - `AuthTest.php`
  - `GuestTest.php`
- Authentication
  - `AuthTest.php`
  - `GuestTest.php`


To run the tests use this command
```
➜  my-app git:(main) sail artisan test
```
```
   PASS  Tests\Unit\ExampleTest
  ✓ that true is true                                                    0.01s

   PASS  Tests\Feature\AuthTest
  ✓ authenticated user can access create offert                          3.28s
  ✓ unauthenticated user can access create offert                        0.02s
  ✓ authenticated user can store offert                                  0.09s
  ✓ unauthenticated user can store offert                                0.02s
  ✓ authenticated user can access edit offert                            0.03s
  ✓ unauthenticated user can access edit offert                          0.02s
  ✓ authenticated user can update offert                                 0.04s
  ✓ unauthenticated user can access update offert                        0.02s
  ✓ authenticated user can access manage                                 0.03s
  ✓ unauthenticated user can access menage                               0.02s
  ✓ authenticated user can delete offert                                 0.05s
  ✓ unauthenticated user can delete offert                               0.02s
  ✓ authenticated user can logout                                        0.03s
  ✓ unauthenticated user can logout                                      0.02s

   PASS  Tests\Feature\ExampleTest
  ✓ the application returns a successful response                        0.04s

   PASS  Tests\Feature\GuestTest
  ✓ guest user can access register                                       0.02s
  ✓ authenticated user can access register                               0.03s
  ✓ guest user can access login                                          0.02s
  ✓ authenticated user can access login                                  0.03s

   PASS  Tests\Feature\StorageTest
  ✓ delete offert deletes profile picture                                0.07s

   PASS  Tests\Feature\ValidationCreateTest
  ✓ authenticated user cannot create offert without first name           0.04s
  ✓ authenticated user cannot create offert without last name            0.04s
  ✓ authenticated user cannot create offert without city                 0.04s
  ✓ authenticated user cannot create offert without professions          0.04s
  ✓ authenticated user cannot create offert without workplaces           0.03s

   PASS  Tests\Feature\ValidationEditTest
  ✓ authenticated user cannot edit offert without name                   0.06s
  ✓ authenticated user cannot edit offert without surname                0.05s
  ✓ authenticated user cannot edit offert without city                   0.05s
  ✓ authenticated user cannot edit offert without profession             0.06s
  ✓ authenticated user cannot edit offert without workplace              0.06s

  Tests:    31 passed (57 assertions)
  Duration: 4.53s
```

