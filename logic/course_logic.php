<?php
require_once 'database.php';

class CourseLogic
{
    private $db;
    private $conn;

    public function __construct()
    {
        $this->db = new Database();
        $this->conn = $this->db->getConnection();
    }

    public function getAllCourses()
    {
        try {
            $sql = "SELECT * FROM Courses ORDER BY course_name";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll();
        } catch (PDOException $e) {
            throw new Exception("Error fetching courses: " . $e->getMessage());
        }
    }
    public function getCourseById($id)
    {
        try {
            $sql = "SELECT * FROM Courses WHERE id = :id";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetch();
        } catch (PDOException $e) {
            throw new Exception("Error fetching course: " . $e->getMessage());
        }
    }
}