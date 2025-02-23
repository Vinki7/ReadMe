# ReadMe
## About ReadMe Project

ReadMe is a simple and responsive e-commerce platform for buying books online.  
The platform allows users to browse books by category, search for specific titles, and purchase books securely.  
Admins can manage books, categories, and orders through a dedicated admin panel. 

### Features
All known features are described below...

#### 🛍️ Client Side  
- Browse books by categories  
- Full-text search for books  
- Filter books by price, author, and genre  
- View book details (title, author, price, description, cover image)  
- Add/remove books from the cart  
- Complete orders with guest checkout or user account  
- Persistent cart for logged-in users  

#### 🔧 Admin Panel  
- Secure admin login  
- Add/edit/delete books  
- Upload book cover images  
- Manage book categories  
- View and manage orders  

### Tech Stack  
- **Backend:** Laravel (PHP Framework)  
- **Frontend:** Blade (Laravel templates), *Tailwind CSS (possibly)*  
- **Database:** PostgreSQL  
- **Version Control:** GitHub  

## License
This project is for ***educational purposes only.***

# Project Wiki

This project will use Laravel as a core framework. Usage of MVC (Model-View-Controller) design pattern would suffice 
for the scope of the project. However, to follow slightly more modular approach, integrating light Clean Architecture 
would have following benefits:

1. Decouples Business Logic from Controllers:
    - Instead of putting logic in controllers, Services handle the actual business logic.
    - Controllers only call Services & return responses.
    - **Benefit:** Easier to maintain, test, and modify business logic.

2. Separates Database Queries Using Repositories:
    - Instead of directly retreiving data from database, **Repositories** will handle the logic.
    - **Benefit:** Allows easier refactoring when changing the database, ORM or core logic.

3. Uses DTOs for Cleaner Data Management:
    - Instead of passing raw request data, DTOs structure the input/output.
    - **Benefit:** Improves data validation & ensures only necessary data is passed.

## Project Structure
ReadMe/<br>
├── app/<br>
│   ├── Console/           # Artisan commands<br>
│   ├── Exceptions/        # Custom error handling<br>
│   ├── Http/<br>
│   │   ├── Controllers/   # Handles HTTP requests<br>
│   │   ├── Middleware/    # Custom middleware<br>
│   │   ├── Requests/      # Request validation<br>
│   ├── Models/            # Eloquent models<br>
│   ├── Services/          # Business logic layer<br>
│   ├── Repositories/<br>
│   │   ├── Interfaces/    # Repository interfaces<br>
│   │   ├── Eloquent/      # Eloquent-based implementations<br>
│   ├── Providers/         # Service providers<br>
├── bootstrap/             # Laravel bootstrap files<br>
├── config/                # Configuration files<br>
├── database/<br>
│   ├── factories/         # Model factories<br>
│   ├── migrations/        # Database migrations<br>
│   ├── seeders/           # Database seeders<br>
├── public/                # Entry point (index.php) and assets<br>
├── resources/<br>
│   ├── views/             # Blade templates<br>
│   ├── lang/              # Language files<br>
├── routes/<br>
│   ├── api.php            # API routes<br>
│   ├── web.php            # Web routes<br>
├── storage/               # File storage (logs, cache, etc.)<br>
├── tests/                 # Unit and feature tests<br>
├── vendor/                # Composer dependencies<br>
├── .env                   # Environment variables<br>
├── artisan                # Artisan CLI<br>
├── composer.json          # Composer dependencies<br>
├── package.json           # Node.js dependencies<br>
└── README.md              # Project documentation

### 🏗️ Project Layers Explanation

1. Models (app/Models/)
    - Represents database tables using Eloquent ORM.
    - Defines relationships, accessors, and mutators.

2. Repositories (app/Repositories/)
    - Encapsulates database queries using Eloquent ORM.
    - Allows switching ORM or database implementation easily.
    - Example:
        - app/Repositories/Interfaces/ProductRepositoryInterface.php
        - app/Repositories/Eloquent/ProductRepository.php

3. Services (app/Services/)
    - Contains business logic and interacts with repositories.
    - Helps keep controllers clean.
    - Example:
        - app/Services/ProductService.php

4. Controllers (app/Http/Controllers/)
    - Handles HTTP requests and responses.
    - Calls services for business logic.

5. Requests (app/Http/Requests/)
    - Validates incoming requests before reaching the controller.

6. Views (resources/views/)
    - Contains Blade templates for UI rendering.

7. Routes (routes/)
    - web.php - Handles web requests (e.g., /books, /cart).
    - api.php - Defines API routes for a RESTful service.

**TODO:** continue with project specification here project here

## Work environment setup
1. Download XAMPP from the following link:
- project will use PHP v. 8.2.12
- https://www.apachefriends.org/download.html
- you can go through the installation wizard and let the preset settings remain (might be beneficial in further work)
- then open CMD and type in:
   ```sh
   php -v
 - if you get something like this continue to step 2:
   ```sh
   PHP 8.2.12 (cli) (built: Oct 24 2023 21:15:15) (ZTS Visual C++ 2019 x64)
   Copyright (c) The PHP Group
   Zend Engine v4.2.12, Copyright (c) Zend Technologies
- if the above statement was not displayed and you get statement like> php is not recognized, you need to set up your env PATH:
  - through environment settings
  - manually in cmd: 
   ```sh
   set PATH=%PATH%;C:\path\to\php\installed\with\xampp
- then test it again by asking for a version of PHP:
   ```sh
   php -v
- you should now have displayed the version
  
2. Download PHP package manager - composer:
- please, don't make the same mistake as the author did. Download the installer and follow the instructions on this page:
  [composer installer](https://getcomposer.org/Composer-Setup.exe)
  [composer guide](https://www.tpointtech.com/how-to-install-composer-on-windows)

3. Download Node.js if it is absent on your system and follow the instructions on the link below, it will be needed for usage of npm:
   [Node.js](https://nodejs.org/en/download)

4. Setup VS code:
- get PHP extension by Devsense
- get Laravel extensions: Laravel Extension Pack
- get Prettier - code formater
- get Tailwind CSS IntelliSense

**TODO:** continue with the wiki here

## Project Installation  
1. Clone this repository:  
   ```sh
   git clone https://github.com/Vinki7/ReadMe.git
   cd ReadMe

2. Install dependencies:
    ```sh
    composer install
    npm install

3. Set up the environment:
    ```sh
    cp .env.example .env
    php artisan key:generate

4. Migrate the database:
    ```sh
    php artisan migrate --seed

5. Start the development server:
    ```sh
    php artisan serve
    npm run dev

6. Open your browser and visit:
    http://localhost:8000

**TODO:** Next steps & detailed approach TBD

## Database structure
![Entity Relation Diagram](./.doc/ReadMe_project%20-%20DB%20relations.png)

# Dev rules / practices
This section should describe practices and conventions to be used during the development process

## Code style

### General Guidelines
- Follow the PSR-12 coding standard for PHP code:
    - **Files**: All PHP files must use the `<?php` or `<?=` tags. Files must use only `UTF-8` without BOM for PHP code.
    - **Indentation**: Code must use 4 spaces for indentation, not tabs.
    - **Lines**: Lines should not be longer than 80 characters; lines longer than that should be split into multiple lines.
    - **Keywords and Constants**: PHP keywords must be in lower case. The PHP constants `true`, `false`, and `null` must be in lower case.
    - **Namespaces and Use Declarations**: Namespaces and use declarations must be declared at the top of the file.
    - **Classes and Methods**: Class names must be declared in `StudlyCaps`. Method names must be declared in `camelCase`.
    - **Properties**: Property names should not be prefixed with a single underscore to indicate protected or private visibility.
    - **Control Structures**: Control structure keywords must have one space after them; method and function calls must not.
    - **Closures**: Closures must be declared with a space after the `function` keyword, and a space before and after the `use` keyword.
- Use 4 spaces for indentation, no tabs.
- Keep lines under 80 characters.
- Use meaningful variable and function names.
- Write comments to explain complex logic and decisions.

### PHP
- Use `<?php` tags.
- Class names should be in `PascalCase`.
- Method names should be in `camelCase`.
- Constants should be in `UPPER_SNAKE_CASE`.
- Use type hints for functions and methods.
- Use strict types where possible.

### JavaScript
- Use `const` and `let` instead of `var`.
- Use `camelCase` for variable and function names.
- Use `PascalCase` for class names.
- Use `===` and `!==` for comparisons.
- Prefer arrow functions for anonymous functions.

### CSS / SaSS
- Use `kebab-case` for class names.
- Use `rem` units for font sizes and spacing.
- Group related CSS properties together.
- Use BEM (Block Element Modifier) methodology for naming classes.

### HTML
- Use semantic HTML5 elements.
- Use double quotes for attribute values.
- Self-close void elements (e.g., `<img />`).


## Clean code principles

### Readability
- Write code that is easy to read and understand.
- Use meaningful and descriptive names for variables, functions, classes, and other identifiers.
- Break down complex logic into smaller, manageable functions or methods.
- Use comments to explain the purpose of the code, especially for complex or non-obvious logic.
- However, the code should be self-explaining so try to achieve this level of readability => comments can be avoided.

### Consistency
- Follow the established coding standards and conventions throughout the codebase.
- Maintain a consistent style for indentation, spacing, and line breaks.
- Use consistent naming conventions for variables, functions, classes, and other identifiers.

### Simplicity
- Keep the code as simple as possible while still solving the problem.
- Avoid unnecessary complexity and over-engineering.
- Use straightforward and clear logic.

### Modularity
- Write modular code by breaking down functionality into smaller, reusable components.
- Use functions, methods, and classes to encapsulate related logic.
- Follow the Single Responsibility Principle (SRP) to ensure that each module has a single responsibility.

### Maintainability
- Write code that is easy to maintain and modify.
- Use version control to track changes and collaborate with others.
- Refactor code regularly to improve its structure and readability.
- Write unit tests to ensure that the code works as expected and to prevent regressions.

### Performance
- Write efficient code that performs well.
- Optimize critical sections of the code for performance.
- Avoid premature optimization; focus on readability and maintainability first.

### Error Handling
- Handle errors and exceptions gracefully.
- Use try-catch blocks to manage exceptions and provide meaningful error messages.
- Validate input data to prevent errors and ensure data integrity.

### Documentation
- Document the code to provide context and explanations.
- Use docstrings and comments to describe the purpose and usage of functions, methods, and classes.
- Maintain up-to-date documentation for the project, including README files and wikis.

By following these clean code principles, we can ensure that our codebase remains high-quality, maintainable, and efficient.


## Contribution Guidelines

- **The first Pull Request (PR) should serve as an outline/template** for future contributions.  
- **Commit messages must be clear and descriptive**, summarizing the key changes made.  
- **PR titles should be short yet informative**, so it's easy to grasp the focus area.  
- **Every PR must include a brief description** of key changes/features implemented.  
- The **PR description helps reviewers understand the scope quickly**, making the review process faster and smoother.  

By following these principles, we keep our repository structured, maintainable, and efficient.

### Commits
Try to *make commits as frequently as possible*, ideally **everytime you have finished a logical unit** (eg.: class, complicated function, part of html template, ...).

#### Types of commit
Here are provided some types of commits:
- **feat:** Introduces a new feature.
- **fix:** Patches a bug.
- docs: Updates or adds documentation.
- **style:** Code style changes (e.g., formatting, missing semi-colons) without affecting functionality.
- **refactor:** Code changes that neither fix a bug nor add a feature.
- perf: Improvements to performance.
- **test:** Adding or correcting tests.
- build: Changes affecting the build system or external dependencies.
- ci: Updates to CI configuration files and scripts.
- **chore:** Other changes that don't modify src or test files.

However, the most frequently used are the types in **bold** so focus on them.

#### Commit structure
Commit consist of 3 parts:
1. **type** = nature of changes
2. **scope** = affected area, this one is *optional*
3. **description**

and is structured as follows:
<type>[optional scope]: <description>

example:
chore(codebase): readme.md outline created
Something similar to *this ↑* should suffice.

### Pull Requests
Pull request naming should follow the same principles as commits, however the **scope is mandatory**.

## .md Styling Rules
Every key concept should be briefly described in wiki (like the structure of Frontend, Backend etc.).
To work in .md seamlessly, the set of some fundamental rules is provided below:

- Use `#` for top-level headings.
- Use `##` for second-level headings.
- Use `###` for third-level headings, and so on.
- Use `**bold**` for bold text.
- Use `*italic*` for italic text.
- Use `-` for bullet points.
- Use `1.` for numbered lists.
- Use backticks for inline code: `` `code` ``.
- Use triple backticks for code blocks:
    ```markdown
    ```
    code block
    ```
    ```
- Use `> ` for blockquotes.
- Use `[text](url)` for links.
- Use `![alt text](image_url)` for images.