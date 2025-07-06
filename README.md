# PHP MVC Image Gallery

This project is a simple image gallery built using the MVC (Model-View-Controller) architectural pattern in native PHP. It allows user authentication, image uploads, categorization, and visual display of images with a responsive UI and music integration.

## Features

- **MVC Structure**: Clean separation between business logic, routing, and UI.
- **Authentication**: Simple login system using `AuthController`.
- **User Management**: Handled through `UsersController` and `Users` model.
- **Image Upload and Display**: Handled by `PhotosController` and `Photos` model.
- **Dynamic Views**: Includes views for dashboard, login, image upload, and user lists.
- **Routing**: Basic routing handled through `Routes/web.php` and `public/router.php`.
- **Database Integration**: SQL file (`sql/database.sql`) included to create and populate required tables.
- **Assets**: Public folder includes styles, scripts, images, and MP3 music integration.

## Folder Structure

ImageGallery-PHP-MVC-MySQL/
├── Controllers/ # Auth, Users, Photos, DB connection
├── Models/ # Users and Photos model classes
├── Views/ # Views for login, dashboard, gallery, and templates
├── Routes/ # Basic routing config
├── public/ # Publicly accessible files (CSS, JS, images, music)
├── sql/ # SQL file to initialize the database
├── index.php # Main entry point
