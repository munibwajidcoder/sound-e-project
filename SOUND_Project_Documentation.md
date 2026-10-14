# 🎵 SOUND – Online Entertainment Portal (Music & Cinema)
### **Aptech eProject Comprehensive Technical Documentation (2-Page Summary)**

---

## 📌 Page 1: Project Overview & User-Side Architecture

### 1. Cover & Team Information
* **Project Title:** SOUND – Regional & English Music & Video Streaming Portal
* **Technology Stack:** Laravel 11/12, PHP 8.2+, MySQL, Blade Engine, Vanilla CSS3
* **Centre Name:** `[ __________________________________________________ ]`
* **Batch Code:** `[ ________________________ ]` | **Group Name:** `[ ________________ ]`
* **Submission Date:** `[ ________________________ ]`
* **Project Team Members:**
  1. **Muhammad Moheeb**
  2. **Muhammad Muneeb**
  3. **Muhammad Burhan**

---

### 2. Project Overview & Problem Statement
**SOUND** is an entertainment web application built for **SOUND Group** to host and stream Regional (Tamil, Telugu, Hindi, Malayalam, Punjabi, Bengali) and English audio tracks and 4K video content. 

Traditional entertainment sites often suffer from fragmented search and unorganized regional catalogs. SOUND resolves this by providing:
* Granular categorization by **Artist, Album, Year, Genre, and Language**.
* Seamless audio streaming via an interactive modal player.
* Verified user reviews and dynamic 5-star ratings.
* Role-based access separating public visitors from authorized administrators.

---

### 3. User / Client-Side Portal (Functional Specifications)
1. **Curated Music Catalog:** Browse studio tracks, official albums (e.g., *Glory*, *Desi Kalakaar*, *Coke Studio*), with active genre filtering.
2. **4K Video Catalog:** High-definition video recordings with thumbnail covers, duration indicators, and video player support.
3. **Instant Search & Quick Filter Pills:** Real-time search by song title, artist, or album, complemented by theme-colored category pills (Qawwali, Hip-Hop, Romantic, Pop, Albums, 4K Videos).
4. **In-Browser Audio Modal Player:** Non-intrusive floating glassmorphism audio player with animated equalizer bars that allows uninterrupted music playback while browsing.
5. **Community Reviews & 5-Star Ratings:** Logged-in users can rate tracks and submit written feedback, dynamically updating the average star rating.
6. **Flash "NEW" Badge Indicators:** Freshly added tracks automatically feature animated glowing "NEW" tags as specified in client requirements.
7. **Home Page 5-5 Listing Compliance:** The home page dynamically features the latest 5 songs and latest 5 videos directly from the MySQL database.

---

## 📌 Page 2: Admin Portal, Database & Setup Guidelines

### 4. Administrator Control Portal (Management Side)
The Admin Panel is a dedicated, protected module (`/admin/dashboard`) designed for complete content and user governance:
* **Admin Dashboard:** Real-time metrics tracking total audio tracks, video tracks, registered accounts, and recent reviews.
* **Music Management (CRUD):** Add new songs with audio links, poster images, duration, album, artist, and genre; update or remove tracks.
* **Video Management (CRUD):** Upload and manage 4K videos and streaming links with cover thumbnails and duration.
* **Category Administration:** Create and update taxonomy categories (Years, Genres, Languages, Albums, Artists).
* **User & Feedback Moderation:** Monitor registered member accounts and moderate reviews.

---

### 5. Relational Database Schema (`sound_db`)
| Table Name | Primary / Foreign Keys | Key Columns & Description |
| :--- | :--- | :--- |
| **`users`** | `id` (PK) | `name, email, password, phone, address, role ('admin'/'user')` — Authentication & profiles. |
| **`categories`** | `id` (PK) | `name, slug, type ('genre'/'language'/'year')` — Content categorization. |
| **`music`** | `id` (PK) | `title, artist, album, genre, language, year, audio_url, cover_image, is_new` — Songs catalog. |
| **`videos`** | `id` (PK) | `title, artist, album, genre, language, year, video_url, thumbnail, is_new` — 4K video catalog. |
| **`reviews`** | `id` (PK), `user_id, music_id, video_id` (FK) | `rating (1-5), comment, created_at` — User reviews and ratings calculation. |

---

### 6. Default Credentials & Local Execution Guide
* **Default Credentials:**
  * **Admin Panel:** URL: `/admin/login` | Email: `admin@sound.com` | Password: `password123`
  * **Member Account:** URL: `/login` | Email: `moheeb@sound.com` | Password: `password123`
  * **Database Name:** `sound_db` (MySQL, Port 3306)
* **Local Setup Commands:**
  1. `cp .env.example .env` & `php artisan key:generate`
  2. `php artisan migrate --seed` (Creates tables and populates initial sample tracks)
  3. `php artisan serve` (Starts local server at `http://127.0.0.1:8000`)

---
*Developed by: Muhammad Moheeb, Muhammad Muneeb, Muhammad Burhan — Aptech eProject Submission*
