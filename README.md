# Fotoverso 📸

**Fotoverso** - *The Home of Your Memories*

A full-featured photo sharing social network web application built with PHP, MySQL, HTML, CSS, and JavaScript. Users can upload, organize, and share their photos in custom galleries while exploring content from other photographers.

## 🌟 Features

### User Management
- **User Registration & Authentication** - Secure account creation and login system
- **User Profiles** - Customizable profiles with profile pictures
- **Profile Editing** - Update nickname, email, phone number, and profile picture

### Photo Management
- **Photo Upload** - Upload photos with descriptions, dates, and categories
- **Photo Organization** - Categorize and tag photos for easy filtering
- **Photo Editing** - Modify photo descriptions, dates, and categories
- **Photo Deletion** - Remove unwanted photos from your collection
- **Date-based Filtering** - Sort photos by date (ascending/descending)
- **Category Filtering** - Filter photos by predefined categories

### Gallery System
- **Create Galleries** - Organize photos into custom collections
- **Gallery Management** - Edit gallery names and descriptions
- **Add Photos to Galleries** - Select multiple photos to add to galleries
- **Gallery Sharing** - View and explore galleries from other users
- **Delete Galleries** - Remove entire galleries and their associations

### Exploration & Discovery
- **Explore Section** - Browse photos from all users
- **User Profiles Viewing** - Visit other photographers' profiles
- **Gallery Browsing** - Explore public galleries
- **Advanced Filtering** - Filter content by category, date, and user

### Dashboard (AdminLTE Integration)
- **Statistics Dashboard** - View platform metrics and analytics
- **User Management** - Administrative controls
- **Photo Statistics** - Track uploads and popular categories

## 🛠️ Technologies Used

- **Frontend:**
  - HTML5
  - CSS3 (Custom stylesheets + Bootstrap 5)
  - JavaScript (jQuery)
  - Bootstrap 5.0

- **Backend:**
  - PHP (Session management, server-side processing)
  - MySQL/MariaDB (Database)
  - Stored Procedures (Database operations)

- **Additional Tools:**
  - AdminLTE (Dashboard template)
  - phpMyAdmin (Database management)

## 📋 Prerequisites

Before you begin, ensure you have the following installed:

- **Web Server** (Apache/Nginx)
- **PHP** (version 7.4 or higher)
- **MySQL/MariaDB** (version 5.7 or higher)
- **phpMyAdmin** (optional, for database management)

**Recommended Stack:**
- XAMPP, WAMP, or LAMP (includes Apache, PHP, and MySQL)

## 🚀 Installation

### 1. Clone the Repository

```bash
git clone https://github.com/yourusername/fotoverso.git
cd fotoverso
```

### 2. Database Setup

1. Import the database schema:
   - Open phpMyAdmin or your MySQL client
   - Create a new database named `picify_new_final_database`
   - Import the file: `picify_new_final_database.sql`

2. Configure database credentials:
   - Open any PHP file in the `/php` directory
   - Update the database connection variables:
   ```php
   $servername = "localhost";
   $username = "your_username";
   $password = "your_password";
   $database = "picify_new_final_database";
   ```

### 3. Directory Setup

Create the following directories if they don't exist:

```bash
mkdir profilePictures
mkdir uploadedPictures
```

Set appropriate permissions:

```bash
chmod 755 profilePictures
chmod 755 uploadedPictures
```

### 4. Web Server Configuration

- Place the project in your web server's document root:
  - XAMPP: `C:/xampp/htdocs/fotoverso/`
  - WAMP: `C:/wamp64/www/fotoverso/`
  - Linux: `/var/www/html/fotoverso/`

- Ensure PHP is enabled and configured
- Start Apache and MySQL services

### 5. Access the Application

Open your browser and navigate to:
```
http://localhost/fotoverso/
```

## 📁 Project Structure

```
fotoverso/
├── index.html              # Landing page
├── css/                    # Stylesheets
│   ├── index_stylesheet.css
│   ├── Pagina_Inicial.css
│   └── ...
├── html/                   # Static HTML pages
│   ├── crearcuenta.html
│   ├── ingresarcuenta.html
│   └── ...
├── php/                    # PHP scripts
│   ├── Pagina_Inicial.php
│   ├── Mi_Perfil.php
│   ├── Subir_Foto.php
│   ├── LLAMAR_*.php        # API endpoints
│   └── ...
├── js/                     # JavaScript files
│   ├── fecha_hoy.js
│   └── obtenedor_de_fecha.js
├── img/                    # Static images
│   └── ...
├── adminlte/               # AdminLTE dashboard
├── profilePictures/        # User profile images (created at runtime)
├── uploadedPictures/       # User uploaded photos (created at runtime)
└── picify_new_final_database.sql  # Database schema
```

## 🔑 Key Features Explained

### Photo Upload Flow
1. User navigates to "Subir Foto" (Upload Photo)
2. Selects image file, adds description, date, and category
3. PHP processes upload and stores in `uploadedPictures/`
4. Database record created with metadata

### Gallery System
1. Create gallery with name and description
2. Add existing photos to gallery
3. Photos maintain relationships via `Exhibidos` junction table
4. Multiple photos can exist in multiple galleries

### User Authentication
1. Session-based authentication
2. Password stored securely (ensure hashing in production)
3. Session variables: `account_nickname`, `account_name`, `account_surname`, `account_email`

## 🔒 Security Considerations

**⚠️ Important for Production:**

1. **Database Credentials** - Move to environment variables or config files outside web root
2. **Password Hashing** - Implement proper password hashing (bcrypt/argon2)
3. **SQL Injection** - Use prepared statements instead of direct queries
4. **XSS Protection** - Sanitize all user inputs
5. **CSRF Protection** - Implement CSRF tokens for forms
6. **File Upload Validation** - Validate file types and sizes strictly
7. **HTTPS** - Use SSL/TLS certificates in production

## 🧪 Testing

To test the application:

1. Create a test account via the registration page
2. Login with the created credentials
3. Upload sample photos
4. Create galleries and add photos
5. Test filtering and search functionality
6. Explore other user profiles

## 📝 Database Schema Overview

### Main Tables:
- **Fotografos** - User accounts (ID, Nombre, Apellido, Nickname, Email, Telefono, IMG_Perfil)
- **Fotos** - Photos (ID, Filename, Fecha, Descripcion, Owner, ID_Categoria, Country)
- **Galerias** - Galleries (ID, Nombre, Descripcion, ID_Propietario)
- **Exhibidos** - Photo-Gallery relationships (ID_Galeria, ID_Foto)
- **Categorias** - Photo categories (ID, Nombre)

### Stored Procedures:
- User management (CAMBIAR_EMAIL, CAMBIAR_NICKNAME, etc.)
- Photo operations (FOTOS_ASC, FOTOS_DES, BORRAR_FOTO, etc.)
- Gallery operations (BORRAR_GALERIA, GET_GALERIA, etc.)
- Statistics (FOTOS_SUBIDAS_HOY, GET_MOST_POPULAR_CATEGORY, etc.)

## 🤝 Contributing

Contributions are welcome! Please follow these steps:

1. Fork the repository
2. Create a feature branch (`git checkout -b feature/AmazingFeature`)
3. Commit your changes (`git commit -m 'Add some AmazingFeature'`)
4. Push to the branch (`git push origin feature/AmazingFeature`)
5. Open a Pull Request

## 📄 License

This project is available for educational purposes. MIT License

## 👥 Authors

- Edgar Karpowicz

## 🙏 Acknowledgments

- Bootstrap for the responsive framework
- AdminLTE for the dashboard template
- All contributors and testers

## 📞 Contact

For questions or support, please open an issue in the repository.

---

**Fotoverso** - *El Hogar de Tus Recuerdos* 📸✨
