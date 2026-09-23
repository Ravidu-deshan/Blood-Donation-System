<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LifeShare - Home</title>
    <link rel="icon" type="image/x-icon" href="img/favicon.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <script src="script.js"></script>

    <style>
        /* General Styles */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f8f9fa;
        }

        header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background: #fff;
            padding: 15px 50px;
            box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
        }

        .logo {
            font-size: 24px;
            font-weight: bold;
            color: #e63946;
        }

        nav ul {
            list-style: none;
            display: flex;
            gap: 20px;
        }

        nav ul li a {
            text-decoration: none;
            color: #333;
            font-weight: bold;
        }

        .register-btn {
            background: #e63946;
            color: #fff;
            border: none;
            padding: 10px 20px;
            cursor: pointer;
            border-radius: 5px;
        }

        /* Hero Section */
        .hero {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 50px;
            background: #ffe5e5;
            flex-wrap: wrap;
        }

        .hero-text {
            max-width: 50%;
        }

        .hero-text h1 {
            font-size: 36px;
            color: #333;
        }

        .donate-btn {
            background: #e63946;
            color: #fff;
            border: none;
            padding: 10px 20px;
            cursor: pointer;
            border-radius: 5px;
        }

        /* Stats Section */
        .stats {
            display: flex;
            justify-content: center;
            text-align: center;
            padding: 50px;
            background: #fff;
            flex-wrap: wrap;
            gap: 20px;
        }

        .stat-item {
            padding: 20px;
            background: #e0e3e6;
            border-radius: 10px;
            box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
            min-width: 150px;
        }

        /* How to Donate */
        .how-to-donate {
            text-align: center;
            padding: 50px;
            background: #dce6f0;
        }

        .steps {
            display: flex;
            justify-content: center;
            gap: 30px;
            flex-wrap: wrap;
        }

        .step {
            background: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
            width: 250px;
            text-align: center;
        }

        /* Carousel Section */
        .carousel-container {
            margin: 50px 0;
        }

        .carousel-item img {
            width: 100%;
            height: auto;
            border-radius: 0px;
        }
    </style>

</head>
<body>
    <div><?php include('navbar.php');?></div>

    <section class="carousel-container">
        <div id="carouselExample" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img src="img/what-we-do-1.jpg" class="d-block w-100" style="height: 90vh; object-fit: cover;" alt="What We Do 1">
                </div>
                <div class="carousel-item">
                    <img src="img/what-we-do-2.jpg" class="d-block w-100" style="height: 90vh; object-fit: cover;" alt="What We Do 2">
                </div>
                <div class="carousel-item">
                    <img src="img/what-we-do-3.jpg" class="d-block w-100" style="height: 90vh; object-fit: cover;" alt="What We Do 3">
                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExample" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    </section>

    <section class="hero">
        <div class="hero-text">
            <h1>Your Donation Can Save Lives</h1>
            <p>Every drop counts. Join our community of life-savers and make a difference today. One donation can save up to three lives.</p>
            <button class="donate-btn"><a href="my_account/index.php?sec=4" style="text-decoration: none;color: inherit;">Donate Now</a></button>
        </div>
        <div class="hero-image">
            <img src="img/nguy-n-hi-p-maYeMl3xCrY-unsplash.jpg" alt="Blood Donation">
        </div>
    </section>
    
    <section class="stats">
        <div class="stat-item">
            <h2 id="donors">0</h2><p>Donors</p>
        </div>
        <div class="stat-item">
            <h2 id="lives-saved">0</h2><p>Lives Saved</p>
        </div>
        <div class="stat-item">
            <h2>50+</h2><p>Blood Banks</p>
        </div>
        <div class="stat-item">
            <h2>24/7</h2><p>Support</p>
        </div>
    </section>

    <section class="how-to-donate">
        <h2>How to Donate</h2>
        <div class="steps">
            <div class="step"><i class="fas fa-user-plus"></i><h3>Register</h3><p>Sign up as a donor in our system</p></div>
            <div class="step"><i class="fas fa-notes-medical"></i><h3>Screening</h3><p>Quick health check-up</p></div>
            <div class="step"><i class="fas fa-hand-holding-medical"></i><h3>Donation</h3><p>Safe and easy donation process</p></div>
            <div class="step"><i class="fas fa-clock"></i><h3>Recovery</h3><p>Short rest and refreshments</p></div>
        </div>
    </section>



    <div id="footer"></div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        window.addEventListener('DOMContentLoaded', () => {
            let donors = 0;
            let livesSaved = 0;

            const updateStats = () => {
                if (donors < 10000) {
                    donors += 500;
                    document.getElementById('donors').innerText = donors;
                }
                if (livesSaved < 30000) {
                    livesSaved += 500;
                    document.getElementById('lives-saved').innerText = livesSaved;
                }

                if (donors < 10000 || livesSaved < 30000) {
                    setTimeout(updateStats, 100);
                }
            };
            updateStats();
        });
    </script>

</body>
</html>
