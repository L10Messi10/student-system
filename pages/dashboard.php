<?php
require_once '../includes/header.php';
require_once '../includes/sidebar.php';
require_once '../logic/student_logic.php';
require_once '../logic/course_logic.php';

$studentLogic = new StudentLogic();
$courseLogic = new CourseLogic();

try {
    $stats = $studentLogic->getStudentStats();
    $recentStudents = $studentLogic->getAllStudents();
    $recentStudents = array_slice($recentStudents, 0, 5);
    $totalCourses = count($courseLogic->getAllCourses());
} catch (Exception $e) {
    $error = $e->getMessage();
}
?>

<div class="content">
    <div class="container-fluid">
        <h2 class="mb-4">Dashboard</h2>

        <?php if (isset($error)): ?>
            <div class="alert alert-danger"><?php echo $error; ?></div>
        <?php endif; ?>

        <!-- Statistics Cards -->
        <div class="row mb-4">
            <div class="col-md-3 mb-3">
                <div class="card stat-card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <div>
                                <h4 class="mb-0"><?php echo $stats['total'] ?? 0; ?></h4>
                                <p class="mb-0">Total Students</p>
                            </div>
                            <i class="fas fa-users"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3 mb-3">
                <div class="card stat-card" style="background: linear-gradient(135deg, #56ab2f 0%, #a8e063 100%);">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <div>
                                <h4 class="mb-0"><?php echo $stats['active'] ?? 0; ?></h4>
                                <p class="mb-0">Active Students</p>
                            </div>
                            <i class="fas fa-user-check"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3 mb-3">
                <div class="card stat-card" style="background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <div>
                                <h4 class="mb-0"><?php echo $totalCourses ?? 0; ?></h4>
                                <p class="mb-0">Courses</p>
                            </div>
                            <i class="fas fa-book"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3 mb-3">
                <div class="card stat-card" style="background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <div>
                                <h4 class="mb-0"><?php echo $stats['recent'] ?? 0; ?></h4>
                                <p class="mb-0">New This Week</p>
                            </div>
                            <i class="fas fa-user-plus"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Recent Students -->
        <div class="row">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h5 class="mb-0">Recent Students</h5>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Student ID</th>
                                        <th>Name</th>
                                        <th>Course</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (!empty($recentStudents)): ?>
                                        <?php foreach ($recentStudents as $student): ?>
                                            <tr>
                                                <td><?php echo htmlspecialchars($student['student_id']); ?></td>
                                                <td><?php echo htmlspecialchars($student['first_name'] . ' ' . $student['last_name']); ?>
                                                </td>
                                                <td><?php echo htmlspecialchars($student['course']); ?></td>
                                                <td>
                                                    <span
                                                        class="badge bg-<?php echo $student['status'] == 'Active' ? 'success' : 'secondary'; ?>">
                                                        <?php echo htmlspecialchars($student['status']); ?>
                                                    </span>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    <?php else: ?>
                                        <tr>
                                            <td colspan="4" class="text-center">No students found</td>
                                        </tr>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">
                        <h5 class="mb-0">Quick Actions</h5>
                    </div>
                    <div class="card-body">
                        <div class="d-grid gap-2">
                            <a href="add_student.php" class="btn btn-primary">
                                <i class="fas fa-plus me-2"></i>Add New Student
                            </a>
                            <a href="students.php" class="btn btn-outline-primary">
                                <i class="fas fa-list me-2"></i>View All Students
                            </a>
                            <button class="btn btn-outline-secondary">
                                <i class="fas fa-download me-2"></i>Export Data
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require_once '../includes/footer.php'; ?>