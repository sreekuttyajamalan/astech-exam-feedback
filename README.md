# Exam Feedback System

A full-stack web application for collecting structured student feedback on individual exam questions.

The system provides a student-facing interface where authenticated students can view their registered exams, select an exam, identify issues with specific questions, provide additional comments, and submit feedback through a Laravel REST API.

---

## 1. Project Overview

The **Exam Feedback System** is designed to provide a structured and maintainable approach to collecting exam-question feedback from students.

The application separates the frontend presentation layer from the backend API and database layer.

### Core workflow

```text
Student
   │
   ▼
Login
   │
   ▼
Student Dashboard / Feedback
   │
   ▼
Load Registered Exams
   │
   ▼
Select Exam
   │
   ▼
Enter Question Number
   │
   ▼
Select Problem Categories
   │
   ▼
Enter Specific Feedback
   │
   ▼
Submit Feedback
   │
   ▼
Laravel REST API
   │
   ▼
MySQL Database
```

---

## 2. Technology Stack

| Layer                   | Technology         |
| ----------------------- | ------------------ |
| Frontend                | Vue.js 3           |
| Language                | TypeScript         |
| Build Tool              | Vite               |
| HTTP Client             | Axios              |
| Backend                 | Laravel            |
| Backend Language        | PHP                |
| Database                | MySQL              |
| API                     | REST API           |
| Version Control         | Git / GitHub       |
| API Testing             | Postman            |
| Development Environment | XAMPP              |
| IDE                     | Visual Studio Code |

---

## 3. Architecture

The application follows a separated frontend/backend architecture.

```text
┌──────────────────────────────┐
│          Vue.js UI           │
│                              │
│  LoginView                   │
│  FeedbackView                │
│  Reusable Components         │
└──────────────┬───────────────┘
               │
               │ Axios / HTTP
               ▼
┌──────────────────────────────┐
│        Laravel API           │
│                              │
│  Routes                      │
│  Controllers                 │
│  Validation                  │
│  Models                      │
└──────────────┬───────────────┘
               │
               │ Eloquent / SQL
               ▼
┌──────────────────────────────┐
│          MySQL               │
│                              │
│  Students                    │
│  Exams                       │
│  Exam Registrations          │
│  Feedback                    │
└──────────────────────────────┘
```

This separation allows the frontend and backend to be developed and tested independently.

---

## 4. Repository Structure

```text
astech-exam-feedback/
│
├── backend/
│   │
│   ├── app/
│   │   ├── Http/
│   │   ├── Models/
│   │   └── ...
│   │
│   ├── database/
│   │   ├── migrations/
│   │   └── seeders/
│   │
│   ├── routes/
│   │   └── api.php
│   │
│   ├── .env.example
│   └── ...
│
├── frontend/
│   │
│   ├── src/
│   │   ├── assets/
│   │   ├── components/
│   │   ├── services/
│   │   └── views/
│   │
│   ├── package.json
│   └── ...
│
└── README.md
```

---

# 5. Implemented Features

## Student Login

The application provides a student login workflow.

After successful login, the student's information is made available to the feedback workflow.

## Registered Exam Retrieval

The Feedback page retrieves exams associated with the logged-in student through the backend API.

Example:

```http
GET /api/student/exam?student_id={student_id}
```

The returned exam information is used to populate the exam selection field.

## Exam Selection

Students can select an exam from their registered exams.

The selected exam's date is displayed automatically.

## Question Feedback

Students can provide feedback for a specific exam question.

The form includes:

* Question number
* Problem categories
* Specific feedback

### Available problem categories

* Not covered in notes
* Question / answers unclear
* More than one correct answer
* No correct answer
* Question difficult to understand
* Missing information

Multiple problem categories can be selected for a single question.

## Feedback Submission

Feedback is submitted to the Laravel backend through:

```http
POST /api/feedback
```

Example request:

```json
{
  "student_id": 1,
  "exam_id": 1,
  "question_number": 1,
  "problems": [
    "unclear",
    "missing_info"
  ],
  "specific_feedback": "The question was unclear and additional information was required.",
  "feedback_date": "2026-09-22"
}
```

## Validation

The frontend validates:

* Student login information
* Exam selection
* Question number
* Feedback content

A submission must contain at least one problem category or specific feedback.

Backend validation is also applied before the data is persisted.

## Logout

A Logout button is provided in the top-right corner of the Feedback page.

The logout workflow:

```text
Logout
   │
   ▼
Remove stored student information
   │
   ▼
Redirect to Login
```

---

# 6. API Endpoints

## Get Registered Exams

```http
GET /api/student/exam
```

### Query Parameter

```text
student_id
```

### Example

```http
GET /api/student/exam?student_id=1
```

---

## Submit Feedback

```http
POST /api/feedback
```

### Request Body

```json
{
  "student_id": 1,
  "exam_id": 1,
  "question_number": 1,
  "problems": [
    "unclear"
  ],
  "specific_feedback": "The question wording could be clearer.",
  "feedback_date": "2026-09-22"
}
```

---

# 7. Database

The application uses MySQL as the persistence layer.

The database contains the core entities required for the exam feedback workflow:

```text
Student
   │
   │
   ▼
Exam Registration
   │
   ▼
Exam
   │
   ▼
Feedback
```

Laravel migrations are used to manage the database schema.

Seeders are provided to create development/test data.

Relevant seeders include:

* `StudentSeeder`
* `ExamSeeder`
* `ExamStudentSeeder`
* `DatabaseSeeder`

---

# 8. Backend Setup

Navigate to the backend directory:

```bash
cd backend
```

Install dependencies:

```bash
composer install
```

Create the environment configuration:

```bash
cp .env.example .env
```

Generate the application key:

```bash
php artisan key:generate
```

Configure the MySQL database in `.env`.

Example:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=exam_feedback
DB_USERNAME=root
DB_PASSWORD=
```

Run migrations:

```bash
php artisan migrate
```

Seed the database:

```bash
php artisan db:seed
```

Start the Laravel development server:

```bash
php artisan serve
```

The backend will normally run at:

```text
http://127.0.0.1:8000
```

---

# 9. Frontend Setup

Navigate to the frontend directory:

```bash
cd frontend
```

Install dependencies:

```bash
npm install
```

Start the development server:

```bash
npm run dev
```

Vite will display the local frontend URL in the terminal.

---

# 10. API Configuration

The frontend Axios configuration is maintained in:

```text
frontend/src/services/api.ts
```

The configured API base URL should point to the Laravel backend.

Example:

```text
http://127.0.0.1:8000/api
```

---

# 11. Error Handling

The application handles common API and validation scenarios.

Examples include:

* No logged-in student
* Invalid student information
* No registered exams
* API endpoint not found
* Validation errors
* Server errors
* Failed feedback submission

The frontend displays appropriate messages to help the user understand the problem.

---

# 12. Testing

## Manual Frontend Testing

The following workflow should be verified:

1. Open the Login page.
2. Log in with a valid student account.
3. Open the Feedback page.
4. Confirm student details are displayed.
5. Confirm registered exams are loaded.
6. Select an exam.
7. Confirm the exam date is displayed.
8. Enter a question number.
9. Select one or more problem categories.
10. Enter specific feedback.
11. Submit the feedback.
12. Confirm successful submission.
13. Confirm the form is reset.
14. Select Logout.
15. Confirm redirection to the Login page.

## API Testing

API endpoints can be tested independently using Postman.

Recommended test cases include:

* Valid student exam request
* Invalid student ID
* Valid feedback submission
* Missing exam ID
* Invalid question number
* Empty feedback
* Invalid student ID
* Server/database failure

---

# 13. Git Branching Strategy

The project uses feature-based development.

Current feature branch:

```text
feature/feedback-submission
```

The feature branch contains the implementation of:

* Feedback database changes
* Feedback API
* Feedback UI
* Feedback validation
* Feedback submission
* Logout functionality
* Related seed data

Recommended workflow:

```text
main
  │
  ▼
dev
  │
  └── feature/feedback-submission
```

After development and testing, the feature branch can be reviewed and merged into the development branch through a Pull Request.

---

# 14. Development Standards

The implementation follows the following principles:

* Separation of frontend and backend responsibilities
* Reusable Vue components
* REST API communication
* Database migrations and seeders
* Input validation
* Error handling
* Meaningful Git commits
* Feature-based branching
* Clear project documentation

---

# 15. Future Enhancements

Potential future improvements include:

* Secure token-based authentication
* Student feedback history
* Admin feedback management
* Feedback reporting and analytics
* Search and filtering
* Pagination
* Automated unit and integration tests
* Role-based access control
* Improved accessibility
* Production environment configuration

---

# 16. Author

**Sreekutty K. Ajamalan**

---

## Project Status

**Feature:** Exam Feedback Submission

**Branch:** `feature/feedback-submission`

**Status:** Development / Assessment Implementation
# astech-exam-feedback
A web application for students to submit feedback on exam questions, built with Vue.js, Laravel REST API, MySQL, Axios, and PWA technologies.
