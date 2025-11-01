<?php
require_once '../includes/header.php';
require_once '../includes/sidebar.php';
require_once '../logic/student_logic.php';

$studentLogic = new StudentLogic();
$error = '';

if (!isset($_GET['id'])) {
    header('Location: students.php');
    exit();
}

try {
    $student = $studentLogic->getStudentById($_GET['id']);
    if (!$student) {
        $error = "Student not found";
    }
} catch (Exception $e) {
    $error = $e->getMessage();
    $student = null;
}
?>

<div class="content">
    <div class="container-fluid">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2>Student Details</h2>
            <div>
                <?php if ($student): ?>
                    <a href="edit_student.php?id=<?php echo $student['id']; ?>" class="btn btn-warning">
                        <i class="fas fa-edit me-2"></i>Edit
                    </a>
                <?php endif; ?>
                <a href="students.php" class="btn btn-secondary">
                    <i class="fas fa-arrow-left me-2"></i>Back
                </a>
            </div>
        </div>

        <?php if ($error): ?>
            <div class="alert alert-danger"><?php echo $error; ?></div>
        <?php endif; ?>

        <?php if ($student): ?>
            <div class="row">
                <div class="col-md-4">
                    <div class="card text-center">
                        <div class="card-body">
                            <div class="mb-3">
                                <i class="fas fa-user-circle" style="font-size: 100px; color: #667eea;"></i>
                            </div>
                            <h4><?php echo htmlspecialchars($student['first_name'] . ' ' . $student['last_name']); ?></h4>
                            <p class="text-muted"><?php echo htmlspecialchars($student['student_id']); ?></p>
                            <span
                                class="badge bg-<?php echo $student['status'] == 'Active' ? 'success' : 'secondary'; ?> fs-6">
                                <?php echo htmlspecialchars($student['status']); ?>
                            </span>
                        </div>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="mb-0">Personal Information</h5>
                        </div>
                        <div class="card-body">
                            <div class="row mb-3">
                                <div class="col-sm-3"><strong>Student ID:</strong></div>
                                <div class="col-sm-9"><?php echo htmlspecialchars($student['student_id']); ?></div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-sm-3"><strong>Full Name:</strong></div>
                                <div class="col-sm-9">
                                    <?php echo htmlspecialchars($student['first_name'] . ' ' . $student['last_name']); ?>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-sm-3"><strong>Email:</strong></div>
                                <div class="col-sm-9"><?php echo htmlspecialchars($student['email']); ?></div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-sm-3"><strong>Phone:</strong></div>
                                <div class="col-sm-9"><?php echo htmlspecialchars($student['phone'] ?: 'N/A'); ?></div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-sm-3"><strong>Gender:</strong></div>
                                <div class="col-sm-9"><?php echo htmlspecialchars($student['gender'] ?: 'N/A'); ?></div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-sm-3"><strong>Birth Date:</strong></div>
                                <div class="col-sm-9"><?php echo htmlspecialchars($student['birth_date'] ?: 'N/A'); ?></div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-sm-3"><strong>Address:</strong></div>
                                <div class="col-sm-9"><?php echo htmlspecialchars($student['address'] ?: 'N/A'); ?></div>
                            </div>
                        </div>
                    </div>

                    <div class="card mt-3">
                        <div class="card-header">
                            <h5 class="mb-0">Academic Information</h5>
                        </div>
                        <div class="card-body">
                            <div class="row mb-3">
                                <div class="col-sm-3"><strong>Course:</strong></div>
                                <div class="col-sm-9"><?php echo htmlspecialchars($student['course'] ?: 'N/A'); ?></div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-sm-3"><strong>Year Level:</strong></div>
                                <div class="col-sm-9">
                                    <?php echo htmlspecialchars($student['year_level'] ? $student['year_level'] . ' Year' : 'N/A'); ?>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-sm-3"><strong>Status:</strong></div>
                                <div class="col-sm-9">
                                    <span
                                        class="badge bg-<?php echo $student['status'] == 'Active' ? 'success' : 'secondary'; ?>">
                                        <?php echo htmlspecialchars($student['status']); ?>
                                    </span>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-sm-3"><strong>Date Added:</strong></div>
                                <div class="col-sm-9"><?php echo htmlspecialchars($student['created_at']); ?></div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-sm-3"><strong>Last Updated:</strong></div>
                                <div class="col-sm-9"><?php echo htmlspecialchars($student['updated_at']); ?></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php endif; ?>
    </div>
</div>

<?php require_once '../includes/footer.php'; ?>