# Student Management System

A comprehensive web-based student management system built with PHP 8.2 and Microsoft SQL Server. This application provides an intuitive interface for managing student records, courses, and generating insightful statistics.

## Features

- **Dashboard Overview**: Real-time statistics including total students, active students, course count, and recent enrollments
- **Student Management**: Complete CRUD operations for student records
- **Course Management**: Manage available courses and departments
- **Responsive Design**: Bootstrap-based UI that works on all devices
- **Data Validation**: Secure input validation and error handling
- **Search and Filter**: Easy navigation and data retrieval

## Prerequisites

Before running this application, ensure you have the following installed:

- **PHP 8.2** or higher
- **Microsoft SQL Server** (2016 or later recommended)
- **Web Server** (Apache/Nginx) - XAMPP recommended for development
- **Composer** (optional, for dependency management)

## Installation

### 1. Clone the Repository

```bash
git clone <repository-url>
cd student-system
```

### 2. Install PHP SQL Server Driver

#### For Windows (XAMPP):

1. Download the Microsoft Drivers for PHP for SQL Server from the [official Microsoft website](https://docs.microsoft.com/en-us/sql/connect/php/download-drivers-php-sql-server).

2. Choose the appropriate version for your PHP 8.2 installation:

   - For PHP 8.2 (Thread Safe): Download `SQLSRV_82_NT.zip` or `SQLSRV_82_x64.zip` depending on your architecture

3. Extract the downloaded zip file and copy the following files to your PHP extensions directory:

   - `php_sqlsrv_82_nts.dll` (or `php_sqlsrv_82_ts.dll` if using thread-safe)
   - `php_pdo_sqlsrv_82_nts.dll` (or `php_pdo_sqlsrv_82_ts.dll` if using thread-safe)

   **Location**: `C:\xampp\php\ext\` (for XAMPP)

4. Edit your `php.ini` file (located at `C:\xampp\php\php.ini`) and add the following lines under the `[ExtensionList]` section:

   ```ini
   extension=php_sqlsrv_82_nts.dll
   extension=php_pdo_sqlsrv_82_nts.dll
   ```

5. Restart your Apache server through XAMPP control panel.

#### For Linux/Ubuntu:

```bash
# Install Microsoft ODBC Driver for SQL Server
curl https://packages.microsoft.com/keys/microsoft.asc | apt-key add -
curl https://packages.microsoft.com/config/ubuntu/20.04/prod.list > /etc/apt/sources.list.d/mssql-release.list
apt-get update
ACCEPT_EULA=Y apt-get install -y msodbcsql18

# Install PHP SQL Server extension
pecl install sqlsrv pdo_sqlsrv

# Add extensions to PHP configuration
echo "extension=sqlsrv.so" >> /etc/php/8.2/apache2/php.ini
echo "extension=pdo_sqlsrv.so" >> /etc/php/8.2/apache2/php.ini

# Restart Apache
systemctl restart apache2
```

#### Verification:

Create a test PHP file to verify the installation:

```php
<?php
if (extension_loaded('sqlsrv')) {
    echo "SQLSRV extension is loaded.";
} else {
    echo "SQLSRV extension is not loaded.";
}

if (extension_loaded('pdo_sqlsrv')) {
    echo "PDO_SQLSRV extension is loaded.";
} else {
    echo "PDO_SQLSRV extension is not loaded.";
}
?>
```

### 3. Database Setup

1. **Create Database**:

   - Open SQL Server Management Studio (SSMS)
   - Connect to your SQL Server instance
   - Execute the `db.sql` script located in the project root to create the database and tables

2. **Alternative - Using SQLCMD**:
   ```bash
   sqlcmd -S your-server-name -U sa -P your-password -i db.sql
   ```

## Configuration

1. **Database Configuration**:

   - Open `config/config.json`
   - Update the connection details:
     ```json
     {
       "serverName": "YOUR_SQL_SERVER_INSTANCE",
       "database": "StudentSystem",
       "uid": "YOUR_USERNAME",
       "pwd": "YOUR_PASSWORD"
     }
     ```

2. **Web Server Configuration**:
   - Place the project in your web server's document root
   - For XAMPP: `C:\xampp\htdocs\student-system`
   - Ensure the web server has read/write permissions to the project directory

## Running the Application

1. **Start your web server** (Apache/Nginx)
2. **Access the application**:
   - Open your browser and navigate to: `http://localhost/student-system`
   - The application will redirect to the dashboard

## Usage

### Dashboard

- View overall statistics and recent student enrollments
- Access quick actions for adding students and viewing all records

### Student Management

- **Add Student**: Navigate to "Add New Student" to create new student records
- **View Students**: Browse all students with search and filter capabilities
- **Edit Student**: Update student information as needed
- **View Details**: See complete student profile information

### Course Management

- View available courses and their details
- Manage course offerings and departments

## Project Structure

```
student-system/
├── assets/
│   ├── css/
│   │   ├── bootstrap.min.css
│   │   └── style.css
│   └── js/
│       └── main.js
├── config/
│   └── config.json          # Database configuration
├── db/
├── includes/
│   ├── header.php           # HTML head and navigation
│   ├── sidebar.php          # Sidebar navigation
│   └── footer.php           # Page footer
├── logic/
│   ├── database.php         # Database connection class
│   ├── student_logic.php    # Student business logic
│   └── course_logic.php     # Course business logic
├── pages/
│   ├── dashboard.php        # Main dashboard
│   ├── students.php         # Student listing
│   ├── add_student.php      # Add new student form
│   ├── edit_student.php     # Edit student form
│   ├── view_student.php     # View student details
│   └── courses.php          # Course management
├── index.php                # Entry point
├── db.sql                   # Database schema
└── README.md               # This file
```

## Technologies Used

- **Backend**: PHP 8.2
- **Database**: Microsoft SQL Server
- **Frontend**: HTML5, CSS3, JavaScript
- **Framework**: Bootstrap 5
- **Icons**: Font Awesome
- **Database Driver**: Microsoft SQL Server Driver for PHP

## Database Schema

### Students Table

- `id` (Primary Key)
- `student_id` (Unique)
- `first_name`, `last_name`
- `email` (Unique)
- `phone`, `address`
- `birth_date`, `gender`
- `course`, `year_level`, `status`
- `created_at`, `updated_at`

### Courses Table

- `id` (Primary Key)
- `course_code` (Unique)
- `course_name`
- `department`
- `duration_years`
- `created_at`

## Troubleshooting

### Common Issues

1. **Connection Failed Error**:

   - Verify SQL Server is running
   - Check database credentials in `config.json`
   - Ensure SQL Server Browser service is running
   - Confirm firewall settings allow SQL Server connections

2. **Extension Not Loaded**:

   - Verify PHP extensions are properly installed
   - Check `php.ini` for correct extension paths
   - Restart web server after configuration changes

3. **Permission Errors**:
   - Ensure web server has read/write access to project files
   - Check file permissions on `config/config.json`

## Contributing

1. Fork the repository
2. Create a feature branch (`git checkout -b feature/AmazingFeature`)
3. Commit your changes (`git commit -m 'Add some AmazingFeature'`)
4. Push to the branch (`git push origin feature/AmazingFeature`)
5. Open a Pull Request

## License

This project is licensed under the MIT License - see the [LICENSE](LICENSE) file for details.

## Support

For support and questions, please open an issue on the GitHub repository or contact the development team.

---

**Note**: This application is designed for educational institutions to manage student information efficiently. Always ensure compliance with data protection regulations when handling personal information.
