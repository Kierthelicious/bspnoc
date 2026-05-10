<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Negros Occidental Council</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.15/index.global.min.css">
    <style>
        :root {
            --primary: #0b2e59;
            --secondary: #1f4e79;
            --accent: #c9a227;
            --accent-cta: #e8c547;
            --surface: #f4f6f8;
            --white: #ffffff;
            --text: #1f2937;
            --muted: #64748b;
            --border: #d7dee6;
            --site-header-height: 56px;
            --site-header-compact-height: 48px;
        }

        * { box-sizing: border-box; }

        .visually-hidden {
            position: absolute;
            width: 1px;
            height: 1px;
            padding: 0;
            margin: -1px;
            overflow: hidden;
            clip: rect(0, 0, 0, 0);
            white-space: nowrap;
            border: 0;
        }

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

        body.site-search-open {
            overflow: hidden;
        }

        .site-header-wrap {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            z-index: 1200;
        }

        .site-header {
            position: relative;
            width: 100%;
            min-height: var(--site-header-height);
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            border-bottom: 2px solid var(--accent);
            box-shadow: 0 2px 12px rgba(0, 0, 0, 0.12);
            transition: min-height 0.28s ease, box-shadow 0.28s ease;
        }

        .site-header-inner {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0.45rem 0.85rem;
            display: flex;
            align-items: center;
            gap: 0.65rem;
            min-height: var(--site-header-height);
            transition: min-height 0.28s ease, padding 0.28s ease;
        }

        .site-header-wrap.is-compact-header .site-header {
            min-height: var(--site-header-compact-height);
            box-shadow: 0 4px 16px rgba(0, 0, 0, 0.18);
        }

        .site-header-wrap.is-compact-header .site-header-inner {
            min-height: var(--site-header-compact-height);
            padding: 0.32rem 0.85rem;
            justify-content: space-between;
        }

        .site-header-wrap.is-compact-header .site-header-logo-link {
            order: 1;
            margin-right: 0;
        }

        .site-header-wrap.is-compact-header .site-header-menu-btn {
            order: 5;
            margin-left: auto;
        }

        .site-header-wrap.is-compact-header .site-header-nav,
        .site-header-wrap.is-compact-header .site-header-actions {
            display: none !important;
        }

        .site-header-wrap.is-compact-header .site-header-logo {
            width: 34px;
            height: 34px;
        }

        .site-header-wrap.is-compact-header .site-header-logo-text {
            display: none !important;
        }

        .site-header-menu-btn {
            border: 0;
            background: transparent;
            color: #fff;
            width: 42px;
            height: 42px;
            padding: 0;
            cursor: pointer;
            border-radius: 8px;
            flex-shrink: 0;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .site-header-menu-btn:hover {
            background: rgba(255, 255, 255, 0.12);
        }

        .site-header-menu-btn svg {
            width: 22px;
            height: 22px;
            fill: currentColor;
        }

        .site-header-logo-link {
            display: flex;
            align-items: center;
            gap: 0.45rem;
            text-decoration: none;
            color: #fff;
            flex-shrink: 0;
            border-radius: 8px;
            padding: 0.15rem 0.35rem 0.15rem 0.15rem;
            margin-right: 0.25rem;
        }

        .site-header-logo-link:hover {
            background: rgba(255, 255, 255, 0.08);
        }

        .site-header-logo-link:focus-visible {
            outline: 2px solid var(--accent);
            outline-offset: 2px;
        }

        .site-header-logo {
            width: 40px;
            height: 40px;
            object-fit: contain;
            border-radius: 50%;
            background: #fff;
            border: 2px solid rgba(255, 255, 255, 0.88);
        }

        .site-header-logo-text {
            display: none;
            font-weight: 700;
            font-size: 0.78rem;
            line-height: 1.2;
            max-width: 9.5rem;
        }

        @media (min-width: 480px) {
            .site-header-logo-text {
                display: block;
            }
        }

        .site-header-nav {
            display: none;
            flex: 1;
            align-items: center;
            justify-content: center;
            flex-wrap: wrap;
            gap: 0.15rem 0.65rem;
            padding: 0 0.5rem;
        }

        .site-header-nav a {
            color: rgba(255, 255, 255, 0.94);
            text-decoration: none;
            font-weight: 600;
            font-size: 0.82rem;
            letter-spacing: 0.02em;
            padding: 0.4rem 0.45rem;
            border-radius: 6px;
            white-space: nowrap;
        }

        .site-header-nav a:hover {
            background: rgba(255, 255, 255, 0.14);
        }

        .site-header-nav a:focus-visible {
            outline: 2px solid var(--accent);
            outline-offset: 2px;
        }

        @media (min-width: 960px) {
            .site-header-wrap:not(.is-compact-header) .site-header-nav {
                display: flex;
            }

            .site-header-wrap:not(.is-compact-header) .site-header-menu-btn {
                display: none;
            }

            .site-header-wrap.is-compact-header .site-header-menu-btn {
                display: flex;
            }

            .site-header-wrap.is-compact-header .site-header-nav {
                display: none !important;
            }
        }

        .site-header-actions {
            display: flex;
            align-items: center;
            gap: 0.45rem;
            margin-left: auto;
            flex-shrink: 0;
        }

        .site-header-icon-btn {
            width: 40px;
            height: 40px;
            border: 0;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.12);
            color: #fff;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: background 0.15s ease;
        }

        .site-header-icon-btn:hover {
            background: rgba(255, 255, 255, 0.22);
        }

        .site-header-icon-btn svg {
            width: 20px;
            height: 20px;
            stroke: currentColor;
            fill: none;
            stroke-width: 2;
            stroke-linecap: round;
        }

        .site-header-icon-btn:focus-visible {
            outline: 2px solid var(--accent);
            outline-offset: 2px;
        }

        .site-header-cta {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 0.48rem 1rem;
            border-radius: 999px;
            background: linear-gradient(180deg, var(--accent-cta), var(--accent));
            color: #1c1608;
            font-weight: 700;
            font-size: 0.82rem;
            text-decoration: none;
            border: 1px solid rgba(180, 140, 30, 0.65);
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.2);
            white-space: nowrap;
            transition: filter 0.15s ease, transform 0.15s ease;
        }

        .site-header-cta:hover {
            filter: brightness(1.06);
        }

        .site-header-cta:active {
            transform: translateY(1px);
        }

        .site-header-cta:focus-visible {
            outline: 3px solid #fff;
            outline-offset: 2px;
        }

        .site-search-panel {
            position: relative;
            left: auto;
            right: auto;
            top: auto;
            width: 100%;
            z-index: 1;
            background: #fff;
            border-bottom: 1px solid var(--border);
            box-shadow: 0 12px 28px rgba(15, 23, 42, 0.12);
            max-height: min(70vh, 520px);
            display: flex;
            flex-direction: column;
        }

        .site-search-panel[hidden] {
            display: none !important;
        }

        .site-search-panel-inner {
            max-width: 720px;
            margin: 0 auto;
            padding: 0.85rem 1rem 1rem;
            width: 100%;
        }

        .site-search-row {
            display: flex;
            gap: 0.5rem;
            align-items: center;
        }

        .site-search-input {
            flex: 1;
            border: 1px solid var(--border);
            border-radius: 999px;
            padding: 0.55rem 1rem;
            font: inherit;
            font-size: 0.95rem;
            min-width: 0;
        }

        .site-search-input:focus {
            outline: none;
            border-color: var(--secondary);
            box-shadow: 0 0 0 3px rgba(31, 78, 121, 0.2);
        }

        .site-search-close {
            border: 0;
            background: #e2e8f0;
            color: #0f172a;
            padding: 0.45rem 0.75rem;
            border-radius: 8px;
            font-weight: 600;
            cursor: pointer;
            font-size: 0.85rem;
        }

        .site-search-results {
            margin-top: 0.75rem;
            overflow-y: auto;
            max-height: min(52vh, 400px);
            font-size: 0.9rem;
            color: #334155;
        }

        .site-search-results:empty {
            display: none;
        }

        .site-search-hit {
            display: block;
            width: 100%;
            text-align: left;
            border: 1px solid var(--border);
            border-radius: 8px;
            padding: 0.55rem 0.65rem;
            margin-bottom: 0.45rem;
            background: #f8fafc;
            cursor: pointer;
            font: inherit;
            color: inherit;
        }

        .site-search-hit:hover {
            border-color: var(--secondary);
            background: #eef4fb;
        }

        .site-search-hit strong {
            display: block;
            color: var(--primary);
            font-size: 0.8rem;
            margin-bottom: 0.2rem;
        }

        .site-search-hint {
            margin: 0 0 0.5rem;
            font-size: 0.85rem;
            color: var(--muted);
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
            position: relative;
            overflow: hidden;
            background-color: var(--primary);
            background-image:
                linear-gradient(rgba(11, 46, 89, 0.58), rgba(11, 46, 89, 0.58)),
                url('{{ asset('images/council-building.jpg') }}');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            color: var(--white);
            text-align: center;
            padding: calc(2.5rem + var(--site-header-height)) 1rem 2.2rem;
            border-bottom: 4px solid var(--accent);
        }

        .hero > * {
            position: relative;
            z-index: 1;
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
            color: #f1f5f9;
        }

        .container {
            max-width: 980px;
            margin: 0 auto;
            padding: 1.3rem 1rem 2.5rem;
        }

        main details.dropdown[id] {
            scroll-margin-top: calc(var(--site-header-height) + 12px);
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
            transition: background-color 0.15s ease;
        }

        .dropdown summary:hover { background: #e5e7eb; }

        .dropdown summary::-webkit-details-marker { display: none; }

        .dropdown[open] summary { background: #eef4fb; }

        .dropdown-content { padding: 0.85rem 1rem 1rem; }

        .dropdown-content ul { margin: 0.3rem 0 0 1.1rem; }

        .dropdown-content p { margin: 0.2rem 0 0.3rem; }

        .who-we-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(min(100%, 280px), 1fr));
            gap: 1.15rem;
            margin-top: 0.35rem;
        }

        .who-we-intro {
            margin: 0.2rem 0 0.65rem;
            color: #475569;
            font-size: 0.95rem;
        }

        .who-we-card {
            display: flex;
            flex-direction: column;
            border: 1px solid var(--border);
            border-radius: 12px;
            overflow: hidden;
            background: #fff;
            box-shadow: 0 1px 3px rgba(15, 23, 42, 0.06);
            cursor: pointer;
            transition: box-shadow 0.25s ease, border-color 0.25s ease;
            -webkit-tap-highlight-color: transparent;
        }

        .who-we-card:hover,
        .who-we-card:focus-visible {
            box-shadow: 0 12px 32px rgba(15, 23, 42, 0.14);
            border-color: #b8c5d8;
        }

        .who-we-card:active {
            box-shadow: 0 6px 18px rgba(15, 23, 42, 0.1);
        }

        .who-we-card:focus {
            outline: none;
        }

        .who-we-card:focus-visible {
            outline: 3px solid var(--accent);
            outline-offset: 3px;
        }

        .who-we-card-figure {
            margin: 0;
            aspect-ratio: 16 / 10;
            background: linear-gradient(145deg, #e2e8f0, #f1f5f9);
            flex-shrink: 0;
            overflow: hidden;
            isolation: isolate;
        }

        .who-we-card-figure img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            object-position: center;
            display: block;
            transform: scale(1);
            transition: transform 0.4s cubic-bezier(0.22, 1, 0.36, 1);
        }

        .who-we-card:hover .who-we-card-figure img,
        .who-we-card:focus-visible .who-we-card-figure img {
            transform: scale(1.06);
        }

        .who-we-card-body {
            padding: 1rem 1.1rem 1.15rem;
            flex: 1;
            display: grid;
            grid-template-rows: auto minmax(2.8rem, auto) 1fr;
            align-content: start;
            gap: 0.5rem;
            min-height: 0;
        }

        .who-we-card-body h3 {
            margin: 0;
            font-size: 1.05rem;
            line-height: 1.35;
            color: var(--primary);
            display: flex;
            align-items: flex-start;
        }

        .who-we-card-kicker {
            margin: 0;
            font-size: 0.78rem;
            font-weight: 700;
            letter-spacing: 0.04em;
            text-transform: uppercase;
            color: #8b6b08;
        }

        .who-we-card-body p {
            margin: 0;
            color: #475569;
            font-size: 0.92rem;
            line-height: 1.55;
            flex: 1;
        }

        .who-we-lightbox {
            position: fixed;
            inset: 0;
            z-index: 2000;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: max(1rem, env(safe-area-inset-top)) max(1rem, env(safe-area-inset-right)) max(1rem, env(safe-area-inset-bottom)) max(1rem, env(safe-area-inset-left));
            opacity: 0;
            visibility: hidden;
            pointer-events: none;
            transition: opacity 0.28s ease, visibility 0.28s ease;
        }

        .who-we-lightbox.is-open {
            opacity: 1;
            visibility: visible;
            pointer-events: auto;
        }

        .who-we-lightbox-backdrop {
            position: absolute;
            inset: 0;
            background: rgba(15, 23, 42, 0.55);
            backdrop-filter: blur(4px);
        }

        .who-we-lightbox-panel {
            position: relative;
            z-index: 1;
            width: min(96vw, 980px);
            max-height: min(93dvh, 980px);
            display: flex;
            flex-direction: column;
            background: #fff;
            border-radius: 14px;
            overflow: hidden;
            box-shadow: 0 24px 60px rgba(0, 0, 0, 0.28);
            border: 1px solid rgba(255, 255, 255, 0.2);
            transform: scale(0.92) translateY(12px);
            opacity: 0;
            transition: transform 0.32s cubic-bezier(0.22, 1, 0.36, 1), opacity 0.28s ease;
        }

        .who-we-lightbox.is-open .who-we-lightbox-panel {
            transform: scale(1) translateY(0);
            opacity: 1;
        }

        .who-we-lightbox-close {
            position: absolute;
            top: 0.55rem;
            right: 0.55rem;
            z-index: 3;
            width: 42px;
            height: 42px;
            border: 0;
            border-radius: 50%;
            background: rgba(15, 23, 42, 0.72);
            color: #fff;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.45rem;
            line-height: 1;
            transition: background 0.15s ease, transform 0.15s ease;
        }

        .who-we-lightbox-close:hover {
            background: rgba(15, 23, 42, 0.9);
        }

        .who-we-lightbox-close:focus-visible {
            outline: 3px solid var(--accent);
            outline-offset: 2px;
        }

        .who-we-lightbox-figure {
            margin: 0;
            flex-shrink: 0;
            width: 100%;
            aspect-ratio: 16 / 9;
            max-height: min(48dvh, 420px);
            min-height: 160px;
            background: #e2e8f0;
            overflow: hidden;
            position: relative;
        }

        .who-we-lightbox-figure img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            object-position: center;
            display: block;
        }

        .who-we-lightbox-nav {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            width: 44px;
            height: 44px;
            border: 0;
            border-radius: 999px;
            background: rgba(15, 23, 42, 0.72);
            color: #fff;
            cursor: pointer;
            display: grid;
            place-items: center;
            font-size: 1.7rem;
            line-height: 1;
            z-index: 2;
            transition: background 0.15s ease, transform 0.15s ease, opacity 0.15s ease;
            opacity: 0.95;
        }

        .who-we-lightbox-nav:hover {
            background: rgba(15, 23, 42, 0.9);
        }

        .who-we-lightbox-nav:active {
            transform: translateY(-50%) scale(0.97);
        }

        .who-we-lightbox-nav:focus-visible {
            outline: 3px solid var(--accent);
            outline-offset: 2px;
        }

        .who-we-lightbox-prev { left: 0.65rem; }
        .who-we-lightbox-next { right: 0.65rem; }

        @media (max-width: 480px) {
            .who-we-lightbox-nav {
                width: 40px;
                height: 40px;
                font-size: 1.55rem;
            }

            .who-we-lightbox-prev { left: 0.5rem; }
            .who-we-lightbox-next { right: 0.5rem; }
        }

        .who-we-lightbox-body {
            padding: 1.15rem 1.35rem 1.35rem;
            overflow-y: auto;
            flex: 1;
            min-height: 0;
        }

        .who-we-lightbox-body h2 {
            margin: 0 0 0.6rem;
            font-size: clamp(1.15rem, 3.5vw, 1.45rem);
            color: var(--primary);
            padding-right: 2.9rem;
            min-height: 2.3rem;
            display: flex;
            align-items: center;
        }

        .who-we-lightbox-body:has(p:empty) h2 {
            margin-bottom: 0;
        }

        .who-we-lightbox-body p {
            margin: 0;
            color: #475569;
            font-size: clamp(0.95rem, 2.4vw, 1.05rem);
            line-height: 1.6;
        }

        .who-we-lightbox-copy {
            color: #334155;
            font-size: 0.98rem;
            line-height: 1.65;
        }

        .who-we-lightbox-copy p {
            margin: 0 0 0.65rem;
            font-size: inherit;
            line-height: inherit;
            color: inherit;
        }

        .who-we-lightbox-copy p:last-child {
            margin-bottom: 0;
        }

        .who-we-lightbox-copy h4 {
            margin: 0.85rem 0 0.45rem;
            font-size: 1rem;
            color: var(--primary);
        }

        .who-we-lightbox-copy ul {
            margin: 0.35rem 0 0.75rem 1.1rem;
            padding: 0;
        }

        .who-we-lightbox-copy li {
            margin: 0.22rem 0;
        }

        .who-we-lightbox-columns {
            display: grid;
            grid-template-columns: 1fr;
            gap: 0.85rem;
        }

        .who-we-lightbox-lang-grid {
            display: grid;
            grid-template-columns: 1fr;
            gap: 0.75rem;
        }

        .who-we-lightbox-lang-panel {
            border: 1px solid #dbe3ed;
            border-radius: 10px;
            padding: 0.75rem 0.85rem;
            background: #f8fafc;
        }

        .who-we-lightbox-lang-panel h5 {
            margin: 0 0 0.45rem;
            font-size: 0.9rem;
            color: #0f172a;
        }

        .who-we-lightbox-lang-panel p {
            margin: 0;
        }

        .who-we-lightbox-body p:empty {
            display: none;
        }

        body.who-we-lightbox-open {
            overflow: hidden;
        }

        @media (min-width: 640px) {
            .who-we-lightbox-panel {
                max-height: min(92dvh, 960px);
            }

            .who-we-lightbox-columns {
                grid-template-columns: 1fr 1fr;
            }

            .who-we-lightbox-lang-grid {
                grid-template-columns: 1fr 1fr;
            }
        }

        @media (prefers-reduced-motion: reduce) {
            .site-header,
            .site-header-inner {
                transition: none;
            }

            .who-we-card,
            .who-we-lightbox,
            .who-we-lightbox-panel,
            .who-we-card-figure img {
                transition: none;
            }

            .who-we-card:hover .who-we-card-figure img,
            .who-we-card:focus-visible .who-we-card-figure img {
                transform: none;
            }

            .who-we-lightbox.is-open .who-we-lightbox-panel {
                transform: none;
            }
        }

        .events-planner {
            margin-top: 0.95rem;
            border: 1px solid var(--border);
            border-radius: 10px;
            padding: 0.9rem;
            background: #f8fafc;
        }

        .events-planner[hidden] {
            display: none;
        }

        .events-helper {
            margin: 0 0 0.7rem;
            color: #334155;
            font-size: 0.93rem;
        }

        .event-form {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(165px, 1fr));
            gap: 0.6rem;
            margin-bottom: 0.9rem;
        }

        .event-form input,
        .event-form select {
            width: 100%;
            border: 1px solid #cbd5e1;
            border-radius: 7px;
            padding: 0.5rem 0.6rem;
            font: inherit;
            background: #fff;
        }

        .event-form button {
            border: 0;
            border-radius: 7px;
            padding: 0.55rem 0.7rem;
            background: var(--primary);
            color: #fff;
            font: inherit;
            font-weight: 600;
            cursor: pointer;
        }

        .event-form .secondary-action {
            background: #64748b;
        }

        .events-layout {
            display: grid;
            grid-template-columns: 1fr;
            gap: 0.9rem;
        }

        .events-card {
            border: 1px solid #dbe3ed;
            border-radius: 9px;
            background: #fff;
            padding: 0.8rem;
        }

        .events-card h3 {
            margin: 0 0 0.5rem;
            color: #0f172a;
            font-size: 1rem;
        }

        #eventCalendar {
            min-height: 390px;
        }

        #negrosMap {
            height: 280px;
            border-radius: 8px;
            overflow: hidden;
            border: 1px solid #cbd5e1;
            margin-bottom: 0.65rem;
        }

        .selected-event-meta {
            margin: 0;
            color: #334155;
            font-size: 0.92rem;
        }

        .events-for-date {
            margin: 0.55rem 0 0;
            padding-left: 1.1rem;
        }

        .events-for-date button {
            border: 0;
            background: transparent;
            color: var(--secondary);
            cursor: pointer;
            padding: 0;
            text-decoration: underline;
            font: inherit;
        }

        .events-for-date .edit-event-btn {
            margin-left: 0.45rem;
            color: #0f766e;
        }

        @media (min-width: 920px) {
            .events-layout {
                grid-template-columns: 1.15fr 1fr;
            }
        }

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
        .social-tiktok {
            background: #000;
            color: #fff;
        }
        .social-tiktok svg {
            width: 17px;
            height: 17px;
        }
    </style>
</head>
<body id="top">
    <div class="site-header-wrap" id="siteHeaderWrap">
    <header class="site-header" role="banner">
        <div class="site-header-inner">
            <button class="site-header-menu-btn" id="menuToggle" type="button" aria-label="Open menu" aria-expanded="false">
                <svg viewBox="0 0 24 24" aria-hidden="true">
                    <path fill="currentColor" d="M3 6h18v2H3V6Zm0 5h18v2H3v-2Zm0 5h18v2H3v-2Z"/>
                </svg>
            </button>
            <a class="site-header-logo-link" href="#top" aria-label="BSP Negros Occidental Council — Home">
                <img class="site-header-logo" src="{{ asset('images/council-logo.png') }}" alt="" width="40" height="40">
                <span class="site-header-logo-text">BSP Negros Occidental Council</span>
            </a>
            <nav class="site-header-nav" aria-label="Primary navigation">
                <a href="#who-we-are">About Us</a>
                <a href="#what-we-do">Programs</a>
                <a href="#newsroom">Memos</a>
                <a href="#events">Events</a>
                <a href="#learning-aids">Resources</a>
                <a href="#scout-shop">Shop</a>
            </nav>
            <div class="site-header-actions">
                <button type="button" class="site-header-icon-btn" id="siteSearchToggle" aria-expanded="false" aria-controls="siteSearchPanel" aria-label="Search memos and learning aids">
                    <svg viewBox="0 0 24 24" aria-hidden="true">
                        <circle cx="11" cy="11" r="7"/>
                        <path d="M20 20l-4.35-4.35"/>
                    </svg>
                </button>
                <a class="site-header-cta" href="#get-involved">Join Us</a>
            </div>
        </div>
    </header>

    <div class="site-search-panel" id="siteSearchPanel" hidden role="search">
        <div class="site-search-panel-inner">
            <p class="site-search-hint" id="siteSearchHint">Find council memos, updates, and learning aid titles.</p>
            <div class="site-search-row">
                <label for="siteSearchInput" class="visually-hidden">Search</label>
                <input type="search" class="site-search-input" id="siteSearchInput" name="q" placeholder="Search memos and resources…" autocomplete="off">
                <button type="button" class="site-search-close" id="siteSearchClose">Close</button>
            </div>
            <div class="site-search-results" id="siteSearchResults" role="listbox" aria-live="polite"></div>
        </div>
    </div>
    </div>

    <div class="side-menu-overlay" id="sideMenuOverlay"></div>
    <nav class="side-menu" id="sideMenu" aria-label="Main menu">
        <div class="side-menu-header">Menu</div>
        <a href="#who-we-are"><span>About Us</span><span>&rarr;</span></a>
        <a href="#what-we-do"><span>Programs</span><span>&rarr;</span></a>
        <a href="#newsroom"><span>Memos</span><span>&rarr;</span></a>
        <a href="#events"><span>Events</span><span>&rarr;</span></a>
        <a href="#learning-aids"><span>Resources</span><span>&rarr;</span></a>
        <a href="#scout-shop"><span>Shop</span><span>&rarr;</span></a>
        <a href="#get-involved"><span>Join Us</span><span>&rarr;</span></a>
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
                <p class="who-we-intro">Discover the principles that shape every scout in Negros Occidental: our promise, values, and council direction.</p>
                <div class="who-we-grid">
                    <article class="who-we-card" id="council-history" tabindex="0" role="button" aria-haspopup="dialog" aria-label="Open Negros Occidental Council History">
                        <figure class="who-we-card-figure">
                            <img src="{{ asset('images/council-building.jpg') }}" alt="Negros Occidental Council building" width="640" height="400" loading="lazy">
                        </figure>
                        <div class="who-we-card-body">
                            <h3>Negros Occidental Council History</h3>
                            <p>How the Boy Scouts of the Philippines serves Negros Occidental—local milestones, growth of units, and the council’s role in youth development across the province.</p>
                        </div>
                    </article>
                    <article class="who-we-card" id="council-executive-staff" tabindex="0" role="button" aria-haspopup="dialog" aria-label="Open Council Executive and Staff">
                        <figure class="who-we-card-figure">
                            <img src="{{ asset('images/council-building.jpg') }}" alt="Council executive and staff" width="640" height="400" loading="lazy">
                        </figure>
                        <div class="who-we-card-body">
                            <h3>Negros Occidental Council Executive and Staff</h3>
                            <p>The professional team that supports units, training, and programs day to day—names, roles, and how leaders and families can reach the council office.</p>
                        </div>
                    </article>
                    <article class="who-we-card" id="council-board" tabindex="0" role="button" aria-haspopup="dialog" aria-label="Open Council Chairman and Executive Board">
                        <figure class="who-we-card-figure">
                            <img src="{{ asset('images/council-building.jpg') }}" alt="Council chairman and executive board" width="640" height="400" loading="lazy">
                        </figure>
                        <div class="who-we-card-body">
                            <h3>Council Chairman and Executive Board Members</h3>
                            <p>Volunteer leadership guiding policy and priorities for scouting in Negros Occidental—the council chairman, board, and how they work with communities and partners.</p>
                        </div>
                    </article>
                    <article class="who-we-card" id="scout-oath-law" tabindex="0" role="button" aria-haspopup="dialog" aria-label="Open Scout Oath and Law" data-detail-template="detail-scout-oath-law">
                        <figure class="who-we-card-figure">
                            <img src="{{ asset('images/council-building.jpg') }}" alt="Scout Oath and Law" width="640" height="400" loading="lazy">
                        </figure>
                        <div class="who-we-card-body">
                            <p class="who-we-card-kicker">Core Promise</p>
                            <h3>Scout Oath and Law</h3>
                            <p>The promises every scout lives by in the BSP program—the Oath and Law as practiced in Negros Occidental units, camps, and service activities.</p>
                        </div>
                    </article>
                    <article class="who-we-card" id="scout-ideals" tabindex="0" role="button" aria-haspopup="dialog" aria-label="Open Scout Ideals" data-detail-template="detail-scout-ideals">
                        <figure class="who-we-card-figure">
                            <img src="{{ asset('images/council-building.jpg') }}" alt="Scout ideals" width="640" height="400" loading="lazy">
                        </figure>
                        <div class="who-we-card-body">
                            <p class="who-we-card-kicker">Formation</p>
                            <h3>Scout Ideals</h3>
                            <p>The Scout Ideals are rooted in the Scout Oath and Law and guide how a scout lives with honor, service, discipline, and moral responsibility every day.</p>
                        </div>
                    </article>
                    <article class="who-we-card" id="mission-vision" tabindex="0" role="button" aria-haspopup="dialog" aria-label="Open Mission and Vision" data-detail-template="detail-mission-vision">
                        <figure class="who-we-card-figure">
                            <img src="{{ asset('images/council-building.jpg') }}" alt="Mission and vision" width="640" height="400" loading="lazy">
                        </figure>
                        <div class="who-we-card-body">
                            <p class="who-we-card-kicker">Council Direction</p>
                            <h3>Mission and Vision</h3>
                            <p>To lead progressive outdoor-based non-formal education and prepare morally upright, disciplined, and self-reliant Filipino citizens.</p>
                        </div>
                    </article>
                </div>
                <template id="detail-scout-oath-law">
                    <div class="who-we-lightbox-copy who-we-lightbox-columns">
                        <section>
                            <h4>The Scout Oath</h4>
                            <div class="who-we-lightbox-lang-grid">
                                <article class="who-we-lightbox-lang-panel">
                                    <h5>English</h5>
                                    <p>On my honor, I will do my best:</p>
                                    <p>To do my duty to God and my country, the Republic of the Philippines</p>
                                    <p>And to obey the Scout Law;</p>
                                    <p>To help other people at all times;</p>
                                    <p>To keep myself physically strong, mentally awake and morally straight.</p>
                                </article>
                                <article class="who-we-lightbox-lang-panel">
                                    <h5>Filipino</h5>
                                    <p>Sa ngalan ng aking dangal, ay gagawin ko ang buong makakaya</p>
                                    <p>Upang tumupad sa aking tungkulin sa Diyos at sa aking Bayan, ang Republika ng Pilipinas, at sumunod sa Batas ng Scout;</p>
                                    <p>Tumulong sa ibang tao sa lahat ng pagkakataon;</p>
                                    <p>Pamalagiing malakas ang aking katawan, gising ang isipan, at marangal ang asal.</p>
                                </article>
                            </div>
                        </section>
                        <section>
                            <h4>The Scout Law</h4>
                            <div class="who-we-lightbox-lang-grid">
                                <article class="who-we-lightbox-lang-panel">
                                    <h5>English</h5>
                                    <p>A Scout is:</p>
                                    <ul>
                                        <li>Trustworthy</li>
                                        <li>Loyal</li>
                                        <li>Helpful</li>
                                        <li>Friendly</li>
                                        <li>Courteous</li>
                                        <li>Kind</li>
                                        <li>Obedient</li>
                                        <li>Cheerful</li>
                                        <li>Thrifty</li>
                                        <li>Brave</li>
                                        <li>Clean</li>
                                        <li>Reverent</li>
                                    </ul>
                                </article>
                                <article class="who-we-lightbox-lang-panel">
                                    <h5>Filipino</h5>
                                    <p>Ang Scout ay:</p>
                                    <ul>
                                        <li>Mapagkakatiwalaan</li>
                                        <li>Matapat</li>
                                        <li>Matulungin</li>
                                        <li>Mapagkaibigan</li>
                                        <li>Magalang</li>
                                        <li>Mabait</li>
                                        <li>Masunurin</li>
                                        <li>Masaya</li>
                                        <li>Matipid</li>
                                        <li>Matapang</li>
                                        <li>Malinis</li>
                                        <li>Maka-Diyos</li>
                                    </ul>
                                </article>
                            </div>
                        </section>
                    </div>
                </template>
                <template id="detail-scout-ideals">
                    <div class="who-we-lightbox-copy">
                        <p>The Scout Ideals are made up of what is contained in the Scout Oath and the Scout Law. They form a code for living and a standard of conduct for every scout.</p>
                        <h4>Foundation of the Scout Ideals</h4>
                        <ul>
                            <li><strong>On my honor</strong> - a scout's honor is sacred, and trustworthiness is the core of character.</li>
                            <li><strong>I will do my best</strong> - a scout gives his best effort in every duty and task.</li>
                            <li><strong>Duty to God and country</strong> - faith, patriotism, and responsible citizenship are central obligations.</li>
                            <li><strong>Obey the Scout Law</strong> - daily conduct is guided by the 12 points of the Law.</li>
                            <li><strong>Help other people at all times</strong> - service to others is a constant commitment.</li>
                            <li><strong>Physically strong, mentally awake, morally straight</strong> - total personal development in body, mind, and values.</li>
                        </ul>
                        <h4>Scout Law in Practice</h4>
                        <p>A scout is Trustworthy, Loyal, Helpful, Friendly, Courteous, Kind, Obedient, Cheerful, Thrifty, Brave, Clean, and Reverent. These are not only words to memorize, but habits to live at home, in school, in the troop, and in the community.</p>
                        <h4>Scout Spirit</h4>
                        <p>Scout spirit is living the Oath and Law every day. It is shown in attitude, decisions, speech, and action. As taught in training, example is essential: leaders and scouts alike must practice these ideals consistently.</p>
                        <h4>Motto and Slogan</h4>
                        <p><strong>Laging Handa (Be Prepared)</strong> reminds scouts to be ready with knowledge and skills for responsible citizenship and service. <strong>Do a Good Turn Daily (Gumawa ng Mabuti Araw-Araw)</strong> challenges every scout to intentionally do good each day.</p>
                    </div>
                </template>
                <template id="detail-mission-vision">
                    <div class="who-we-lightbox-copy">
                        <h4>Vision</h4>
                        <p>To be the leading provider of progressive outdoor-based non-formal education committed to develop morally straight, disciplined, concerned, self-reliant citizens in the best tradition of World Scouting.</p>
                        <h4>Mission</h4>
                        <p>To inculcate in our Scouts and love of God, country and fellowmen; to prepare the youth for responsible leadership; and to contribute to nation-building according to the ideals, principles and program of Scouting.</p>
                    </div>
                </template>
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
                <p data-search-item>Find official advisories, announcements, and council memoranda for Negros Occidental units and partners.</p>
                <ul>
                    <li data-search-item>Memo 2026-014: Provincial Camp Safety Protocols</li>
                    <li data-search-item>Memo 2026-010: Annual Registration and Unit Validation</li>
                    <li data-search-item>Memo 2026-006: School-LGU Partnership Guidelines</li>
                </ul>
                <a class="btn btn-primary" href="#">View All Memos</a>
            </div>
        </details>

        <details class="dropdown" id="events">
            <summary>4. Events</summary>
            <div class="dropdown-content">
                <p>Schedules for camps, trainings, leadership activities, and provincial events.</p>
                <button class="btn btn-secondary" id="toggleEventPlanner" type="button">View Event Calendar</button>
                <section class="events-planner" id="eventPlanner" hidden>
                    <p class="events-helper">Select a date on the calendar to check events. Add new events and the map will point to their location in Negros Occidental.</p>
                    <form class="event-form" id="eventForm">
                        <input id="eventTitle" name="eventTitle" type="text" placeholder="Event title" required>
                        <input id="eventDate" name="eventDate" type="date" required>
                        <input id="editingEventId" type="hidden">
                        <select id="eventLocation" name="eventLocation" required>
                            <option value="">Select municipality/city</option>
                            <option value="Bacolod City|10.6765|122.9511">Bacolod City</option>
                            <option value="Bago City|10.5317|122.8331">Bago City</option>
                            <option value="Cadiz City|10.9465|123.2884">Cadiz City</option>
                            <option value="Escalante City|10.8402|123.4994">Escalante City</option>
                            <option value="Himamaylan City|10.0984|122.8700">Himamaylan City</option>
                            <option value="Kabankalan City|9.9902|122.8143">Kabankalan City</option>
                            <option value="La Carlota City|10.4224|122.9202">La Carlota City</option>
                            <option value="Sagay City|10.9001|123.4115">Sagay City</option>
                            <option value="San Carlos City|10.4852|123.4188">San Carlos City</option>
                            <option value="Silay City|10.7960|122.9730">Silay City</option>
                            <option value="Talisay City|10.7376|122.9667">Talisay City</option>
                            <option value="Victorias City|10.8998|123.0706">Victorias City</option>
                            <option value="Hinigaran|10.2700|122.8500">Hinigaran</option>
                            <option value="Pontevedra|10.3744|122.8678">Pontevedra</option>
                            <option value="Sipalay|9.7530|122.4657">Sipalay</option>
                        </select>
                        <button id="saveEventButton" type="submit">Add Event</button>
                        <button id="cancelEditEventButton" class="secondary-action" type="button" hidden>Cancel Edit</button>
                    </form>

                    <div class="events-layout">
                        <article class="events-card">
                            <h3>Calendar</h3>
                            <div id="eventCalendar"></div>
                        </article>
                        <article class="events-card">
                            <h3>Negros Occidental Event Map</h3>
                            <div id="negrosMap"></div>
                            <p class="selected-event-meta" id="selectedEventDetails">Pick a date or event to show location details.</p>
                            <ul class="events-for-date" id="eventsForDate"></ul>
                        </article>
                    </div>
                </section>
            </div>
        </details>

        <details class="dropdown" id="scout-shop">
            <summary>5. Scout Shop</summary>
            <div class="dropdown-content">
                <p data-search-item>Official uniforms, badges, handbooks, and scouting essentials for units in Negros Occidental.</p>
                <a class="btn btn-secondary" href="#">Visit Scout Shop</a>
            </div>
        </details>

        <details class="dropdown" id="learning-aids">
            <summary>6. Learning Aids</summary>
            <div class="dropdown-content">
                <p data-search-item>Downloadable references and instructional materials for scouts, leaders, and training teams across the council.</p>
                <ul>
                    <li data-search-item>Advancement and program guides for patrol and troop operations</li>
                    <li data-search-item>Outdoor skills and safety briefing aids</li>
                    <li data-search-item>Youth protection and adult volunteer onboarding summaries</li>
                    <li data-search-item>Camp craft checklists and council activity templates</li>
                </ul>
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

    <div class="who-we-lightbox" id="whoWeLightbox" hidden aria-hidden="true" role="dialog" aria-modal="true" aria-labelledby="whoWeLightboxTitle">
        <div class="who-we-lightbox-backdrop" id="whoWeLightboxBackdrop" tabindex="-1"></div>
        <div class="who-we-lightbox-panel">
            <button type="button" class="who-we-lightbox-close" id="whoWeLightboxClose" aria-label="Close expanded view">&times;</button>
            <figure class="who-we-lightbox-figure">
                <img id="whoWeLightboxImg" src="" alt="">
                <button type="button" class="who-we-lightbox-nav who-we-lightbox-prev" id="whoWeLightboxPrev" aria-label="Previous item">
                    <span aria-hidden="true">&#x2039;</span>
                </button>
                <button type="button" class="who-we-lightbox-nav who-we-lightbox-next" id="whoWeLightboxNext" aria-label="Next item">
                    <span aria-hidden="true">&#x203A;</span>
                </button>
            </figure>
            <div class="who-we-lightbox-body">
                <h2 id="whoWeLightboxTitle"></h2>
                <div id="whoWeLightboxText"></div>
            </div>
        </div>
    </div>

    <footer>
        <div class="social-links">
            <a class="social-icon social-facebook" href="https://www.facebook.com/profile.php?id=61588700494967" target="_blank" rel="noopener noreferrer" aria-label="Facebook">
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
            <a class="social-icon social-tiktok" href="https://www.tiktok.com/@bsp.negros.occide?_r=1&amp;_t=ZS-964XALWFXAy" target="_blank" rel="noopener noreferrer" aria-label="TikTok (@bsp.negros.occide)">
                <svg viewBox="0 0 24 24" aria-hidden="true" fill="currentColor">
                    <path d="M19.59 6.69a4.83 4.83 0 0 1-3.77-4.25V2h-3.45v13.67a2.89 2.89 0 0 1-5.2 1.74 2.89 2.89 0 0 1 2.31-4.64 2.93 2.93 0 0 1 .88.13V9.4a6.84 6.84 0 0 0-1-.05A6.33 6.33 0 0 0 5 20.1a6.34 6.34 0 0 0 10.86-4.43v-7a8.16 8.16 0 0 0 4.77 1.52v-3.4a4.85 4.85 0 0 1-1-.1z"/>
                </svg>
            </a>
        </div>
        <p>&copy; {{ date('Y') }} Boy Scouts of the Philippines - Negros Occidental Council</p>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.15/index.global.min.js"></script>
    <script>
        const menuToggle = document.getElementById("menuToggle");
        const siteHeaderWrap = document.getElementById("siteHeaderWrap");
        const siteSearchPanel = document.getElementById("siteSearchPanel");
        const siteSearchToggle = document.getElementById("siteSearchToggle");
        const siteSearchClose = document.getElementById("siteSearchClose");
        const siteSearchInput = document.getElementById("siteSearchInput");
        const siteSearchResults = document.getElementById("siteSearchResults");
        const sideMenu = document.getElementById("sideMenu");
        const sideMenuOverlay = document.getElementById("sideMenuOverlay");
        const sideMenuLinks = sideMenu.querySelectorAll("a");
        const toggleEventPlannerButton = document.getElementById("toggleEventPlanner");
        const eventPlanner = document.getElementById("eventPlanner");
        const eventForm = document.getElementById("eventForm");
        const eventTitleInput = document.getElementById("eventTitle");
        const eventDateInput = document.getElementById("eventDate");
        const editingEventIdInput = document.getElementById("editingEventId");
        const saveEventButton = document.getElementById("saveEventButton");
        const cancelEditEventButton = document.getElementById("cancelEditEventButton");
        const eventLocationInput = document.getElementById("eventLocation");
        const eventsForDateElement = document.getElementById("eventsForDate");
        const selectedEventDetails = document.getElementById("selectedEventDetails");
        const whoWeLightbox = document.getElementById("whoWeLightbox");
        const whoWeLightboxBackdrop = document.getElementById("whoWeLightboxBackdrop");
        const whoWeLightboxClose = document.getElementById("whoWeLightboxClose");
        const whoWeLightboxPrev = document.getElementById("whoWeLightboxPrev");
        const whoWeLightboxNext = document.getElementById("whoWeLightboxNext");
        const whoWeLightboxImg = document.getElementById("whoWeLightboxImg");
        const whoWeLightboxTitle = document.getElementById("whoWeLightboxTitle");
        const whoWeLightboxText = document.getElementById("whoWeLightboxText");
        const whoWeCards = document.querySelectorAll(".who-we-card");

        let whoWeLightboxReturnFocus = null;
        let whoWeLightboxCloseTimer = null;
        let whoWeLightboxIndex = -1;

        const NEGROS_OCCIDENTAL_BOUNDS = [[9.45, 122.2], [11.2, 123.7]];
        const NEGROS_OCCIDENTAL_CENTER = [10.56, 122.95];
        const EVENTS_STORAGE_KEY = "negros_council_events_v1";
        const initialEvents = [
            { id: "evt-1", title: "Council Leaders Training", date: "2026-05-14", locationName: "Bacolod City", lat: 10.6765, lng: 122.9511 },
            { id: "evt-2", title: "Provincial Camp Orientation", date: "2026-05-22", locationName: "Kabankalan City", lat: 9.9902, lng: 122.8143 },
            { id: "evt-3", title: "Community Scouting Day", date: "2026-06-03", locationName: "Sagay City", lat: 10.9001, lng: 123.4115 }
        ];

        let plannerReady = false;
        let plannerMap = null;
        let plannerMarker = null;
        let plannerCalendar = null;
        let selectedDate = null;
        let eventRecords = [];

        const SEARCH_SECTION_LABELS = {
            newsroom: "Memos — Newsroom",
            "learning-aids": "Resources — Learning Aids",
            "scout-shop": "Shop — Scout Shop"
        };

        function collectSearchEntries() {
            const entries = [];

            ["newsroom", "learning-aids", "scout-shop"].forEach((sectionId) => {
                const root = document.getElementById(sectionId);

                if (!root) {
                    return;
                }

                root.querySelectorAll("[data-search-item]").forEach((element, index) => {
                    const text = element.textContent.trim().replace(/\s+/g, " ");

                    if (!text) {
                        return;
                    }

                    entries.push({
                        sectionId,
                        label: SEARCH_SECTION_LABELS[sectionId] || sectionId,
                        text,
                        key: `${sectionId}-${index}`
                    });
                });
            });

            return entries;
        }

        function openSectionAndScroll(sectionId) {
            const target = document.getElementById(sectionId);

            if (!target) {
                return;
            }

            if (target.tagName === "DETAILS") {
                target.open = true;
            }

            target.scrollIntoView({ behavior: "smooth", block: "start" });
        }

        function closeSiteSearch() {
            if (!siteSearchPanel) {
                return;
            }

            siteSearchPanel.setAttribute("hidden", "");

            if (siteSearchToggle) {
                siteSearchToggle.setAttribute("aria-expanded", "false");
            }

            document.body.classList.remove("site-search-open");

            if (siteSearchResults) {
                siteSearchResults.innerHTML = "";
            }

            if (siteSearchInput) {
                siteSearchInput.value = "";
            }

            updateSiteHeaderScrollVisibility();
        }

        function openSiteSearch() {
            if (!siteSearchPanel) {
                return;
            }

            if (siteHeaderWrap) {
                siteHeaderWrap.classList.remove("is-compact-header");
            }

            siteSearchPanel.removeAttribute("hidden");

            if (siteSearchToggle) {
                siteSearchToggle.setAttribute("aria-expanded", "true");
            }

            document.body.classList.add("site-search-open");

            if (siteSearchInput) {
                siteSearchInput.focus();
                siteSearchInput.select();
            }

            if (siteSearchInput && siteSearchInput.value.trim()) {
                renderSiteSearchResults(siteSearchInput.value);
            }
        }

        function renderSiteSearchResults(rawQuery) {
            if (!siteSearchResults) {
                return;
            }

            const query = rawQuery.trim().toLowerCase();
            siteSearchResults.innerHTML = "";

            if (!query) {
                return;
            }

            const hits = collectSearchEntries().filter((entry) => entry.text.toLowerCase().includes(query));

            if (!hits.length) {
                siteSearchResults.innerHTML = "<p class=\"site-search-hint\">No matches yet. Try another word or open Memos and Resources below.</p>";
                return;
            }

            hits.forEach((hit) => {
                const row = document.createElement("button");
                row.type = "button";
                row.className = "site-search-hit";
                row.innerHTML = `<strong>${hit.label}</strong><span>${hit.text}</span>`;
                row.addEventListener("click", () => {
                    openSectionAndScroll(hit.sectionId);
                    closeSiteSearch();
                });
                siteSearchResults.appendChild(row);
            });
        }

        function loadStoredEvents() {
            const rawData = localStorage.getItem(EVENTS_STORAGE_KEY);

            if (!rawData) {
                return [...initialEvents];
            }

            try {
                const parsed = JSON.parse(rawData);
                return Array.isArray(parsed) ? parsed : [...initialEvents];
            } catch (_error) {
                return [...initialEvents];
            }
        }

        function saveEvents() {
            localStorage.setItem(EVENTS_STORAGE_KEY, JSON.stringify(eventRecords));
        }

        function eventById(eventId) {
            return eventRecords.find((item) => item.id === eventId);
        }

        function locationValueFromEvent(eventInfo) {
            return `${eventInfo.locationName}|${eventInfo.lat}|${eventInfo.lng}`;
        }

        function refreshCalendarEvents() {
            plannerCalendar.removeAllEvents();
            eventRecords.forEach((item) => {
                plannerCalendar.addEvent({
                    title: item.title,
                    start: item.date,
                    allDay: true,
                    extendedProps: { eventId: item.id }
                });
            });
        }

        function resetEventForm() {
            eventForm.reset();
            editingEventIdInput.value = "";
            saveEventButton.textContent = "Add Event";
            cancelEditEventButton.setAttribute("hidden", "");
        }

        function startEditingEvent(eventInfo) {
            editingEventIdInput.value = eventInfo.id;
            eventTitleInput.value = eventInfo.title;
            eventDateInput.value = eventInfo.date;
            eventLocationInput.value = locationValueFromEvent(eventInfo);
            saveEventButton.textContent = "Save Changes";
            cancelEditEventButton.removeAttribute("hidden");
            selectedEventDetails.textContent = `Editing: ${eventInfo.title} (${eventInfo.date})`;
            showEventOnMap(eventInfo);
        }

        function showEventOnMap(eventInfo) {
            if (!plannerMap || !eventInfo) {
                return;
            }

            const target = [eventInfo.lat, eventInfo.lng];
            plannerMap.flyTo(target, 11, { duration: 0.7 });
            plannerMarker.setLatLng(target);
            plannerMarker.bindPopup(`<strong>${eventInfo.title}</strong><br>${eventInfo.locationName}<br>${eventInfo.date}`).openPopup();
            selectedEventDetails.textContent = `${eventInfo.date} - ${eventInfo.title} (${eventInfo.locationName})`;
        }

        function renderEventsForDate(dateString) {
            selectedDate = dateString;
            const matching = eventRecords.filter((item) => item.date === dateString);

            eventsForDateElement.innerHTML = "";

            if (!matching.length) {
                const emptyItem = document.createElement("li");
                emptyItem.textContent = `No events found for ${dateString}.`;
                eventsForDateElement.appendChild(emptyItem);
                selectedEventDetails.textContent = `No event selected for ${dateString}.`;
                return;
            }

            matching.forEach((item) => {
                const li = document.createElement("li");
                const viewButton = document.createElement("button");
                viewButton.type = "button";
                viewButton.textContent = `${item.title} - ${item.locationName}`;
                viewButton.addEventListener("click", () => showEventOnMap(item));

                const editButton = document.createElement("button");
                editButton.type = "button";
                editButton.className = "edit-event-btn";
                editButton.textContent = "Edit";
                editButton.addEventListener("click", () => startEditingEvent(item));

                li.appendChild(viewButton);
                li.appendChild(editButton);
                eventsForDateElement.appendChild(li);
            });

            showEventOnMap(matching[0]);
        }

        function setupEventsPlanner() {
            eventRecords = loadStoredEvents();

            plannerMap = L.map("negrosMap", {
                maxBounds: NEGROS_OCCIDENTAL_BOUNDS,
                minZoom: 8,
                maxZoom: 16
            }).setView(NEGROS_OCCIDENTAL_CENTER, 9);

            L.tileLayer("https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png", {
                maxZoom: 18,
                attribution: "&copy; OpenStreetMap contributors"
            }).addTo(plannerMap);

            plannerMarker = L.marker(NEGROS_OCCIDENTAL_CENTER).addTo(plannerMap);

            plannerCalendar = new FullCalendar.Calendar(document.getElementById("eventCalendar"), {
                initialView: "dayGridMonth",
                height: 430,
                events: eventRecords.map((item) => ({
                    title: item.title,
                    start: item.date,
                    allDay: true,
                    extendedProps: { eventId: item.id }
                })),
                dateClick: (info) => {
                    eventDateInput.value = info.dateStr;
                    renderEventsForDate(info.dateStr);
                },
                eventClick: (info) => {
                    const clicked = eventById(info.event.extendedProps.eventId);
                    if (clicked) {
                        eventDateInput.value = clicked.date;
                        renderEventsForDate(clicked.date);
                        startEditingEvent(clicked);
                    }
                }
            });

            plannerCalendar.render();

            eventForm.addEventListener("submit", (event) => {
                event.preventDefault();

                const title = eventTitleInput.value.trim();
                const date = eventDateInput.value;
                const locationValue = eventLocationInput.value;
                const editingId = editingEventIdInput.value;

                if (!title || !date || !locationValue) {
                    return;
                }

                const [locationName, lat, lng] = locationValue.split("|");
                let activeEvent;

                if (editingId) {
                    const eventIndex = eventRecords.findIndex((item) => item.id === editingId);

                    if (eventIndex === -1) {
                        return;
                    }

                    eventRecords[eventIndex] = {
                        ...eventRecords[eventIndex],
                        title,
                        date,
                        locationName,
                        lat: Number(lat),
                        lng: Number(lng)
                    };
                    activeEvent = eventRecords[eventIndex];
                } else {
                    const newEvent = {
                        id: `evt-${Date.now()}`,
                        title,
                        date,
                        locationName,
                        lat: Number(lat),
                        lng: Number(lng)
                    };
                    eventRecords.push(newEvent);
                    activeEvent = newEvent;
                }

                saveEvents();
                refreshCalendarEvents();
                resetEventForm();
                eventDateInput.value = date;
                renderEventsForDate(date);
                showEventOnMap(activeEvent);
            });

            cancelEditEventButton.addEventListener("click", () => {
                resetEventForm();
                if (selectedDate) {
                    eventDateInput.value = selectedDate;
                }
            });

            const todayDate = new Date().toISOString().slice(0, 10);
            eventDateInput.value = todayDate;
            renderEventsForDate(todayDate);
            plannerReady = true;
        }

        function contentFromWhoWeCard(card) {
            const img = card.querySelector("img");
            const titleEl = card.querySelector("h3");
            const textEl = card.querySelector("p");
            const detailTemplateId = card.dataset.detailTemplate;
            const detailTemplate = detailTemplateId ? document.getElementById(detailTemplateId) : null;

            if (!img || !titleEl) {
                return null;
            }

            return {
                imgSrc: img.currentSrc || img.src,
                imgAlt: img.alt || "",
                title: titleEl.textContent || "",
                text: textEl ? textEl.textContent : "",
                detailHtml: detailTemplate ? detailTemplate.innerHTML : ""
            };
        }

        function setWhoWeLightboxContent(card, index = -1) {
            const content = contentFromWhoWeCard(card);
            if (!content) {
                return;
            }

            whoWeLightboxIndex = index;
            whoWeLightboxImg.src = content.imgSrc;
            whoWeLightboxImg.alt = content.imgAlt;
            whoWeLightboxTitle.textContent = content.title;
            if (whoWeLightboxText) {
                whoWeLightboxText.innerHTML = content.detailHtml || `<p class="who-we-lightbox-copy">${content.text}</p>`;
            }
        }

        function showWhoWeLightboxByIndex(nextIndex) {
            const cards = Array.from(whoWeCards);
            if (!cards.length) {
                return;
            }

            const wrappedIndex = ((nextIndex % cards.length) + cards.length) % cards.length;
            setWhoWeLightboxContent(cards[wrappedIndex], wrappedIndex);
        }

        function openWhoWeLightbox(card) {
            if (!whoWeLightbox || !card) {
                return;
            }

            if (whoWeLightboxCloseTimer) {
                clearTimeout(whoWeLightboxCloseTimer);
                whoWeLightboxCloseTimer = null;
            }

            whoWeLightboxReturnFocus = document.activeElement;
            const cards = Array.from(whoWeCards);
            const index = cards.indexOf(card);
            setWhoWeLightboxContent(card, index);

            whoWeLightbox.removeAttribute("hidden");
            whoWeLightbox.setAttribute("aria-hidden", "false");
            document.body.classList.add("who-we-lightbox-open");

            requestAnimationFrame(() => {
                requestAnimationFrame(() => {
                    whoWeLightbox.classList.add("is-open");
                    if (whoWeLightboxClose) {
                        whoWeLightboxClose.focus();
                    }
                });
            });
        }

        function closeWhoWeLightbox() {
            if (!whoWeLightbox || !whoWeLightbox.classList.contains("is-open")) {
                return;
            }

            whoWeLightbox.classList.remove("is-open");
            document.body.classList.remove("who-we-lightbox-open");
            whoWeLightbox.setAttribute("aria-hidden", "true");

            if (whoWeLightboxCloseTimer) {
                clearTimeout(whoWeLightboxCloseTimer);
            }

            whoWeLightboxCloseTimer = setTimeout(() => {
                whoWeLightbox.setAttribute("hidden", "");
                whoWeLightboxCloseTimer = null;
                if (whoWeLightboxReturnFocus && typeof whoWeLightboxReturnFocus.focus === "function") {
                    whoWeLightboxReturnFocus.focus();
                }

                whoWeLightboxReturnFocus = null;
                whoWeLightboxIndex = -1;
            }, 300);
        }

        whoWeCards.forEach((card) => {
            card.addEventListener("click", () => openWhoWeLightbox(card));
            card.addEventListener("keydown", (event) => {
                if (event.key === "Enter" || event.key === " ") {
                    event.preventDefault();
                    openWhoWeLightbox(card);
                }
            });
        });

        if (whoWeLightboxClose) {
            whoWeLightboxClose.addEventListener("click", (event) => {
                event.stopPropagation();
                closeWhoWeLightbox();
            });
        }

        if (whoWeLightboxPrev) {
            whoWeLightboxPrev.addEventListener("click", (event) => {
                event.stopPropagation();
                showWhoWeLightboxByIndex(whoWeLightboxIndex - 1);
            });
        }

        if (whoWeLightboxNext) {
            whoWeLightboxNext.addEventListener("click", (event) => {
                event.stopPropagation();
                showWhoWeLightboxByIndex(whoWeLightboxIndex + 1);
            });
        }

        if (whoWeLightboxBackdrop) {
            whoWeLightboxBackdrop.addEventListener("click", closeWhoWeLightbox);
        }

        if (whoWeLightbox) {
            whoWeLightbox.querySelector(".who-we-lightbox-panel")?.addEventListener("click", (event) => {
                event.stopPropagation();
            });
        }

        function closeMenu() {
            sideMenu.classList.remove("is-open");
            sideMenuOverlay.classList.remove("is-open");
            document.body.classList.remove("menu-open");
            menuToggle.setAttribute("aria-expanded", "false");
            menuToggle.setAttribute("aria-label", "Open menu");
        }

        function openMenu() {
            closeSiteSearch();
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

            closeSiteSearch();
            openMenu();
        });

        if (siteSearchToggle && siteSearchPanel) {
            siteSearchToggle.addEventListener("click", () => {
                if (sideMenu.classList.contains("is-open")) {
                    closeMenu();
                }

                if (siteSearchPanel.hasAttribute("hidden")) {
                    openSiteSearch();
                    return;
                }

                closeSiteSearch();
            });
        }

        document.querySelectorAll(".site-header-nav a[href^='#']").forEach((anchor) => {
            anchor.addEventListener("click", closeSiteSearch);
        });

        if (siteSearchClose) {
            siteSearchClose.addEventListener("click", closeSiteSearch);
        }

        if (siteSearchInput) {
            siteSearchInput.addEventListener("input", () => renderSiteSearchResults(siteSearchInput.value));

            siteSearchInput.addEventListener("keydown", (event) => {
                if (event.key !== "Enter") {
                    return;
                }

                event.preventDefault();
                const firstHit = siteSearchResults?.querySelector(".site-search-hit");

                if (firstHit) {
                    firstHit.click();
                }
            });
        }

        sideMenuOverlay.addEventListener("click", closeMenu);
        sideMenuLinks.forEach((link) => link.addEventListener("click", closeMenu));
        toggleEventPlannerButton.addEventListener("click", () => {
            const isHidden = eventPlanner.hasAttribute("hidden");

            if (isHidden) {
                eventPlanner.removeAttribute("hidden");

                if (!plannerReady) {
                    setupEventsPlanner();
                } else if (plannerMap) {
                    setTimeout(() => plannerMap.invalidateSize(), 80);
                }

                return;
            }

            eventPlanner.setAttribute("hidden", "");
        });

        window.addEventListener("keydown", (event) => {
            if (event.key === "Escape") {
                if (siteSearchPanel && !siteSearchPanel.hasAttribute("hidden")) {
                    closeSiteSearch();
                    return;
                }

                closeWhoWeLightbox();
                closeMenu();
                return;
            }

            if (!whoWeLightbox || !whoWeLightbox.classList.contains("is-open")) {
                return;
            }

            if (event.key === "ArrowLeft") {
                event.preventDefault();
                showWhoWeLightboxByIndex(whoWeLightboxIndex - 1);
            }

            if (event.key === "ArrowRight") {
                event.preventDefault();
                showWhoWeLightboxByIndex(whoWeLightboxIndex + 1);
            }
        });

        let headerScrollTicking = false;
        const SITE_HEADER_COMPACT_AFTER = 72;

        function updateSiteHeaderScrollVisibility() {
            headerScrollTicking = false;

            if (!siteHeaderWrap) {
                return;
            }

            const scrollY = window.scrollY || window.pageYOffset || 0;

            if (document.body.classList.contains("menu-open")) {
                siteHeaderWrap.classList.remove("is-compact-header");
                return;
            }

            if (siteSearchPanel && !siteSearchPanel.hasAttribute("hidden")) {
                siteHeaderWrap.classList.remove("is-compact-header");
                return;
            }

            if (scrollY > SITE_HEADER_COMPACT_AFTER) {
                siteHeaderWrap.classList.add("is-compact-header");
            } else {
                siteHeaderWrap.classList.remove("is-compact-header");
            }
        }

        function onWindowScrollForSiteHeader() {
            if (!siteHeaderWrap || headerScrollTicking) {
                return;
            }

            headerScrollTicking = true;
            requestAnimationFrame(updateSiteHeaderScrollVisibility);
        }

        window.addEventListener("scroll", onWindowScrollForSiteHeader, { passive: true });
        window.addEventListener("load", updateSiteHeaderScrollVisibility);
    </script>
</body>
</html>