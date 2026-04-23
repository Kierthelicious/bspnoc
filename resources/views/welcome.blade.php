<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Negros Occidental Council</title>
    <style>
        :root {
            --primary: #0b2e59;
            --secondary: #1f4e79;
            --accent: #c9a227;
            --surface: #f4f6f8;
            --white: #ffffff;
            --text: #1f2937;
            --muted: #64748b;
            --border: #d7dee6;
        }

        * { box-sizing: border-box; }

        body {
            margin: 0;
            font-family: "Segoe UI", Tahoma, Arial, sans-serif;
            color: var(--text);
            background: var(--surface);
            line-height: 1.6;
        }

        body.menu-open {
            overflow: hidden;
        }

        .sticky-bar {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            z-index: 1200;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0.45rem 0.9rem;
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            border-bottom: 2px solid var(--accent);
            transform: translateY(-120%);
            transition: transform 0.2s ease;
        }

        .sticky-bar.is-visible {
            transform: translateY(0);
        }

        .sticky-menu-btn {
            border: 0;
            background: transparent;
            color: #fff;
            width: 40px;
            height: 40px;
            padding: 0;
            cursor: pointer;
        }

        .sticky-menu-btn svg {
            width: 22px;
            height: 22px;
            fill: currentColor;
        }

        .sticky-bar-logo {
            width: 40px;
            height: 40px;
            object-fit: contain;
            border-radius: 50%;
            background: #fff;
            border: 2px solid rgba(255, 255, 255, 0.85);
        }

        .side-menu-overlay {
            position: fixed;
            inset: 0;
            background: rgba(2, 6, 23, 0.35);
            opacity: 0;
            visibility: hidden;
            transition: opacity 0.2s ease, visibility 0.2s ease;
            z-index: 1250;
        }

        .side-menu-overlay.is-open {
            opacity: 1;
            visibility: visible;
        }

        .side-menu {
            position: fixed;
            top: 0;
            left: 0;
            width: min(86vw, 360px);
            height: 100vh;
            background: #f9fafb;
            box-shadow: 10px 0 22px rgba(0, 0, 0, 0.18);
            transform: translateX(-105%);
            transition: transform 0.2s ease;
            z-index: 1300;
            display: flex;
            flex-direction: column;
        }

        .side-menu.is-open {
            transform: translateX(0);
        }

        .side-menu-header {
            text-align: center;
            font-weight: 700;
            color: #111827;
            padding: 1.1rem 1rem;
            border-bottom: 1px solid var(--border);
        }

        .side-menu a {
            display: flex;
            align-items: center;
            justify-content: space-between;
            text-decoration: none;
            color: #111827;
            font-weight: 700;
            padding: 1.2rem 1.35rem;
            border-bottom: 1px solid #e5e7eb;
        }

        .side-menu a span:last-child {
            color: #7c3aed;
            font-size: 1.1rem;
        }

        .hero {
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            color: var(--white);
            text-align: center;
            padding: 2.5rem 1rem 2.2rem;
            border-bottom: 4px solid var(--accent);
        }

        .hero-logo {
            width: min(190px, 50vw);
            aspect-ratio: 1 / 1;
            object-fit: contain;
            object-position: center;
            border-radius: 50%;
            border: 4px solid rgba(255, 255, 255, 0.85);
            background: #fff;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.25);
            margin-bottom: 0.9rem;
        }

        .hero h1 {
            margin: 0 0 0.35rem;
            font-size: 1.9rem;
            letter-spacing: 0.2px;
        }

        .hero p {
            margin: 0 auto;
            max-width: 720px;
            color: #e2e8f0;
        }

        .container {
            max-width: 980px;
            margin: 0 auto;
            padding: 1.3rem 1rem 2.5rem;
        }

        h2 {
            margin: 0 0 0.65rem;
            color: var(--primary);
            font-size: 1.2rem;
        }

        .dropdown {
            background: var(--white);
            border: 1px solid var(--border);
            border-radius: 10px;
            margin-bottom: 0.8rem;
            overflow: hidden;
        }

        .dropdown summary {
            list-style: none;
            cursor: pointer;
            padding: 0.9rem 1rem;
            font-weight: 700;
            color: var(--primary);
            background: #f8fafc;
            border-bottom: 1px solid var(--border);
        }

        .dropdown summary::-webkit-details-marker { display: none; }

        .dropdown[open] summary { background: #eef4fb; }

        .dropdown-content { padding: 0.85rem 1rem 1rem; }

        .dropdown-content ul { margin: 0.3rem 0 0 1.1rem; }

        .dropdown-content p { margin: 0.2rem 0 0.3rem; }

        .btn {
            display: inline-block;
            text-decoration: none;
            font-weight: 600;
            border-radius: 7px;
            padding: 0.5rem 0.8rem;
            margin-top: 0.45rem;
        }

        .btn-primary {
            background: var(--primary);
            color: #fff;
        }

        .btn-secondary {
            background: #e2e8f0;
            color: #0f172a;
        }

        footer {
            text-align: center;
            padding: 1rem;
            color: var(--muted);
            font-size: 0.9rem;
        }

        .social-links {
            display: flex;
            justify-content: center;
            gap: 0.8rem;
            margin-bottom: 0.6rem;
        }

        .social-icon {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 38px;
            height: 38px;
            border-radius: 50%;
            text-decoration: none;
            color: #fff;
            transition: transform 0.15s ease, opacity 0.15s ease;
        }

        .social-icon:hover {
            transform: translateY(-2px);
            opacity: 0.9;
        }

        .social-icon svg {
            width: 19px;
            height: 19px;
            fill: currentColor;
        }

        .social-facebook { background: #1877f2; }
        .social-instagram {
            background: radial-gradient(circle at 30% 107%, #fdf497 0%, #fdf497 5%, #fd5949 45%, #d6249f 60%, #285aeb 90%);
        }
        .social-youtube { background: #ff0000; }
    </style>
</head>
<body>
    <div class="sticky-bar" id="stickyBar">
        <button class="sticky-menu-btn" id="menuToggle" type="button" aria-label="Open menu" aria-expanded="false">
            <svg viewBox="0 0 24 24" aria-hidden="true">
                <path d="M3 6h18v2H3V6Zm0 5h18v2H3v-2Zm0 5h18v2H3v-2Z"/>
            </svg>
        </button>
        <img class="sticky-bar-logo" src="{{ asset('images/council-logo.png') }}" alt="Council logo">
    </div>

    <div class="side-menu-overlay" id="sideMenuOverlay"></div>
    <nav class="side-menu" id="sideMenu" aria-label="Main menu">
        <div class="side-menu-header">Menu</div>
        <a href="#who-we-are"><span>Who we are</span><span>&rarr;</span></a>
        <a href="#what-we-do"><span>What we do</span><span>&rarr;</span></a>
        <a href="#newsroom"><span>Newsroom</span><span>&rarr;</span></a>
        <a href="#events"><span>Events</span><span>&rarr;</span></a>
        <a href="#get-involved"><span>Get involved</span><span>&rarr;</span></a>
    </nav>

    <header class="hero">
        <img class="hero-logo" src="{{ asset('images/council-logo.png') }}" alt="Negros Occidental Council Logo">
        <h1>Boy Scouts of the Philippines - Negros Occidental Council</h1>
        <p>Homepage for scouting programs, council updates, and youth development initiatives.</p>
    </header>

    <main class="container">
        <details class="dropdown" id="who-we-are" open>
            <summary>1. Who We Are</summary>
            <div class="dropdown-content">
                <ul>
                    <li>Negros Occidental Council History</li>
                    <li>Negros Occidental Council Executive and Staff</li>
                    <li>Council Chairman and Executive Board Members</li>
                    <li>Scout Oath and Law</li>
                    <li>Scout Ideals</li>
                    <li>Mission and Vision</li>
                </ul>
            </div>
        </details>

        <details class="dropdown" id="what-we-do">
            <summary>2. What We Do</summary>
            <div class="dropdown-content">
                <ul>
                    <li>Kab Scouting</li>
                    <li>Boy Scouting</li>
                    <li>Senior Scouting</li>
                    <li>Rover Scouting</li>
                    <li>Adults in Scouting</li>
                    <li>Community Service and Environment</li>
                    <li>Peace</li>
                    <li>Humanitarian Action</li>
                    <li>Diversity and Inclusion</li>
                </ul>
            </div>
        </details>

        <details class="dropdown" id="newsroom">
            <summary>3. Newsroom and Council Memo</summary>
            <div class="dropdown-content">
                <p>Find official advisories, announcements, and council memoranda.</p>
                <ul>
                    <li>Memo 2026-014: Provincial Camp Safety Protocols</li>
                    <li>Memo 2026-010: Annual Registration and Unit Validation</li>
                    <li>Memo 2026-006: School-LGU Partnership Guidelines</li>
                </ul>
                <a class="btn btn-primary" href="#">View All Memos</a>
            </div>
        </details>

        <details class="dropdown" id="events">
            <summary>4. Events</summary>
            <div class="dropdown-content">
                <p>Schedules for camps, trainings, leadership activities, and provincial events.</p>
                <a class="btn btn-secondary" href="#">View Event Calendar</a>
            </div>
        </details>

        <details class="dropdown">
            <summary>5. Scout Shop</summary>
            <div class="dropdown-content">
                <p>Official uniforms, badges, handbooks, and scouting essentials.</p>
                <a class="btn btn-secondary" href="#">Visit Scout Shop</a>
            </div>
        </details>

        <details class="dropdown">
            <summary>6. Learning Aids</summary>
            <div class="dropdown-content">
                <p>Downloadable references and instructional materials for scouts and leaders.</p>
            </div>
        </details>

        <details class="dropdown" id="get-involved">
            <summary>7. Get Involved</summary>
            <div class="dropdown-content">
                <ul>
                    <li>Join Scouting</li>
                    <li>Volunteer</li>
                    <li>Partner with us</li>
                    <li>Donate to Scouting</li>
                </ul>
                <a class="btn btn-primary" href="#">Coordinate with Council</a>
            </div>
        </details>
    </main>

    <footer>
        <div class="social-links">
            <a class="social-icon social-facebook" href="https://www.facebook.com/profile.php?id=61567997816720" target="_blank" rel="noopener noreferrer" aria-label="Facebook">
                <svg viewBox="0 0 24 24" aria-hidden="true">
                    <path d="M13.5 22v-8h2.7l.4-3h-3.1V9.1c0-.9.3-1.6 1.7-1.6h1.5V4.8c-.3 0-1.3-.1-2.4-.1-2.4 0-4.1 1.5-4.1 4.2V11H8v3h2.2v8h3.3Z"/>
                </svg>
            </a>
            <a class="social-icon social-instagram" href="https://www.instagram.com/" target="_blank" rel="noopener noreferrer" aria-label="Instagram">
                <svg viewBox="0 0 24 24" aria-hidden="true">
                    <path d="M7 2h10a5 5 0 0 1 5 5v10a5 5 0 0 1-5 5H7a5 5 0 0 1-5-5V7a5 5 0 0 1 5-5Zm0 2a3 3 0 0 0-3 3v10a3 3 0 0 0 3 3h10a3 3 0 0 0 3-3V7a3 3 0 0 0-3-3H7Zm5 3.8A5.2 5.2 0 1 1 6.8 13 5.2 5.2 0 0 1 12 7.8Zm0 2A3.2 3.2 0 1 0 15.2 13 3.2 3.2 0 0 0 12 9.8Zm5.5-3.3a1.2 1.2 0 1 1-1.2 1.2 1.2 1.2 0 0 1 1.2-1.2Z"/>
                </svg>
            </a>
            <a class="social-icon social-youtube" href="https://www.youtube.com/" target="_blank" rel="noopener noreferrer" aria-label="YouTube">
                <svg viewBox="0 0 24 24" aria-hidden="true">
                    <path d="M23 12c0 2.8-.3 4.7-.8 5.8a3 3 0 0 1-1.7 1.7c-1.1.5-3 .8-8.5.8s-7.4-.3-8.5-.8a3 3 0 0 1-1.7-1.7C1.3 16.7 1 14.8 1 12s.3-4.7.8-5.8a3 3 0 0 1 1.7-1.7C4.6 4 6.5 3.7 12 3.7s7.4.3 8.5.8a3 3 0 0 1 1.7 1.7c.5 1.1.8 3 .8 5.8ZM10 8.8v6.4l5.5-3.2L10 8.8Z"/>
                </svg>
            </a>
        </div>
        <p>&copy; {{ date('Y') }} Boy Scouts of the Philippines - Negros Occidental Council</p>
    </footer>
    <script>
        const stickyBar = document.getElementById("stickyBar");
        const heroLogo = document.querySelector(".hero-logo");
        const menuToggle = document.getElementById("menuToggle");
        const sideMenu = document.getElementById("sideMenu");
        const sideMenuOverlay = document.getElementById("sideMenuOverlay");
        const sideMenuLinks = sideMenu.querySelectorAll("a");

        function toggleStickyBar() {
            const heroLogoBottom = heroLogo.offsetTop + heroLogo.offsetHeight;
            stickyBar.classList.toggle("is-visible", window.scrollY > heroLogoBottom);
        }

        function closeMenu() {
            sideMenu.classList.remove("is-open");
            sideMenuOverlay.classList.remove("is-open");
            document.body.classList.remove("menu-open");
            menuToggle.setAttribute("aria-expanded", "false");
            menuToggle.setAttribute("aria-label", "Open menu");
        }

        function openMenu() {
            sideMenu.classList.add("is-open");
            sideMenuOverlay.classList.add("is-open");
            document.body.classList.add("menu-open");
            menuToggle.setAttribute("aria-expanded", "true");
            menuToggle.setAttribute("aria-label", "Close menu");
        }

        menuToggle.addEventListener("click", () => {
            if (sideMenu.classList.contains("is-open")) {
                closeMenu();
                return;
            }

            openMenu();
        });

        sideMenuOverlay.addEventListener("click", closeMenu);
        sideMenuLinks.forEach((link) => link.addEventListener("click", closeMenu));

        window.addEventListener("keydown", (event) => {
            if (event.key === "Escape") {
                closeMenu();
            }
        });

        window.addEventListener("scroll", toggleStickyBar);
        window.addEventListener("load", toggleStickyBar);
    </script>
</body>
</html>
