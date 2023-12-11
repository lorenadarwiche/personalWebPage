-- Create the database
CREATE DATABASE IF NOT EXISTS contentEdit;

-- Use the database
USE contentEdit;

-- Create the content table
CREATE TABLE IF NOT EXISTS content (
    id INT AUTO_INCREMENT PRIMARY KEY,
    content_text TEXT
);

-- Insert some sample content
INSERT INTO content (content_text) VALUES
('Professor Kahanda is an amazing professor!'),
('You can edit as much as you want in here!'),
('My favorite artist is Fares Karem! I love his song called Shefta and El Tanoura!');
