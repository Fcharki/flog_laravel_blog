<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>About Flog</title>

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
            --soft-bg: #f7faf9;
        }

        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            color: var(--text-dark);
            background:
                radial-gradient(circle at 85% 8%, rgba(98, 248, 198, 0.16), transparent 28%),
                radial-gradient(circle at 8% 45%, rgba(139, 120, 249, 0.08), transparent 25%),
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
            border: 1.5px solid #62f8c6 !important;
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
           HERO
        ========================== */

        .about-wrapper {
            max-width: 1180px;
            margin: 0 auto;
        }

        .hero-section {
            padding: 80px 0 30px;
        }

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

        .about-title {
            max-width: 1000px;
            margin: 0;
            font-family: "Platypi", serif;
            font-size: clamp(48px, 7vw, 82px);
            line-height: 1.08;
            letter-spacing: -0.045em;
            font-weight: 650;

            background: linear-gradient(
                105deg,
                #20c98f 0%,
                #42e5a8 38%,
                #62eec0 62%,
                #91c7e5 100%
            );

            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .hero-divider {
            width: 75px;
            height: 4px;
            margin: 38px 0 0;
            border-radius: 10px;
            background: linear-gradient(
                90deg,
                var(--flog-green),
                var(--flog-purple)
            );
        }

        /* =========================
           CONTENT
        ========================== */

        .content-section {
            padding: 45px 0 80px;
        }

        .content-layout {
            display: grid;
            grid-template-columns: 0.7fr 1.8fr;
            gap: 70px;
            align-items: start;
        }

        .side-heading {
            position: sticky;
            top: 30px;
            font-family: "Platypi", serif;
            font-size: 20px;
            font-weight: 600;
            color: #424a52;
            line-height: 1.5;
        }

        .side-heading span {
            display: block;
            margin-top: 12px;
            width: 35px;
            height: 2px;
            background: var(--flog-green);
        }

        .about-text {
            margin: 0;
            color: var(--text-muted);
            font-family: "Platypi", serif;
            font-size: 20px;
            line-height: 1.9;
            letter-spacing: -0.01em;
        }

        .about-text p {
            margin-bottom: 32px;
        }

        .about-text p:first-child {
            color: #343b42;
            font-size: 22px;
        }

        .about-text strong {
            color: var(--text-dark);
        }

        /* =========================
           CLOSING CARD
        ========================== */

        .mission-card {
            position: relative;
            margin-top: 55px;
            padding: 38px 42px;
            overflow: hidden;
            border-radius: 24px;
            background: linear-gradient(
                135deg,
                rgba(40, 212, 155, 0.10),
                rgba(139, 120, 249, 0.08)
            );
            border: 1px solid rgba(40, 212, 155, 0.14);
        }

        .mission-card::after {
            content: "";
            position: absolute;
            width: 180px;
            height: 180px;
            right: -80px;
            top: -80px;
            border-radius: 50%;
            background: rgba(98, 248, 198, 0.16);
        }

        .mission-icon {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 48px;
            height: 48px;
            margin-bottom: 20px;
            border-radius: 14px;
            background: #ffffff;
            color: var(--flog-green);
            box-shadow: 0 7px 20px rgba(32, 37, 43, 0.07);
        }

        .mission-card h2 {
            position: relative;
            z-index: 1;
            margin-bottom: 10px;
            font-family: "Platypi", serif;
            font-size: 25px;
            font-weight: 650;
        }

        .mission-card p {
            position: relative;
            z-index: 1;
            max-width: 700px;
            margin: 0;
            color: #66717a;
            font-size: 17px;
            line-height: 1.7;
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

            .content-layout {
                grid-template-columns: 1fr;
                gap: 20px;
            }

            .side-heading {
                position: static;
            }

            .side-heading span {
                display: none;
            }
        }

        @media (max-width: 767.98px) {
            .hero-section {
                padding: 55px 0 20px;
            }

            .about-title {
                font-size: clamp(43px, 12vw, 60px);
                line-height: 1.1;
            }

            .content-section {
                padding: 35px 0 55px;
            }

            .about-text {
                font-size: 18px;
                line-height: 1.8;
            }

            .about-text p:first-child {
                font-size: 19px;
            }

            .mission-card {
                padding: 28px;
                border-radius: 20px;
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

    <div class="container about-wrapper">

        <!-- Hero -->
        <section class="hero-section">

            <div class="eyebrow">
                <span class="eyebrow-dot"></span>
                About Flog
            </div>

            <h1 class="about-title">
                Everyone holds a story
                <br class="d-none d-md-block">
                worth sharing.
            </h1>

            <div class="hero-divider"></div>

        </section>


        <!-- Content -->
        <section class="content-section">

            <div class="content-layout">

                <div class="side-heading">
                    A place for ideas,
                    stories &amp; perspective.
                    <span></span>
                </div>

                <div class="about-text">

                    <p>
                        Flog is a space for human stories and ideas.
                        Here, anyone can share meaningful perspectives,
                        valuable knowledge, and life wisdom with the world—
                        without needing to build a mailing list or a following first.
                    </p>

                    <p>
                        The internet is often noisy and chaotic;
                        Flog is calm yet full of insight.
                        It’s simple, beautiful, collaborative, and helps you
                        find the right audience for whatever you have to say.
                    </p>

                    <p>
                        We believe that what you read and write matters.
                        Words can divide or unite us, inspire or discourage us.
                        In a world where the most sensational and surface-level
                        stories often win, we’re creating a platform that rewards
                        depth, nuance, and thoughtful engagement.
                    </p>

                    <p>
                        A place for meaningful conversation rather than
                        fleeting remarks, and substance over superficiality.
                    </p>

                    <!-- Mission -->
                    <div class="mission-card">

                        <div class="mission-icon">
                            <i class="fas fa-feather-alt"></i>
                        </div>

                        <h2>
                            Why Flog exists
                        </h2>

                        <p>
                            Ultimately, our goal is to deepen our collective
                            understanding of the world through the power of writing.
                        </p>

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
