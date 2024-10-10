<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-4">
            <h3 class="text-center mb-4">Login</h3>
            @if (session('success'))
                <div class="alert alert-primary">
                    {{ session('success') }}
                </div>
            @endif
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>

                </div>
            @endif
            <form action="/login" method="POST">
                @csrf
                <div class="form-group">
                    <label for="email">Email </label>
                    <input type="email" name="email" class="form-control" id="email"
                        placeholder="Enter your email" required>
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" name="password" class="form-control" id="password"
                        placeholder="Enter your password" required>
                </div>
                <div>
                    <input type="checkbox" name="remember" id="remember">
                    <label for="remember">Nhớ tài khoản</label>
                </div>
                <a href="/register">Đăng kí</a>
                <button type="submit" class="btn btn-primary btn-block">Login</button>
            </form>
        </div>
    </div>
</div>
