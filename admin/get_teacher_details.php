<!DOCTYPE html>
<html>
<head>
    <title>Teacher Details</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="view_student_style.css">
    <link rel="stylesheet" href="get_student_style.css">
    <script src="admin_script.js"></script>
</head>

<body>
    <div class="header">
        <div class="header-title">Dashboard</div>
        <div class="logout">
            <a href="login.html" class="button">Logout</a>
        </div>
    </div>
    <div class="container">
        <div class="sidebar-toggle">
            <i class="fa fa-bars"></i>
        </div>
        <div class="sidebar">
            <div class="sidebar-header">
                <img src="avatar.png" alt="Avatar" class="sidebar-avatar">
                <h3 class="sidebar-username">Admin</h3>
            </div>
            <div class="sidebar-item">
                <i class="fas fa-users count-icon"></i><a href="class.php">Class</a>
            </div>
            <div class="sidebar-item">
                <i class="fas fa-user-graduate count-icon"></i><a href="student.html">Student</a>
            </div>
            <div class="sidebar-item">
                <i class="fas fa-chalkboard-teacher count-icon"></i><a href="teacher.html">Teacher</a>
            </div>
            <div class="sidebar-item">
                <i class="far fa-calendar-alt count-icon"></i><a href="../Achieve/main.php">Achievement</a>
            </div>
        </div>

        <div id="studentDetailsContent">
            <div class="content">
                <button class="close" onclick="closeDetailsModal()">&times;</button>

                <?php
                include 'db.php';
                $teacher_id = isset($_GET['teacher_id']) ? (int)$_GET['teacher_id'] : 0;

                if ($teacher_id > 0) {
                    $sql = "SELECT * FROM teacher WHERE teacher_id = ?";
                    $stmt = $conn->prepare($sql);
                    $stmt->bind_param("i", $teacher_id);
                    $stmt->execute();
                    $result = $stmt->get_result();

                    if ($result->num_rows > 0) {
                        $row = $result->fetch_assoc();
                        echo '<h2>Teacher Details</h2>';
                        echo '<table class="student-details-table">';
                        echo '<tr><td>Name:</td><td>' . htmlspecialchars($row['first_name'] . ' ' . htmlspecialchars($row['last_name'])) . '</td></tr>';
                        echo '<tr><td>Register No:</td><td>' . htmlspecialchars($row['reg_no']) . '</td></tr>';
                        echo '<tr><td>Email:</td><td>' . htmlspecialchars($row['email']) . '</td></tr>';
                        echo '<tr><td>Phone:</td><td>' . htmlspecialchars($row['phone_number']) . '</td></tr>';
                        echo '<tr><td>Address:</td><td>' . htmlspecialchars($row['address']) . '</td></tr>';
                        echo '</table>';
                    } else {
                        echo '<p>No teacher found.</p>';
                    }

                    $stmt->close();
                } else {
                    echo '<p>Invalid Teacher ID.</p>';
                }

                $conn->close();
                ?>
            </div>
        </div>
    </div>

    <div class="footer" style="background-color: #333;">
        <div>
            <div class="circle" style="background-color: #7e7e7b;">
                <a href="https://www..edu/">
                    <i class="fa fa-globe"></i>
                </a>
            </div>
            <div class="circle" style="background-color: #3b5998;">
                <a href="https://www.facebook.com/TheOfficialPage">
                    <i class="fa fa-facebook"></i>
                </a>
            </div>
            <div class="circle" style="background-color: #1da1f2;">
                <a href="https://twitter.com/officialpage">
                    <i class="fa fa-twitter"></i>
                </a>
            </div>
            <div class="circle" style="background-color: #0e76a8;">
                <a href="https://www.linkedin.com/in/madurai">
                    <i class="fa fa-linkedin"></i>
                </a>
            </div>
            <div class="circle" style="background-color: #fa099d;">
                <a href="https://www.instagram.com/madurai/">
                    <i class="fa fa-instagram"></i>
                </a>
            </div>
            <div class="circle" style="background-color: #ff0000;">
                <a href="https://www.youtube.com/ThiagarajarCollegeofEngineering">
                    <i class="fa fa-youtube"></i>
                </a>
            </div>
        </div>
        <div align="center">
            rvcollege<br> SE_PROJECT &copy;  
        </div>
    </div>

    <script>
        function closeDetailsModal() {
            var modal = document.getElementById("detailsModal");
            modal.style.display = "none";
        }
    </script>

</body>
</html>
