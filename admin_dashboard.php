<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            display: flex;
            background-color: #f8f9fa;
        }
        .sidebar {
            min-width: 250px;
            background-color: #343a40;
            color: white;
            height: 100vh;
        }
        .sidebar a {
            color: white;
        }
        .sidebar a:hover {
            background-color: #495057;
        }
        .content {
            flex: 1;
            padding: 20px;
        }
        .card {
            margin-bottom: 20px;
        }
    </style>
</head>
<body>

<div class="sidebar">
    <h2 class="text-center">Admin Dashboard</h2>
    <ul class="nav flex-column">
        <li class="nav-item">
            <a class="nav-link active" href="#">Overview</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#">Users</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#">Products</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#">Orders</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#">Reports</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#">Settings</a>
        </li>
    </ul>
</div>

<div class="content">
    <h1>Dashboard Overview</h1>
    <div class="row">
        <div class="col-md-4">
            <div class="card text-white bg-primary">
                <div class="card-header">Total Users</div>
                <div class="card-body">
                    <h5 class="card-title">120</h5>
                    <p class="card-text">Number of registered users.</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card text-white bg-success">
                <div class="card-header">Total Products</div>
                <div class="card-body">
                    <h5 class="card-title">75</h5>
                    <p class="card-text">Total products available in the store.</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card text-white bg-warning">
                <div class="card-header">Total Orders</div>
                <div class="card-body">
                    <h5 class="card-title">30</h5>
                    <p class="card-text">Total orders placed this month.</p>
                </div>
            </div>
        </div>
    </div>

    <h2>Recent Activity</h2>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>#</th>
                <th>User</th>
                <th>Action</th>
                <th>Date</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>1</td>
                <td>John Doe</td>
                <td>Added a new product</td>
                <td>2025-04-01</td>
            </tr>
            <tr>
                <td>2</td>
                <td>Jane Smith</td>
                <td>Updated profile</td>
                <td>2025-04-02</td>
            </tr>
            <tr>
                <td>3</td>
                <td>Mike Johnson</td>
                <td>Placed an order</td>
                <td>2025-04-03</td>
            </tr>
        </tbody>
    </table>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>