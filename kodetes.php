.navbar {
            background-color: white;
            box-shadow: 0 2px 4px 0 rgba(0,0,0,0.1);
        }
        .navbar-brand {
            font-size: 24px;
            font-weight: bold;
            color: #1dbf73;
        }
        .navbar-brand:hover {
            color: #17a668;
        }
        .navbar-nav {
            margin-left: auto;
        }
        .nav-link {
            font-size: 16px;
            font-weight: bold;
            color: #333;
            margin-right: 15px;
        }
        .nav-link:hover {
            color: #1dbf73;
        }
        .nav-link.active {
            color: #1dbf73;
            border-bottom: 3px solid #1dbf73;
        }
        .btn-join {
            border: none;
            background-color: #1dbf73;
            color: white;
            padding: 10px 20px;
            border-radius: 5px;
            transition: background-color 0.3s;
        }
        .btn-join:hover {
            background-color: #17a668;
        }

<nav class="navbar navbar-expand-lg navbar-light">
        <div class="container">
            <a class="navbar-brand" href="#">TalentaHub</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link active" href="#">Explore</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Become a Seller</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Sign In</a>
                    </li>
                    <li class="nav-item">
                        <button class="btn-join">Join</button>
                    </li>
                </ul>
            </div>
        </div>
    </nav>