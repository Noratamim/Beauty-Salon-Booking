<?php include 'db.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard | Luxe Salon</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #fdfbfb;
        }
        .admin-header {
            background: linear-gradient(45deg, #d63384, #ff6b6b);
            color: white;
            padding: 2rem;
            border-radius: 0 0 20px 20px;
            margin-bottom: 2rem;
            box-shadow: 0 4px 15px rgba(214, 51, 132, 0.3);
        }
        .table-card {
            background: white;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.05);
            padding: 20px;
            border: none;
        }
        .table thead {
            background-color: #f8f9fa;
            color: #d63384;
        }
        .badge-confirmed {
            background-color: #d1e7dd;
            color: #0f5132;
            padding: 8px 12px;
            border-radius: 20px;
        }
        .btn-home {
            background: white;
            color: #d63384;
            border: none;
            font-weight: 600;
        }
        .btn-delete {
            background-color: #ff4d4d;
            color: white;
            border: none;
            padding: 5px 15px;
            border-radius: 10px;
            font-size: 0.9rem;
            transition: 0.3s;
            text-decoration: none;
        }
        .btn-delete:hover {
            background-color: #cc0000;
            color: white;
        }
    </style>
</head>
<body>

    <div class="container">
        <div class="admin-header d-flex justify-content-between align-items-center">
            <div>
                <h2 class="mb-0">Admin Dashboard 🛠️</h2>
                <small>Manage bookings & Remove cancelled ones</small>
            </div>
            <a href="index.php" class="btn btn-home rounded-pill px-4">Go to Website</a>
        </div>

        <div class="card table-card">
            <h4 class="mb-4 text-secondary">Recent Appointments</h4>
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead>
                        <tr>
                            <th>#ID</th>
                            <th>Service</th>
                            <th>Date & Time</th>
                            <th>Status</th>
                            <th>Action</th> </tr>
                    </thead>
                    <tbody>
                        <?php
                        $sql = "SELECT a.appointment_id, s.name AS service_name, a.appointment_date, a.status 
                                FROM appointments a 
                                JOIN services s ON a.service_id = s.service_id
                                ORDER BY a.appointment_date DESC";
                        
                        $result = $conn->query($sql);

                        if ($result->num_rows > 0) {
                            while($row = $result->fetch_assoc()) {
                                echo "<tr>
                                    <td class='fw-bold text-muted'>#" . $row["appointment_id"] . "</td>
                                    <td class='fw-bold'>" . $row["service_name"] . "</td>
                                    <td>" . $row["appointment_date"] . "</td>
                                    <td><span class='badge-confirmed'>● " . $row["status"] . "</span></td>
                                    
                                    <td>
                                        <a href='delete.php?id=" . $row["appointment_id"] . "' 
                                           class='btn-delete'
                                           onclick=\"return confirm('Are you sure you want to delete this booking?');\">
                                           Delete 🗑️
                                        </a>
                                    </td>

                                </tr>";
                            }
                        } else {
                            echo "<tr><td colspan='5' class='text-center py-4 text-muted'>No bookings found.</td></tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</body>
</html>