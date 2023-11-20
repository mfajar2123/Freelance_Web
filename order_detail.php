<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Detail - TalentaHub</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="assets/css/dashboard.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap">
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            background-color: #f8f9fa;
        }
        .navbar-brand {
            font-size: 32px;
            font-weight: bold;
            color: #1dbf73;
        }
        .navbar-brand:hover {
            color: #17a668;
        }
        .navbar {
            background-color: #ffffff;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
        }
        .card {
            border: none;
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
        }
        .card-title {
            color: #333;
            font-size: 24px;
            font-weight: bold;
        }
        .card-text {
            color: #666;
            font-size: 16px;
        }
        .card-profile {
            display: flex;
            align-items: center;
            margin-top: 10px;
            padding: 20px;
        }
        .card-profile-img {
            border-radius: 50%;
            margin-right: 10px;
        }
        .card-profile-name {
            font-weight: bold;
            color: #333;
            font-size: 16px;
        }
        .card-footer {
            color: #333;
            font-size: 18px;
        }
        .order-details h4,
        .payment-info h4,
        .actions h4 {
            color: #333;
            font-size: 24px;
            font-weight: bold;
        }
        .order-details ul,
        .payment-info ul {
            list-style: none;
            padding: 0;
        }
        .order-details li,
        .payment-info li {
            margin-bottom: 10px;
            font-size: 16px;
            color: #666;
        }
        .btn-primary,
        .btn-danger {
            transition: background-color 0.3s ease;
            font-size: 18px;
            font-weight: bold;
            margin-right: 10px;
        }
        .btn-primary:hover {
            background-color: #17a668;
        }
        .btn-danger:hover {
            background-color: #ff4444;
        }
        .modal-content {
            background-color: #ffffff;
            border-radius: 15px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
        }
        .modal-header {
            border-bottom: none;
        }
        .modal-title {
            font-size: 24px;
            font-weight: bold;
            color: #333;
        }
        .modal-body {
            padding: 20px;
        }

         /* Additional styles for modals */
         .modal-content {
            background-color: #ffffff;
            border-radius: 15px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
        }
        .modal-header {
            border-bottom: none;
        }
        .modal-title {
            font-size: 24px;
            font-weight: bold;
            color: #333;
        }
        .modal-body {
            padding: 20px;
        }
        .btn-next {
            background-color: #17a668;
            color: #ffffff;
            font-weight: bold;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light">
        <div class="container">
            <a class="navbar-brand" href="#">TalentaHub</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="dashboard.php">Back to Dashboard</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container mt-4">
        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Web Development</h5>
                        <p class="card-text">I can create responsive and dynamic websites using the latest technologies.</p>
                        <div class="card-profile">
                            <img src="assets/img/download.jpg" class="card-profile-img rounded-circle" alt="Profile Image" style="width: 50px; height: 50px;">
                            <span class="card-profile-name" style="font-weight: bold;">Muhamad Fajar</span>
                        </div>
                        <!-- <div class="card-footer">
                            <span>Price: $50</span>
                        </div> -->
                    </div>
                </div>

            <!-- Modal for Price, Order Details, and Payment Information -->
            <div class="modal" id="myModal">
                <div class="modal-dialog">
                    <div class="modal-content">

                        <!-- Modal Header -->
                        <div class="modal-header">
                            <h4 class="modal-title">Details</h4>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>

                        <!-- Modal Body -->
                        <div class="modal-body">
                            <div class="order-details">
                                <h4>Order Details</h4>
                                <ul>
                                    <li><strong>Order ID:</strong> #123456</li>
                                    <li><strong>Order Date:</strong> January 1, 2023</li>
                                    <li><strong>Client Name:</strong> John Doe</li>
                                    <li><strong>Contact Email:</strong> john.doe@example.com</li>
                                    <li><strong>Additional Notes:</strong> Lorem ipsum dolor sit amet, consectetur adipiscing elit.</li>
                                </ul>
                            </div>

                            <div class="mt-4 payment-info">
                                <h4>Payment Information</h4>
                                <ul>
                                    <li><strong>Total Amount:</strong> $50</li>
                                    <li><strong>Payment Method:</strong> Credit Card</li>
                                    <li><strong>Transaction ID:</strong> ABC123XYZ</li>
                                </ul>
                            </div>
                            <button type="button" class="btn btn-primary mt-4" data-bs-toggle="modal" data-bs-target="#myModal2">
                            Continue
                             </button>
            
                        </div>
                    </div>
                </div>
            </div>

            <!-- Button to Open the Modal -->
            <button type="button" class="btn btn-primary mt-4" data-bs-toggle="modal" data-bs-target="#myModal">
                Open Details
            </button>
        </div>
    </div>
    

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>
