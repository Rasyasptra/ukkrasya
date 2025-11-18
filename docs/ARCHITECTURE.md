# Arsitektur Sistem Web Gallery Sekolah

## 1. Overview Sistem

Web Gallery Sekolah adalah sistem manajemen galeri foto digital yang dibangun menggunakan Laravel Framework dengan arsitektur MVC (Model-View-Controller). Sistem ini dirancang untuk mengelola, menyimpan, dan menampilkan koleksi foto kegiatan sekolah dengan fitur-fitur modern dan responsif.

## 2. Arsitektur Layer

### 2.1 Presentation Layer
- **Admin Dashboard**: Interface untuk administrator mengelola foto dan informasi
- **User Dashboard**: Interface untuk user melihat galeri dan informasi
- **Public Gallery**: Interface publik untuk melihat galeri tanpa login
- **Authentication Pages**: Login, register, dan halaman autentikasi

### 2.2 Application Layer
- **PhotoController**: Mengelola CRUD operasi foto
- **InformationController**: Mengelola informasi dan pengumuman
- **AuthController**: Menangani autentikasi dan otorisasi
- **UserController**: Mengelola profil dan dashboard user
- **GalleryController**: Menangani tampilan galeri publik

### 2.3 Business Logic Layer
- **Photo Model**: Logika bisnis untuk manajemen foto
- **Information Model**: Logika bisnis untuk informasi
- **User Model**: Logika bisnis untuk user management
- **CategoryHelper**: Helper class untuk manajemen kategori
- **Validation Rules**: Aturan validasi untuk input data

### 2.4 Data Layer
- **Photos Table**: Menyimpan metadata foto
- **Information Table**: Menyimpan informasi dan pengumuman
- **Users Table**: Menyimpan data user dan admin
- **File Storage**: Penyimpanan file foto di storage/app/public

## 3. Design Patterns yang Diterapkan

### 3.1 MVC Pattern
```
Model: Photo, Information, User
View: Blade templates
Controller: PhotoController, InformationController, AuthController
```

### 3.2 Repository Pattern (Implisit)
- Model Laravel bertindak sebagai repository
- Encapsulation data access logic
- Separation of concerns

### 3.3 Service Layer Pattern
- Helper classes untuk business logic
- CategoryHelper untuk manajemen kategori
- Validation services

### 3.4 Middleware Pattern
- Authentication middleware
- CSRF protection middleware
- Role-based access control

## 4. Database Schema

### 4.1 Photos Table
```sql
CREATE TABLE photos (
    id BIGINT PRIMARY KEY AUTO_INCREMENT,
    title VARCHAR(255) NOT NULL,
    description TEXT,
    filename VARCHAR(255) NOT NULL,
    file_path VARCHAR(255) NOT NULL,
    category VARCHAR(50) NOT NULL,
    uploaded_by BIGINT NOT NULL,
    created_at TIMESTAMP NULL,
    updated_at TIMESTAMP NULL,
    FOREIGN KEY (uploaded_by) REFERENCES users(id)
);
```

### 4.2 Information Table
```sql
CREATE TABLE information (
    id BIGINT PRIMARY KEY AUTO_INCREMENT,
    title VARCHAR(255) NOT NULL,
    content TEXT NOT NULL,
    type ENUM('announcement', 'news', 'event', 'general') NOT NULL,
    priority ENUM('urgent', 'high', 'medium', 'low') NOT NULL,
    is_published BOOLEAN DEFAULT FALSE,
    published_at TIMESTAMP NULL,
    expires_at TIMESTAMP NULL,
    created_by BIGINT NOT NULL,
    created_at TIMESTAMP NULL,
    updated_at TIMESTAMP NULL,
    FOREIGN KEY (created_by) REFERENCES users(id)
);
```

### 4.3 Users Table
```sql
CREATE TABLE users (
    id BIGINT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(255) NOT NULL,
    username VARCHAR(255) UNIQUE NOT NULL,
    email VARCHAR(255) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    role ENUM('admin', 'user') DEFAULT 'user',
    created_at TIMESTAMP NULL,
    updated_at TIMESTAMP NULL
);
```

## 5. Security Implementation

### 5.1 Authentication
- Username/password based authentication
- Session-based login system
- Password hashing menggunakan bcrypt

### 5.2 Authorization
- Role-based access control (Admin/User)
- Middleware untuk proteksi route
- CSRF token protection

### 5.3 Input Validation
- Server-side validation menggunakan Laravel validation
- File upload validation (type, size, extension)
- XSS protection melalui Blade templating

## 6. Performance Considerations

### 6.1 Database Optimization
- Indexed columns untuk query performance
- Eager loading untuk menghindari N+1 queries
- Pagination untuk data besar

### 6.2 File Storage
- Local file storage dengan organized structure
- Image optimization untuk web display
- Lazy loading untuk galeri foto

### 6.3 Caching Strategy
- View caching untuk static content
- Query result caching untuk data yang jarang berubah
- Browser caching untuk static assets

## 7. Error Handling

### 7.1 Exception Handling
- Global exception handler
- Custom error pages (404, 500, 419)
- Logging untuk debugging

### 7.2 User Feedback
- Toast notifications untuk success/error
- Form validation error display
- Graceful error handling

## 8. Scalability Considerations

### 8.1 Horizontal Scaling
- Stateless application design
- Database connection pooling
- Load balancer ready

### 8.2 Vertical Scaling
- Memory optimization
- CPU efficient algorithms
- Resource monitoring

## 9. Monitoring and Logging

### 9.1 Application Logs
- Laravel log system
- Error tracking
- Performance monitoring

### 9.2 System Metrics
- Response time monitoring
- Memory usage tracking
- Database query performance

## 10. Deployment Architecture

### 10.1 Development Environment
- Local development dengan XAMPP
- MySQL database
- PHP 8.2+

### 10.2 Production Considerations
- Web server (Apache/Nginx)
- Database server (MySQL)
- File storage (Local/Cloud)
- SSL certificate
- Backup strategy
