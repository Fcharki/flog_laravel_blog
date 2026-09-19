<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Flog | Help Center</title>

    <link rel="icon" type="image/png" href="{{ asset('../icon3.png') }}">
    <link href="{{ asset('../style.css') }}" rel="stylesheet">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@600&family=Platypi:ital,wght@0,300..800;1,300..800&display=swap" rel="stylesheet">

    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        :root {
            --flog-green: #28d49b;
            --flog-green-light: #62f8c6;
            --flog-purple: #8b78f9;
            --flog-blue: #94c6e6;
            --text-dark: #20252b;
            --text-muted: #69727d;
        }

        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            color: var(--text-dark);
            background:
                radial-gradient(
                    circle at 85% 8%,
                    rgba(98, 248, 198, 0.16),
                    transparent 28%
                ),
                radial-gradient(
                    circle at 8% 55%,
                    rgba(139, 120, 249, 0.08),
                    transparent 25%
                ),
                #ffffff;
            font-family: Arial, sans-serif;
        }

        /* =========================
           NAVBAR
        ========================== */

        .flog-navbar {
            margin: 18px auto 0;
            max-width: 1320px;
            padding: 10px 18px !important;
            border: 1px solid rgba(0, 0, 0, 0.055);
            border-radius: 18px;
            background: rgba(255, 255, 255, 0.92) !important;
            box-shadow: 0 8px 30px rgba(32, 37, 43, 0.06) !important;
            backdrop-filter: blur(10px);
        }

        .navbar-brand img {
            width: 105px;
            height: auto;
            transition: transform 0.2s ease;
        }

        .navbar-brand:hover img {
            transform: translateY(-1px);
        }

        .nav-link {
            transition: all 0.2s ease;
        }

        .login-btn {
            color: #343a40 !important;
            font-weight: 600;
            padding: 10px 18px !important;
        }

        .login-btn:hover {
            color: var(--flog-green) !important;
        }

        .signup-btn {
            color: #35bd91 !important;
            border: 1.5px solid var(--flog-green-light) !important;
            background: rgba(98, 248, 198, 0.06);
            font-weight: 600;
            padding: 9px 18px !important;
        }

        .signup-btn:hover {
            color: #ffffff !important;
            background: var(--flog-green);
            border-color: var(--flog-green) !important;
        }

        .dash {
            background: var(--flog-purple) !important;
            color: #ffffff !important;
            font-weight: 600;
            padding: 10px 18px !important;
            transition: all 0.2s ease;
        }

        .dash:hover {
            background: #7663e8 !important;
            transform: translateY(-1px);
            color: #ffffff !important;
        }

        /* =========================
           MAIN
        ========================== */

        .help-wrapper {
            max-width: 1180px;
            margin: 0 auto;
        }

        .help-section {
            min-height: calc(100vh - 190px);
            display: flex;
            align-items: center;
            padding: 75px 0 90px;
        }

        .help-layout {
            display: grid;
            grid-template-columns: 0.8fr 1.5fr;
            gap: 80px;
            align-items: center;
            width: 100%;
        }

        /* =========================
           LEFT SIDE
        ========================== */

        .eyebrow {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            margin-bottom: 22px;
            padding: 7px 13px;
            border-radius: 999px;
            background: rgba(40, 212, 155, 0.09);
            color: #22aa7c;
            font-size: 13px;
            font-weight: 700;
            letter-spacing: 0.08em;
            text-transform: uppercase;
        }

        .eyebrow-dot {
            width: 7px;
            height: 7px;
            border-radius: 50%;
            background: var(--flog-green);
            box-shadow: 0 0 0 5px rgba(40, 212, 155, 0.12);
        }

        .help-title {
            margin: 0;
            font-family: "Platypi", serif;
            font-size: clamp(48px, 6vw, 72px);
            line-height: 1.08;
            letter-spacing: -0.045em;
            font-weight: 650;
            color: var(--text-dark);
        }

        .help-title span {
            background: linear-gradient(
                105deg,
                #20c98f,
                #42e5a8,
                #62eec0,
                #91c7e5
            );

            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .help-description {
            max-width: 430px;
            margin-top: 25px;
            color: var(--text-muted);
            font-family: "Platypi", serif;
            font-size: 18px;
            line-height: 1.75;
        }

        .help-divider {
            width: 65px;
            height: 4px;
            margin-top: 30px;
            border-radius: 10px;
            background: linear-gradient(
                90deg,
                var(--flog-green),
                var(--flog-purple)
            );
        }

        /* =========================
           CONTACT CARD
        ========================== */

        .help-card {
            position: relative;
            overflow: hidden;
            padding: 50px;
            border-radius: 30px;
            background:
                linear-gradient(
                    135deg,
                    rgba(40, 212, 155, 0.12),
                    rgba(139, 120, 249, 0.09)
                );
            border: 1px solid rgba(40, 212, 155, 0.16);
            box-shadow: 0 25px 70px rgba(32, 37, 43, 0.08);
        }

        .help-card::before {
            content: "";
            position: absolute;
            width: 260px;
            height: 260px;
            top: -130px;
            right: -100px;
            border-radius: 50%;
            background: rgba(98, 248, 198, 0.17);
        }

        .help-card::after {
            content: "";
            position: absolute;
            width: 180px;
            height: 180px;
            bottom: -110px;
            left: -80px;
            border-radius: 50%;
            background: rgba(139, 120, 249, 0.08);
        }

        .help-card-content {
            position: relative;
            z-index: 2;
        }

        .help-icon {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 62px;
            height: 62px;
            margin-bottom: 28px;
            border-radius: 18px;
            background: #ffffff;
            color: var(--flog-green);
            font-size: 24px;
            box-shadow: 0 10px 25px rgba(32, 37, 43, 0.08);
        }

        .help-card h2 {
            margin-bottom: 14px;
            font-family: "Platypi", serif;
            font-size: 31px;
            font-weight: 650;
            color: var(--text-dark);
        }

        .help-card-text {
            margin-bottom: 30px;
            color: #66717a;
            font-size: 17px;
            line-height: 1.7;
        }

        .contact-label {
            margin-bottom: 8px;
            color: #7b858d;
            font-size: 12px;
            font-weight: 700;
            letter-spacing: 0.08em;
            text-transform: uppercase;
        }

        .contact-email {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            color: #30383e;
            font-size: 18px;
            font-weight: 600;
            text-decoration: none;
            transition: color 0.2s ease;
        }

        .contact-email i {
            color: var(--flog-green);
        }

        .contact-email:hover {
            color: var(--flog-green);
        }

        .contact-button {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 9px;
            margin-top: 30px;
            padding: 12px 22px;
            border: none;
            border-radius: 12px;
            background: var(--flog-green);
            color: #ffffff;
            font-size: 15px;
            font-weight: 700;
            text-decoration: none;
            box-shadow: 0 8px 20px rgba(40, 212, 155, 0.2);
            transition: all 0.2s ease;
        }

        .contact-button:hover {
            color: #ffffff;
            background: #20bf8b;
            transform: translateY(-2px);
            box-shadow: 0 12px 25px rgba(40, 212, 155, 0.25);
        }

        /* =========================
           FOOTER
        ========================== */

        .flog-footer {
            padding: 28px 0;
            border-top: 1px solid rgba(0, 0, 0, 0.06);
            background: rgba(255, 255, 255, 0.75);
        }

        .footer-inner {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 20px;
        }

        .footer-brand {
            font-family: "Dancing Script", cursive;
            font-size: 25px;
            color: var(--flog-green);
        }

        .footer-text {
            margin: 0;
            color: #8a9299;
            font-size: 13px;
        }

        /* =========================
           RESPONSIVE
        ========================== */

        @media (max-width: 991.98px) {
            .flog-navbar {
                margin: 12px;
            }

            .navbar-nav {
                padding-top: 15px;
            }

            .navbar-nav .nav-item {
                margin: 4px 0;
            }

            .help-section {
                min-height: auto;
                padding: 65px 0 75px;
            }

            .help-layout {
                grid-template-columns: 1fr;
                gap: 50px;
            }

            .help-description {
                max-width: 650px;
            }
        }

        @media (max-width: 767.98px) {
            .help-section {
                padding: 50px 0 60px;
            }

            .help-title {
                font-size: clamp(43px, 12vw, 60px);
            }

            .help-description {
                font-size: 17px;
            }

            .help-card {
                padding: 32px 27px;
                border-radius: 22px;
            }

            .help-card h2 {
                font-size: 26px;
            }

            .contact-email {
                font-size: 16px;
                word-break: break-word;
            }

            .footer-inner {
                flex-direction: column;
                text-align: center;
            }
        }
    </style>
</head>

<body>

<header>
    <nav class="navbar navbar-expand-lg navbar-light flog-navbar">
        <div class="container-fluid">

            <a class="navbar-brand" href="/">
                <img
                    src="{{ asset('../flog-logo.png') }}"
                    class="d-inline-block align-top"
                    alt="Flog logo"
                >
            </a>

            <button
                class="navbar-toggler border-0 shadow-none"
                type="button"
                data-bs-toggle="collapse"
                data-bs-target="#navbarNav"
                aria-controls="navbarNav"
                aria-expanded="false"
                aria-label="Toggle navigation"
            >
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">

                <ul class="navbar-nav ms-auto align-items-lg-center">

                    @auth
                        <li class="nav-item">
                            <a
                                class="nav-link dash rounded-3 me-lg-2"
                                href="{{ url('/dashboard') }}"
                            >
                                <i class="fas fa-th-large me-1"></i>
                                Dashboard
                            </a>
                        </li>
                    @else
                        <li class="nav-item">
                            <a
                                class="nav-link login-btn"
                                href="{{ route('login') }}"
                            >
                                Log in
                            </a>
                        </li>
                        @if (Route::has('register'))
                            <li class="nav-item">
                                <a
                                    class="nav-link signup-btn rounded-3"
                                    href="{{ route('register') }}"
                                >
                                    Sign up
                                </a>
                            </li>
                        @endif
                    @endauth

                </ul>
            </div>
        </div>
    </nav>
</header>
<main>
    <div class="container help-wrapper">

        <section class="help-section">

            <div class="help-layout">

                <!-- Intro -->
                <div>

                    <div class="eyebrow">
                        <span class="eyebrow-dot"></span>
                        Help Center
                    </div>

                    <h1 class="help-title">
                        How can we
                        <span>help?</span>
                    </h1>

                    <p class="help-description">
                        Have a question, found something that isn't working,
                        or simply want to get in touch? We're here to help.
                    </p>

                    <div class="help-divider"></div>

                </div>
                <!-- Contact Card -->
                <div class="help-card">

                    <div class="help-card-content">

                        <div class="help-icon">
                            <i class="fas fa-headset"></i>
                        </div>

                        <h2>
                            Talk to the Flog team
                        </h2>
                        <p class="help-card-text">
                            Whether you need assistance with your account,
                            have a question about Flog, or want to share
                            some feedback, send us a message and we'll
                            get back to you.
                        </p>

                        <div class="contact-label">
                            Email us
                        </div>

                        <a
                            class="contact-email"
                            href="mailto:flog@contact.com"
                        >
                            <i class="fas fa-envelope"></i>
                            flog@contact.com
                        </a>
                        <br>
                        <a
                            class="contact-button"
                            href="mailto:flog@contact.com"
                        >
                            Contact Flog
                            <i class="fas fa-arrow-right"></i>
                        </a>
                    </div>
                </div>
            </div>
        </section>
    </div>
</main>
<footer class="flog-footer">

    <div class="container">
        <div class="footer-inner">
            <div class="footer-brand">
                Flog
            </div>
            <p class="footer-text">
                &copy; {{ date('Y') }} Flog Blog. All rights reserved.
            </p>
        </div>
    </div>
</footer>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.7/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"></script>
</body>
</html>
