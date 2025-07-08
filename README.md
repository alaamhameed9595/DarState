# DarState 🏠

**A modern real estate web application built with Laravel.**  
Manage properties, users, analytics, and more—all in one place.

---

## 🚀 Overview

DarState is a feature-rich real estate platform designed to streamline property management, user engagement, and administrative tasks. With robust authentication, real-time chat, interactive maps, and analytics, DarState empowers both agents and administrators.

---

## ✨ Features

- **User Authentication**: Secure login, registration, and password management
- **Property Management**: List, create, edit, and view properties
- **Interactive Map**: Visualize property locations on a dynamic map
- **Admin Dashboard**: Analytics and insights for administrators
- **Notifications**: Real-time notifications for inquiries and contacts
- **Role & Permission Management**: Fine-grained access control (admin, agent, etc.)
- **Real-Time Chat**: Integrated chatbot for instant communication
- **Location Services**: Enhanced property search and filtering by location
- **Telegram Integration**: Receive notifications via Telegram
- **SEO Sitemap Generation**: Automatic sitemap for better search engine indexing

---

## 🛠️ Built With

### Backend (Laravel/PHP)

- **[Laravel Framework](https://laravel.com/)** – The PHP web application framework
- **[Laravel Breeze](https://laravel.com/docs/10.x/starter-kits#breeze)** – Simple authentication scaffolding
- **[Laravel Sanctum](https://laravel.com/docs/10.x/sanctum)** – API token authentication
- **[Laravel Scout](https://laravel.com/docs/10.x/scout)** – Full-text search
- **[Spatie Laravel Permission](https://spatie.be/docs/laravel-permission/)** – Role & permission management
- **[Spatie Laravel Sitemap](https://spatie.be/docs/laravel-sitemap/)** – SEO sitemap generation
- **[Cloudinary Laravel](https://cloudinary.com/documentation/laravel_integration)** – Image management and CDN
- **[BotMan](https://botman.io/)** – Chatbot framework
- **[Meilisearch PHP](https://www.meilisearch.com/docs/)** – Fast, relevant search
- **[GuzzleHTTP](https://docs.guzzlephp.org/)** – HTTP client

### Frontend (JS/CSS)

- **Bootstrap** – Responsive UI components
- **jQuery** – DOM manipulation and AJAX
- **Chart.js** – Data visualization
- **Owl Carousel** – Responsive carousel slider
- **Select2** – Enhanced select boxes
- **Font Awesome** – Icon library
- **(Map Library: _Please specify if using Google Maps, Leaflet, etc._)**

---

## 📦 Dev & Testing Tools

- **PHPUnit** – Unit testing
- **FakerPHP** – Fake data for testing
- **Laravel Sail** – Docker development environment
- **Laravel Pint** – Code style fixer
- **Mockery** – Mocking framework
- **Collision** – Error handling
- **Spatie Laravel Ignition** – Error page for Laravel

---

## ⚙️ Installation

1. **Clone the repository**
   ```bash
   git clone https://github.com/your-username/DarState.git
   cd DarState
   ```

2. **Install PHP dependencies**
   ```bash
   composer install
   ```

3. **Copy and configure environment**
   ```bash
   cp .env.example .env
   # Edit .env with your database and service credentials
   ```

4. **Generate application key**
   ```bash
   php artisan key:generate
   ```

5. **Run migrations and seeders**
   ```bash
   php artisan migrate --seed
   ```

6. **Install frontend dependencies and build assets**
   ```bash
   npm install
   npm run dev
   ```

7. **Serve the application**
   ```bash
   php artisan serve
   ```

---

## 🔑 Admin Login

You can access the admin dashboard using the following credentials (for demo/testing purposes):

- **Email:** admin@darstate.com
- **Password:** adminadmin

---

## 📄 License

This project is open-source and available under the [MIT License](LICENSE).

---

## 🙌 Contributing

Pull requests are welcome! For major changes, please open an issue first to discuss what you would like to change.

---

## 📫 Contact

For questions or support, please open an issue or contact the maintainer.

---
