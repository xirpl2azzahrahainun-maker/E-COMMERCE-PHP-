<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>LOGIN</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" >
    <style>
        /* LOGIN PAGE */
body{
    background: linear-gradient(135deg,#0f172a,#1e3a8a);
    height:100vh;
    display:flex;
    justify-content:center;
    align-items:center;
    font-family: Arial, Helvetica, sans-serif;
}

/* CONTAINER */
.login-container{
    width:100%;
    max-width:400px;
}

/* CARD */
.login-card{
    background:white;
    padding:35px;
    border-radius:12px;
    box-shadow:0 10px 30px rgba(0,0,0,0.2);
}

/* HEADER */
.login-header{
    text-align:center;
    margin-bottom:25px;
}

.login-header h1{
    font-size:28px;
    color:#0f172a;
    font-weight:bold;
}

.login-header p{
    color:#6b7280;
}

/* FORM */
.form-group{
    margin-bottom:18px;
}

.form-control{
    border-radius:8px;
    padding:10px;
}

/* LOGIN BUTTON */
.btn-login{
    width:100%;
    background:#1e3a8a;
    border:none;
    padding:10px;
    border-radius:8px;
    color:white;
    font-weight:600;
    transition:0.3s;
}

.btn-login:hover{
    background:#0f172a;
}
    </style>
</head>
<body>
 <div class="login-container">
    <div class="login-card">
        <div class="login-header">
            <h1>Welcome</h1>
            <p>Please login to your account</p>

        </div>
        @if ($errors->any())
        <div class="alert alert-danger">
            @foreach ($errors->all() as $error)
            {{ $error }}
            @endforeach
        </div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf
            <div class="form-group">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control @error('email') is-invalid @enderror "
                 id="email" name="email" value="{{ old('email') }}" required placeholder="enter your email">
                 @error('email')
                 <span class="invalid-feedback">{{ $message }}</span>
                 @enderror
            </div>
            <div class="form-group">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control @error('password') is-invalid @enderror"
                 id="password" name="password"  value="{{ old('password') }}" required placeholder="enter your password">
                   @error('password')
                 <span class="invalid-feedback">{{ $message }}</span>
                 @enderror
            </div>
            </div>
            <button type="submit" class="btn-login btn-primary btn-block mt-4">Login</button>
        </form>
    </div>
 </div>





 <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
