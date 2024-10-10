<h1>Chào mừng đến Dashboard</h1>
<form action="{{ route('logout') }}" method="POST">
    @csrf
    <button type="submit">Đăng Xuất</button>
</form>
