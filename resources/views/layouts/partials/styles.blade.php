<style>
    :root {
        --flog-green: #28d49b;
        --flog-green-dark: #149c72;
        --flog-teal: #8b78f9;
        --text-dark: #1c2836;
    }

    /* =========================
       UNIFIED NAVBAR (Flog)
    ========================== */

    /* Bootstrap navbar collapse must not be hidden by Tailwind's
       .collapse utility, which sets `visibility: collapse`. Bootstrap
       only toggles `display`, so restore visibility for the nav. */
    .navbar-collapse,
    .navbar-collapse.collapse.show,
    .navbar-collapse.collapsing {
        visibility: visible !important;
    }

    /* Fix legacy `.dash` styles (fixed 44px height, 12px top margin,
       non-flex layout) that misalign the icon + label in the navbar
       Dashboard button. Keep it a centered inline-flex pill. */
    .navbar-nav .nav-link.dash {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 0.45rem;
        height: auto;
        min-height: 42px;
        margin: 0;
        padding: 0.55rem 1.25rem;
        line-height: inherit;
        white-space: nowrap;
        color: #fff !important;
        font-weight: 600;
        border-radius: 50rem;
        transition: transform 0.18s ease, box-shadow 0.18s ease;
    }
    .navbar-nav .nav-link.dash:hover {
        transform: translateY(-1px);
        color: #fff !important;
    }

    .flog-navbar {
        background-color: #fff;
        border-bottom: 1px solid #eef2f6;
        box-shadow: 0 2px 10px rgba(15, 23, 30, 0.035);
        padding: 0.85rem 0;
    }

    .flog-brand {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        text-decoration: none;
        transition: transform 0.2s ease;
    }

    .flog-brand:hover { transform: scale(1.03); }
    .flog-brand img {
        width: 40px;
        height: 40px;
    }

    .flog-brand .flog-wordmark {
        font-family: "Pacifico", cursive;
        font-size: 1.45rem;
        font-weight: 400;
        color: var(--flog-green);
        text-shadow: 0 1px 0 rgba(0, 0, 0, 0.04);
        line-height: 1;
    }

    .flog-nav {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        margin-left: auto;
    }
    .flog-nav .flog-nav-link {
        font-weight: 500;
        color: #33435c !important;
        border-radius: 50rem;
        padding: 0.5rem 1.1rem !important;
        transition: background-color 0.18s ease, color 0.18s ease;
    }

    .flog-nav .flog-nav-link:hover {
        background-color: #eef9f4;
        color: var(--flog-green-dark) !important;
    }

    .login-btn {
        font-weight: 500;
        color: #33435c !important;
        border-radius: 50rem;
        padding: 0.5rem 1.2rem !important;
        transition: background-color 0.18s ease, color 0.18s ease;
    }
    .login-btn:hover {
        background-color: #f1f3f5;
        color: #1c2836 !important;
    }

    .signup-btn {
        font-weight: 600;
        color: var(--flog-green-dark) !important;
        background: #ffffff !important;
        border: 2px solid var(--flog-green) !important;
        border-radius: 50rem !important;
        padding: 0.38rem 1.15rem !important;
        transition: background-color 0.18s ease, color 0.18s ease,
                    transform 0.18s ease, box-shadow 0.18s ease;
    }

    .signup-btn:hover {
        color: #fff !important;
        background: linear-gradient(135deg, var(--flog-green), var(--flog-green-dark)) !important;
        border-color: var(--flog-green) !important;
        transform: translateY(-1px);
        box-shadow: 0 7px 16px rgba(40, 212, 155, 0.45);
    }

    .dash-btn {
        display: inline-flex;
        align-items: center;
        gap: 0.4rem;
        font-weight: 600;
        color: #fff !important;
        background: linear-gradient(135deg, var(--flog-green), var(--flog-green-dark));
        border-radius: 50rem !important;
        padding: 0.5rem 1.25rem !important;
        box-shadow: 0 4px 12px rgba(40, 212, 155, 0.35);
        transition: transform 0.18s ease, box-shadow 0.18s ease;
    }
    .dash-btn:hover {
        transform: translateY(-1px);
        color: #fff !important;
    }

    /* ------- Categories dropdown ------- */

    .navbar-category-trigger {
        display: inline-flex;
        align-items: center;
        gap: 0.55rem;
        background: linear-gradient(135deg, var(--flog-green), var(--flog-green-dark));
        color: #fff !important;
        border-radius: 50rem;
        padding: 0.55rem 1.15rem !important;
        text-decoration: none;
        font-weight: 600;
        font-size: 0.95rem;
        box-shadow: 0 4px 12px rgba(40, 212, 155, 0.35);
        transition: transform 0.18s ease, box-shadow 0.18s ease;
    }

    .navbar-category-trigger:hover,
    .navbar-category-trigger:focus {
        color: #fff !important;
        transform: translateY(-2px);
        box-shadow: 0 7px 18px rgba(40, 212, 155, 0.45);
    }

    .navbar-category-trigger .cat-chevron {
        font-size: 0.65rem;
        transition: transform 0.25s ease;
    }

    .navbar-category-trigger[aria-expanded="true"] .cat-chevron {
        transform: rotate(180deg);
    }

    .category-menu {
        border: 0 !important;
        border-radius: 1rem;
        box-shadow: 0 14px 38px rgba(15, 25, 25, 0.18);
        padding: 0.75rem !important;
        min-width: 270px;
        max-height: 380px;
        overflow-y: auto;
    }

    .category-menu .cat-head {
        font-family: "Pacifico", cursive;
        font-weight: 400;
        color: var(--flog-green-dark);
        font-size: 1.05rem;
        padding: 0.25rem 0.55rem 0.6rem;
        margin-bottom: 0.25rem;
        border-bottom: 2px dashed #c9d1da;
        list-style: none;
    }

    .category-link {
        display: flex;
        align-items: center;
        gap: 0.7rem;
        padding: 0.55rem 0.7rem !important;
        border-radius: 0.65rem;
        color: #333 !important;
        text-decoration: none;
        font-weight: 500;
        transition: background-color 0.18s ease, color 0.18s ease,
                    transform 0.18s ease, padding-left 0.18s ease;
    }

    .category-link .cat-dot {
        width: 9px;
        height: 9px;
        border-radius: 50%;
        flex: none;
        box-shadow: 0 0 0 3px rgba(255, 255, 255, 0.55);
    }

    .category-link:hover {
        background-color: #e9fbf3;
        color: var(--flog-green-dark) !important;
        padding-left: 1rem !important;
        transform: translateX(2px);
    }

    .more-cat-toggle {
        display: block;
        width: 100%;
        text-align: center;
        padding: 0.55rem !important;
        margin-top: 0.5rem;
        border: 0;
        background-color: #f3f6f9;
        border-radius: 0.65rem;
        color: #197a5a !important;
        font-weight: 600;
        transition: background-color 0.18s ease, color 0.18s ease;
    }

    .more-cat-toggle:hover {
        background-color: #e0f6ec;
        color: var(--flog-green-dark) !important;
    }

    /* =========================
       UNIFIED FOOTER (Flog)
    ========================== */

    .flog-footer {
        padding: 28px 0;
        border-top: 1px solid rgba(0, 0, 0, 0.06);
        background: rgba(255, 255, 255, 0.85);
        margin-top: 70px;
    }
    .footer-inner {
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 20px;
        flex-wrap: wrap;
    }

    .footer-brand {
        font-family: "Dancing Script", cursive;
        font-size: 26px;
        color: var(--flog-green-dark);
        text-decoration: none;
    }

    .footer-text {
        margin: 0;
        color: #8a9299;
        font-size: 13px;
    }

    .footer-links a {
        color: #66717a;
        text-decoration: none;
        font-size: 14px;
        transition: color 0.18s ease;
    }
    
    .footer-links a:hover {
        color: var(--flog-green-dark);
    }

@media (max-width: 991.98px) {

    .flog-navbar {
        padding: 0.75rem 0;
    }

    .navbar-collapse {
        width: 100%;
    }

    .navbar-collapse.show {
        display: block !important;
    }

    .navbar-nav {
        width: 100%;
        padding: 0.9rem 0 0.4rem;
        align-items: stretch !important;
        gap: 0.35rem;
    }

    .navbar-nav .nav-item {
        width: 100%;
    }

    .navbar-nav .nav-link,
    .navbar-category-trigger {
        width: 100%;
        justify-content: center;
        text-align: center;
    }

    .navbar-nav .dropdown-menu {
        width: 100%;
    }
}
</style>
