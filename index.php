<?php include 'db.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>✨ Luxe Beauty Salon</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background: url('https://images.unsplash.com/photo-1521590832167-7bcbfaa6381f?q=80&w=1920&auto=format&fit=crop') no-repeat center center fixed;
            background-size: cover;
            min-height: 100vh;
        }

        .overlay {
            background-color: rgba(0, 0, 0, 0.2);
            min-height: 100vh;
            padding-bottom: 50px;
        }

        .glass-container {
            background: rgba(255, 255, 255, 0.2); 
            backdrop-filter: blur(15px); 
            -webkit-backdrop-filter: blur(15px);
            border-radius: 20px;
            padding: 40px;
            border: 1px solid rgba(255, 255, 255, 0.3);
            box-shadow: 0 8px 32px 0 rgba(31, 38, 135, 0.15);
            margin-top: 50px;
        }

        .hero-title {
            color: white;
            text-shadow: 2px 2px 10px rgba(0,0,0,0.5);
            margin-top: 100px;
            font-weight: 700;
        }

        .service-card {
            border: none;
            border-radius: 15px;
            transition: transform 0.3s;
            background: rgba(255, 255, 255, 0.9); 
            border: 1px solid rgba(255,255,255,0.5);
        }
        .service-card:hover {
            transform: translateY(-5px);
            background: #ffffff;
            box-shadow: 0 10px 20px rgba(0,0,0,0.1);
        }

        .btn-book {
            background: linear-gradient(45deg, #d63384, #ff6b6b);
            border: none;
            color: white;
            width: 100%;
            border-radius: 50px;
            padding: 10px;
        }
        .btn-book:hover {
            color: white; 
            opacity: 0.9;
        }
        
        input[type="datetime-local"] {
            color-scheme: dark;       
            background-color: #2c2c2c; 
            border: 1px solid #555;   
        }

        input[type="datetime-local"]::-webkit-calendar-picker-indicator {
            filter: invert(1);
            cursor: pointer;
        }
    </style>
</head>
<body>
    <div class="overlay">
        <nav class="navbar navbar-expand-lg navbar-dark bg-transparent pt-4">
            <div class="container">
                <a class="navbar-brand fw-bold fs-3" href="#"> Luxe Salon</a>
                <div class="ms-auto">
                    <a href="admin.php" class="btn btn-outline-light rounded-pill">Admin Login</a>
                </div>
            </div>
        </nav>

        <div class="container">
            <div class="text-center mb-5">
                <h1 class="hero-title display-3">Welcome to Elegance</h1>
                <p class="text-white fs-5">Where beauty meets perfection</p>
            </div>

            <div class="glass-container">
                <h2 class="text-center mb-5 fw-bold" style="color: #fff; text-shadow: 1px 1px 5px rgba(0,0,0,0.3);">Our Premium Services</h2>
                <div class="row">
                    <?php
                    $sql = "SELECT * FROM services";
                    $result = $conn->query($sql);
                    if ($result->num_rows > 0) {
                        while($row = $result->fetch_assoc()) {
                            echo '
                            <div class="col-md-4 mb-4">
                                <div class="card service-card shadow-sm h-100">
                                    <div class="card-body text-center">
                                        <h5 class="card-title fw-bold text-secondary">'. $row["name"] .'</h5>
                                        <p class="text-muted small">'. $row["description"] .'</p>
                                        <h4 class="text-pink my-3" style="color:#d63384;">$'. $row["price"] .'</h4>
                                        <form action="book.php" method="POST">
                                            <input type="hidden" name="service_id" value="'. $row["service_id"] .'">
                                            <div class="mb-3">
                                                <input type="datetime-local" name="date" class="form-control form-control-sm" required>
                                            </div>
                                            <button type="submit" class="btn btn-book">Book Now</button>
                                        </form>
                                    </div>
                                </div>
                            </div>';
                        }
                    } else { echo "<p class='text-center text-white'>No services available.</p>"; }
                    ?>
                </div>
            </div>
        </div>
        
        <footer class="text-center text-white mt-5 opacity-75">
            <small>&copy; 2025 Beauty Salon System</small>
        </footer>
    </div>
</body>
</html>