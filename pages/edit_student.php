<?php
require_once '../includes/header.php';
require_once '../includes/sidebar.php';
require_once '../logic/student_logic.php';
require_once '../logic/course_logic.php';

$studentLogic = new StudentLogic();
$courseLogic = new CourseLogic();
$message = '';
$error = '';

if (!isset($_GET['id'])) {
    header('Location: students.php');
    exit();
}

try {
    $student = $studentLogic->getStudentById($_GET['id']);
    $courses = $courseLogic->getAllCourses();

    if (!$student) {
        $error = "Student not found";
    }
} catch (Exception $e) {
    $error = $e->getMessage();
    $student = null;
    $courses = [];
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && $student) {
    $data = [
        'first_name' => $_POST['first_name'],
        'last_name' => $_POST['last_name'],
        'email' => $_POST['email'],
        'phone' => $_POST['phone'],
        'address' => $_POST['address'],
        'birth_date' => $_POST['birth_date'],
        'gender' => $_POST['gender'],
        'course' => $_POST['course'],
        'year_level' => $_POST['year_level'],
        'status' => $_POST['status']
    ];

    try {
        if ($studentLogic->updateStudent($_GET['id'], $data)) {
            $message = "Student updated successfully!";
            // Refresh student data
            $student = $studentLogic->getStudentById($_GET['id']);
        }
    } catch (Exception $e) {
        $error = $e->getMessage();
    }
}
?>

<div class="content">
    <div class="container-fluid">
        <h2 class="mb-4">Edit Student</h2>

        <?php if ($message): ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <?php echo $message; ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        <?php endif; ?>

        <?php if ($error): ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <?php echo $error; ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        <?php endif; ?>

        <?php if ($student): ?>
            <div class="card">
                <div class="card-body">
                    <form method="POST" action="">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Student ID</label>
                                <input type="text" class="form-control"
                                    value="<?php echo htmlspecialchars($student['student_id']); ?>" readonly>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" id="email" name="email"
                                    value="<?php echo htmlspecialchars($student['email']); ?>" required>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="first_name" class="form-label">First Name</label>
                                <input type="text" class="form-control" id="first_name" name="first_name"
                                    value="<?php echo htmlspecialchars($student['first_name']); ?>" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="last_name" class="form-label">Last Name</label>
                                <input type="text" class="form-control" id="last_name" name="last_name"
                                    value="<?php echo htmlspecialchars($student['last_name']); ?>" required>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="phone" class="form-label">Phone</label>
                                <input type="text" class="form-control" id="phone" name="phone"
                                    value="<?php echo htmlspecialchars($student['phone']); ?>">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="birth_date" class="form-label">Birth Date</label>
                                <input type="date" class="form-control" id="birth_date" name="birth_date"
                                    value="<?php echo htmlspecialchars($student['birth_date']); ?>">
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="gender" class="form-label">Gender</label>
                                <select class="form-select" id="gender" name="gender">
                                    <option value="">Select Gender</option>
                                    <option value="Male" <?php echo $student['gender'] == 'Male' ? 'selected' : ''; ?>>Male
                                    </option>
                                    <option value="Female" <?php echo $student['gender'] == 'Female' ? 'selected' : ''; ?>>
                                        Female</option>
                                    <option value="Other" <?php echo $student['gender'] == 'Other' ? 'selected' : ''; ?>>Other
                                    </option>
                                </select>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="status" class="form-label">Status</label>
                                <select class="form-select" id="status" name="status">
                                    <option value="Active" <?php echo $student['status'] == 'Active' ? 'selected' : ''; ?>>
                                        Active</option>
                                    <option value="Inactive" <?php echo $student['status'] == 'Inactive' ? 'selected' : ''; ?>>Inactive</option>
                                </select>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="course" class="form-label">Course</label>
                                <select class="form-select" id="course" name="course">
                                    <option value="">Select Course</option>
                                    <?php foreach ($courses as $course): ?>
                                        <option value="<?php echo htmlspecialchars($course['course_name']); ?>" <?php echo $student['course'] == $course['course_name'] ? 'selected' : ''; ?>>
                                            <?php echo htmlspecialchars($course['course_name']); ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="year_level" class="form-label">Year Level</label>
                                <select class="form-select" id="year_level" name="year_level">
                                    <option value="">Select Year</option>
                                    <option value="1" <?php echo $student['year_level'] == '1' ? 'selected' : ''; ?>>1st Year
                                    </option>
                                    <option value="2" <?php echo $student['year_level'] == '2' ? 'selected' : ''; ?>>2nd Year
                                    </option>
                                    <option value="3" <?php echo $student['year_level'] == '3' ? 'selected' : ''; ?>>3rd Year
                                    </option>
                                    <option value="4" <?php echo $student['year_level'] == '4' ? 'selected' : ''; ?>>4th Year
                                    </option>
                                    <option value="5" <?php echo $student['year_level'] == '5' ? 'selected' : ''; ?>>5th Year
                                    </option>
                                </select>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="address" class="form-label">Address</label>
                            <textarea class="form-control" id="address" name="address"
                                rows="3"><?php echo htmlspecialchars($student['address']); ?></textarea>
                        </div>

                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save me-2"></i>Update Student
                            </button>
                            <a href="students.php" class="btn btn-secondary">
                                <i class="fas fa-times me-2"></i>Cancel
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        <?php endif; ?>
    </div>
</div>

<?php require_once '../includes/footer.php'; ?>