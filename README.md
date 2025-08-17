# 📸 Sahasra Studio Management System  

## 🎯 Overview  
The **Sahasra Studio Management System** is a **comprehensive web application** designed to manage a photography studio's daily operations, including **customer bookings, equipment rentals, product sales, employee management, and financial reporting**.  

---

## 🧩 System Components  

### 🔐 Authentication System  
- 👥 Separate login interfaces for **Managers** and **Employees**  
- 🔑 Session-based authentication with PHP  
- 🔒 Basic password security (⚠️ For production: use password hashing)  

### 👨‍💼 User Roles  
- **Manager**: Full access to all features & reports  
- **Photographer**: Manage bookings & schedules  
- **Frame Maker**: Manage frame production & inventory  
- **Crew Member**: Track attendance & basic tasks  

### 🛠 Core Modules  

#### 👨‍👩‍👧 Customer Management  
- Customer registration & profiles  
- Contact form for inquiries  
- Booking system for:  
  - 📷 Event Photography  
  - 🪪 ID Photography  
  - 🏞️ Studio/Outdoor Photography  
  - 💍 Wedding Photography  

#### 📦 Inventory Management  
- Camera sales  
- Equipment rentals (cameras, lenses, drones, lighting)  
- Frame production & sublimation services  

#### 🛒 Order Processing  
- Online shop for gear & equipment  
- Rental system for photography gear  
- Order tracking & status updates  

#### 👩‍💻 Employee Management  
- Attendance tracking  
- Leave request system  
- Task assignment  
- Salary processing  

#### 📊 Reporting System  
- Orders & rentals reports  
- Booking analytics  
- Profit reports  
- Customer interaction history  

---

## 🗄️ Database Structure  
MySQL database with **20+ tables** covering all aspects of operations. Key tables include:  
- `customer` → Customer information  
- `employeelog` → Employee records  
- `booking_*` → Various booking types  
- `shop_filter` → Product inventory  
- `rent_items` → Rental equipment  
- `shop_order`, `rent_order` → Transactions  
- `employee_*` → HR-related tables  

---

## ⚙️ Technical Stack  
- **Frontend**: HTML5, CSS3, JavaScript (+ Chart.js 📊)  
- **Backend**: PHP 🐘  
- **Database**: MySQL 🗄️  
- **Dependencies**:  
  - jQuery ⚡ (AJAX operations)  
  - Font Awesome 🎨 (icons)  
  - SweetAlert 🔔 (notifications)  

---

## 🛠 Installation Instructions  

### ✅ Prerequisites  
- Apache / XAMPP (Web Server)  
- PHP 7.4+  
- MySQL 5.7+  
- Browser with JavaScript enabled  

### ⚡ Setup Steps  
1. Clone repo into server directory (`htdocs` for XAMPP)  
2. Create database `sahasrastudiodb`  
3. Import provided SQL schema  
4. Update DB credentials in `db_connection.php`  
5. Set correct permissions for `/uploads`  

---

## 🚀 Usage Guide  

### 👨‍💼 For Managers  
- Dashboard access after login  
- Approve leave requests  
- Process salaries  
- Generate financial reports  
- Monitor inventory & inquiries  

### 👩‍🏫 For Employees  
- Login with employee credentials  
- Role-specific access:  
  - 📷 Photographers → Manage bookings  
  - 🖼️ Frame Makers → Frame production  
  - 👷 Crew → Attendance & tasks  

### 👩‍👩‍👧 For Customers  
- Browse products & services  
- Book photography services  
- Rent equipment  
- Purchase gear  
- Submit inquiries  

---

## 🌟 Key Features  
- 📊 Advanced reporting (orders, rentals, profits)  
- 🌍 City-wise distribution analytics  
- 📈 Monthly profit breakdowns  
- 📱 Responsive design (mobile-friendly)  
- ⚡ Dynamic charts (Chart.js)  
- 🔔 Interactive alerts (SweetAlert)  
- 🔄 AJAX form submissions  

---

## 🔒 Security Considerations  
- ✅ Session-based authentication  
- ✅ Input sanitization in PHP  
- ⚠️ Recommend adding **password hashing & CSRF protection**  

---

## 📝 Development Notes  

### 📌 Areas for Improvement  
- Implement password hashing  
- Add CSRF protection  
- Improve error handling  
- Enhance mobile responsiveness  
- Add pagination for large data sets  
- Stronger input validation  

### 🎨 Customization Points  
- `styles.css` → Main styling  
- `db_connection.php` → Database settings  
- `config.php` → App configurations  
- `/reports/` → Report templates  

---

