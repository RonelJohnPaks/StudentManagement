<?php
use Benatero\StudentManagement\Core\Model\StudentModel;
include 'vendor/autoload.php';

$student = new StudentModel();
$message = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST'){
    $student->id = $_POST['id'] ?? '';
    $student->fullname = $_POST['fullname'] ?? '';
    $student->course = $_POST['course'] ?? '';
    $student->yearlevel = $_POST['yearlevel'] ?? '';
    $student->section = $_POST['section'] ?? '';

    if (isset($_POST['update'])){
        $student->update();
        $message = "Updated: ID {$student->id}, Name: {$student->fullname}, Year Level: {$student->yearlevel}, Course:{$student->course}, Section: {$student->section}";
    } elseif (isset($_POST['delete'])){
        $student->delete();
        $message = "Deleted student with ID: {$student->id}";
    }
}

$allStudents = $student->read();

?>

<!DOCTYPE html>
<html>
    <head>
        <title>Student Management</title>
        <style>
            body { font-family: Arial, sans-serif; margin: 30px;}
            table { border-collapse: collapse; width: 100%; margin-top: 20px;}
            th, td { border: 1px solid #ccc; padding: 10px; text-align: left;}
            .form-container { margin-bottom: 30px;}
            .message { background-color: #e0ffe0; border: 1px solid #00a000; padding: 10px; margin-bottom: 20px;}
            .table-title { font-size: 20px; font-weight: bold; margin-top: 30px;}
        </style>
    </head>
    <body>
        <h1> Student Management</h1>
        <?php if($message): ?>
        <div class="message"><?php echo $message; ?></div>
        <?php endif; ?>

        <div class="form-container">
            <form method="post">
                <label>ID:</label><br>
                <input type="text" name="id"required><br>

                <label>Full Name:</label>
                <input type="type" name="fullname"><br>

                <label>Course:</label>
                <input type="text" name="course"><br>

                <label>Year Level:</label>
                <input type="type" name="yearlevel"><br>

                <label>Section:</label>
                <input type="text" name="section"><br>

                <button type="submit" name="update">Update</button>
                <button type="submit" name="delete">Delete</button>
            </form>
        </div>

        <div class="table-title">All Students</div>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Full Name</th>
                    <th>Course</th>
                    <th>Year Level</th>
                    <th>Section</th>
                </tr>
            </thead>
            <tbody>
               <?php if (!empty($allStudents)); ?>
               <?php foreach ($allStudents as $studentRow) ; ?>
                <tr>
                <td><?php echo isset($studentRow['id']) ? $studentRow['id'] : ''; ?></td>
                <td><?php echo isset($studentRow['fullname']) ? htmlspecialchars($studentRow['fullname']) : ''; ?></td>
                <td><?php echo isset($studentRow['course']) ? htmlspecialchars($studentRow['course']) : ''; ?></td>
                <td><?php echo isset($studentRow['year_level']) ? htmlspecialchars($studentRow['yearl_level']) : ''; ?></td>
                <td><?php echo isset($studentRow['section']) ? htmlspecialchars($studentRow['section']) : ''; ?></td>
               </tr>
                <?php endforeach; ?>
               <?php else: ?>
                <tr>
                    <td colspan="5" style="text-align: center; color: #999;"> No Student found</td>
                </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </body>
</html>