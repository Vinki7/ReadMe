# ReadMe
## About ReadMe Project

ReadMe is a simple and responsive e-commerce platform for buying books online.  
The platform allows users to browse books by category, search for specific titles, and purchase books securely.  
Admins can manage books, categories, and orders through a dedicated admin panel. 

### Features
All known features are described bellow...

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

### Installation  
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

## License
This project is for ***educational purposes only.***

# Project Wiki
**TODO:** Start writing the wiki here

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