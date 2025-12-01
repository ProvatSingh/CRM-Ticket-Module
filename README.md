📘 CRM Ticket Module – Full Documentation

A lightweight CRM-style ticketing system built using PHP, HTML, CSS/SCSS, and JavaScript.
This documentation explains the architecture, folder structure, routing, authentication, ticket management, file uploads, and deployment process.

1. Overview

The CRM Ticket Module allows users to:

✔ Register an account
✔ Log in / Log out
✔ Create support or task-based tickets
✔ Attach files to tickets
✔ Assign tickets to other users
✔ Edit/update tickets
✔ View tickets created by them
✔ View tickets assigned to them

The system follows a simple, modular PHP structure with minimal dependencies.

Live Deployment

https://crm-ticket-module.fwh.is

2. Folder Structure
/ (root)
├── index.php                 → Dashboard / homepage
├── header.php                → Common layout header
├── footer.php                → Common layout footer
│
├── auth/
│   ├── login.php             → User login form + logic
│   ├── logout.php            → Logs out the session
│   └── register.php          → User registration
│
├── components/
│   └── user-session-start.php → Starts PHP session + session checks
│
├── tickets/
│   ├── create.php            → Create ticket form + processing
│   ├── edit.php              → Edit/update ticket logic
│   ├── created-list.php      → Tickets created by logged-in user
│   └── assigned-list.php     → Tickets assigned to user / update ticket status
│
├── assets/
│   ├── css/                  → Compiled CSS files
│   ├── js/                   → Client-side scripts
│   └── images/               → UI images/icons
│
├── uploads/                  → Uploaded ticket files (images)
│
└── config/
    └── db.php                → Database connection script

--------

3. Database Structure
3.1 users Table
** id	INT (PK)	Unique user ID
** name	VARCHAR	Full name
** email	VARCHAR	Login email (unique)
** password	VARCHAR	Hashed password (bcrypt)
   
3.2 tickets Table
** id	INT (PK)	Unique ticket ID
** name	VARCHAR	Ticket title
** description	TEXT	Full description
** status	VARCHAR	Ticket status (e.g., Open, In Progress, Done)
** file	VARCHAR	File path of uploaded document
** assignee_to	INT (FK)	User ID assigned to handle the ticket status
** created_by	INT (FK)	User ID who created the ticket
** created_at	TIMESTAMP	Timestamp of creation
** updated_at	TIMESTAMP	Timestamp of latest update

--------

4. System Workflow
4.1 Authentication Flow

User registers using register.php

Password stored using password_hash()

User logs in through login.php

PHP session is created

user-session-start.php ensures protected pages require login

--------

5. Ticket Management
5.1 Create Ticket (tickets/create.php)

Users can:

✓ Enter ticket name
✓ Add detailed description
✓ Upload a file (images)
✓ Assign to another user
✓ Edit ticket

Uploaded files are moved to /uploads/.

5.2 Edit Ticket (tickets/edit.php)

Users can:

✓ Update ticket name
✓ Change description
✓ Reassign ticket
✓ Replace attachment

Existing file is replaced if a new one is uploaded.

5.3 Ticket Lists
Created Tickets (tickets/created-list.php)

Shows tickets where:

created_by = logged_in_user_id

Assigned Tickets (tickets/assigned-list.php)

Shows tickets where:

assignee_to = logged_in_user_id

--------

6. File Upload System

Uploaded files follow this path:

/uploads/{unique_file_name.ext}

File handling features include:

✔ Secure move using move_uploaded_file()

--------

7. Routing Flow (Simple PHP Routing)

Example flow:

User visits index.php → Session check → Show dashboard
Click "Create Ticket" → Redirect to tickets/create.php
Submit → Save to DB → Redirect to created-list.php

8. Deployment Guide (Live Server)
This project is hosted using:

Source Code: GitHub
Repository: https://github.com/ProvatSingh/CRM-Ticket-Module

Hosting Provider: InfinityFree (https://www.infinityfree.com/)

Database: MySQL (provided by InfinityFree)

--------

9. Security 
✔ Passwords are hashed
✔ Sessions prevent unauthorized access
