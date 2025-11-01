<?php
require_once 'database.php';

class StudentLogic
{
    private $db;
    private $conn;

    public function __construct()
    {
        $this->db = new Database();
        $this->conn = $this->db->getConnection();
    }

    public function getAllStudents()
    {
        try {
            $sql = "SELECT * FROM Students ORDER BY last_name, first_name";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll();
        } catch (PDOException $e) {
            throw new Exception("Error fetching students: " . $e->getMessage());
        }
    }

    public function getStudentById($id)
    {
        try {
            $sql = "SELECT * FROM Students WHERE id = :id";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetch();
        } catch (PDOException $e) {
            throw new Exception("Error fetching student: " . $e->getMessage());
        }
    }

    public function addStudent($data)
    {
        try {
            $sql = "INSERT INTO Students (student_id, first_name, last_name, email, phone, address, 
                    birth_date, gender, course, year_level, status) 
                    VALUES (:student_id, :first_name, :last_name, :email, :phone, :address, 
                    :birth_date, :gender, :course, :year_level, :status)";

            $stmt = $this->conn->prepare($sql);

            // Bind parameters
            $stmt->bindParam(':student_id', $data['student_id']);
            $stmt->bindParam(':first_name', $data['first_name']);
            $stmt->bindParam(':last_name', $data['last_name']);
            $stmt->bindParam(':email', $data['email']);
            $stmt->bindParam(':phone', $data['phone']);
            $stmt->bindParam(':address', $data['address']);
            $stmt->bindParam(':birth_date', $data['birth_date']);
            $stmt->bindParam(':gender', $data['gender']);
            $stmt->bindParam(':course', $data['course']);
            $stmt->bindParam(':year_level', $data['year_level'], PDO::PARAM_INT);
            $stmt->bindParam(':status', $data['status']);

            return $stmt->execute();
        } catch (PDOException $e) {
            throw new Exception("Error adding student: " . $e->getMessage());
        }
    }

    public function updateStudent($id, $data)
    {
        try {
            $sql = "UPDATE Students SET first_name = :first_name, last_name = :last_name, 
                    email = :email, phone = :phone, address = :address, birth_date = :birth_date, 
                    gender = :gender, course = :course, year_level = :year_level, 
                    status = :status 
                    WHERE id = :id";

            $stmt = $this->conn->prepare($sql);

            // Bind parameters
            $stmt->bindParam(':first_name', $data['first_name']);
            $stmt->bindParam(':last_name', $data['last_name']);
            $stmt->bindParam(':email', $data['email']);
            $stmt->bindParam(':phone', $data['phone']);
            $stmt->bindParam(':address', $data['address']);
            $stmt->bindParam(':birth_date', $data['birth_date']);
            $stmt->bindParam(':gender', $data['gender']);
            $stmt->bindParam(':course', $data['course']);
            $stmt->bindParam(':year_level', $data['year_level'], PDO::PARAM_INT);
            $stmt->bindParam(':status', $data['status']);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);

            return $stmt->execute();
        } catch (PDOException $e) {
            throw new Exception("Error updating student: " . $e->getMessage());
        }
    }

    public function deleteStudent($id)
    {
        try {
            $sql = "DELETE FROM Students WHERE id = :id";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            return $stmt->execute();
        } catch (PDOException $e) {
            throw new Exception("Error deleting student: " . $e->getMessage());
        }
    }

    public function getStudentStats()
    {
        try {
            $stats = [];

            // Total students
            $stmt = $this->conn->prepare("SELECT COUNT(*) as total FROM Students");
            $stmt->execute();
            $stats['total'] = $stmt->fetch()['total'];

            // Active students
            $stmt = $this->conn->prepare("SELECT COUNT(*) as active FROM Students WHERE status = 'Active'");
            $stmt->execute();
            $stats['active'] = $stmt->fetch()['active'];

            // Inactive students
            $stmt = $this->conn->prepare("SELECT COUNT(*) as inactive FROM Students WHERE status = 'Inactive'");
            $stmt->execute();
            $stats['inactive'] = $stmt->fetch()['inactive'];

            // Recent students (last 7 days)
            $stmt = $this->conn->prepare("SELECT COUNT(*) as recent FROM Students WHERE created_at >= DATEADD(day, -7, GETDATE())");
            $stmt->execute();
            $stats['recent'] = $stmt->fetch()['recent'];

            return $stats;
        } catch (PDOException $e) {
            throw new Exception("Error fetching stats: " . $e->getMessage());
        }
    }

    public function searchStudents($keyword)
    {
        try {
            $sql = "SELECT * FROM Students 
                WHERE student_id LIKE :kw1 
                OR first_name LIKE :kw2 
                OR last_name LIKE :kw3 
                OR email LIKE :kw4 
                OR course LIKE :kw5 
                ORDER BY last_name, first_name";

            $searchTerm = "%{$keyword}%";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':kw1', $searchTerm);
            $stmt->bindParam(':kw2', $searchTerm);
            $stmt->bindParam(':kw3', $searchTerm);
            $stmt->bindParam(':kw4', $searchTerm);
            $stmt->bindParam(':kw5', $searchTerm);
            $stmt->execute();

            return $stmt->fetchAll();
        } catch (PDOException $e) {
            throw new Exception("Error searching students: " . $e->getMessage());
        }
    }

}