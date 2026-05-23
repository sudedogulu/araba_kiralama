<?php
session_set_cookie_params(0);
session_start();

include 'php/db.php';

if (!isset($_SESSION['user_id'])) {
    die("<script>
        alert('Rezervasyon yapabilmek için lütfen önce giriş yapın!'); 
        window.history.back();
    </script>");
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_id = $_SESSION['user_id'];
    $car_name = mysqli_real_escape_string($conn, $_POST['car_name']);
    $pickup_location = mysqli_real_escape_string($conn, $_POST['pickup_location']);
    $dropoff_location = mysqli_real_escape_string($conn, $_POST['dropoff_location']);
    $start_date = mysqli_real_escape_string($conn, $_POST['start_date']);
    $end_date = mysqli_real_escape_string($conn, $_POST['end_date']);
    $total_price = floatval($_POST['total_price']);

    if (empty($car_name) || empty($pickup_location) || empty($dropoff_location) || empty($start_date) || empty($end_date)) {
        die("<script>
            alert('Lütfen tüm bilgileri eksiksiz doldurun!'); 
            window.history.back();
        </script>");
    }

    if ($total_price <= 0) {
        die("<script>
            alert('Lütfen geçerli bir tarih aralığı seçin!'); 
            window.history.back();
        </script>");
    }

    $sql = "INSERT INTO reservations (user_id, car_name, pickup_location, dropoff_location, start_date, end_date, total_price)
            VALUES ('$user_id', '$car_name', '$pickup_location', '$dropoff_location', '$start_date', '$end_date', '$total_price')";

    if (mysqli_query($conn, $sql)) {
        ?>
        <!DOCTYPE html>
        <html lang="tr">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Rezervasyon Başarılı - DriveNow</title>
            <link rel="stylesheet" href="css/style.css">
        </head>
        <body class="success-page">
            <div class="success-card">
                <div class="check-circle">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path>
                    </svg>
                </div>
                <h1>Ön Rezervasyon Alındı!</h1>
                <p>Harika seçim! Seçtiğiniz araç sizin için başarıyla ayırıldı. Kesin onay ve <strong>şubede ödeme / havale</strong> adımları için müşteri temsilcimiz en kısa sürede sizinle iletişime geçecektir.</p>
                
                <div class="details-box">
                    <span>Seçilen Araç: <strong><?php echo htmlspecialchars($car_name); ?></strong></span>
                    <span>Tutar: <strong class="price-text"><?php echo number_format($total_price, 0, ',', '.'); ?> ₺</strong></span>
                </div>

                <a href="index.php" class="home-btn">Ana Sayfaya Dön</a>
            </div>
        </body>
        </html>
        <?php
    } else {
        echo "<script>
            alert('Sistemsel bir hata oluştu: " . mysqli_error($conn) . "'); 
            window.history.back();
        </script>";
    }
} else {
    header("Location: index.php");
    exit();
}
?>