<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SAAS Developer - Agile Developer</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="your-custom-styles.css"> <!-- Add your custom CSS file -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap">
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            background-color: #f8f9fa;
            margin: 0;
            padding: 0;
        }
        .container {
            margin-top: 50px;
        }
        .profile-section, .order-info, .portfolio-section, .skills-section {
            background-color: #ffffff;
            border-radius: 15px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
            margin-bottom: 20px;
        }
        .profile-section img {
            border-radius: 50%;
            width: 100px;
            height: 100px;
            object-fit: cover;
            margin-right: 20px;
        }
        .profile-info {
            flex: 1;
        }
        .profile-name {
            font-weight: bold;
            font-size: 24px;
            margin-bottom: 5px;
        }
        .profile-title {
            font-size: 18px;
            color: #666;
        }
        .order-info h4, .portfolio-section h4, .skills-section h4 {
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 20px;
        }
        .order-info p, .portfolio-section p {
            font-size: 16px;
            color: #666;
        }
        .portfolio-img {
            width: 100%;
            height: auto;
            border-radius: 10px;
            margin-bottom: 20px;
        }
        .skills-list {
            list-style: none;
            padding: 0;
            margin: 0;
        }
        .skills-list li {
            display: inline-block;
            background-color: #1dbf73;
            color: #ffffff;
            font-size: 14px;
            font-weight: bold;
            border-radius: 5px;
            padding: 5px 10px;
            margin: 0 5px 5px 0;
        }
        .btn-primary {
            background-color: #1dbf73;
            border-color: #1dbf73;
        }
        .btn-primary:hover {
            background-color: #149f5b;
            border-color: #149f5b;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="row">
            <!-- Profile Section -->
            <div class="col-md-4">
                <div class="profile-section">
                    <div class="d-flex align-items-center">
                        <img src="your-profile-image.jpg" alt="Profile Image" class="profile-img">
                        <div class="profile-info">
                            <div class="profile-name">Agile Developer</div>
                            <div class="profile-title">Germany</div>
                        </div>
                    </div>
                    <div class="mt-3">
                        <p>I speak English, German</p>
                        <p>87 orders completed</p>
                        <p>Level 2 - Highly Responsive</p>
                    </div>
                    <button class="btn btn-primary mt-3">Contact me</button>
                </div>
            </div>

            <!-- Main Content Section -->
            <div class="col-md-8">
                <!-- Order Info Section -->
                <div class="order-info">
                    <h4>About this Gig</h4>
                    <p>Looking for a custom-built web app for your SaaS business? As a full stack web developer, I specialize in creating tailored web applications using TypeScript, React, MongoDB, Nodejs, PHP, and JavaScript...</p>
                    <!-- Add more details about the gig as needed -->
                </div>

                <!-- Portfolio Section -->
                <div class="portfolio-section">
                    <h4>My Portfolio</h4>
                    <!-- Add your portfolio projects with images and descriptions -->
                    <img src="portfolio-project-1.jpg" alt="Project 1" class="portfolio-img">
                    <img src="portfolio-project-2.jpg" alt="Project 2" class="portfolio-img">
                    <!-- Add more portfolio items as needed -->
                </div>

                <!-- Skills Section -->
                <div class="skills-section">
                    <h4>Skills</h4>
                    <ul class="skills-list">
                        <li>JavaScript</li>
                        <li>React.js</li>
                        <li>Node.js</li>
                        <!-- Add more skills as needed -->
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>