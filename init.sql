-- ENUM types for various application-specific values
CREATE TYPE role_value AS ENUM (
    'admin',
    'user',
    'guest'
);

CREATE TYPE payment_value AS ENUM (
    'credit_card',
    'paypal',
    'bank_transfer'
);

CREATE TYPE delivery_value AS ENUM (
    'standard',
    'express',
    'same_day'
);

CREATE TYPE product_category_value AS ENUM (
    'fantasy',
    'sci-fi',
    'mystery',
    'romance',
    'horror',
    'non-fiction',
    'biography',
    'self_help',
    'education',
    'fitness',
    'psychology',
    'adults'
);

-- Users Table
CREATE TABLE Users (
    id UUID PRIMARY KEY DEFAULT gen_random_uuid(),
    name VARCHAR(25) NOT NULL,
    surname VARCHAR(25) NOT NULL,
    role role_value NOT NULL DEFAULT 'guest'
);

-- Credentials Table
CREATE TABLE Credentials (
    id UUID PRIMARY KEY REFERENCES Users(id) ON DELETE CASCADE,
    username VARCHAR(25) UNIQUE NOT NULL,
    password VARCHAR(60) NOT NULL, -- 60 for bcrypt hash
    email VARCHAR(320) UNIQUE NOT NULL,
    last_login TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Carts Table
CREATE TABLE Carts (
    id UUID PRIMARY KEY DEFAULT gen_random_uuid(),
    user_id UUID REFERENCES Users(id) ON DELETE CASCADE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    total_amount NUMERIC(10, 2) DEFAULT 0.00
);

-- Sessions Table
CREATE TABLE Sessions (
    id UUID PRIMARY KEY DEFAULT gen_random_uuid(),
    user_id UUID REFERENCES Users(id) ON DELETE CASCADE,
    session_token VARCHAR(255) UNIQUE NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    expires_at TIMESTAMP NOT NULL,
    cart_id UUID REFERENCES Carts(id) ON DELETE CASCADE
);

-- Products Table
CREATE TABLE Products (
    id UUID PRIMARY KEY DEFAULT gen_random_uuid(),
    title VARCHAR(100) NOT NULL,
    description TEXT NOT NULL,
    price NUMERIC(10, 2) NOT NULL,
    stock INT NOT NULL DEFAULT 0,
    category product_category_value NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Product Images Table
CREATE TABLE ProductImages (
    id UUID PRIMARY KEY DEFAULT gen_random_uuid(),
    product_id UUID REFERENCES Products(id) ON DELETE CASCADE,
    image_data BYTEA NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)

-- Cart Products Table
CREATE TABLE CartProducts (
    cart_id UUID REFERENCES Carts(id) ON DELETE CASCADE,
    product_id UUID REFERENCES Products(id) ON DELETE CASCADE,
    quantity INT NOT NULL DEFAULT 1,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)

-- Authors Table
CREATE TABLE Authors (
    id UUID PRIMARY KEY DEFAULT gen_random_uuid(),
    name VARCHAR(50) NOT NULL,
    surname VARCHAR(50) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Product Authors Table
CREATE TABLE ProductAuthors {
    product_id UUID REFERENCES Products(id) ON DELETE CASCADE,
    author_id UUID REFERENCES Authors(id) ON DELETE CASCADE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
}