<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
</head>

<body>
    <div>
        <h2>Đây là trang chủ</h2>
        <button>
            <a href="{{ url('/user') }}" class="btn btn-success btn-sm" title="List User">
                List User
            </a>
        </button>
        <button>
            <a href="{{ url('/logout') }}" class="btn btn-success btn-sm" title="Log Out">
                Log out
            </a>
        </button>
        <button>
            <a href="{{ url('/product') }}" class="btn btn-success btn-sm" title="List Product">
                Product
            </a>
        </button>
    </div>
</body>

</html>