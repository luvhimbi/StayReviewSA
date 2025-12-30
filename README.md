# StayReview SA 🏠🇿🇦
StayReview SA is a South Africa–focused web platform that allows tenants to review places they have previously stayed at. The goal is to help people who are looking for accommodation make better, informed decisions based on real experiences shared by other tenants.

The platform promotes transparency, accountability, and safer housing choices by giving renters a voice.

## 🎯 Purpose

Finding a place to stay often comes with uncertainty — hidden issues, misleading listings, or lack of honest feedback.  
StayReviewSA exists to:

- Give tenants a voice through real reviews
- Help users avoid bad accommodation choices
- Encourage better standards from property owners
- Build trust in the rental ecosystem

---

## 🧑‍💻 User Features

### 🔐 User Registration & Login
- Email & password signup
- Optional social login
- Email verification for account security

### 👤 Profile Management
- Edit personal information
- Upload profile avatar
- View and manage personal reviews

### ⭐ Apartment / Property Ratings
- Rate properties on multiple criteria:
  - Cleanliness
  - Amenities
  - Location
  - Price / value
- Leave detailed written reviews
- Upload photos of apartments

### 🔍 Search & Filter
- Search by:
  - Location
  - Price range
  - Property type
- Filter by:
  - Rating
  - Availability
  - Amenities

### ❤️ Favorites / Wishlist
- Save apartments for later viewing
- Quickly access preferred listings


### 🔔 Notifications
- Alerts for new apartments in preferred areas
- Notifications for message replies

### 🔐 POPI / Privacy Consent
- Explicit consent for storing:
  - Personal information
  - Reviews and uploaded content

---

## 🛠️ Admin / Property Owner Features

### 🏢 Property Management
- Add new properties
- Edit property details:
  - Photos
  - Descriptions
  - Pricing
- Manage property availability status

### 🧹 Review Management
- Moderate user reviews
- Flag or delete inappropriate or abusive content

### 📊 Dashboard & Analytics
- View most-rated properties
- Track user activity
- Display average ratings and trends

### 👥 User Management
- Manage platform users
- Ban users if necessary
- Edit roles and permissions

---

## 🌍 Social / Community Features

### 🌟 Top Rated / Featured Apartments
- Highlight highly rated properties

### 👍 Review Voting
- Users can mark reviews as helpful

### 💬 Comment Replies
- Property owners can reply to reviews

  ##  How to Run the App (Local Setup)

Follow these steps to run **StayReviewSA** locally using **Laravel + PostgreSQL**.

---

##  Install PHP

### Windows
1. Download PHP **8.1 or newer** from: https://www.php.net/downloads
2. Extract PHP to:C:\php
3. Enable this extension on your php.ini file
extension=pdo_pgsql
extension=pgsql
extension=mbstring
extension=openssl
extension=fileinfo
extension=curl
4.verify installation with php -v on cmd
5.download composer for php n then install it on your pc
6.install Postgres on to your pc and during the installation please take note of the username and password which you will be prompted to set up
7.After  open pgadmin to verify if your installation was successful
8.then clone the project from git
9.run composer install to install dependencies on the project
10.set up your environment using this commands:
 cp .env.example .env
php artisan key:generate
11.on the.env file u just created setup the connection to the postgres using the same username and password you set up during installation and also create the db which you want all the tables to get created in
DB_CONNECTION=pgsql
DB_HOST=127.0.0.1
DB_PORT=5432
DB_DATABASE=stayreview_sa
DB_USERNAME=postgres
DB_PASSWORD=your_password_here
12.after run migrations(which create tables and relationships and indexes which are already on the project inside of your local pgadmin db):php artisan migrate


13.set storage using :php artisan storage:link 
14.then now finally😭:start the server using - php artisan serve
15.the localhost is on:http://127.0.0.1:8000 




