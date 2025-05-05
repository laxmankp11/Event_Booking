# 🎟️ Event Booking System API

A RESTful API built with **Laravel 10+** to manage **events**, **attendees**, and **bookings**.

## 📋 Table of Contents

- [🔧 Setup Instructions](#setup-instructions)
- [🔐 How to Generate API Token](#how-to-generate-api-token)
- [✅ Create an Event](#create-an-event)
- [👤 Register Attendee](#register-attendee)
- [🎟️ Book an Event](#book-an-event)
- [⚠️ Try Duplicate Booking](#try-duplicate-booking)
- [🧪 Testing Tips](#testing-tips)

---

## 🔧 Setup Instructions

### 1. Clone the repository (if applicable)

```bash
git clone https://github.com/yourusername/event-booking-api.git
cd event-booking-api

2. Install dependencies
composer install

cp .env.example .env
php artisan key:generate



---

## 🔐 Authentication Setup

Generate a test user and authentication token using the following commands:

```bash
php artisan tinker
```

Then run:

```php
App\Models\User::factory()->create([
    'email' => 'admin@example.com',
    'password' => bcrypt('password123'),
]);

$user = App\Models\User::first();
$token = $user->createToken('auth_token')->plainTextToken;
echo $token;
```

Copy the generated token and use it as a **Bearer Token** in your API requests.

Example header:
```
Authorization: Bearer your_generated_token_here
```

---

## ▶️ Running the Server

```bash
php artisan serve
```

The API will be available at:  
`http://127.0.0.1:8000`

---

## 📘 API Documentation

Swagger UI is available at:  
`http://127.0.0.1:8000/api/documentation`  
*(URL may vary depending on your setup)*

---


## 📝 License

This project is licensed under the MIT License.  
Feel free to use and modify it as needed.

---

## 🙋‍♂️ Contact

For queries or support, reach out at:  
`admin@example.com`

---

## 📘 API Documentation

Swagger UI is available at:  
`http://127.0.0.1:8000/api/documentation`  
*(URL may vary depending on your setup)*

---

## 🧪 Running Tests

```bash
php artisan test
```

---

## 📝 License

This project is licensed under the MIT License.  
Feel free to use and modify it as needed.

---

## 🙋‍♂️ Contact

For queries or support, reach out at:  
`admin@example.com`

---

## 📮 Example API Endpoint

### Create Event

**Endpoint:**  
`POST /api/events`

**Headers:**  
```
Authorization: Bearer your_generated_token_here
Content-Type: application/json
```

**Body:**
```json
{
  "title": "Sample Event",
  "description": "An example event",
  "start_time": "2025-05-10 10:00:00",
  "end_time": "2025-05-10 12:00:00",
  "location": "New York"
}
```

**Response:**
```json
{
  "success": true,
  "message": "Event created successfully.",
  "data": {
    "id": 1,
    "title": "Sample Event",
    "description": "An example event",
    "start_time": "2025-05-10T10:00:00.000000Z",
    "end_time": "2025-05-10T12:00:00.000000Z",
    "location": "New York"
  }
}
```

---

## 📮 API Endpoints

### 🔹 Events

#### Create Event
- **URL:** `POST /api/events`
- **Headers:**
  ```
  Accept: application/json
  Content-Type: application/json
  Authorization: Bearer <your_token>
  ```
- **Body:**
  ```json
  {
    "title": "Laravel Dev Conference",
    "country": "USA",
    "capacity": 50,
    "start_time": "2024-12-10T10:00:00Z",
    "end_time": "2024-12-12T17:00:00Z"
  }
  ```

#### List Events
- **URL:** `GET /api/events`
- **Headers:**
  ```
  Accept: application/json
  Authorization: Bearer <your_token>
  ```

#### Get Single Event
- **URL:** `GET /api/events/{id}`
- **Headers:**
  ```
  Accept: application/json
  Authorization: Bearer <your_token>
  ```

#### Update Event
- **URL:** `PUT /api/events/{id}`
- **Headers:**
  ```
  Accept: application/json
  Content-Type: application/json
  Authorization: Bearer <your_token>
  ```
- **Body:**
  ```json
  {
    "title": "Updated Title",
    "country": "Canada",
    "capacity": 60,
    "start_time": "2024-12-11T10:00:00Z",
    "end_time": "2024-12-13T17:00:00Z"
  }
  ```

#### Delete Event
- **URL:** `DELETE /api/events/{id}`
- **Headers:**
  ```
  Accept: application/json
  Authorization: Bearer <your_token>
  ```

---

### 🔹 Attendees

#### Register Attendee
- **URL:** `POST /api/attendees`
- **Headers:**
  ```
  Accept: application/json
  Content-Type: application/json
  ```
- **Body:**
  ```json
  {
    "name": "John Doe",
    "email": "john@example.com"
  }
  ```

---

### 🔹 Bookings

#### Book an Event
- **URL:** `POST /api/bookings`
- **Headers:**
  ```
  Accept: application/json
  Content-Type: application/json
  ```
- **Body:**
  ```json
  {
    "event_id": 6,
    "attendee_id": 2
  }
  ```

#### Try Duplicate Booking
- Same as Book an Event

#### Overbook Event
- Same as Book an Event with a full event


#### Video Demonstratino

https://www.awesomescreenshot.com/video/39416270?key=3afbe70a7a0620f5309a2987bdc21f9f

####  Postman Json flle is also committed :
Event Booking API.postman_collection.json
