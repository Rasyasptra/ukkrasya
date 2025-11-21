# Class Diagram - Web Gallery Sekolah

## 1. Model Classes

### 1.1 Photo Model
```php
class Photo extends Model
{
    // Properties
    + id: bigint
    + title: string
    + description: text
    + filename: string
    + file_path: string
    + category: string
    + uploaded_by: bigint
    + created_at: timestamp
    + updated_at: timestamp

    // Relationships
    + user(): BelongsTo
    + getCategoryOptions(): array
    + getFileUrl(): string
    + deleteFile(): bool

    // Methods
    + fillable: array
    + casts: array
    + boot(): void
}
```

### 1.2 Information Model
```php
class Information extends Model
{
    // Properties
    + id: bigint
    + title: string
    + content: text
    + type: enum
    + priority: enum
    + is_published: boolean
    + published_at: timestamp
    + expires_at: timestamp
    + created_by: bigint
    + created_at: timestamp
    + updated_at: timestamp

    // Relationships
    + creator(): BelongsTo
    + getTypeOptions(): array
    + getPriorityOptions(): array
    + isExpired(): bool

    // Methods
    + fillable: array
    + casts: array
    + scopePublished(): Builder
    + scopeByType(): Builder
}
```

### 1.3 User Model
```php
class User extends Authenticatable
{
    // Properties
    + id: bigint
    + name: string
    + username: string
    + email: string
    + password: string
    + role: enum
    + created_at: timestamp
    + updated_at: timestamp

    // Relationships
    + photos(): HasMany
    + information(): HasMany
    + isAdmin(): bool
    + isUser(): bool

    // Methods
    + fillable: array
    + hidden: array
    + casts: array
    + getRoleOptions(): array
}
```

## 2. Controller Classes

### 2.1 PhotoController
```php
class PhotoController extends Controller
{
    // Dependencies
    - photoService: PhotoService

    // Methods
    + index(): View
    + create(): View
    + store(Request): RedirectResponse
    + show(Photo): View
    + edit(Photo): View
    + update(Request, Photo): RedirectResponse
    + destroy(Photo): RedirectResponse
    + upload(Request): JsonResponse
    - validatePhoto(Request): array
    - handleFileUpload(Request): string
}
```

### 2.2 InformationController
```php
class InformationController extends Controller
{
    // Dependencies
    - informationService: InformationService

    // Methods
    + index(): View
    + create(): View
    + store(Request): RedirectResponse
    + show(Information): View
    + edit(Information): View
    + update(Request, Information): RedirectResponse
    + destroy(Information): RedirectResponse
    + publish(Information): RedirectResponse
    - validateInformation(Request): array
}
```

### 2.3 AuthController
```php
class AuthController extends Controller
{
    // Methods
    + showLogin(): View
    + login(Request): RedirectResponse
    + logout(): RedirectResponse
    + showRegister(): View
    + register(Request): RedirectResponse
    - validateLogin(Request): array
    - validateRegister(Request): array
    - redirectBasedOnRole(User): string
}
```

### 2.4 UserController
```php
class UserController extends Controller
{
    // Methods
    + dashboard(): View
    + information(): View
    + profile(): View
    + updateProfile(Request): RedirectResponse
    - validateProfile(Request): array
}
```

### 2.5 GalleryController
```php
class GalleryController extends Controller
{
    // Methods
    + index(): View
    + category(string): View
    + search(Request): View
    + show(Photo): View
    - getPhotosByCategory(string): Collection
    - searchPhotos(string): Collection
}
```

## 3. Service Classes

### 3.1 CategoryHelper
```php
class CategoryHelper
{
    // Constants
    + CATEGORIES: array

    // Methods
    + getCategories(): array
    + getCategoryOptions(): array
    + isValidCategory(string): bool
    + getCategoryIcon(string): string
    + getCategoryColor(string): string
}
```

### 3.2 PhotoService
```php
class PhotoService
{
    // Dependencies
    - storage: Storage

    // Methods
    + createPhoto(array): Photo
    + updatePhoto(Photo, array): Photo
    + deletePhoto(Photo): bool
    + uploadFile(UploadedFile): string
    + deleteFile(string): bool
    + getPhotosByCategory(string): Collection
    + searchPhotos(string): Collection
    - validateFile(UploadedFile): bool
    - generateFileName(UploadedFile): string
}
```

### 3.3 InformationService
```php
class InformationService
{
    // Methods
    + createInformation(array): Information
    + updateInformation(Information, array): Information
    + deleteInformation(Information): bool
    + publishInformation(Information): Information
    + getPublishedInformation(): Collection
    + getInformationByType(string): Collection
    + searchInformation(string): Collection
    - validateInformationData(array): array
}
```

## 4. Middleware Classes

### 4.1 PreventAdminRegistration
```php
class PreventAdminRegistration
{
    // Methods
    + handle(Request, Closure): Response
    - isAdmin(): bool
}
```

### 4.2 RedirectIfAuthenticated
```php
class RedirectIfAuthenticated
{
    // Methods
    + handle(Request, Closure): Response
    - redirectBasedOnRole(User): string
}
```

## 5. Request Classes

### 5.1 PhotoRequest
```php
class PhotoRequest extends FormRequest
{
    // Methods
    + authorize(): bool
    + rules(): array
    + messages(): array
    + attributes(): array
}
```

### 5.2 InformationRequest
```php
class InformationRequest extends FormRequest
{
    // Methods
    + authorize(): bool
    + rules(): array
    + messages(): array
    + attributes(): array
}
```

## 6. View Classes (Blade Components)

### 6.1 PhotoCard Component
```php
class PhotoCard extends Component
{
    // Properties
    + photo: Photo
    + showActions: bool
    + size: string

    // Methods
    + render(): View
    + getPhotoUrl(): string
    + getCategoryBadge(): string
}
```

### 6.2 InformationCard Component
```php
class InformationCard extends Component
{
    // Properties
    + information: Information
    + showActions: bool
    + compact: bool

    // Methods
    + render(): View
    + getPriorityBadge(): string
    + getTypeBadge(): string
    + isExpired(): bool
}
```

## 7. Database Migration Classes

### 7.1 CreatePhotosTable
```php
class CreatePhotosTable extends Migration
{
    // Methods
    + up(): void
    + down(): void
    - createPhotosTable(): void
    - addForeignKeys(): void
}
```

### 7.2 CreateInformationTable
```php
class CreateInformationTable extends Migration
{
    // Methods
    + up(): void
    + down(): void
    - createInformationTable(): void
    - addForeignKeys(): void
}
```

### 7.3 AddRoleToUsersTable
```php
class AddRoleToUsersTable extends Migration
{
    // Methods
    + up(): void
    + down(): void
    - addRoleColumn(): void
    - removeRoleColumn(): void
}
```

## 8. Seeder Classes

### 8.1 DatabaseSeeder
```php
class DatabaseSeeder extends Seeder
{
    // Dependencies
    - userSeeder: UserSeeder
    - photoSeeder: PhotoSeeder
    - informationSeeder: InformationSeeder

    // Methods
    + run(): void
    - createAdminUser(): User
    - createTestUsers(): void
    - createSamplePhotos(): void
    - createSampleInformation(): void
}
```

## 9. Relationship Diagram

```
User (1) -----> (n) Photo
User (1) -----> (n) Information

Photo belongsTo User
Information belongsTo User
User hasMany Photos
User hasMany Information
```

## 10. Design Patterns Implementation

### 10.1 MVC Pattern
- **Model**: Photo, Information, User
- **View**: Blade templates
- **Controller**: PhotoController, InformationController, etc.

### 10.2 Repository Pattern
- Model classes act as repositories
- Encapsulation of data access logic
- Separation of concerns

### 10.3 Service Layer Pattern
- Service classes for business logic
- Helper classes for utilities
- Clean separation of concerns

### 10.4 Middleware Pattern
- Authentication middleware
- Authorization middleware
- CSRF protection middleware

### 10.5 Observer Pattern
- Model events and observers
- Automatic file cleanup
- Logging and auditing
