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