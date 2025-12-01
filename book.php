<?php
include 'db.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking Confirmed</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background: url('https://images.unsplash.com/photo-1521590832167-7bcbfaa6381f?q=80&w=1920&auto=format&fit=crop') no-repeat center center fixed;
            background-size: cover;
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        
        .confirmation-card {
            background: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(15px);
            padding: 50px;
            border-radius: 25px;
            text-align: center;
            box-shadow: 0 15px 35px rgba(0,0,0,0.2);
            max-width: 500px;
            width: 90%;
            border: 1px solid rgba(255,255,255,0.5);
            animation: fadeIn 0.8s ease-in-out;
        }

        .check-icon {
            font-size: 80px;
            color: #198754;
            margin-bottom: 20px;
        }

        .btn-back {
            background-color: #333;
            color: white;
            padding: 10px 30px;
            border-radius: 50px;
            text-decoration: none;
            transition: 0.3s;
        }
        .btn-back:hover {
            background-color: #555;
            color: white;
            transform: scale(1.05);
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
    </style>
</head>
<body>

    <div class="confirmation-card">
        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $service_id = $_POST['service_id'];
            $date = $_POST['date'];
            $user_id = 1;

            $selected_date = strtotime($date);
            $current_date = time();

            if ($selected_date < $current_date) {
                echo '<div style="color: #dc3545;">
                        <span style="font-size: 60px;">⚠️</span>
                        <h2 class="fw-bold mt-3">Oops! Invalid Date</h2>
                        <p class="text-muted mb-4">You cannot book an appointment in the past.</p>
                        <a href="index.php" class="btn btn-outline-danger rounded-pill px-4">Try Again</a>
                      </div>';
            } else {
                $sql = "INSERT INTO appointments (user_id, service_id, appointment_date) VALUES ('$user_id', '$service_id', '$date')";

                if ($conn->query($sql) === TRUE) {
                    echo '
                    <div class="check-icon">✓</div>
                    <h2 class="fw-bold mb-3" style="color: #333;">Booking Confirmed!</h2>
                    <p class="text-muted mb-4">Thank you! Your appointment has been scheduled successfully on <br> <strong>'. str_replace("T", " at ", $date) .'</strong></p>
                    <a href="index.php" class="btn-back">Back to Home</a>
                    ';
                } else {
                    echo "Error: " . $conn->error;
                }
            }
        } else {
            header("Location: index.php");
        }
        ?>
    </div>

</body>
</html>