<?php
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Use prepared statements to prevent SQL injection
    $stmt = $conn->prepare("SELECT * FROM User WHERE email = ? AND password = ?");
    $stmt->bind_param("ss", $email, $password);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();

        session_start();
        $_SESSION['user_id'] = $row['user_id'];
        $_SESSION['username'] = $row['username'];
        $_SESSION['role'] = $row['role'];

        // Check the role and redirect accordingly
        if ($row['role'] == 'Admin') {
            echo "<script>alert('Login successful'); window.location.href='./admin/admin_dashboard.php';</script>";
        } elseif ($row['role'] == 'Teacher') {
            echo "<script>alert('Login successful'); window.location.href='./teacher/teacher_dashboard.php';</script>";
        } elseif ($row['role'] == 'Student') {
            echo "<script>alert('Login successful'); window.location.href='./student/student_dashboard.php';</script>";
        }
    } else {
        echo "<script>alert('Invalid email or password'); window.location.href='login.html';</script>";
    }

    $stmt->close();
}

$conn->close();
?>
