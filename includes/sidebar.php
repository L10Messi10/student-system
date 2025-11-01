<!-- Sidebar -->
<nav id="sidebar" class="sidebar">
    <div class="sidebar-header">
        <h3><i class="fas fa-graduation-cap me-2"></i>Student System</h3>
        <button type="button" id="sidebarCollapse" class="btn btn-sm">
            <i class="fas fa-bars"></i>
        </button>
    </div>

    <ul class="list-unstyled components">
        <li class="<?php echo basename($_SERVER['PHP_SELF']) == 'dashboard.php' ? 'active' : ''; ?>">
            <a href="dashboard.php">
                <i class="fas fa-tachometer-alt me-2"></i>
                <span>Dashboard</span>
            </a>
        </li>
        <li
            class="<?php echo in_array(basename($_SERVER['PHP_SELF']), ['students.php', 'add_student.php', 'edit_student.php', 'view_student.php']) ? 'active' : ''; ?>">
            <a href="#studentsSubmenu" data-bs-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                <i class="fas fa-users me-2"></i>
                <span>Students</span>
            </a>
            <ul class="collapse list-unstyled" id="studentsSubmenu">
                <li><a href="students.php"><i class="fas fa-list me-2"></i>All Students</a></li>
                <li><a href="add_student.php"><i class="fas fa-plus me-2"></i>Add Student</a></li>
            </ul>
        </li>
        <li>
            <a href="#">
                <i class="fas fa-chart-bar me-2"></i>
                <span>Reports</span>
            </a>
        </li>
        <li>
            <a href="#">
                <i class="fas fa-cog me-2"></i>
                <span>Settings</span>
            </a>
        </li>
    </ul>
</nav>