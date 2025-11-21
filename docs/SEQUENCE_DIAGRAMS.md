# Sequence Diagrams - Web Gallery Sekolah

## 1. User Login Sequence

```mermaid
sequenceDiagram
    participant U as User
    participant B as Browser
    participant A as AuthController
    participant M as User Model
    participant D as Database
    participant S as Session

    U->>B: Access login page
    B->>A: GET /login
    A->>B: Return login form
    U->>B: Enter credentials
    B->>A: POST /login
    A->>A: Validate input
    A->>M: findUserByUsername()
    M->>D: SELECT * FROM users WHERE username = ?
    D->>M: Return user data
    M->>A: Return user object
    A->>A: Verify password
    A->>S: Create session
    A->>A: Check user role
    A->>B: Redirect to appropriate dashboard
    B->>U: Show dashboard
```

## 2. Photo Upload Sequence

```mermaid
sequenceDiagram
    participant A as Admin
    participant B as Browser
    participant P as PhotoController
    participant V as Validation
    participant F as File Storage
    participant M as Photo Model
    participant D as Database

    A->>B: Access photo upload page
    B->>P: GET /admin/photos/create
    P->>B: Return upload form
    A->>B: Select file and fill form
    B->>P: POST /admin/photos
    P->>V: Validate request
    V->>P: Return validation result
    P->>F: Store uploaded file
    F->>P: Return file path
    P->>M: Create new photo record
    M->>D: INSERT INTO photos
    D->>M: Return created record
    M->>P: Return photo object
    P->>B: Redirect with success message
    B->>A: Show success notification
```

## 3. Gallery View Sequence

```mermaid
sequenceDiagram
    participant V as Visitor
    participant B as Browser
    participant G as GalleryController
    participant M as Photo Model
    participant D as Database
    participant F as File Storage

    V->>B: Access gallery page
    B->>G: GET /gallery
    G->>M: getAllPhotos()
    M->>D: SELECT * FROM photos ORDER BY created_at DESC
    D->>M: Return photos data
    M->>G: Return photos collection
    G->>F: Get photo URLs
    F->>G: Return file URLs
    G->>B: Return gallery view with photos
    B->>V: Display gallery
```

## 4. Information Management Sequence

```mermaid
sequenceDiagram
    participant A as Admin
    participant B as Browser
    participant I as InformationController
    participant V as Validation
    participant M as Information Model
    participant D as Database

    A->>B: Access information management
    B->>I: GET /admin/information
    I->>M: getAllInformation()
    M->>D: SELECT * FROM information ORDER BY created_at DESC
    D->>M: Return information data
    M->>I: Return information collection
    I->>B: Return information list view
    B->>A: Display information list
    
    A->>B: Click create new information
    B->>I: GET /admin/information/create
    I->>B: Return create form
    A->>B: Fill form and submit
    B->>I: POST /admin/information
    I->>V: Validate request
    V->>I: Return validation result
    I->>M: createInformation()
    M->>D: INSERT INTO information
    D->>M: Return created record
    M->>I: Return information object
    I->>B: Redirect with success message
    B->>A: Show success notification
```

## 5. User Registration Sequence

```mermaid
sequenceDiagram
    participant U as User
    participant B as Browser
    participant R as RegisterController
    participant V as Validation
    participant M as User Model
    participant D as Database
    participant A as AuthController

    U->>B: Access registration page
    B->>R: GET /register
    R->>B: Return registration form
    U->>B: Fill registration form
    B->>R: POST /register
    R->>V: Validate request
    V->>R: Return validation result
    R->>M: checkUsernameAvailability()
    M->>D: SELECT COUNT(*) FROM users WHERE username = ?
    D->>M: Return count
    M->>R: Return availability status
    R->>M: createUser()
    M->>D: INSERT INTO users
    D->>M: Return created user
    M->>R: Return user object
    R->>A: Auto login user
    A->>B: Redirect to user dashboard
    B->>U: Show user dashboard
```

## 6. Photo Search Sequence

```mermaid
sequenceDiagram
    participant U as User
    participant B as Browser
    participant G as GalleryController
    participant M as Photo Model
    participant D as Database

    U->>B: Enter search term
    B->>G: GET /gallery?search=term
    G->>M: searchPhotos(term)
    M->>D: SELECT * FROM photos WHERE title LIKE ? OR description LIKE ?
    D->>M: Return matching photos
    M->>G: Return photos collection
    G->>B: Return search results view
    B->>U: Display search results
```

## 7. Category Filter Sequence

```mermaid
sequenceDiagram
    participant U as User
    participant B as Browser
    participant G as GalleryController
    participant M as Photo Model
    participant D as Database

    U->>B: Click category filter
    B->>G: GET /gallery/category/sports
    G->>M: getPhotosByCategory(sports)
    M->>D: SELECT * FROM photos WHERE category = ?
    D->>M: Return photos in category
    M->>G: Return photos collection
    G->>B: Return filtered gallery view
    B->>U: Display filtered photos
```

## 8. Information Publishing Sequence

```mermaid
sequenceDiagram
    participant A as Admin
    participant B as Browser
    participant I as InformationController
    participant M as Information Model
    participant D as Database

    A->>B: Click publish information
    B->>I: POST /admin/information/{id}/publish
    I->>M: publishInformation(id)
    M->>D: UPDATE information SET is_published = true, published_at = NOW()
    D->>M: Return updated record
    M->>I: Return information object
    I->>B: Redirect with success message
    B->>A: Show success notification
```

## 9. File Deletion Sequence

```mermaid
sequenceDiagram
    participant A as Admin
    participant B as Browser
    participant P as PhotoController
    participant M as Photo Model
    participant D as Database
    participant F as File Storage

    A->>B: Click delete photo
    B->>P: DELETE /admin/photos/{id}
    P->>M: findPhoto(id)
    M->>D: SELECT * FROM photos WHERE id = ?
    D->>M: Return photo data
    M->>P: Return photo object
    P->>F: deleteFile(photo.file_path)
    F->>P: Return deletion result
    P->>M: deletePhoto(id)
    M->>D: DELETE FROM photos WHERE id = ?
    D->>M: Return deletion result
    M->>P: Return deletion status
    P->>B: Redirect with success message
    B->>A: Show success notification
```

## 10. Dashboard Statistics Sequence

```mermaid
sequenceDiagram
    participant A as Admin
    participant B as Browser
    participant D as DashboardController
    participant PM as Photo Model
    participant IM as Information Model
    participant UM as User Model
    participant DB as Database

    A->>B: Access admin dashboard
    B->>D: GET /admin/dashboard
    D->>PM: count()
    PM->>DB: SELECT COUNT(*) FROM photos
    DB->>PM: Return photo count
    PM->>D: Return count
    
    D->>IM: count()
    IM->>DB: SELECT COUNT(*) FROM information
    DB->>IM: Return information count
    IM->>D: Return count
    
    D->>UM: count()
    UM->>DB: SELECT COUNT(*) FROM users
    DB->>UM: Return user count
    UM->>D: Return count
    
    D->>PM: getRecentPhotos()
    PM->>DB: SELECT * FROM photos ORDER BY created_at DESC LIMIT 6
    DB->>PM: Return recent photos
    PM->>D: Return photos collection
    
    D->>B: Return dashboard view with statistics
    B->>A: Display dashboard with stats
```

## 11. Error Handling Sequence

```mermaid
sequenceDiagram
    participant U as User
    participant B as Browser
    participant C as Controller
    participant V as Validation
    participant E as Exception Handler
    participant L as Logger

    U->>B: Submit invalid form
    B->>C: POST with invalid data
    C->>V: Validate request
    V->>C: Return validation errors
    C->>B: Return form with errors
    B->>U: Display error messages
    
    Note over U,L: Database Error Scenario
    U->>B: Submit valid form
    B->>C: POST with valid data
    C->>C: Process request
    C->>C: Database operation fails
    C->>E: Throw exception
    E->>L: Log error
    E->>B: Return error page
    B->>U: Display error message
```

## 12. Authentication Middleware Sequence

```mermaid
sequenceDiagram
    participant U as User
    participant B as Browser
    participant M as Middleware
    participant A as AuthController
    participant S as Session

    U->>B: Access protected route
    B->>M: Request with session
    M->>S: Check session validity
    S->>M: Return session status
    
    alt Session Valid
        M->>B: Allow request to continue
        B->>U: Show protected content
    else Session Invalid
        M->>A: Redirect to login
        A->>B: Return login page
        B->>U: Show login form
    end
```
