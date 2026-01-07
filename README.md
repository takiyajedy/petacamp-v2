# 🏕️ PetaCamp - Malaysia Camping Directory

A comprehensive web-based camping site directory for Malaysia, built with Laravel 11 and Bootstrap 5. Find, share, and explore camping destinations across Malaysia with interactive maps, community submissions, and bilingual support.

![PetaCamp](https://img.shields.io/badge/Laravel-11-red?style=flat&logo=laravel)
![PHP](https://img.shields.io/badge/PHP-8.2+-blue?style=flat&logo=php)
![Bootstrap](https://img.shields.io/badge/Bootstrap-5-purple?style=flat&logo=bootstrap)
![License](https://img.shields.io/badge/License-MIT-green?style=flat)

---

## 📋 Table of Contents

- [Features](#-features)
- [Tech Stack](#-tech-stack)
- [Requirements](#-requirements)
- [Installation](#-installation)
- [Configuration](#-configuration)
- [Database Setup](#-database-setup)
- [Usage](#-usage)
- [Admin Panel](#-admin-panel)
- [API Integration](#-api-integration)
- [Contributing](#-contributing)
- [License](#-license)
- [Support](#-support)

---

## ✨ Features

### Core Features
- 🗺️ **Interactive Maps** - Browse camping sites with Leaflet.js integration
- 📍 **Geolocation** - GPS coordinates for every camping site
- 🔍 **Advanced Search** - Filter by location, amenities, price, and activities
- 📱 **Responsive Design** - Mobile-friendly interface
- 🌓 **Dark Mode** - Toggle between light and dark themes
- 🌐 **Bilingual Support** - Full English and Bahasa Melayu interface

### User Features
- 👤 **User Authentication** - Secure login/registration with Laravel Breeze
- 🔐 **Google OAuth** - One-click login with Google account
- ✉️ **Community Submissions** - Users can submit new camping sites
- ✏️ **Edit Suggestions** - Suggest improvements to existing listings
- ⭐ **Favorites** - Save favorite camping sites (coming soon)
- 💬 **Reviews & Ratings** - Rate and review camping sites (coming soon)

### Admin Features
- 🛡️ **Admin Dashboard** - Comprehensive admin panel
- ✅ **Submission Management** - Review and approve user submissions
- 📊 **Analytics** - View site statistics and insights
- 🏕️ **Camp Management** - Full CRUD operations for camping sites
- 👥 **User Management** - Manage user accounts and permissions
- 🔔 **Notifications** - SweetAlert2 integration for beautiful alerts

### Technical Features
- 🎨 **Modern UI** - Clean, professional design with Bootstrap 5
- 🚀 **Performance** - Optimized queries and caching
- 🔒 **Security** - CSRF protection, SQL injection prevention
- 📧 **Email Notifications** - Automated emails for submissions
- 🗄️ **Database** - SQLite for easy setup (MySQL/PostgreSQL compatible)
- 🌍 **SEO Friendly** - Optimized for search engines

---

## 🛠️ Tech Stack

### Backend
- **Framework**: Laravel 11.x
- **Language**: PHP 8.2+
- **Database**: SQLite (default) / MySQL / PostgreSQL
- **Authentication**: Laravel Breeze
- **OAuth**: Laravel Socialite (Google)

### Frontend
- **CSS Framework**: Bootstrap 5.3
- **JavaScript**: Vanilla JS + Alpine.js (optional)
- **Maps**: Leaflet.js
- **Icons**: Font Awesome 6
- **Alerts**: SweetAlert2
- **Build Tool**: Vite

### Additional Tools
- **Package Manager**: Composer (PHP) + NPM (JavaScript)
- **Version Control**: Git
- **Code Style**: PSR-12

---

## 📦 Requirements

- **PHP**: >= 8.2
- **Composer**: >= 2.5
- **Node.js**: >= 18.x
- **NPM**: >= 9.x
- **Database**: SQLite (included) or MySQL/PostgreSQL
- **Web Server**: Apache/Nginx or Laravel Valet

---

## 🚀 Installation

### 1. Clone the Repository

```bash
git clone https://github.com/yourusername/petacamp.git
cd petacamp
```

### 2. Install PHP Dependencies

```bash
composer install
```

### 3. Install JavaScript Dependencies

```bash
npm install
```

### 4. Environment Configuration

```bash
# Copy environment file
cp .env.example .env

# Generate application key
php artisan key:generate
```

### 5. Database Setup

```bash
# Create SQLite database
touch database/database.sqlite

# Run migrations
php artisan migrate

# Seed database with sample data
php artisan db:seed
```

### 6. Build Frontend Assets

```bash
# Development
npm run dev

# Production
npm run build
```

### 7. Create Storage Symlink

```bash
php artisan storage:link
```

### 8. Start Development Server

```bash
php artisan serve
```

Visit: `http://localhost:8000`

---

## ⚙️ Configuration

### Environment Variables

Update `.env` file with your settings:

```env
APP_NAME=PetaCamp
APP_ENV=local
APP_KEY=base64:... # Generated automatically
APP_DEBUG=true
APP_URL=http://localhost:8000

DB_CONNECTION=sqlite
# For MySQL/PostgreSQL, update these:
# DB_HOST=127.0.0.1
# DB_PORT=3306
# DB_DATABASE=petacamp
# DB_USERNAME=root
# DB_PASSWORD=

MAIL_MAILER=smtp
MAIL_HOST=mailhog
MAIL_PORT=1025
MAIL_USERNAME=null
MAIL_PASSWORD=null
MAIL_ENCRYPTION=null
MAIL_FROM_ADDRESS="hello@petacamp.test"
MAIL_FROM_NAME="${APP_NAME}"

# Google OAuth (Optional)
GOOGLE_CLIENT_ID=your-client-id
GOOGLE_CLIENT_SECRET=your-client-secret
GOOGLE_REDIRECT_URI="${APP_URL}/auth/google/callback"
```

### Google OAuth Setup (Optional)

1. Go to [Google Cloud Console](https://console.cloud.google.com/)
2. Create a new project
3. Enable Google+ API
4. Create OAuth credentials
5. Add authorized redirect URIs:
   - `http://localhost:8000/auth/google/callback`
   - `https://yourdomain.com/auth/google/callback`
6. Copy Client ID and Client Secret to `.env`

See full guide: [GOOGLE_OAUTH_COMPLETE_GUIDE.md](docs/GOOGLE_OAUTH_COMPLETE_GUIDE.md)

---

## 🗄️ Database Setup

### Database Structure

The application uses 7 main tables:

1. **users** - User accounts and authentication
2. **camps** - Camping site information
3. **amenities** - Available amenities (toilets, parking, etc.)
4. **camp_amenities** - Many-to-many relationship
5. **activities** - Upcoming activities and events
6. **submissions** - User-submitted sites (pending approval)
7. **audit_logs** - Admin action logging

### Seeding Sample Data

```bash
# Seed all tables with sample data
php artisan db:seed

# Or seed specific seeders
php artisan db:seed --class=AmenitySeeder
php artisan db:seed --class=CampSeeder
php artisan db:seed --class=UserSeeder
```

### Sample Admin Account

After seeding, you can login with:

```
Email: admin@petacamp.test
Password: password123
```

**⚠️ Important**: Change this password in production!

---

## 📖 Usage

### For Users

#### Browse Camping Sites
1. Visit homepage
2. Use search bar or filters to find sites
3. Click on a camp card to view details
4. View location on interactive map

#### Submit a New Site
1. Login or register
2. Click "Contribute" in navigation
3. Fill in camp details
4. Upload photo
5. Select amenities
6. Submit for admin review

#### Suggest Edits
1. View any camp detail page
2. Click "Suggest Changes"
3. Edit the information
4. Submit for admin review

### For Admins

#### Access Admin Panel
1. Login as admin user
2. Click "Admin" in navigation
3. Access dashboard at `/admin`

#### Manage Submissions
1. Go to "Submissions" tab
2. Review pending submissions
3. Click "View" to see details
4. Approve or Reject with reason

#### Manage Camps
1. Go to "Camps" tab
2. View all camping sites
3. Edit or delete sites
4. Mark sites as featured

---

## 🛡️ Admin Panel

### Features

- **Dashboard**: Overview statistics and quick actions
- **Submissions**: Approve/reject user submissions
- **Camps**: CRUD operations for camping sites
- **Users**: Manage user accounts (coming soon)
- **Settings**: Configure site settings (coming soon)

### Admin Routes

```
/admin              - Dashboard
/admin/submissions  - Manage submissions
/admin/camps        - Manage camps
/admin/users        - Manage users (coming soon)
```

### Admin Middleware

Protected by `admin` middleware. Only users with `is_admin = 1` can access.

---

## 🔌 API Integration

### Available APIs

#### Leaflet Maps
- **Provider**: OpenStreetMap
- **Usage**: Interactive maps on camp listings
- **Docs**: [Leaflet.js](https://leafletjs.com/)

#### Google OAuth
- **Provider**: Google Cloud Platform
- **Usage**: Social login
- **Docs**: [Laravel Socialite](https://laravel.com/docs/socialite)

### Future API Integrations

- Weather API for camping site conditions
- Booking system integration
- Payment gateway (Stripe/PayPal)

---

## 🎨 Customization

### Themes

#### Dark Mode
Toggle dark mode using the moon/sun icon in navigation.
Persists across sessions using localStorage.

#### Colors
Edit primary colors in `resources/sass/app.scss`:

```scss
:root {
    --primary-color: #2c5f2d;  // Main green
    --secondary-color: #97bc62; // Light green
}
```

### Languages

Add new language by:
1. Create `lang/[locale]/app.php`
2. Add translations
3. Add language switcher option

---

## 📱 Responsive Design

### Breakpoints

- **Mobile**: < 768px
- **Tablet**: 768px - 1024px
- **Desktop**: > 1024px

### Mobile Features

- Hamburger menu
- Touch-friendly buttons
- Optimized forms
- Swipeable galleries

---

## 🧪 Testing

### Run Tests

```bash
# Run all tests
php artisan test

# Run specific test suite
php artisan test --filter=CampTest

# With coverage
php artisan test --coverage
```

### Browser Testing

Recommended browsers:
- Chrome (latest)
- Firefox (latest)
- Safari (latest)
- Edge (latest)

---

## 🚢 Deployment

### Production Checklist

- [ ] Set `APP_ENV=production`
- [ ] Set `APP_DEBUG=false`
- [ ] Generate new `APP_KEY`
- [ ] Configure production database
- [ ] Update `APP_URL` to production domain
- [ ] Set up SSL certificate
- [ ] Configure mail server
- [ ] Update Google OAuth redirect URIs
- [ ] Run `php artisan config:cache`
- [ ] Run `php artisan route:cache`
- [ ] Run `php artisan view:cache`
- [ ] Run `npm run build`
- [ ] Set up automated backups
- [ ] Configure queue workers
- [ ] Set up monitoring

### Deployment Platforms

Compatible with:
- Laravel Forge
- Laravel Vapor
- DigitalOcean
- AWS
- Heroku
- Shared hosting (cPanel)

### Server Requirements

```
PHP >= 8.2
BCMath PHP Extension
Ctype PHP Extension
JSON PHP Extension
Mbstring PHP Extension
OpenSSL PHP Extension
PDO PHP Extension
Tokenizer PHP Extension
XML PHP Extension
```

---

## 📚 Documentation

Additional documentation available in `/docs` folder:

- [Setup Guide](docs/PETACAMP_SETUP_GUIDE.md)
- [Dark Mode](docs/DARK_MODE_IMPLEMENTATION.md)
- [Bilingual Support](docs/BILINGUAL_SETUP.md)
- [Google OAuth](docs/GOOGLE_OAUTH_COMPLETE_GUIDE.md)
- [Modal Authentication](docs/AUTH_MODALS_TUTORIAL.md)
- [Troubleshooting](docs/TROUBLESHOOTING.md)

---

## 🤝 Contributing

We welcome contributions! Please follow these steps:

### How to Contribute

1. **Fork the Repository**
   ```bash
   git clone https://github.com/yourusername/petacamp.git
   ```

2. **Create a Feature Branch**
   ```bash
   git checkout -b feature/amazing-feature
   ```

3. **Make Your Changes**
   - Write clean, documented code
   - Follow PSR-12 coding standards
   - Add tests if applicable

4. **Commit Your Changes**
   ```bash
   git commit -m 'Add some amazing feature'
   ```

5. **Push to Branch**
   ```bash
   git push origin feature/amazing-feature
   ```

6. **Open a Pull Request**
   - Describe your changes
   - Reference any related issues

### Code Style

Follow Laravel conventions:
- PSR-12 for PHP
- Prettier for JavaScript
- EditorConfig for consistency

### Reporting Bugs

Open an issue with:
- Clear description
- Steps to reproduce
- Expected vs actual behavior
- Screenshots if applicable
- Environment details

---

## 🐛 Troubleshooting

### Common Issues

#### "Class not found" Error
```bash
composer dump-autoload
php artisan clear-compiled
```

#### Assets Not Loading
```bash
npm run build
php artisan storage:link
```

#### Database Connection Error
```bash
# Check database exists
touch database/database.sqlite

# Run migrations
php artisan migrate:fresh --seed
```

#### Dark Mode Not Working
```bash
# Rebuild assets
npm run build

# Clear cache
php artisan cache:clear
php artisan view:clear
```

#### Google Login Not Working
- Check OAuth credentials in `.env`
- Verify redirect URIs in Google Console
- Clear config cache: `php artisan config:clear`

See full troubleshooting guide: [TROUBLESHOOTING.md](docs/TROUBLESHOOTING.md)

---

## 📄 License

This project is licensed under the MIT License - see the [LICENSE](LICENSE) file for details.

```
MIT License

Copyright (c) 2025 PetaCamp

Permission is hereby granted, free of charge, to any person obtaining a copy
of this software and associated documentation files (the "Software"), to deal
in the Software without restriction, including without limitation the rights
to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
copies of the Software, and to permit persons to whom the Software is
furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in all
copies or substantial portions of the Software.
```

---

## 👥 Authors

- **Your Name** - *Initial work* - [YourGitHub](https://github.com/yourusername)

See also the list of [contributors](https://github.com/yourusername/petacamp/contributors) who participated in this project.

---

## 🙏 Acknowledgments

- Laravel Framework Team
- Bootstrap Team
- Leaflet.js Contributors
- OpenStreetMap Contributors
- Font Awesome
- SweetAlert2
- All camping enthusiasts in Malaysia! 🏕️

---

## 📞 Support

### Need Help?

- 📧 Email: support@petacamp.test
- 💬 Discord: [Join our community](https://discord.gg/petacamp)
- 🐛 Issues: [GitHub Issues](https://github.com/yourusername/petacamp/issues)
- 📖 Docs: [Documentation](https://docs.petacamp.test)

### Social Media

- Facebook: [@PetaCampMY](https://facebook.com/petacampmy)
- Instagram: [@petacamp_my](https://instagram.com/petacamp_my)
- Twitter: [@PetaCampMY](https://twitter.com/petacampmy)

---

## 🗺️ Roadmap

### Version 1.0 (Current)
- ✅ Basic camping site directory
- ✅ User authentication
- ✅ Admin panel
- ✅ Map integration
- ✅ Dark mode
- ✅ Bilingual support

### Version 1.1 (Planned)
- [ ] User reviews and ratings
- [ ] Photo galleries
- [ ] Weather integration
- [ ] Mobile app (React Native)

### Version 2.0 (Future)
- [ ] Booking system
- [ ] Payment integration
- [ ] Real-time availability
- [ ] Advanced analytics
- [ ] API for third-party integrations

---

## 📊 Project Statistics

```
Languages:
PHP         65%
Blade       20%
JavaScript  10%
CSS/SCSS    5%

Files:      150+
Lines:      15,000+
Commits:    100+
```

---

## 🌟 Star History

[![Star History Chart](https://api.star-history.com/svg?repos=yourusername/petacamp&type=Date)](https://star-history.com/#yourusername/petacamp&Date)

---

## 💝 Sponsor

If you find this project useful, please consider:
- ⭐ Starring the repository
- 🍴 Forking and contributing
- ☕ [Buy me a coffee](https://buymeacoffee.com/petacamp)

---

<div align="center">

**Made with ❤️ in Malaysia 🇲🇾**

[Website](https://petacamp.test) • [Documentation](https://docs.petacamp.test) • [API](https://api.petacamp.test)

</div>