## 🩸 Blood Donation & Management System

This system is designed to streamline the process of blood donation, hospital coordination, and donor engagement through a modern web platform. It provides an intuitive interface for hospitals, medical staff, and donors, aiming to make blood donation more efficient, transparent, and accessible.

### 🚀 Key Features

#### 🔐 Role-Based Access

* **Super Admin**: Only system creators can register new hospitals.
* **Hospital Admin Panel**:

  * Register and manage **doctors**, **nurses**, and **staff**.
  * View **blood reports**, manage **blood inventory** (add/withdraw).
  * Upload **blood campaign posters** with Google Map integration.
  * Create and manage **blood requests** with critical levels (Low/Medium/High) by district.
  * Register users who lack technical knowledge to use the app.
  * Receive email alerts for new **donor registrations** and **staff onboarding**.

#### 🏥 Medical Staff

* Doctors, staff, and nurses can:

  * Add and manage other medical users (doctor, staff, nurse).
  * Access the hospital panel based on their roles.

#### 👤 User Portal

* Register as a **donor** through the web app or by admin registration.
* Add personal details like **blood type** and **weight**.
* Donate blood after undergoing a **health checkup** and optional **counseling** session.
* Book **appointments** for checkups and counseling.
* View **blood request notifications** (including for friends with compatible blood types).
* Update account information and password.
* View **blood campaign posters** uploaded by hospitals. Clicking the poster opens the event location in **Google Maps**.

#### 📢 Notification System

* Real-time **in-app notifications** for blood requests based on:

  * Matching **blood type**
  * Matching **district**
* **Email alerts** are sent to all relevant users when a hospital posts a new blood request.

---

### 📍 Smart Blood Request Matching

When a hospital posts a blood request:

* It is tagged with a **district** and **urgency level** (High/Medium/Low).
* All users who match the blood type and district receive an **email notification**.
* Other users can still view the request in the app and **share it with friends**.

---

### 💡 Technologies Used

* Frontend: *\HTML, CSS, Bootstrap*
* Backend: *\PHP*
* Database: *\MySQL*
* Email Service: *\PHPMailer*
* Maps: **Google Maps**

---

### 🧪 Future Enhancements

* SMS alerts for critical blood shortages.
* Mobile app integration.
* Donor history and recognition system.

---

> ❤️ Together, we can save lives — one drop at a time.

---

