<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'UCA Delivery System' }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@400;600;700&display=swap" rel="stylesheet">
    
    <style>
        /* ==========================================================================
           1. VARIABEL WARNA (TEMA DEFAULT: GELAP CHIRAL)
           ========================================================================== */
        :root {
            --bg-outer: #0b0f13;
            --bg-sidebar: #10161d;
            --bg-content-gradient: radial-gradient(circle at 80% 20%, #131b24 0%, #0b0f13 100%);
            --border-color: #1f2c3a;
            --text-main: #d1d7de;
            --text-muted: #8fa0b3;
            --card-bg: rgba(16, 22, 29, 0.7);
            --neon-blue: #00d2ff;
            --neon-orange: #ff9f1a;
            --neon-blue-shadow: rgba(0, 210, 255, 0.3);
            --neon-orange-shadow: rgba(255, 159, 26, 0.3);
            --sidebar-active-bg: linear-gradient(90deg, rgba(0,212,255,0.1) 0%, rgba(0,0,0,0) 100%);
            --bg-status-box: rgba(255, 255, 255, 0.03); /* WARNA BOX DI DARK MODE */
        }
        /* ==========================================================================
           2. VARIABEL WARNA (TEMA TERANG: BRIDGES STANDARD)
           ========================================================================== */
        [data-theme="light"] {
            --bg-outer: #e9ecef;
            --bg-sidebar: #ffffff;
            --bg-content-gradient: radial-gradient(circle at 80% 20%, #f8f9fa 0%, #e9ecef 100%);
            --border-color: #ced4da;
            --text-main: #212529;
            --text-muted: #495057;
            --card-bg: rgba(255, 255, 255, 0.85);
            --neon-blue: #0066cc;
            --neon-orange: #d97706;
            --neon-blue-shadow: rgba(0, 102, 204, 0.15);
            --neon-orange-shadow: rgba(217, 119, 6, 0.15);
            --sidebar-active-bg: linear-gradient(90deg, rgba(0,102,204,0.08) 0%, rgba(0,0,0,0) 100%);
            --bg-status-box: rgba(0, 0, 0, 0.05); /* WARNA BOX DI LIGHT MODE */
        }

        /* ==========================================================================
           3. BASE STYLING USING VARIABLES
           ========================================================================== */
        body { 
            font-family: 'Space Grotesk', sans-serif;
            background-color: var(--bg-outer);
            color: var(--text-main);
            display: flex; 
            min-height: 100vh; 
            overflow-x: hidden;
            transition: background-color 0.3s ease, color 0.3s ease;
        }
        
        .sidebar { 
            width: 260px; 
            background-color: var(--bg-sidebar); 
            border-right: 1px solid var(--border-color);
            padding: 25px 20px; 
            display: flex;
            flex-direction: column;
            transition: background-color 0.3s ease, border-color 0.3s ease;
        }
        
        .sidebar-brand {
            font-size: 1.3rem;
            font-weight: 700;
            letter-spacing: 2px;
            color: var(--neon-blue);
            text-shadow: 0 0 10px var(--neon-blue-shadow);
        }
        
        .sidebar-sub {
            font-size: 0.65rem;
            text-transform: uppercase;
            letter-spacing: 3px;
            color: var(--neon-orange);
            text-shadow: 0 0 8px var(--neon-orange-shadow);
            margin-bottom: 30px;
        }
        
        .sidebar a { 
            color: var(--text-muted); 
            text-decoration: none; 
            display: block; 
            padding: 12px 15px; 
            font-size: 0.9rem;
            border-left: 3px solid transparent;
            margin-bottom: 5px;
            transition: all 0.2s ease;
        }
        
        .sidebar a:hover, .sidebar a.active { 
            color: var(--text-main); 
            background: var(--sidebar-active-bg);
            border-left-color: var(--neon-blue);
            padding-left: 20px;
        }

        .main-content { 
            flex: 1; 
            padding: 40px;
            background: var(--bg-content-gradient);
        }
        
        .ds-card {
            background: var(--card-bg);
            border: 1px solid var(--border-color);
            border-radius: 0px; 
            position: relative;
            backdrop-filter: blur(5px);
            transition: background-color 0.3s ease, border-color 0.3s ease;
        }
        
            .ds-card::before {
                content: '';
                position: absolute;
                top: 0; left: 0; width: 4px; height: 100%;
                background-color: var(--neon-blue);
            }
        
        .text-neon-blue {
            color: var(--neon-blue);
            text-shadow: 0 0 8px var(--neon-blue-shadow);
        }
        
        .text-neon-orange {
            color: var(--neon-orange);
            text-shadow: 0 0 8px var(--neon-orange-shadow);
        }

        .ds-text-fix {
            color: var(--text-muted) !important;
        }

        .ds-table {
            border-color: var(--border-color) !important;
            background-color: transparent !important;
        }

        .ds-table th {
            color: var(--neon-orange) !important;
            border-bottom: 2px solid var(--border-color) !important;
            background-color: transparent !important;
        }

        /* Memaksa background td transparan agar warna ds-card di bawahnya yang nembus */
        .ds-table td {
            color: var(--text-main) !important;
            border-bottom: 1px solid var(--border-color) !important;
            background-color: transparent !important; 
        }

        /* Mengatur warna hover baris agar serasi di kedua mode */
        .ds-table tbody tr:hover td {
            background-color: rgba(0, 210, 255, 0.05) !important;
            transition: background-color 0.15s ease;
        }

        /* SWITCH BUTTON CONTAINER AT SIDEBAR BOTTOM */
        .theme-switcher-box {
            margin-top: auto; /* Memaksa box turun ke bagian paling bawah */
            padding-top: 20px;
            border-top: 1px dashed var(--border-color);
        }

        .ds-status-box {
            padding: 1rem;
            border-bottom: 2px solid var(--border-color);
            background-color: var(--bg-status-box) !important;
            transition: background-color 0.3s ease;
        }    
    </style>
</head>
<body>

    <div class="sidebar">
        <div class="sidebar-brand">MINIPOST</div>
        <div class="sidebar-sub">Bridges Network v2.0</div>
        
        <a href="{{ url('/') }}" class="{{ Request::is('/') ? 'active' : '' }}">⚠️ DASHBOARD MAP</a>
        <a href="{{ url('/produk') }}" class="{{ Request::is('produk*') ? 'active' : '' }}">📦 CARGO MANAGEMENT</a>
        <a href="{{ url('/transaksi') }}" class="{{ Request::is('transaksi*') ? 'active' : '' }}">🛒 DELIVERY ORDERS</a>
        <form action="{{ url('/logout') }}" method="POST" class="mt-2">
            @csrf
            <button type="submit" class="sidebar-link-btn text-start w-100 bg-transparent border-0" style="color: #ff4d4d; font-size: 0.9rem; padding: 12px 15px; letter-spacing: 1px; cursor: pointer;">
                (LOGOUT)
            </button>
        </form>
        <div class="theme-switcher-box">
            <div class="form-check form-switch">
                <input class="form-check-input" type="checkbox" id="themeSwitch" style="cursor: pointer;">
                <label class="form-check-label small text-uppercase tracking-wider" for="themeSwitch" style="font-size: 0.75rem; cursor: pointer; color: var(--text-muted);">
                    ⚡ Switch Theme
                </label>
            </div>
        </div>
    </div>

    <div class="main-content">
        <div class="container-fluid">
            {{ $slot }}
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>
        const themeSwitch = document.getElementById('themeSwitch');
        const currentTheme = localStorage.getItem('theme') || 'dark';

        // Set tema awal berdasarkan history penyimpanan browser
        document.documentElement.setAttribute('data-theme', currentTheme);
        if (currentTheme === 'light') {
            themeSwitch.checked = true;
        }

        // Fungsi penanganan klik saklar
        themeSwitch.addEventListener('change', function() {
            if (this.checked) {
                document.documentElement.setAttribute('data-theme', 'light');
                localStorage.setItem('theme', 'light');
            } else {
                document.documentElement.setAttribute('data-theme', 'dark');
                localStorage.setItem('theme', 'dark');
            }
        });
    </script>
</body>
</html>