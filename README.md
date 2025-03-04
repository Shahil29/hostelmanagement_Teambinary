# ULAB Hostel Management System (UHMS)

## Introduction
Managing hostel accommodations for students at the **University of Liberal Arts Bangladesh (ULAB)** is a critical challenge as ULAB does not have its own hostel. Many students struggle to find suitable rooms. This project aims to develop a **ULAB Hostel Management System (UHMS)** that provides an automated platform for students to book rooms, track fee payments, and allow admins to efficiently manage hostel operations.

## Features
### Student Features
- Register/Login securely
- Search for available hostel rooms
- Book hostel rooms
- View booking history
- Make online payments for fees
- View payment history
- Provide feedback on hostels

### Admin Features
- Register/Login securely
- Manage student records
- Update system data
- Approve/Reject booking requests
- Manage room allocations
- Track fee payments

### Landlord Features
- Register/Login securely
- List rooms for rent
- Update room details

## Problem Statement
Managing hostel rooms, student details, and fees manually is inefficient, prone to errors, and time-consuming. Hostel managers face difficulties in tracking room availability, student bookings, and fee payments, leading to operational inefficiencies.

## Objectives
1. Enable students to register and book hostel rooms online.
2. Allow admins to manage room allocations and student fees.
3. Automate room availability updates to ensure real-time accuracy.
4. Track fee payments and outstanding balances.
5. Allow landlords to register and upload flat descriptions and images.
6. Provide detailed hostel information, including amenities, costs, and availability specific to ULAB students.
7. Ensure a secure and scalable system to manage data effectively.

## Technology Stack
- **Frontend:** HTML, CSS, JavaScript
- **Backend:** PHP
- **Database:** MySQL
- **Deployment:** Web hosting service (Apache, MySQL Server)

## System Architecture
- **Client-Server Model:**
  - **Frontend:** User-friendly web interface for ULAB students, landlords, and admins.
  - **Backend:** Secure database and processing logic.
  - **Database:** Stores student data, room availability, fee records, and booking history.

## Methodology
The project follows the **Agile development methodology**, allowing incremental feature development and regular user feedback.

### Development Phases
1. **Requirement Analysis:** Conduct surveys and interviews with ULAB students.
2. **System Design:** Create UI mockups and database schema.
3. **Implementation:** Develop frontend and backend components.
4. **Testing:** Perform unit, integration, and user acceptance testing.
5. **Deployment & Maintenance:** Host the system and ensure continuous updates.

## Tools & Resources
- **Development Tools:** VS Code, XAMPP
- **Hosting & Deployment:** Apache, MySQL server
- **User Feedback Tools:** Google Forms for surveys

## Expected Outcomes
The final product will provide an **efficient, automated system** for managing hostel rooms and student information. It will simplify room allocations and fee tracking, resulting in improved operational efficiency.

## Installation & Setup
1. Clone the repository:
   ```bash
   git clone https://github.com/your-username/ulab-hostel-management.git
   ```
2. Navigate to the project directory:
   ```bash
   cd ulab-hostel-management
   ```
3. Start the XAMPP server and configure **Apache** and **MySQL**.
4. Import the database:
   - Open **phpMyAdmin** and create a new database (e.g., `ulab_hostel`).
   - Import the `ulab_hostel.sql` file from the project folder.
5. Update database connection settings in `config.php`.
6. Start the server:
   - Place the project files inside the `htdocs` folder of XAMPP.
   - Open a browser and navigate to `http://localhost/ulab-hostel-management`.

## Contribution Guidelines
1. Fork the repository.
2. Create a new branch for your feature/bug fix.
3. Commit your changes with meaningful commit messages.
4. Push to your branch and create a pull request.

## License
This project is open-source and available under the **MIT License**.

## Contact
For any queries, reach out to **Md Shahil Siyam** (Project Lead) at shahil.siyam.cse@ulab.edu.bd
