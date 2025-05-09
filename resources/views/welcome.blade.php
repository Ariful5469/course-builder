<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Course Management</title>
    <style>
        /* General Styles */
        body {
            font-family: 'Segoe UI', sans-serif;
            background-color: #121212;
            margin: 0;
            padding: 0;
            color: #f1f1f1;
        }

        /* Navbar Styles */
        nav {
            background-color: #1f1f1f;
            padding: 15px 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.5);
        }

        .navbar-brand {
            color: #00ffcc;
            font-size: 2em;
            font-weight: bold;
            text-decoration: none;
            transition: color 0.3s ease;
        }

        .navbar-brand:hover {
            color: #ff4081;
        }

        .navbar-nav {
            list-style-type: none;
            display: flex;
            margin: 0;
            padding: 0;
        }

        .nav-item {
            margin-left: 20px;
        }

        .nav-link {
            color: #ffffff;
            font-size: 1.1em;
            text-decoration: none;
            padding: 10px 18px;
            border-radius: 6px;
            background: linear-gradient(135deg, #6a11cb 0%, #2575fc 100%);
            transition: transform 0.3s ease, background 0.3s ease;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.3);
        }

        .nav-link:hover {
            background: linear-gradient(135deg, #43e97b 0%, #38f9d7 100%);
            transform: scale(1.05);
        }

        /* Content Styles */
        .container {
            max-width: 1100px;
            margin: 30px auto;
            padding: 20px;
        }

        .content {
            padding: 30px;
            background: #1e1e2f;
            border-radius: 12px;
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.4);
        }

        h1 {
            font-size: 2.4em;
            color: #00e6e6;
            font-weight: 700;
            margin-bottom: 20px;
        }

        /* Button Styles */
        .btn {
            background: linear-gradient(135deg, #ff416c, #ff4b2b);
            color: #fff;
            padding: 12px 25px;
            border-radius: 8px;
            font-size: 1.1em;
            text-decoration: none;
            font-weight: bold;
            display: inline-block;
            transition: all 0.3s ease-in-out;
            box-shadow: 0 5px 12px rgba(255, 75, 43, 0.5);
        }

        .btn:hover {
            background: linear-gradient(135deg, #00c9ff, #92fe9d);
            box-shadow: 0 5px 15px rgba(0, 255, 196, 0.5);
            transform: translateY(-2px);
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .navbar-brand {
                font-size: 1.6em;
            }

            .nav-link {
                font-size: 1em;
                padding: 8px 12px;
            }

            .container {
                padding: 10px;
            }

            .content {
                padding: 20px;
            }

            .btn {
                font-size: 1em;
                padding: 10px 20px;
            }
        }
    </style>
</head>
<body>
    <nav>
        <a class="navbar-brand" href="{{ url('/') }}">Course Management</a>
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" href="{{ route('courses.create') }}">Create Course</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('modules.index') }}">Show All Modules</a>
            </li>
        </ul>
    </nav>

    <div class="container">
        <div class="content">
            @yield('content')
        </div>
    </div>
</body>
</html>
