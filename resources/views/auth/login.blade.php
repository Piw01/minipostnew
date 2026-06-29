<!DOCTYPE html>
<html lang="en" data-theme="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bridges POS - Identification Terminal</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Space Grotesk', sans-serif;
            background-color: #0b0f13;
            background-image: radial-gradient(circle at 50% 50%, #131b24 0%, #0b0f13 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #d1d7de;
        }
        .login-card {
            background: rgba(16, 22, 29, 0.85);
            border: 1px solid #1f2c3a;
            border-radius: 0px;
            width: 100%;
            max-width: 420px;
            padding: 35px;
            position: relative;
            backdrop-filter: blur(10px);
            box-shadow: 0 10px 30px rgba(0,0,0,0.5);
        }
        .login-card::before {
            content: '';
            position: absolute;
            top: 0; left: 0; width: 100%; height: 4px;
            background-color: #00d2ff; /* Chiral Blue Neon */
            box-shadow: 0 0 10px rgba(0, 212, 255, 0.5);
        }
        .text-neon-blue { color: #00d2ff; text-shadow: 0 0 8px rgba(0, 210, 255, 0.3); }
        .text-neon-orange { color: #ff9f1a; text-shadow: 0 0 8px rgba(255, 159, 26, 0.3); }
    </style>
</head>
<body>

    <div class="login-card">
        <div class="text-center mb-4">
            <h3 class="fw-bold tracking-wider m-0 text-white">BRIDGES NETWORK</h3>
            <span class="text-neon-orange small tracking-widest text-uppercase" style="font-size: 0.65rem; letter-spacing: 3px;">
                ID Verification Terminal
            </span>
        </div>

        @error('email')
            <div class="alert alert-danger bg-danger bg-opacity-10 border-danger border-opacity-25 rounded-0 small text-neon-orange p-2 mb-4 text-center" style="font-size: 0.8rem;">
                {{ $message }}
            </div>
        @enderror

        <form action="{{ url('/login') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label class="form-label small text-uppercase tracking-wider fw-semibold text-neon-blue" style="font-size: 0.75rem;">Chiral Email Address</label>
                <input type="email" name="email" class="form-control bg-transparent rounded-0 text-white border-secondary" value="{{ old('email') }}" placeholder="operator@pos.com" required style="color: #ffffff !important;">
            </div>

            <div class="mb-4">
                <label class="form-label small text-uppercase tracking-wider fw-semibold text-neon-blue" style="font-size: 0.75rem;">Security Encryption Key (Password)</label>
                <input type="password" name="password" class="form-control bg-transparent rounded-0 text-white border-secondary" placeholder="••••••••" required style="color: #ffffff !important;">
            </div>

            <button type="submit" class="btn btn-outline-info w-100 rounded-0 py-2 fw-bold tracking-wide mb-2" style="font-size: 0.9rem;">
                🔓 INITIATE LINK
            </button>
        </form>
    </div>

</body>
</html>