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
ReadMe/
├── app/
│   ├── Console/           # Artisan commands
│   ├── Exceptions/        # Custom error handling
│   ├── Http/
│   │   ├── Controllers/   # Handles HTTP requests
│   │   ├── Middleware/    # Custom middleware
│   │   ├── Requests/      # Request validation
│   ├── Models/            # Eloquent models
│   ├── Services/          # Business logic layer
│   ├── Repositories/
│   │   ├── Interfaces/    # Repository interfaces
│   │   ├── Eloquent/      # Eloquent-based implementations
│   ├── Providers/         # Service providers
├── bootstrap/             # Laravel bootstrap files
├── config/                # Configuration files
├── database/
│   ├── factories/         # Model factories
│   ├── migrations/        # Database migrations
│   ├── seeders/           # Database seeders
├── public/                # Entry point (index.php) and assets
├── resources/
│   ├── views/             # Blade templates
│   ├── lang/              # Language files
├── routes/
│   ├── api.php            # API routes
│   ├── web.php            # Web routes
├── storage/               # File storage (logs, cache, etc.)
├── tests/                 # Unit and feature tests
├── vendor/                # Composer dependencies
├── .env                   # Environment variables
├── artisan                # Artisan CLI
├── composer.json          # Composer dependencies
├── package.json           # Node.js dependencies
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