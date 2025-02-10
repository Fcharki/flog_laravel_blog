# Laravel Blog Application ( **_Flog Blog_** )

## 🚀 Introduction
This is a feature-rich **Laravel-powered Blog Application** with modern functionalities, built to provide a seamless user experience. It includes a full authentication system, a rich text editor for content creation, database notifications, and interactive user engagement features.
## ✨ Features
### 🔐 **Authentication & User Management**
- Full user authentication implemented using **Laravel Breeze**.
- Email verification enabled for enhanced security.
- Users can freely update their profile information.
### 📝 **Content Creation & Management**
- **Rich Text Editor**: Integrated **TinyMCE** for a flexible and powerful post-editing experience.
- **Categorization**: Posts are organized into categories to improve content discovery.
### 🔔 **User Notifications**
- **Database notifications** keep users informed about interactions with their posts.
- Notifications can be marked as **read** for better organization.
### ❤️ **User Engagement**
- Users can **like posts**, **leave reviews**, and **reply to existing reviews**.
- Interactive features enhance the blog community experience.
### 🏠 **User Dashboard**
- Users have a dedicated **dashboard** to:
  - Manage their posts.
  - View and interact with notifications.
  - Update profile settings.
---
## ⚙️ Installation & Setup
### **1️⃣ Clone the Repository**
```sh
git clone https://github.com/Fcharki/flog-laravel-blog.git
cd flog-laravel-blog
```
### **2️⃣ Install Dependencies**
```sh
composer install
npm install
```
### **3️⃣ Environment Setup**
add an environment file(.env) and generate an application key:
```sh
php artisan key:generate
```
Configure your **database credentials** in `.env`:
```sh
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=your_database_name
DB_USERNAME=your_database_user
DB_PASSWORD=your_database_password
```
### **4️⃣ Run Database Migrations**
```sh
php artisan migrate
```

### **5️⃣ Run Database Seeders**
```sh
php artisan db:seed
```


### **6️⃣ Serve the Application**
```sh
php artisan serve
```

### **7️⃣ Build Frontend Assets**
```sh
npm install && npm run dev
```

Now, visit **http://127.0.0.1:8000** in your browser! 🚀

---

## 📜 License
This project is open-source and licensed under the [MIT License](LICENSE). .  
You are free to use, modify, and distribute it as long as you include the original license.

---

## 📬 Contact
For any inquiries or support, reach out via:
- **Email**: fadma.charki101@gmail.com
- **GitHub**: [Fcharki](https://github.com/Fcharki/)

