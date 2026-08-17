<!DOCTYPE html><html data-srcloc="/ulei/index.tsx:18"><head data-srcloc="/ulei/index.tsx:19"><meta charset="UTF-8" data-srcloc="/ulei/index.tsx:20"><meta name="viewport" content="width=device-width, initial-scale=1.0" data-srcloc="/ulei/index.tsx:21"><title data-srcloc="/ulei/index.tsx:22">УЛЕЙ — Коннект и нетворкинг</title><link rel="preconnect" href="https://fonts.googleapis.com" data-srcloc="/ulei/index.tsx:23"><link rel="preconnect" href="https://fonts.gstatic.com" crossorigin="anonymous" data-srcloc="/ulei/index.tsx:24"><link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&amp;display=swap" rel="stylesheet" data-srcloc="/ulei/index.tsx:25"><link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" data-srcloc="/ulei/index.tsx:26"><style data-srcloc="/ulei/index.tsx:28">
          @font-face {
            font-family: 'CSTM';
            src: url('https://fs.chatium.ru/get/msk_bhsgLpp7xD.ttf') format('truetype');
            font-weight: normal;
            font-style: normal;
            font-display: swap;
          }

          @font-face {
            font-family: 'CSTM';
            src: url('https://fs.chatium.ru/get/msk_bhsgLpp7xD.ttf') format('truetype');
            font-weight: bold;
            font-style: normal;
            font-display: swap;
          }
          *, *::before, *::after {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
          }

          html {
            scroll-behavior: smooth;
          }

          body {
            font-family: 'CSTM', 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif;
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
            background: #000000;
            color: #fff;

            overflow-x: hidden;
            position: relative;
          }

          /* ─── GOLDEN EDGE DECOR ─── */
          body::before,
          body::after {
            content: '';
            position: fixed;
            top: 0;
            bottom: 0;
            width: 4px;
            z-index: 9999;
            pointer-events: none;
          }

          body::before {
            left: 0;
            background: linear-gradient(180deg,
              rgba(232, 169, 10, 0.4) 0%,
              #e8a90a 20%,
              #e8a90a 40%,
              #e8a90a 60%,
              #e8a90a 80%,
              rgba(232, 169, 10, 0.4) 100%
            );
            box-shadow: 4px 0 30px rgba(232, 169, 10, 0.2);
          }

          body::after {
            right: 0;
            background: linear-gradient(180deg,
              rgba(232, 169, 10, 0.4) 0%,
              #e8a90a 20%,
              #e8a90a 40%,
              #e8a90a 60%,
              #e8a90a 80%,
              rgba(232, 169, 10, 0.4) 100%
            );
            box-shadow: -4px 0 30px rgba(232, 169, 10, 0.2);
          }

          a {
            text-decoration: none;
            color: inherit;
          }

          img {
            max-width: 100%;
            display: block;
          }

          button {
            cursor: pointer;
            font-family: inherit;
            border: none;
            outline: none;
          }

          

          /* ─── HEADER ─── */
          .header {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            z-index: 1000;
            padding: 12px 0;
            background: transparent;
            transition: background 0.4s ease, backdrop-filter 0.4s ease;
          }

          .header.scrolled {
            background: rgba(10, 10, 10, 0.75);
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);
          }

          .header-container {
            max-width: 1400px;
            margin: 0 auto;
            padding: 0 32px;
            display: flex;
            align-items: center;
            justify-content: space-between;
          }

          /* Logo */
          .logo {
            display: flex;
            align-items: center;
            flex-shrink: 0;
          }

          .logo-img {
            height: 52px;
            width: auto;
          }

          /* Navigation */
          .nav {
            display: flex;
            align-items: center;
            gap: 32px;
            list-style: none;
          }

          .nav a {
            font-size: 15px;
            font-weight: 500;
            color: rgba(255,255,255,0.8);

            transition: color 0.3s ease;
            letter-spacing: 0.3px;
            position: relative;
          }

          .nav a:hover {
            color: #e8a90a;
          }

          .nav a::after {
            content: '';
            position: absolute;
            bottom: -4px;
            left: 0;
            width: 0;
            height: 2px;
            background: #e8a90a;
            transition: width 0.3s ease;
            border-radius: 2px;
          }

          .nav a:hover::after {
            width: 100%;
          }

          /* Header right section */
          .header-right {
            display: flex;
            align-items: center;
            gap: 20px;
          }

          /* Hamburger */
          .hamburger {
            display: none;
            flex-direction: column;
            gap: 5px;
            background: none;
            border: none;
            cursor: pointer;
            padding: 4px;
            z-index: 1001;
          }

          .hamburger span {
            display: block;
            width: 24px;
            height: 2px;
            background: #fff;

            border-radius: 2px;
            transition: all 0.3s ease;
          }

          .hamburger.active span:nth-child(1) {
            transform: rotate(45deg) translate(5px, 5px);
          }

          .hamburger.active span:nth-child(2) {
            opacity: 0;
          }

          .hamburger.active span:nth-child(3) {
            transform: rotate(-45deg) translate(5px, -5px);
          }

          /* Mobile menu */
          .mobile-menu {
            display: none;
            position: fixed;
            inset: 0;
            z-index: 999;
            background: rgba(10, 10, 10, 0.97);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            flex-direction: column;
            align-items: center;
            justify-content: center;
            gap: 40px;
            opacity: 0;
            visibility: hidden;
            transition: opacity 0.4s ease, visibility 0.4s ease;
          }

          .mobile-menu.open {
            opacity: 1;
            visibility: visible;
          }

          .mobile-menu a {
            font-size: 24px;
            font-weight: 600;
            color: #fff;

            transition: color 0.3s ease;
          }

          .mobile-menu a:hover {
            color: #e8a90a;
          }

          /* CTA Button */
          .btn-ticket {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 14px 32px;
            background: #e8a90a;
            color: #1a1a1a;

            font-size: 15px;
            font-weight: 700;
            letter-spacing: 0.5px;
            border-radius: 50px;
            transition: all 0.3s ease;
            white-space: nowrap;
            box-shadow: 0 4px 20px rgba(232, 169, 10, 0.3);
            flex-shrink: 0;
          }

          .btn-ticket:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 30px rgba(232, 169, 10, 0.5);
            background: #d49a09;
          }

          .btn-ticket i {
            margin-left: 8px;
            font-size: 14px;
          }
          

          
          /* ─── HERO ─── */
          .hero {
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            position: relative;
            overflow: hidden;
          }

          .hero-bg {
            position: absolute;
            inset: 0;
            z-index: 0;
          }

          .hero-bg video {
            width: 100%;
            height: 100%;
            object-fit: cover;
          }

          .hero-gradient-overlay {
            position: absolute;
            inset: 0;
            z-index: 1;
            background: linear-gradient(135deg,
              rgba(0,0,0,0.75) 0%,
              rgba(0,0,0,0.55) 40%,
              rgba(40,25,5,0.7) 70%,
              rgba(80,50,10,0.5) 100%
            );
          }

          .hero-honeycomb-decor {
            position: absolute;
            right: -50px;
            top: 10%;
            width: 500px;
            height: 600px;
            z-index: 2;
            pointer-events: none;
            opacity: 0.5;
            background: 
              radial-gradient(ellipse at 50% 50%, rgba(232,169,10,0.25) 0%, transparent 70%),
              repeating-conic-gradient(
                from 30deg at 50% 50%,
                transparent 0deg 60deg,
                rgba(232,169,10,0.04) 60deg 120deg
              );
            mask-image: radial-gradient(ellipse at 50% 50%, black 30%, transparent 70%);
            -webkit-mask-image: radial-gradient(ellipse at 50% 50%, black 30%, transparent 70%);
          }

          .hero-content {
            position: relative;
            z-index: 3;
            flex: 1;
            display: flex;
            flex-direction: column;
            justify-content: center;
            padding: 120px 48px 100px;
            max-width: 1400px;
            margin: 0 auto;
            width: 100%;
          }

          .hero-inner {
            display: flex;
            flex-direction: column;
            align-items: flex-start;
            text-align: left;
            max-width: 900px;
          }

          .hero-top-row {
            display: flex;
            align-items: center;
            gap: 28px;
            margin-bottom: 8px;
          }

          .hero-davayte {
            font-size: 96px;
            font-weight: 900;
            color: #fff;
            letter-spacing: -2px;
            line-height: 0.85;
            text-transform: uppercase;
          }

          .hero-date-img {
            height: 85px;
            width: auto;
            display: block;
            flex-shrink: 0;
          }

          .hero-main-title {
            font-size: 96px;
            font-weight: 900;
            color: #e8a90a;
            letter-spacing: -2px;
            line-height: 1.05;
            margin-bottom: 32px;
            text-transform: uppercase;
            white-space: nowrap;
          }

          .hero-brand-row {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 40px;
          }

          .hero-brand-from {
            font-size: 22px;
            font-weight: 400;
            color: rgba(255,255,255,0.55);
          }

          .hero-brand-img {
            height: 48px;
            width: auto;
            display: block;
          }

          .hero-actions {
            display: flex;
            align-items: center;
            gap: 20px;
          }

          .hero-actions .btn-ticket {
            padding: 22px 56px;
            font-size: 26px;
          }

          .hero-tagline-img {
            position: absolute;
            bottom: 40px;
            left: 48px;
            z-index: 4;
            height: 120px;
            width: auto;
            display: block;
          }

          /* ─── MOBILE ─── */
          @media (max-width: 1200px) {
            .hero-davayte {
              font-size: 80px;
              line-height: 0.85;
            }

            .hero-main-title {
              font-size: 72px;
            }

            .hero-date-img {
              height: 60px;
            }

            .hero-tagline-img {
              height: 100px;
            }
          }

          @media (max-width: 1024px) {
            .hero-davayte {
              font-size: 64px;
              line-height: 0.85;
            }

            .hero-main-title {
              font-size: 56px;
            }

            .hero-brand-from {
              font-size: 18px;
            }

            .hero-date-img {
              height: 50px;
            }

            .hero-brand-img {
              height: 40px;
            }

            .hero-honeycomb-decor {
              width: 350px;
              height: 400px;
            }

            .hero-actions .btn-ticket {
              padding: 18px 44px;
              font-size: 22px;
            }

            .hero-tagline-img {
              height: 80px;
            }

            .nav {
              gap: 20px;
            }

            .nav a {
              font-size: 13px;
            }
          }

          @media (max-width: 860px) {
            .nav {
              display: none;
            }

            .hamburger {
              display: flex;
            }

            .mobile-menu {
              display: flex;
            }

            .header-right .btn-ticket {
              display: none;
            }

            .mobile-menu .btn-ticket {
              display: inline-flex;
              padding: 16px 40px;
              font-size: 17px;
            }
          }

          @media (max-width: 768px) {
            .header-container {
              padding: 0 20px;
            }

            .logo-img {
              height: 40px;
            }

            .btn-ticket {
              padding: 10px 20px;
              font-size: 13px;
            }

            .hero-content {
              padding: 80px 20px 80px;
            }

            .hero-top-row {
              flex-direction: column;
              gap: 4px;
            }

            .hero-davayte {
              font-size: 53px;
              line-height: 0.85;
            }

            

            .hero-date-img {
              height: 38px;
            }

            .hero-main-title {
              font-size: 44px;
              margin-bottom: 24px;
            }

            .hero-brand-row {
              flex-wrap: wrap;
              gap: 8px;
              margin-bottom: 28px;
            }

            .hero-brand-from {
              font-size: 16px;
            }

            .hero-brand-img {
              height: 32px;
            }

            .hero-honeycomb-decor {
              width: 200px;
              height: 250px;
              right: -30px;
            }

            .hero-actions {
              gap: 12px;
            }

            .hero-actions .btn-ticket {
              padding: 16px 36px;
              font-size: 18px;
            }

            .hero-tagline-img {
              position: relative;
              bottom: auto;
              left: auto;
              margin-top: 24px;
              padding-left: 20px;
              height: auto;
              max-width: 60%;
            }
          }

          @media (max-width: 480px) {
            .hero-davayte {
              font-size: 42px;
              line-height: 0.85;
            }

            .hero-date-img {
              height: 28px;
            }

            .hero-main-title {
              font-size: 32px;
            }

            .hero-brand-from {
              font-size: 14px;
            }

            .hero-brand-img {
              height: 24px;
            }

            .hero-honeycomb-decor {
              width: 140px;
              height: 180px;
            }

            .hero-actions {
              flex-direction: column;
              gap: 12px;
              width: 100%;
            }

            .hero-actions .btn-ticket {
              padding: 14px 32px;
              font-size: 16px;
              width: 100%;
              text-align: center;
            }

            .hero-tagline-img {
              max-width: 70%;
              height: auto;
            }
          }

          /* ─── BENEFITS ─── */
          .benefits {
            position: relative;
            padding: 80px 0 60px;
            background: #000000;
            overflow: visible;
          }

          .benefits-honeycomb {
            position: absolute;
            right: 0;
            bottom: 0;
            width: 600px;
            height: 750px;
            background: url('https://fs.chatium.ru/get/image_msk_xYGJSiSVmh.1822x2977.png') right bottom / contain no-repeat;
            pointer-events: none;
            z-index: 0;
            opacity: 0.25;
          }

          .benefits-glow {
            position: absolute;
            top: 10%;
            left: 50%;
            transform: translateX(-50%);
            width: 1200px;
            height: 900px;
            background: url('https://fs.chatium.ru/get/image_msk_UOYwVFBlfX.6672x6215.png') center center / contain no-repeat;
            pointer-events: none;
            z-index: 0;
            opacity: 0.7;
          }

          

          .benefits-container {
            max-width: 1400px;
            margin: 0 auto;
            padding: 0 32px;
            position: relative;
            z-index: 2;
          }

          .benefits-header {
            margin-bottom: 56px;
          }

          .benefits-header h2 {
            font-size: 56px;
            font-weight: 900;
            color: #fff;

            letter-spacing: -1px;
            line-height: 1.1;
            margin-bottom: 12px;
          }

          .benefits-header p {
            font-size: 18px;
            line-height: 1.6;
            color: rgba(255,255,255,0.7);

            max-width: 700px;
          }

          .benefits-grid {
            display: grid;
            grid-template-columns: 1fr 1fr 1fr;
            gap: 24px;
            align-items: start;
          }

          .benefits-cols-left {
            display: flex;
            flex-direction: column;
            gap: 24px;
          }

          .benefits-cols-right {
            display: flex;
            flex-direction: column;
            gap: 24px;
          }

          .benefit-card {
            display: block;
            border: none;
            border-radius: 16px;
            overflow: hidden;
            padding: 0;
            transition: all 0.4s ease;
            cursor: default;
            background: transparent;
            position: relative;
            line-height: 0;
          }

          .benefit-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 0 40px rgba(232,169,10,0.15);
          }

          .benefit-card img {
            width: 100%;
            height: auto;
            display: block;
            border-radius: inherit;
          }

          .benefits-col-right {
            display: flex;
            flex-direction: column;
            gap: 24px;
            align-items: center;
            text-align: center;
            position: relative;
            justify-self: end;
            width: 800px;
            margin-right: -300px;
            height: 400px;
          }

          .ceo-photo-wrapper {
            position: relative;
            border: none;
            overflow: hidden;
            display: inline-block;
            line-height: 0;
            width: 100%;
            max-width: 320px;
            aspect-ratio: 1 / 1;
            clip-path: polygon(25% 0%, 75% 0%, 100% 50%, 75% 100%, 25% 100%, 0% 50%);
          }

          .ceo-photo-wrapper img {
            width: 100%;
            height: 100%;
            display: block;
            object-fit: cover;
            border: none;
          }

          .ceo-text-box {
            background: rgba(255, 255, 255, 0.04);
            border-radius: 12px;
            padding: 16px 20px;
            border-left: 3px solid #e8a90a;
            text-align: left;
            max-width: 320px;
          }

          .ceo-text-box p {
            font-size: 16px;
            line-height: 1.6;
            color: rgba(255, 255, 255, 0.85);
            margin: 0;
          }

          .ceo-text-box strong {
            color: #e8a90a;
            font-weight: 600;
          }

          .benefits-stats {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 6px;
            margin-top: 40px;
          }

          .benefits-stats .num {
            font-size: 64px;
            font-weight: 900;
            color: #e8a90a;
            line-height: 1;
            letter-spacing: 2px;
          }

          .benefits-stats .label {
            font-size: 17px;
            font-weight: 600;
            color: rgba(255,255,255,0.6);
            text-transform: uppercase;
            letter-spacing: 3px;
          }

          

          

          

          

          @media (max-width: 1024px) {
            .benefits-grid {
              gap: 24px;
            }

            .benefits-header h2 {
              font-size: 42px;
            }

            .benefit-card {
              border-radius: 14px;
            }

            

            

            .ceo-photo-wrapper {
              max-width: 260px;
            }

            .ceo-text-box {
              max-width: 260px;
              padding: 14px 18px;
            }

            .ceo-text-box p {
              font-size: 14px;
            }

            .benefits-stats .num {
              font-size: 64px;
            }
          }

          @media (max-width: 1024px) {
            .benefits-honeycomb {
              width: 200px;
              height: 280px;
              opacity: 0.15;
            }
          }

          @media (max-width: 768px) {
            .benefits-honeycomb {
              display: none;
            }

            .benefits {
              padding: 48px 0;
            }

            .benefits-container {
              padding: 0 20px;
            }

            .benefits-header {
              margin-bottom: 32px;
            }

            .benefits-header h2 {
              font-size: 32px;
            }

            .benefits-header p {
              font-size: 14px;
              max-width: 100%;
            }

            .benefits-grid {
              grid-template-columns: 1fr;
              gap: 20px;
            }

            .benefits-cols-left,
            .benefits-cols-right {
              display: grid;
              grid-template-columns: 1fr 1fr;
              gap: 12px;
            }

            .benefits-col-right {
              justify-self: center;
            }

            .benefit-card {
              border-radius: 12px;
            }

            .ceo-photo-wrapper {
              max-width: 220px;
            }

            .ceo-text-box {
              max-width: 280px;
              padding: 12px 16px;
            }

            .ceo-text-box p {
              font-size: 13px;
            }

            .benefits-stats .num {
              font-size: 40px;
            }
          }

          /* ─── VENUE / ABOUT SECTION ─── */
          #about { scroll-margin-top: 80px; }

        .venue-honeycomb-left {
          position: absolute;
          left: 0;
          top: 0;
          bottom: 0;
          width: 50%;
          max-width: 500px;
          background: url('https://fs.chatium.ru/get/image_msk_Y2Acts2gRV.1822x2977.png') left center / auto 100% no-repeat;
          pointer-events: none;
          z-index: 0;
          opacity: 0.35;
        }

          .venue-section {
            padding: 0;
            background: #000000;
            position: relative;
            overflow: hidden;
          }

          .venue-banner {
            width: 100%;
            max-width: 1200px;
            height: 350px;
            margin: 40px auto 0;
            border-radius: 16px;
            position: relative;
            overflow: hidden;
          }

          .venue-banner video {
  width: 100%;
  height: 100%;
  object-fit: cover;
  border-radius: inherit;
}

          .venue-banner-overlay {
            position: absolute;
            inset: 0;
            background: linear-gradient(180deg, rgba(10,10,10,0.15) 0%, rgba(10,10,10,0.6) 100%);
            border-radius: 16px;
            z-index: 1;
          }

          .venue-banner-content {
            position: absolute;
            inset: 0;
            z-index: 2;
            display: flex;
            flex-direction: column;
            align-items: flex-start;
            justify-content: flex-end;
            padding: 20px 32px 28px;
            text-align: left;
          }

          .venue-banner-content .venue-pin {
            display: flex;
            align-items: center;
            gap: 8px;
            margin-bottom: 6px;
            justify-content: flex-start;
          }

          .venue-banner-content .venue-pin i {
            font-size: 16px;
            color: #e8a90a;
          }

          .venue-banner-content .venue-label {
            font-size: 17px;
            font-weight: 600;
            letter-spacing: 3px;
            color: #e8a90a;
            text-transform: uppercase;
          }

          .venue-banner-content h3 {
            font-size: 42px;
            font-weight: 800;
            color: #fff;
            margin-bottom: 4px;
            letter-spacing: -0.3px;
          }

          .venue-banner-content p {
            font-size: 20px;
            color: rgba(255,255,255,0.8);
            font-weight: 400;
          }

          .venue-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 24px 32px 60px;
            position: relative;
            z-index: 2;
          }

          .venue-info {
            flex: 1;
            max-width: 360px;
            position: relative;
            text-align: center;
          }

          .venue-pin {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 20px;
            justify-content: center;
          }

          .venue-pin i {
            font-size: 28px;
            color: #e8a90a;
          }

          .venue-label {
            font-size: 34px;
            font-weight: 600;
            letter-spacing: 4px;
            color: #e8a90a;
            text-transform: uppercase;
          }

          .venue-info h3 {
            font-size: 56px;
            font-weight: 800;
            color: #fff;

            margin-bottom: 10px;
            letter-spacing: -0.5px;
          }

          .venue-info p {
            font-size: 32px;
            color: rgba(255,255,255,0.7);

            font-weight: 400;
          }

          

          .venue-inner {
            display: block;
            position: relative;
          }

          

          .venue-cards {
            display: grid;
            width: 100%;
            grid-template-columns: 1fr 1fr;
            gap: 8px;
          }

          

          

          .venue-card {
            border-radius: 12px;
            overflow: hidden;
            background: rgba(10,10,10,0.6);
            transition: transform 0.35s ease;
            aspect-ratio: 3 / 2;
            cursor: default;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 4px;
          }

          

          .venue-card:hover {
            transform: translateY(-4px);
          }

          .venue-card img {
            display: block;
            max-width: 100%;
            max-height: 100%;
            width: auto;
            height: auto;
            object-fit: contain;
            border-radius: 8px;
          }

          

          

          @media (max-width: 1024px) {
            .venue-container {
              padding: 20px 32px 40px;
            }

            .venue-info {
              max-width: 100%;
              text-align: center;
            }

            .venue-banner {
              height: 260px;
              max-width: 700px;
            }

            .venue-banner-content h3 {
              font-size: 30px;
            }

            .venue-banner-content .venue-label {
              font-size: 14px;
              letter-spacing: 2px;
            }

            .venue-banner-content p {
              font-size: 17px;
            }

            
          }

          @media (max-width: 768px) {
            .venue-container {
              padding: 16px 20px 32px;
            }

            

            .venue-banner {
              height: 200px;
              max-width: 100%;
              margin: 24px auto 0;
              border-radius: 12px;
            }

            .venue-banner-content h3 {
              font-size: 26px;
            }

            .venue-banner-content .venue-label {
              font-size: 10px;
              letter-spacing: 2px;
            }

            .venue-banner-content p {
              font-size: 13px;
            }

            .venue-cards {
              gap: 4px;
            }

            

            

            .venue-card {
            border-radius: 8px;
            padding: 3px;
          }

            

            
          }

          @media (max-width: 480px) {
            

            .venue-banner-content h3 {
              font-size: 18px;
            }

            .venue-banner-content .venue-label {
              font-size: 9px;
              letter-spacing: 1.5px;
            }

            .venue-banner-content p {
              font-size: 12px;
            }

            .venue-cards {
              gap: 4px;
            }

            

            .venue-card {
            border-radius: 6px;
            padding: 3px;
          }

            .venue-banner {
              height: 160px;
              border-radius: 10px;
            }
          }
        </style></head><body data-srcloc="/ulei/index.tsx:1265"><header class="header" id="header" data-srcloc="/ulei/index.tsx:1268"><div class="header-container" data-srcloc="/ulei/index.tsx:1269"><a href="#" class="logo" data-srcloc="/ulei/index.tsx:1270"><img src="https://fs.chatium.ru/get/image_msk_TrDivijlhJ.804x452.png" alt="УЛЕЙ — Коннект и нетворкинг" class="logo-img" data-srcloc="/ulei/index.tsx:1271"></a><nav class="nav" id="nav" data-srcloc="/ulei/index.tsx:1278"><a href="#about" data-srcloc="/ulei/index.tsx:1279">О форуме</a><a href="#speakers" data-srcloc="/ulei/index.tsx:1280">Спикеры</a><a href="#program" data-srcloc="/ulei/index.tsx:1281">Программа</a><a href="#tickets" data-srcloc="/ulei/index.tsx:1282">Билеты</a><a href="#partners" data-srcloc="/ulei/index.tsx:1283">Партнеры</a><a href="#contacts" data-srcloc="/ulei/index.tsx:1284">Контакты</a></nav><div class="header-right" data-srcloc="/ulei/index.tsx:1287"><button class="hamburger" id="hamburger" aria-label="Меню" data-srcloc="/ulei/index.tsx:1288"><span data-srcloc="/ulei/index.tsx:1289"></span><span data-srcloc="/ulei/index.tsx:1290"></span><span data-srcloc="/ulei/index.tsx:1291"></span></button><a href="#buy" class="btn-ticket" data-srcloc="/ulei/index.tsx:1293">Купить билет</a></div></div><div class="mobile-menu" id="mobileMenu" data-srcloc="/ulei/index.tsx:1301"><a href="#about" class="mobile-link" data-srcloc="/ulei/index.tsx:1302">О форуме</a><a href="#speakers" class="mobile-link" data-srcloc="/ulei/index.tsx:1303">Спикеры</a><a href="#program" class="mobile-link" data-srcloc="/ulei/index.tsx:1304">Программа</a><a href="#tickets" class="mobile-link" data-srcloc="/ulei/index.tsx:1305">Билеты</a><a href="#partners" class="mobile-link" data-srcloc="/ulei/index.tsx:1306">Партнеры</a><a href="#contacts" class="mobile-link" data-srcloc="/ulei/index.tsx:1307">Контакты</a><a href="#buy" class="btn-ticket" data-srcloc="/ulei/index.tsx:1308">Купить билет<i class="fas fa-arrow-right" data-srcloc="/ulei/index.tsx:1310"></i></a></div></header><section class="hero" data-srcloc="/ulei/index.tsx:1316"><div class="hero-bg" data-srcloc="/ulei/index.tsx:1317"><video src="https://fs.chatium.ru/get/video_msk_CAuQeWZBDg.d4.1920x1080.mp4" autoplay="autoplay" muted="muted" loop="loop" playsinline="playsinline" data-srcloc="/ulei/index.tsx:1318"></video></div><div class="hero-gradient-overlay" data-srcloc="/ulei/index.tsx:1326"></div><div class="hero-honeycomb-decor" data-srcloc="/ulei/index.tsx:1327"></div><div class="hero-content" data-srcloc="/ulei/index.tsx:1329"><div class="hero-inner" data-srcloc="/ulei/index.tsx:1330"><div class="hero-top-row" data-srcloc="/ulei/index.tsx:1331"><span class="hero-davayte" data-srcloc="/ulei/index.tsx:1332">ДАВАЙТЕ</span><img src="https://fs.chatium.ru/get/image_msk_9XB9E0GUwB.1073x451.png" alt="7 ОКТЯБРЯ ТОЛЬЯТТИ" class="hero-date-img" data-srcloc="/ulei/index.tsx:1333" style="height: 120px; margin-top: 10px;"></div><div class="hero-main-title" data-srcloc="/ulei/index.tsx:1340">ПЕРЕЙДЕМ К ДЕЛУ</div><div class="hero-brand-row" data-srcloc="/ulei/index.tsx:1342"><span class="hero-brand-from" data-srcloc="/ulei/index.tsx:1343">Бизнес-форум от</span><img src="https://fs.chatium.ru/get/image_msk_fCY135hniQ.1076x238.png" alt="Облако" class="hero-brand-img" data-srcloc="/ulei/index.tsx:1344"></div><div class="hero-actions" data-srcloc="/ulei/index.tsx:1347"><a href="#buy" class="btn-ticket" data-srcloc="/ulei/index.tsx:1348" >Купить билет</a></div></div><img src="https://fs.chatium.ru/get/image_msk_3719SPn5cc.1387x498.png" alt="Легальный выход из операционки на сутки" class="hero-tagline-img" data-srcloc="/ulei/index.tsx:1355" style="margin-bottom: 100px; margin-left: -50px;"></div></section><section class="benefits" data-srcloc="/ulei/index.tsx:1360"><div class="benefits-honeycomb" data-srcloc="/ulei/index.tsx:1360.5" style="width: 600px;"></div><div class="benefits-glow" data-srcloc="/ulei/index.tsx:1361"></div><div class="benefits-container" data-srcloc="/ulei/index.tsx:1362"><div class="benefits-header" data-srcloc="/ulei/index.tsx:1363"><h2 data-srcloc="/ulei/index.tsx:1364">СОЗДАЕМ ПОЛЬЗУ ДЛЯ:</h2><p data-srcloc="/ulei/index.tsx:1365">Улей объединяет тех, кто строит, масштабирует и меняет рынок.<br> Здесь нет зрителей — только участники живой системы роста</p></div><div class="benefits-grid" data-srcloc="/ulei/index.tsx:1371"><div class="benefits-cols-left" data-srcloc="/ulei/index.tsx:1373"><div class="benefit-card" data-srcloc="/ulei/index.tsx:1374"><img src="https://fs.chatium.ru/get/image_msk_Vac8YJr0jV.1306x942.png" alt="Учредителей бизнеса" style="width:100%;height:100%;object-fit:cover;border-radius:inherit;display:block" data-srcloc="/ulei/index.tsx:1375"></div><div class="benefit-card" data-srcloc="/ulei/index.tsx:1381"><img src="https://fs.chatium.ru/get/image_msk_zfz4nTAJew.1306x942.png" alt="Предпринимателей" style="width:100%;height:100%;object-fit:cover;border-radius:inherit;display:block" data-srcloc="/ulei/index.tsx:1382"></div></div><div class="benefits-cols-right" data-srcloc="/ulei/index.tsx:1391"><div class="benefit-card" data-srcloc="/ulei/index.tsx:1392"><img src="https://fs.chatium.ru/get/image_msk_js9ZXNjEDU.1306x942.png" alt="Топ-менеджеров" style="width:100%;height:100%;object-fit:cover;border-radius:inherit;display:block" data-srcloc="/ulei/index.tsx:1393"></div><div class="benefit-card" data-srcloc="/ulei/index.tsx:1399"><img src="https://fs.chatium.ru/get/image_msk_cO2n7f6mmz.1306x942.png" alt="Экспертов рынка" style="width:100%;height:100%;object-fit:cover;border-radius:inherit;display:block" data-srcloc="/ulei/index.tsx:1400"></div></div><div class="benefits-col-right" data-srcloc="/ulei/index.tsx:1409" ><div class="ceo-photo-wrapper" data-srcloc="/ulei/index.tsx:1410"><img src="https://fs.chatium.ru/get/image_msk_KvJuIzDzlU.1493x1302.png" alt="CEO Облако" data-srcloc="/ulei/index.tsx:1411"></div><div class="ceo-text-box" data-srcloc="/ulei/index.tsx:1416"><p data-srcloc="/ulei/index.tsx:1417">Форум от CEO федеральной сети печатных центров <strong data-srcloc="/ulei/index.tsx:1417">«Облако»</strong></p></div></div></div><div class="benefits-stats" data-srcloc="/ulei/index.tsx:1423"><span class="num" data-srcloc="/ulei/index.tsx:1424">1000+</span><span class="label" data-srcloc="/ulei/index.tsx:1425">ожидаемых участников</span></div></div></section><section class="venue-section" id="about" data-srcloc="/ulei/components/venue-section.tsx:5"></div><div class="venue-banner" data-srcloc="/ulei/components/venue-section.tsx:7"><video id="venueVideo" autoplay="autoplay" loop="loop" muted="muted" playsinline="playsinline" poster="https://slt.cdn-chatium.io/thumbnail/video_msk_zBZKgkrZVa.d11.2232x928.mp4/s/800x450" data-srcloc="/ulei/components/venue-section.tsx:8"><source src="https://fs.chatium.ru/get/video_msk_zBZKgkrZVa.d11.2232x928.mp4" type="video/mp4" data-srcloc="/ulei/components/venue-section.tsx:9"></video><div class="venue-banner-overlay" data-srcloc="/ulei/components/venue-section.tsx:11"></div><div class="venue-banner-content" data-srcloc="/ulei/components/venue-section.tsx:12"><div class="venue-pin" data-srcloc="/ulei/components/venue-section.tsx:13"><i class="fas fa-map-pin" data-srcloc="/ulei/components/venue-section.tsx:14"></i><span class="venue-label" data-srcloc="/ulei/components/venue-section.tsx:15">МЕСТО ПРОВЕДЕНИЯ</span></div><h3 data-srcloc="/ulei/components/venue-section.tsx:17">Легкоатлетический манеж</h3><p data-srcloc="/ulei/components/venue-section.tsx:18">Стадион «Торпедо»</p></div></div><div class="venue-image-grid" data-srcloc="/ulei/components/venue-section.tsx:23"><div class="venue-image-card" data-srcloc="/ulei/components/venue-section.tsx:24"><img src="https://fs.chatium.ru/get/image_msk_CSZCejWcEK.3175x1884.png" alt="Спикеры" class="venue-image-card-img" data-srcloc="/ulei/components/venue-section.tsx:25""></div><div class="venue-image-card" data-srcloc="/ulei/components/venue-section.tsx:31"><img src="https://fs.chatium.ru/get/image_msk_20RzOZ8vbX.1630x1477.png" alt="Программа" class="venue-image-card-img" data-srcloc="/ulei/components/venue-section.tsx:32" margin-top: 170px;></div><div class="venue-image-card" data-srcloc="/ulei/components/venue-section.tsx:38"><img src="https://fs.chatium.ru/get/image_msk_ALLQVJommD.2390x1477.png" alt="Фуршет" class="venue-image-card-img" data-srcloc="/ulei/components/venue-section.tsx:39"></div><div class="venue-image-card" data-srcloc="/ulei/components/venue-section.tsx:45"><img src="https://fs.chatium.ru/get/image_msk_T92nvqzydm.2390x1480.png" alt="Нетворкинг" class="venue-image-card-img" data-srcloc="/ulei/components/venue-section.tsx:46"></div></div><style data-srcloc="/ulei/components/venue-section.tsx:54">
        .venue-section {
          padding: 0 0 60px;
          background: #000000;
          position: relative;
          overflow: hidden;
        }

        #about { scroll-margin-top: 80px; }

        /* ─── BANNER ─── */
        .venue-banner {
          width: 100%;
          max-width: 1400px;
          height: 400px;
          margin: 0 auto;
          border-radius: 10px;
          position: relative;
          overflow: hidden;
          margin-right: 220px;

        }

        .venue-banner video {
          width: 100%;
          height: 100%;
          object-fit: cover;

        }

        .venue-banner-overlay {
          position: absolute;
          inset: 0;
          background: linear-gradient(180deg, rgba(10,10,10,0.15) 0%, rgba(10,10,10,0.6) 100%);
          z-index: 1;
        }

        .venue-banner-content {
          position: absolute;
          inset: 0;
          z-index: 2;
          display: flex;
          flex-direction: column;
          align-items: flex-start;
          justify-content: flex-end;
          padding: 40px 32px;
          text-align: left;
        }

        .venue-banner-content .venue-pin {
          display: flex;
          align-items: center;
          gap: 10px;
          margin-bottom: 8px;
          justify-content: flex-start;
        }

        .venue-banner-content .venue-pin i {
          font-size: 20px;
          color: #e8a90a;
        }

        .venue-banner-content .venue-label {
          font-size: 18px;
          font-weight: 600;
          letter-spacing: 4px;
          color: #e8a90a;
          text-transform: uppercase;
        }

        .venue-banner-content h3 {
          font-size: 48px;
          font-weight: 800;
          color: #fff;
          margin-bottom: 4px;
          letter-spacing: -0.3px;
        }

        .venue-banner-content p {
          font-size: 24px;
          color: rgba(255,255,255,0.8);
          font-weight: 450;
        }

        /* ─── 2×2 FULL-WIDTH IMAGE GRID ─── */
        .venue-image-grid {
          max-width: 1400px;
          margin: 0 auto;
          padding: 40px 32px 0;
          display: grid;
          grid-template-columns: 1fr 1fr;
          gap: 20px;
        }

        .venue-image-card {
          position: relative;
          border-radius: 16px;
          overflow: hidden;
          border: 0px solid rgba(232, 169, 10, 0.25);
          transition: all 0.4s ease;
          line-height: 0;
          aspect-ratio: 16 / 9;
          
        }

        .venue-image-card:hover {
          border-color: rgba(232, 169, 10, 0.6);
          transform: translateY(-4px);
          box-shadow: 0 8px 40px rgba(232, 169, 10, 0.15);
        }

        .venue-image-card-img {
          width: 100%;
          height: 100%;
          object-fit: cover;
          display: block;
        }
         .venue-image-card:nth-child(1) {
          overflow: visible;
          width: 950px;
          background: #000;
          border-radius: 0;
          margin-left: -20px;
          
        }

        .venue-image-card:nth-child(1) .venue-image-card-img {
          object-fit: contain;
          border-radius: 16px;
        }
        .venue-image-card:nth-child(2) {
          overflow: visible;
          background: #000;
          border-radius: 0;
          margin-top: 50px;
        }

        .venue-image-card:nth-child(2) .venue-image-card-img {
          object-fit: contain;
          border-radius: 16px;
          width: 550px;
          height: 420px;
          margin-top: 65px;
          margin-left: -50px;
        }
        .venue-image-card:nth-child(3) {
          width: 700px;
        }
        .venue-image-card:nth-child(4) {
          width: 680px;
          margin-left: -220px;
        }
        /* ─── Responsive ─── */
        @media (max-width: 1024px) {
          .venue-banner {
            height: 300px;
          }

          .venue-banner-content h3 {
            font-size: 36px;
          }

          .venue-banner-content p {
            font-size: 20px;
          }

          .venue-banner-content .venue-label {
            font-size: 15px;
            letter-spacing: 3px;
          }

          .venue-image-grid {
            gap: 16px;
            padding: 32px 32px 0;
          }
        }

        @media (max-width: 768px) {
          .venue-section {
            padding: 0 0 40px;
          }

          .venue-banner {
            height: 220px;
          }

          .venue-banner-content {
            padding: 24px 20px;
          }

          .venue-banner-content h3 {
            font-size: 26px;
          }

          .venue-banner-content p {
            font-size: 16px;
          }

          .venue-banner-content .venue-label {
            font-size: 12px;
            letter-spacing: 2px;
          }

          .venue-image-grid {
            padding: 24px 20px 0;
            gap: 12px;
          }
        }

        @media (max-width: 480px) {
          .venue-banner {
            height: 180px;
          }

          .venue-banner-content h3 {
            font-size: 20px;
          }

          .venue-banner-content p {
            font-size: 14px;
          }

          .venue-banner-content .venue-label {
            font-size: 10px;
            letter-spacing: 1.5px;
          }

          .venue-image-grid {
            grid-template-columns: 1fr;
            gap: 12px;
          }
        }
      </style></section><section class="speakers-section" id="speakers" data-srcloc="/ulei/components/speakers-section.tsx:33"><div class="venue-honeycomb-left" data-srcloc="/ulei/components/venue-section.tsx:5.5"></div></div><div class="speakers-glow" data-srcloc="/ulei/components/speakers-section.tsx:37"></div><div class="speakers-container" data-srcloc="/ulei/components/speakers-section.tsx:39"><div class="speakers-header" data-srcloc="/ulei/components/speakers-section.tsx:41"><span class="speakers-suptitle" data-srcloc="/ulei/components/speakers-section.tsx:42">СПИКЕРЫ</span><h2 class="speakers-title" data-srcloc="/ulei/components/speakers-section.tsx:43" style="color: #e8a90a">ТОЛЬКО ПРАКТИКИ</span></h2></div><div class="speakers-grid" data-srcloc="/ulei/components/speakers-section.tsx:50"><div class="speaker-card" data-srcloc="/ulei/components/speakers-section.tsx:52"><div class="speaker-card-img" data-srcloc="/ulei/components/speakers-section.tsx:53"><img src="https://fs.chatium.ru/thumbnail/image_msk_Ek4DeQN0kw.1178x2150.png/s/400x731" alt="Спикер 1" loading="eager" data-srcloc="/ulei/components/speakers-section.tsx:54"></div></div><div class="speaker-card" data-srcloc="/ulei/components/speakers-section.tsx:52"><div class="speaker-card-img" data-srcloc="/ulei/components/speakers-section.tsx:53"><img src="https://fs.chatium.ru/thumbnail/image_msk_wkITum7TdW.1177x2150.png/s/400x731" alt="Спикер 2" loading="eager" data-srcloc="/ulei/components/speakers-section.tsx:54"></div></div><div class="speaker-card" data-srcloc="/ulei/components/speakers-section.tsx:52"><div class="speaker-card-img" data-srcloc="/ulei/components/speakers-section.tsx:53"><img src="https://fs.chatium.ru/thumbnail/image_msk_1uuHUpjpwZ.1177x2150.png/s/400x731" alt="Спикер 3" loading="eager" data-srcloc="/ulei/components/speakers-section.tsx:54"></div></div><div class="speaker-card" data-srcloc="/ulei/components/speakers-section.tsx:52"><div class="speaker-card-img" data-srcloc="/ulei/components/speakers-section.tsx:53"><img src="https://fs.chatium.ru/thumbnail/image_msk_hMzNkvMc2Y.1177x2150.png/s/400x731" alt="Спикер 4" loading="lazy" data-srcloc="/ulei/components/speakers-section.tsx:54"></div></div></div><div class="speakers-cta" data-srcloc="/ulei/components/speakers-section.tsx:65"></div></div><style data-srcloc="/ulei/components/speakers-section.tsx:73">
        .speakers-section {
          padding: 80px 0;
          background: #000000;
          position: relative;
          overflow: hidden;
          scroll-margin-top: 90px;
        }

        .speakers-container {
          max-width: 1400px;
          margin: 0 auto;
          padding: 0 32px;
          position: relative;
          z-index: 2;
        }

        .speakers-header {
          margin-bottom: 48px;
          text-align: left;
        }

        .speakers-suptitle {
          display: inline-block;
          font-size: 15px;
          font-weight: 600;
          letter-spacing: 4px;
          color: #e8a90a;
          text-transform: uppercase;
          margin-bottom: 12px;
          position: relative;
        }

        .speakers-suptitle::after {
          display: inline-block;
          content: '';
          width: 40px;
          height: 1px;
          background: linear-gradient(90deg, #e8a90a, transparent);
          vertical-align: middle;
          margin-left: 16px;
        }

        .speakers-title {
          font-size: 56px;
          font-weight: 900;
          line-height: 1.1;
          letter-spacing: -1px;
          color: #fff;
        }

        .speakers-title-accent {
          color: #e8a90a;
        }

        .speakers-grid {
          display: grid;
          grid-template-columns: repeat(4, 1fr);
          gap: 16px;
        }

        .speaker-card {
          position: relative;
          border-radius: 16px;
          overflow: hidden;
          border: 2px solid rgba(232, 169, 10, 0.3);
          background: rgba(255, 255, 255, 0.02);
          transition: transform 0.4s ease, border-color 0.4s ease, box-shadow 0.4s ease;
          cursor: default;
          line-height: 0;
        }

        .speaker-card:hover {
          transform: translateY(-6px);
          border-color: rgba(232, 169, 10, 0.6);
          box-shadow: 0 12px 40px rgba(232, 169, 10, 0.15);
        }

        .speaker-card-img {
          width: 100%;
          overflow: hidden;
          line-height: 0;
        }

        .speaker-card-img img {
          width: 100%;
          height: auto;
          display: block;
          transition: transform 0.5s ease;
        }

        .speaker-card:hover .speaker-card-img img {
          transform: scale(1.05);
        }

        

        .speakers-cta {
          text-align: center;
          margin-top: 40px;
        }

        .speakers-btn {
          padding: 18px 48px;
          font-size: 18px;
        }

        /* ─── Responsive ─── */
        @media (max-width: 1200px) {
          .speakers-grid {
            gap: 14px;
          }

          
        }

        @media (max-width: 1024px) {
          .speakers-section {
            padding: 60px 0;
          }

          .speakers-title {
            font-size: 44px;
          }

          .speakers-grid {
            grid-template-columns: repeat(2, 1fr);
            gap: 12px;
          }

          
        }

        @media (max-width: 768px) {
          .speakers-section {
            padding: 48px 0;
          }

          .speakers-container {
            padding: 0 20px;
          }

          .speakers-header {
            margin-bottom: 24px;
          }

          .speakers-suptitle {
            font-size: 12px;
            letter-spacing: 3px;
          }

          .speakers-suptitle::after {
            width: 24px;
            margin-left: 10px;
          }

          .speakers-title {
            font-size: 32px;
          }

          .speakers-grid {
            grid-template-columns: 1fr 1fr;
            gap: 10px;
          }

          

          .speakers-btn {
            padding: 14px 36px;
            font-size: 16px;
          }

          .speakers-cta {
            margin-top: 28px;
          }
        }

        @media (max-width: 480px) {
          .speakers-title {
            font-size: 28px;
            letter-spacing: 0;
          }

          .speaker-card {
            border-radius: 12px;
          }

          .speakers-grid {
            gap: 8px;
          }

          
        }

        /* ─── Honeycomb strip — left edge ─── */
        .speakers-honeycomb-left {
          position: absolute;
          left: 0;
          top: 0;
          bottom: 0;
          width: 140px;
background: url('https://fs.chatium.ru/get/image_msk_XFCxEXfKBT.1822x2977.png') left center / auto 100% no-repeat;
          pointer-events: none;
          z-index: 0;
          opacity: 0.45;
        }

        /* ─── Gold gradient glow — bottom left ─── */
        .speakers-glow {
          position: absolute;
          left: -100px;
          bottom: -100px;
          width: 600px;
          height: 600px;
          background: radial-gradient(circle at 30% 70%, rgba(232, 169, 10, 0.15) 0%, transparent 60%);
          pointer-events: none;
          z-index: 0;
        }

        @media (max-width: 1024px) {
          .speakers-honeycomb-left {
            width: 80px;
            opacity: 0.3;
          }
          .speakers-glow {
            width: 400px;
            height: 400px;
            left: -80px;
            bottom: -80px;
          }
        }

        @media (max-width: 768px) {
          .speakers-honeycomb-left {
            display: none;
          }
          .speakers-glow {
            width: 300px;
            height: 300px;
            left: -60px;
            bottom: -60px;
            opacity: 0.5;
          }
        }
      </style></section><section class="program-section" id="program" data-srcloc="/ulei/components/program-section.tsx:51"><div class="program-glow" data-srcloc="/ulei/components/program-section.tsx:53"></div></div><div class="program-container" data-srcloc="/ulei/components/program-section.tsx:58"><div class="program-header" data-srcloc="/ulei/components/program-section.tsx:60"><span class="program-suptitle" data-srcloc="/ulei/components/program-section.tsx:61" style="margin-left: -50px">ПРОГРАММА</span><h2 class="program-title" data-srcloc="/ulei/components/program-section.tsx:62" style="margin-left: -50px;">ОДИН ДЕНЬ, КОТОРЫЙ<br data-srcloc="/ulei/components/program-section.tsx:63"><span class="program-title-accent" data-srcloc="/ulei/components/program-section.tsx:64">МЕНЯЕТ ТВОЙ МАСШТАБ</span></h2></div><div class="program-layout" data-srcloc="/ulei/components/program-section.tsx:69"><div class="program-timeline" data-srcloc="/ulei/components/program-section.tsx:72"><div class="timeline-line" data-srcloc="/ulei/components/program-section.tsx:73"></div><div class="timeline-item " data-srcloc="/ulei/components/program-section.tsx:75"><div class="timeline-time" data-srcloc="/ulei/components/program-section.tsx:77"><span class="timeline-clock" data-srcloc="/ulei/components/program-section.tsx:78">09:00</span></div><div class="timeline-dot" data-srcloc="/ulei/components/program-section.tsx:82"></div><div class="timeline-content" data-srcloc="/ulei/components/program-section.tsx:95"><div class="timeline-label" data-srcloc="/ulei/components/program-section.tsx:99" style="margin-top: -30px;">РЕГИСТРАЦИЯ + НЕТВОРКИНГ</div></div></div><div class="timeline-item " data-srcloc="/ulei/components/program-section.tsx:75"><div class="timeline-time" data-srcloc="/ulei/components/program-section.tsx:77"><span class="timeline-clock" data-srcloc="/ulei/components/program-section.tsx:78">10:00</span></div><div class="timeline-dot" data-srcloc="/ulei/components/program-section.tsx:82"></div><div class="timeline-content" data-srcloc="/ulei/components/program-section.tsx:95"><div class="timeline-label" data-srcloc="/ulei/components/program-section.tsx:99" style="margin-top: -10px;">ОТКРЫТИЕ ФОРУМА</div></div></div><div class="timeline-item has-speaker" data-srcloc="/ulei/components/program-section.tsx:75"><div class="timeline-time" data-srcloc="/ulei/components/program-section.tsx:77"><span class="timeline-clock" data-srcloc="/ulei/components/program-section.tsx:78">10:15</span></div><div class="timeline-dot" data-srcloc="/ulei/components/program-section.tsx:82"></div><div class="timeline-speaker-avatar" data-srcloc="/ulei/components/program-section.tsx:86"><img src="https://fs.chatium.ru/thumbnail/image_msk_8nlhBFVSf3.268x359.png/s/120x160" alt="ВЛАДИМИР КОЧНЕВ" data-srcloc="/ulei/components/program-section.tsx:87"></div><div class="timeline-content" data-srcloc="/ulei/components/program-section.tsx:95"><div class="timeline-speaker-name" data-srcloc="/ulei/components/program-section.tsx:97">ИЛЬНАЗ НАБИУЛЛИН</div><div class="timeline-label" data-srcloc="/ulei/components/program-section.tsx:99">МАСШТАБИРОВАНИЕ БИЗНЕСА</div><div class="timeline-subtitle" data-srcloc="/ulei/components/program-section.tsx:101" style="background: #e8a90a; color: #1a1a1a; font-size: 13px; font-weight: 800; letter-spacing: 3px; text-transform: uppercase; padding: 10px 28px; border-radius: 30px; white-space: nowrap; width: 300px;">ОТКРЫТЫЙ МИКРОФОН</div></div></div><div class="timeline-item has-speaker" data-srcloc="/ulei/components/program-section.tsx:75"><div class="timeline-time" data-srcloc="/ulei/components/program-section.tsx:77"><span class="timeline-clock" data-srcloc="/ulei/components/program-section.tsx:78">11:15</span></div><div class="timeline-dot" data-srcloc="/ulei/components/program-section.tsx:82"></div><div class="timeline-speaker-avatar" style="width: 100px; height: 130px; z-index: 10;" data-srcloc="/ulei/components/program-section.tsx:86"><img src="https://fs.chatium.ru/thumbnail/image_msk_FG6HXiwMse.370x465.png/s/240x320" alt="АНАСТАСИЯ ПРОНИНА" data-srcloc="/ulei/components/program-section.tsx:87" style="margin-top: -20px;"></div><div class="timeline-content" data-srcloc="/ulei/components/program-section.tsx:95"><div class="timeline-speaker-name" data-srcloc="/ulei/components/program-section.tsx:97">АНАСТАСИЯ ПРОНИНА</div><div class="timeline-label" data-srcloc="/ulei/components/program-section.tsx:99">НАЛОГОВАЯ БЕЗОПАСТНОСТЬ</div></div></div><div class="timeline-item has-speaker" data-srcloc="/ulei/components/program-section.tsx:75"><div class="timeline-time" data-srcloc="/ulei/components/program-section.tsx:77"><span class="timeline-clock" data-srcloc="/ulei/components/program-section.tsx:78">11:50</span></div><div class="timeline-dot" data-srcloc="/ulei/components/program-section.tsx:82"></div><div class="timeline-speaker-avatar" data-srcloc="/ulei/components/program-section.tsx:86"><img src="https://fs.chatium.ru/thumbnail/image_msk_GTzLQx3LbJ.259x363.png/s/120x160" alt="ВЛАДИМИР КОЧНЕВ" data-srcloc="/ulei/components/program-section.tsx:87"></div><div class="timeline-content" data-srcloc="/ulei/components/program-section.tsx:95"><div class="timeline-speaker-name" data-srcloc="/ulei/components/program-section.tsx:97">ВЛАДИМИР МОЖЕНКОВ</div><div class="timeline-label" data-srcloc="/ulei/components/program-section.tsx:99">РОСТ И РАЗВИТИЕ</div><div class="timeline-subtitle" data-srcloc="/ulei/components/program-section.tsx:101" style="background: #e8a90a; color: #1a1a1a; font-size: 13px; font-weight: 800; letter-spacing: 3px; text-transform: uppercase; padding: 10px 28px; border-radius: 30px; white-space: nowrap; width: 300px;">ОТКРЫТЫЙ МИКРОФОН</div></div></div><div class="timeline-item " data-srcloc="/ulei/components/program-section.tsx:75"><div class="timeline-time" data-srcloc="/ulei/components/program-section.tsx:77"><span class="timeline-clock" data-srcloc="/ulei/components/program-section.tsx:78">13:15</span></div><div class="timeline-dot" data-srcloc="/ulei/components/program-section.tsx:82"></div><div class="timeline-content" data-srcloc="/ulei/components/program-section.tsx:95"><div class="timeline-label" data-srcloc="/ulei/components/program-section.tsx:99" style="margin-top: -30px;">DJ SET + НЕТВОРКИНГ</div></div></div><div class="timeline-item " data-srcloc="/ulei/components/program-section.tsx:75"><div class="timeline-time" data-srcloc="/ulei/components/program-section.tsx:77"><span class="timeline-clock" data-srcloc="/ulei/components/program-section.tsx:78">14:00</span></div><div class="timeline-dot" data-srcloc="/ulei/components/program-section.tsx:82"></div><div class="timeline-content" data-srcloc="/ulei/components/program-section.tsx:95"><div class="timeline-label" data-srcloc="/ulei/components/program-section.tsx:99" style="margin-top: -30px;">ПРОДОЛЖЕНИЕ ФОРУМА</div></div></div><div class="timeline-item has-speaker" data-srcloc="/ulei/components/program-section.tsx:75"><div class="timeline-time" data-srcloc="/ulei/components/program-section.tsx:77"><span class="timeline-clock" data-srcloc="/ulei/components/program-section.tsx:78">14:15</span></div><div class="timeline-dot" data-srcloc="/ulei/components/program-section.tsx:82"></div><div class="timeline-speaker-avatar" data-srcloc="/ulei/components/program-section.tsx:86"><img src="https://fs.chatium.ru/thumbnail/image_msk_FoVH4SnwNp.273x350.png/s/120x160" alt="ВЛАДИМИР КОЧНЕВ" data-srcloc="/ulei/components/program-section.tsx:87"></div><div class="timeline-content" data-srcloc="/ulei/components/program-section.tsx:95"><div class="timeline-speaker-name" data-srcloc="/ulei/components/program-section.tsx:97">ВЛАДИМИР МОЖЕНКОВ</div><div class="timeline-label" data-srcloc="/ulei/components/program-section.tsx:99">АНТИКРИЗИСНОЕ УПРАВЛЕНИЕ</div><div class="timeline-subtitle" data-srcloc="/ulei/components/program-section.tsx:101">35 АНТИКРИЗИСНЫХ УПРАВЛЕНЧЕСКИХ МЕХАНИК</div></div></div><div class="timeline-item " data-srcloc="/ulei/components/program-section.tsx:75"><div class="timeline-time" data-srcloc="/ulei/components/program-section.tsx:77"><span class="timeline-clock" data-srcloc="/ulei/components/program-section.tsx:78">15:20</span></div><div class="timeline-dot" data-srcloc="/ulei/components/program-section.tsx:82"></div><div class="timeline-content" data-srcloc="/ulei/components/program-section.tsx:95"><div class="timeline-label" data-srcloc="/ulei/components/program-section.tsx:99" style="margin-top: -10px;">КОФЕ БРЕЙК</div></div></div><div class="timeline-item has-speaker" data-srcloc="/ulei/components/program-section.tsx:75"><div class="timeline-time" data-srcloc="/ulei/components/program-section.tsx:77"><span class="timeline-clock" data-srcloc="/ulei/components/program-section.tsx:78">15:40</span></div><div class="timeline-dot" data-srcloc="/ulei/components/program-section.tsx:82"></div><div class="timeline-speaker-avatar" data-srcloc="/ulei/components/program-section.tsx:86"><img src="https://fs.chatium.ru/thumbnail/image_msk_G6Dt5kaFGz.273x350.png/s/120x160" alt="ВЛАДИМИР КОЧНЕВ" data-srcloc="/ulei/components/program-section.tsx:87"></div><div class="timeline-content" data-srcloc="/ulei/components/program-section.tsx:95"><div class="timeline-speaker-name" data-srcloc="/ulei/components/program-section.tsx:97">ВЛАДИМИР КОЧНЕВ</div><div class="timeline-label" data-srcloc="/ulei/components/program-section.tsx:99" >ПРОДОЛЖЕНИЕ ТЕМЫ</div></div></div><div class="timeline-item " data-srcloc="/ulei/components/program-section.tsx:75"><div class="timeline-time" data-srcloc="/ulei/components/program-section.tsx:77"><span class="timeline-clock" data-srcloc="/ulei/components/program-section.tsx:78">17:00</span></div><div class="timeline-dot" data-srcloc="/ulei/components/program-section.tsx:82"></div><div class="timeline-content" data-srcloc="/ulei/components/program-section.tsx:95"><div class="timeline-label" data-srcloc="/ulei/components/program-section.tsx:99" style="margin-top: -10px;">КОФЕ БРЕЙК</div></div></div><div class="timeline-item " data-srcloc="/ulei/components/program-section.tsx:75"><div class="timeline-time" data-srcloc="/ulei/components/program-section.tsx:77"><span class="timeline-clock" data-srcloc="/ulei/components/program-section.tsx:78">17:20</span></div><div class="timeline-dot" data-srcloc="/ulei/components/program-section.tsx:82"></div><div class="timeline-content" data-srcloc="/ulei/components/program-section.tsx:95"><div class="timeline-label" data-srcloc="/ulei/components/program-section.tsx:99" style="margin-top: -10px;">КОНЕЦ ФОРУМА</div></div></div></div><div class="program-decor" data-srcloc="/ulei/components/program-section.tsx:109"><div class="program-video-wrap" data-srcloc="/ulei/components/program-section.tsx:110"><video class="program-video" autoplay="autoplay" loop="loop" muted="muted" playsinline="playsinline" poster="https://fs.chatium.ru/thumbnail/video_msk_qlVYLbFA7n.d5.720x720.webm/s/800x800" data-srcloc="/ulei/components/program-section.tsx:111"><source src="https://fs.chatium.ru/get/video_msk_qlVYLbFA7n.d5.720x720.webm" type="video/webm" data-srcloc="/ulei/components/program-section.tsx:119" ></video></div></div></div></div><style data-srcloc="/ulei/components/program-section.tsx:126">
        .program-section {
          padding: 80px 0;
          background: #000000;
          position: relative;
          overflow: hidden;
        }

        /* ─── Gold gradient glow — centered ─── */
        .program-glow {
          position: absolute;
          top: 50%;
          left: 50%;
          transform: translate(-50%, -50%);
          width: 900px;
          height: 900px;
          background: url('https://fs.chatium.ru/get/image_msk_UOYwVFBlfX.6672x6215.png') center center / contain no-repeat;
          pointer-events: none;
          z-index: 0;
          opacity: 0.6;
        }

        /* ─── Honeycomb — bottom right ─── */
        .program-hex {
          position: absolute;
          right: 0;
          bottom: 0;
          width: 260px;
          height: 260px;
          background: url('https://fs.chatium.ru/get/image_msk_XFCxEXfKBT.1822x2977.png') bottom right / contain no-repeat;
          pointer-events: none;
          z-index: 1;
          opacity: 0.35;
        }

        .program-container {
          max-width: 1400px;
          margin: 0 auto;
          padding: 0 32px;
          position: relative;
          z-index: 2;
        }

        /* ─── Header ─── */
        .program-header {
          margin-bottom: 48px;
        }

        .program-suptitle {
          display: inline-block;
          font-size: 22px;
          font-weight: 600;
          letter-spacing: 6px;
          color: #e8a90a;
          text-transform: uppercase;
          margin-bottom: 16px;
          position: relative;
          padding-left: 6px;
        }

        .program-suptitle::before {
          content: '';
          position: absolute;
          right: 100%;
          top: 50%;
          width: 120px;
          height: 1.5px;
          background: linear-gradient(90deg, transparent, #e8a90a);
          transform: translateY(-50%);
          margin-right: 12px;
        }

        .program-suptitle::after {
          content: '';
          display: inline-block;
          width: 60px;
          height: 1.5px;
          background: linear-gradient(90deg, #e8a90a, transparent);
          vertical-align: middle;
          margin: 0 16px;
        }

        .program-title {
          font-size: 84px;
          font-weight: 900;
          line-height: 1.1;
          letter-spacing: -1.5px;
          color: #fff;
        }

        .program-title-accent {
          color: #e8a90a;
          display: inline-block;
        }

        /* ─── Layout ─── */
        .program-layout {
          display: flex;
          gap: 48px;
          align-items: flex-start;
          position: relative;
        }

        /* ─── Timeline ─── */
        .program-timeline {
          flex: 1;
          max-width: 760px;
          position: relative;
        }

        .timeline-line {
          position: absolute;
          left: 155px;
          top: 10px;
          bottom: 10px;
          width: 2px;
          background: linear-gradient(180deg, #e8a90a 0%, rgba(232, 169, 10, 0.15) 100%);
          z-index: 1;
        }

        .timeline-item {
          position: relative;
          margin-bottom: 36px;
          min-height: 70px;
        }

        .timeline-item:last-child {
          margin-bottom: 0;
        }

        /* ─── Time — on the far left ─── */
        .timeline-time {
          position: absolute;
          left: -40px;
          top: 10px;
          width: 130px;
          text-align: right;
          padding-right: 16px;
        }

        .timeline-clock {
          font-size: 45px;
          font-weight: 800;
          color: #e8a90a;
          line-height: 1;
          letter-spacing: 0.8px;
          white-space: nowrap;
        }

        /* ─── Dot — centered on the line ─── */
        .timeline-dot {
          position: absolute;
          left: 148px;
          top: 20px;
          width: 16px;
          height: 16px;
          min-width: 16px;
          border-radius: 50%;
          background: #e8a90a;
          border: 3px solid #000000;
          box-shadow: 0 0 0 2px rgba(232, 169, 10, 0.4);
          z-index: 2;
        }

        /* ─── Avatar — between time and timeline line ─── */
        .timeline-speaker-avatar {
          position: absolute;
          left: 108px;
          top: 4px;
          width: 72px;
          height: 96px;
          border-radius: 8px;
          overflow: hidden;
          z-index: 3;
          
          transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .timeline-speaker-avatar:hover {
          transform: scale(1.08);
          box-shadow: 0 0 28px rgba(232, 169, 10, 0.5);
        }

        .timeline-speaker-avatar img {
          width: 100%;
          height: 100%;
          object-fit: cover;
          display: block;
        }

        /* ─── Content — consistent margin for ALL items ─── */
        .timeline-content {
          margin-left: 210px;
          padding-top: 12px;
        }

        /* Items without speaker: dot is a bit higher */
        .timeline-item:not(.has-speaker) .timeline-dot {
          top: 8px;
        }

        .timeline-item:not(.has-speaker) .timeline-content {
          padding-top: 4px;
        }

        .timeline-speaker-name {
          font-size: 24px;
          font-weight: 700;
          color: #e8a90a;
          letter-spacing: 1.5px;
          text-transform: uppercase;
          margin-bottom: 4px;
        }

        .timeline-label {
          font-size: 36px;
          font-weight: 700;
          color: #fff;
          letter-spacing: 0.8px;
          line-height: 1.3;
        }

        .timeline-subtitle {
          font-size: 21px;
          font-weight: 600;
          color: #e8a90a;
          letter-spacing: 1.5px;
          margin-top: 4px;
          text-transform: uppercase;

        }

        /* ─── Decor: Video player — large, no frame ─── */
        .program-decor {
          flex-shrink: 0;
          width: 960px;
          position: sticky;
          top: 100px;
          display: flex;
          flex-direction: column;
          align-items: center;
          justify-content: center;
        }

        .program-video-wrap {
          width: 100%;
          max-width: 880px;
          border-radius: 40px;
          overflow: hidden;
          position: relative;
        }

        .program-video {
          width: 100%;
          height: auto;
          display: block;
          border-radius: inherit;
          margin-top: 300px;
        }

        /* ─── Responsive ─── */
        @media (max-width: 1400px) {
          .program-title {
            font-size: 72px;
          }

          .timeline-clock {
            font-size: 40px;
          }

          .program-decor {
            width: 800px;
          }

          .program-video-wrap {
            max-width: 720px;
          }

          .program-glow {
            width: 700px;
            height: 700px;
          }

          .program-hex {
            width: 200px;
            height: 200px;
          }
        }

        @media (max-width: 1200px) {
          .program-title {
            font-size: 60px;
          }

          .program-decor {
            width: 680px;
          }

          .program-video-wrap {
            max-width: 600px;
          }

          .program-glow {
            width: 600px;
            height: 600px;
          }

          .program-hex {
            width: 160px;
            height: 160px;
          }

          .timeline-clock {
            font-size: 36px;
          }

          .timeline-label {
            font-size: 30px;
          }
        }

        @media (max-width: 1024px) {
          .program-section {
            padding: 60px 0;
          }

          .program-title {
            font-size: 52px;
          }

          .program-decor {
            display: none;
          }

          .program-timeline {
            max-width: 100%;
          }

          .program-glow {
            opacity: 0.4;
          }

          .program-hex {
            width: 120px;
            height: 120px;
            opacity: 0.25;
          }

          .timeline-line {
            left: 140px;
          }

          .timeline-dot {
            left: 133px;
          }

          .timeline-speaker-avatar {
            left: 102px;
            width: 66px;
            height: 88px;
          }

          .timeline-content {
            margin-left: 190px;
          }

          .timeline-time {
            width: 115px;
          }

          .timeline-clock {
            font-size: 32px;
          }

          .timeline-label {
            font-size: 26px;
          }
        }

        @media (max-width: 768px) {
          .program-section {
            padding: 48px 0;
          }

          .program-container {
            padding: 0 20px;
          }

          .program-header {
            margin-bottom: 32px;
          }

          .program-suptitle {
            font-size: 16px;
            letter-spacing: 4px;
          }

          .program-suptitle::before,
          .program-suptitle::after {
            width: 36px;
            margin: 0 12px;
          }

          .program-title {
            font-size: 42px;
          }

          .program-timeline {
            padding-left: 0;
          }

          .timeline-line {
            left: 32px;
            top: 8px;
          }

          .timeline-item {
            padding-left: 0;
            margin-bottom: 28px;
            min-height: 56px;
          }

          .timeline-time {
            position: absolute;
            left: -5px;
            top: 4px;
            width: auto;
            text-align: left;
            padding-right: 0;
          }

          .timeline-clock {
            font-size: 24px;
          }

          .timeline-dot {
            left: 26px;
            top: 14px;
            width: 14px;
            height: 14px;
            min-width: 14px;
          }

          .timeline-item:not(.has-speaker) .timeline-dot {
            top: 8px;
          }

          .timeline-speaker-avatar {
            left: 24px;
            top: 4px;
            width: 54px;
            height: 72px;
            border-radius: 6px;
          }

          .timeline-content {
            margin-left: 0;
            padding-top: 0;
          }

          .timeline-item:not(.has-speaker) .timeline-content {
            margin-left: 0;
            padding-top: 2px;
          }

          .timeline-label {
            font-size: 20px;
          }

          .timeline-speaker-name {
            font-size: 16px;
          }

          .timeline-subtitle {
            font-size: 14px;
          }

          .program-glow {
            width: 400px;
            height: 400px;
            opacity: 0.3;
          }

          .program-hex {
            display: none;
          }
        }

        @media (max-width: 480px) {
          .program-title {
            font-size: 32px;
          }

          .timeline-clock {
            font-size: 20px;
          }

          .timeline-label {
            font-size: 18px;
          }

          .timeline-item {
            margin-bottom: 18px;
          }
        }
      </style></section><section id="tickets" class="tickets-section" data-srcloc="/ulei/components/tickets-section.tsx:5"><div class="tickets-hex" data-srcloc="/ulei/components/tickets-section.tsx:5.5"></div><div class="tickets-container" data-srcloc="/ulei/components/tickets-section.tsx:6"><div class="tickets-label" data-srcloc="/ulei/components/tickets-section.tsx:8">БИЛЕТЫ</div><h2 class="tickets-heading" data-srcloc="/ulei/components/tickets-section.tsx:11">ВЫБЕРИ СВОЮ СОТУ</h2><div class="tickets-countdown" data-srcloc="/ulei/components/tickets-section.tsx:14"><span class="countdown-text" data-srcloc="/ulei/components/tickets-section.tsx:15">ДО ПОДНЯТИЯ<br> ЦЕН НА БИЛЕТЫ</span><div class="countdown-box" data-srcloc="/ulei/components/tickets-section.tsx:16"><span class="countdown-number" data-srcloc="/ulei/components/tickets-section.tsx:17" style="color: #e8a90a">25</span></div><span class="countdown-unit" data-srcloc="/ulei/components/tickets-section.tsx:19">ДНЕЙ</span></div><div class="tickets-grid" data-srcloc="/ulei/components/tickets-section.tsx:23"><div class="ticket-card" data-srcloc="/ulei/components/tickets-section.tsx:25"><div class="ticket-header" data-srcloc="/ulei/components/tickets-section.tsx:26"><span class="ticket-name" data-srcloc="/ulei/components/tickets-section.tsx:27">STANDARD</span><div class="ticket-old-price" data-srcloc="/ulei/components/tickets-section.tsx:28">3 500 ₽</div></div><div class="ticket-price-row" data-srcloc="/ulei/components/tickets-section.tsx:30"><span class="ticket-price" data-srcloc="/ulei/components/tickets-section.tsx:31">2 500 ₽</span><span class="ticket-price-note" data-srcloc="/ulei/components/tickets-section.tsx:32" style="font-size: 12px;">первые 300<br>билетов</span></div><ul class="ticket-features" data-srcloc="/ulei/components/tickets-section.tsx:34"><li data-srcloc="/ulei/components/tickets-section.tsx:35"><i class="fas fa-check" data-srcloc="/ulei/components/tickets-section.tsx:36"></i>Свободная посадка</li><li data-srcloc="/ulei/components/tickets-section.tsx:39"><i class="fas fa-check" data-srcloc="/ulei/components/tickets-section.tsx:40"></i>Доступ ко всем сессиям</li><li data-srcloc="/ulei/components/tickets-section.tsx:43"><i class="fas fa-check" data-srcloc="/ulei/components/tickets-section.tsx:44"></i>Нетворкинг-зона</li></ul><button class="ticket-btn ticket-btn-outline" data-srcloc="/ulei/components/tickets-section.tsx:48">Купить</button></div><div class="ticket-card" data-srcloc="/ulei/components/tickets-section.tsx:52"><div class="ticket-header" data-srcloc="/ulei/components/tickets-section.tsx:53"><span class="ticket-name" data-srcloc="/ulei/components/tickets-section.tsx:54">VIP</span></div><div class="ticket-price-row" data-srcloc="/ulei/components/tickets-section.tsx:56"><span class="ticket-price" data-srcloc="/ulei/components/tickets-section.tsx:57">10 000 ₽</span></div><ul class="ticket-features" data-srcloc="/ulei/components/tickets-section.tsx:59"><li data-srcloc="/ulei/components/tickets-section.tsx:60"><i class="fas fa-check" data-srcloc="/ulei/components/tickets-section.tsx:61"></i>Места 1-5 ряд</li><li data-srcloc="/ulei/components/tickets-section.tsx:64"><i class="fas fa-check" data-srcloc="/ulei/components/tickets-section.tsx:65"></i>Доступ ко всем сессиям</li><li data-srcloc="/ulei/components/tickets-section.tsx:68"><i class="fas fa-check" data-srcloc="/ulei/components/tickets-section.tsx:69"></i>Нетворкинг-зона</li></ul><button class="ticket-btn ticket-btn-outline" data-srcloc="/ulei/components/tickets-section.tsx:73">Купить</button></div><div class="ticket-card ticket-card-featured" data-srcloc="/ulei/components/tickets-section.tsx:77"><div class="ticket-badge" data-srcloc="/ulei/components/tickets-section.tsx:78">МАКСИМУМ ПОЛЬЗЫ</div><div class="ticket-header" data-srcloc="/ulei/components/tickets-section.tsx:79"><span class="ticket-name" data-srcloc="/ulei/components/tickets-section.tsx:80">FIRST</span><span class="ticket-flame" data-srcloc="/ulei/components/tickets-section.tsx:81">🔥</span></div><div class="ticket-price-row" data-srcloc="/ulei/components/tickets-section.tsx:83"><span class="ticket-price" data-srcloc="/ulei/components/tickets-section.tsx:84">39 900 ₽</span></div><ul class="ticket-features" data-srcloc="/ulei/components/tickets-section.tsx:86"><li data-srcloc="/ulei/components/tickets-section.tsx:87"><i class="fas fa-check" data-srcloc="/ulei/components/tickets-section.tsx:88"></i>Первый ряд</li><li data-srcloc="/ulei/components/tickets-section.tsx:91"><i class="fas fa-check" data-srcloc="/ulei/components/tickets-section.tsx:92"></i>Только 10 мест</li><li data-srcloc="/ulei/components/tickets-section.tsx:95"><i class="fas fa-check" data-srcloc="/ulei/components/tickets-section.tsx:96"></i>Ужин со спикерами</li></ul><button class="ticket-btn ticket-btn-gold" data-srcloc="/ulei/components/tickets-section.tsx:100">Купить</button></div></div></div><style data-srcloc="/ulei/components/tickets-section.tsx:107">
        .tickets-section {
          position: relative;
          padding: 120px 0 150px;
          background: #000000;
          overflow: hidden;
        }

        

        .tickets-container {
          max-width: 1400px;
          margin: 0 auto;
          padding: 0 48px;
          position: relative;
          z-index: 2;
          text-align: left;
        }

        .tickets-label {
          font-size: 22px;
          font-weight: 600;
          letter-spacing: 6px;
          color: #e8a90a;
          text-transform: uppercase;
          margin-bottom: 18px;
        }

        .tickets-heading {
          font-size: 84px;
          font-weight: 900;
          color: #fff;

          letter-spacing: -3px;
          margin-bottom: 36px;
          line-height: 1.1;
        }

        /* ─── Countdown ─── */
        .tickets-countdown {
          display: flex;
          align-items: center;
          justify-content: flex-start;
          gap: 20px;
          margin-bottom: 60px;
          flex-wrap: wrap;
        }

        .countdown-text {
          font-size: 27px;
          font-weight: 600;
          color: #e8a90a;
          letter-spacing: 3px;
          text-transform: uppercase;
        }

        .countdown-box {
          width: 108px;
          height: 108px;
          border: 2px solid #e8a90a;
          border-radius: 16px;
          display: flex;
          align-items: center;
          justify-content: center;
        }

        .countdown-number {
          font-size: 54px;
          font-weight: 900;
          color: #fff;

          line-height: 1;
        }

        .countdown-unit {
          font-size: 27px;
          font-weight: 700;
          color: #e8a90a;
          letter-spacing: 3px;
          text-transform: uppercase;
        }

        /* ─── Grid ─── */
        .tickets-grid {
          display: grid;
          grid-template-columns: repeat(3, 1fr);
          gap: 30px;
          margin-left: 0;
          align-items: stretch;
        }

        /* ─── Card ─── */
        .ticket-card {
          position: relative;
          display: flex;
          flex-direction: column;
          background: rgba(255,255,255,0.02);
          border: 1px solid rgba(232,169,10,0.25);
          border-radius: 24px;
          padding: 42px 36px 36px;
          text-align: left;
          transition: transform 0.35s ease, border-color 0.35s ease, box-shadow 0.35s ease;
          backdrop-filter: blur(4px);

        }

        .ticket-card:hover {
          transform: translateY(-6px);
          border-color: rgba(232,169,10,0.5);
          box-shadow: 0 12px 48px rgba(232,169,10,0.08);
        }

        .ticket-card-featured {
          border: 2px solid #e8a90a;
          box-shadow: 0 0 0 1px rgba(232,169,10,0.3), 0 0 60px rgba(232,169,10,0.25), 0 0 120px rgba(232,169,10,0.1);
          background: rgba(255,255,255,0.03);
           box-shadow: 0 0 0 1px rgba(232,169,10,0.4), 0 0 80px rgba(232,169,10,0.35), 0 0 160px rgba(232,169,10,0.15), 0 12px 48px rgba(232,169,10,0.1);
        }

        .ticket-card-featured::before {
          content: '';
          position: absolute;
          top: -30px;
          left: -30px;
          right: -30px;
          bottom: -30px;
          border-radius: 36px;
          background: radial-gradient(ellipse at center, rgba(232,169,10,0.08) 0%, transparent 70%);
          pointer-events: none;
          z-index: -1;
          animation: glowPulse 3s ease-in-out infinite alternate;
        }

        @keyframes glowPulse {
          0% { opacity: 0.6; transform: scale(1); }
          100% { opacity: 1; transform: scale(1.03); }
        }

        .ticket-card-featured:hover {
          box-shadow: 0 0 0 1px rgba(232,169,10,0.4), 0 0 80px rgba(232,169,10,0.35), 0 0 160px rgba(232,169,10,0.15), 0 12px 48px rgba(232,169,10,0.1);
        }

        .ticket-badge {
          position: absolute;
          top: -14px;
          left: 50%;
          transform: translateX(-50%);
          background: #e8a90a;
          color: #1a1a1a;

          font-size: 13px;
          font-weight: 800;
          letter-spacing: 3px;
          text-transform: uppercase;
          padding: 10px 28px;
          border-radius: 30px;
          white-space: nowrap;
        }

        .ticket-header {
          min-height: 82px;
          margin-bottom: 24px;
        }

        .ticket-name {
          font-size: 36px;
          font-weight: 800;
          color: #fff;

          letter-spacing: 1px;
        }

        .ticket-flame {
          font-size: 28px;
          margin-left: 8px;
          vertical-align: middle;
        }

        .ticket-old-price {
          font-size: 27px;
          font-weight: 500;
          color: rgba(232,169,10,0.5);
          text-decoration: line-through;
          margin-top: 6px;
        }

        .ticket-price-row {
          display: flex;
          align-items: baseline;
          gap: 14px;
          flex-wrap: wrap;
          min-height: 90px;
          margin-bottom: 30px;
          padding-bottom: 30px;
          border-bottom: 1px solid rgba(255,255,255,0.08);
        }

        .ticket-price {
          font-size: 50px;
          font-weight: 900;
          color: #e8a90a;
          letter-spacing: 1px;
          line-height: 1;
        }

        .ticket-price-note {
          font-size: 22px;
          font-weight: 600;
          color: rgba(255,255,255,0.6);

          letter-spacing: 0.5px;
        }

        .ticket-card:first-child .ticket-price-note {
          color: #e8a90a;
          line-height: 1.2;
        }

        .ticket-card:first-child .ticket-price-row {
          flex-wrap: nowrap;
        }

        .ticket-features {
          list-style: none;
          display: flex;
          flex-direction: column;
          gap: 20px;
          margin-bottom: 42px;
          flex: 1;
        }

        .ticket-features li {
          font-size: 15px;
          font-weight: 500;
          color: rgba(255,255,255,0.7);
          font-family: Arial;
          display: flex;
          align-items: center;
          gap: 14px;
          line-height: 1.4;
        }

        .ticket-features li i {
          color: #e8a90a;
          font-size: 18px;
          width: 24px;
          text-align: center;
          flex-shrink: 0;

        }

        /* ─── Buttons ─── */
        .ticket-btn {
          display: inline-flex;
          align-items: center;
          justify-content: center;
          width: 100%;
          padding: 21px 36px;
          font-size: 18px;
          font-weight: 700;
          letter-spacing: 0.5px;
          border-radius: 50px;
          transition: all 0.3s ease;
          cursor: pointer;
          text-transform: uppercase;
          font-family: inherit;
        }

        .ticket-btn-outline {
          background: transparent;
          color: #fff;

          border: 1px solid rgba(232,169,10,0.5);
        }

        .ticket-btn-outline:hover {
          background: rgba(232,169,10,0.1);
          border-color: #e8a90a;
          transform: translateY(-2px);
          box-shadow: 0 8px 30px rgba(232,169,10,0.15);
        }

        .ticket-btn-gold {
          background: #e8a90a;
          color: #1a1a1a;

          border: none;
          box-shadow: 0 4px 20px rgba(232,169,10,0.3);
        }

        .ticket-btn-gold:hover {
          transform: translateY(-2px);
          box-shadow: 0 8px 30px rgba(232,169,10,0.5);
          background: #d49a09;
        }

        

        /* ─── Responsive ─── */
        @media (max-width: 1024px) {
          .tickets-heading {
            font-size: 56px;
          }

          .tickets-grid {
            gap: 20px;
          }

          .ticket-card {
            padding: 32px 24px 28px;
          }

          .ticket-price {
            font-size: 40px;
          }
        }

        @media (max-width: 768px) {
          .tickets-section {
            padding: 64px 0 80px;
          }

          .tickets-container {
            padding: 0 24px;
          }

          .tickets-heading {
            font-size: 40px;
            letter-spacing: -1px;
          }

          .tickets-grid {
            grid-template-columns: 1fr;
            gap: 20px;
            max-width: 500px;
            margin: 0 auto;
          }

          .ticket-card {
            padding: 32px 24px 24px;
          }

          .countdown-box {
            width: 72px;
            height: 72px;
          }

          .countdown-number {
            font-size: 36px;
          }

          .ticket-name {
            font-size: 28px;
          }

          .ticket-price {
            font-size: 36px;
          }

          .ticket-features li {
            font-size: 16px;
          }
        }

        @media (max-width: 480px) {
          .tickets-heading {
            font-size: 32px;
          }

          .ticket-price {
            font-size: 30px;
          }

          .ticket-name {
            font-size: 24px;
          }

          .ticket-btn {
            font-size: 18px;
            padding: 16px 24px;
          }
        }

        .tickets-hex {
          position: absolute;
          right: 0;
          top: 0;
          bottom: 0;
          width: 500px;
          background: url('https://fs.chatium.ru/get/image_msk_8AluVpBnoE.1822x2977.png') right center / auto 100% no-repeat;
          pointer-events: none;
          z-index: 0;
          opacity: 0.35;
          mask-image: linear-gradient(to bottom, transparent 0%, transparent 35%, black 55%, black 100%);
          -webkit-mask-image: linear-gradient(to bottom, transparent 0%, transparent 35%, black 55%, black 100%);
        }
      </style></section><section class="partners-section" id="partners" data-srcloc="/ulei/components/partners-section.tsx:30"><h2 class="partners-heading" data-srcloc="/ulei/components/partners-section.tsx:31">ПАРТНЁРЫ</h2><div class="partners-divider" data-srcloc="/ulei/components/partners-section.tsx:32"></div><div class="partners-gradient-bg" data-srcloc="/ulei/components/partners-section.tsx:33"><div class="partners-logos-row" data-srcloc="/ulei/components/partners-section.tsx:34"><div class="partners-logo-item" data-srcloc="/ulei/components/partners-section.tsx:36"><img src="https://fs.chatium.ru/get/image_msk_bQ0cJT5UBh.739x232.png" alt="Логотип" data-srcloc="/ulei/components/partners-section.tsx:40"></div><div class="partners-logo-item" data-srcloc="/ulei/components/partners-section.tsx:36"><img src="https://fs.chatium.ru/get/image_msk_1sGVoJe9Wp.763x328.png" alt="Альфа Банк" data-srcloc="/ulei/components/partners-section.tsx:40"></div><div class="partners-logo-item" data-srcloc="/ulei/components/partners-section.tsx:36"><img src="https://fs.chatium.ru/get/image_msk_se4oJrDPYp.1124x249.png" alt="Облако" data-srcloc="/ulei/components/partners-section.tsx:40"></div><div class="partners-logo-item" data-srcloc="/ulei/components/partners-section.tsx:36"><img src="https://fs.chatium.ru/get/image_msk_XTTnOhF2dx.892x189.png" alt="2ГИС" data-srcloc="/ulei/components/partners-section.tsx:40"></div><div class="partners-logo-item" data-srcloc="/ulei/components/partners-section.tsx:36"><img src="https://fs.chatium.ru/get/image_msk_bQ0cJT5UBh.739x232.png" alt="Логотип" data-srcloc="/ulei/components/partners-section.tsx:40"></div><div class="partners-logo-item" data-srcloc="/ulei/components/partners-section.tsx:36"><img src="https://fs.chatium.ru/get/image_msk_bQ0cJT5UBh.739x232.png" alt="Логотип" data-srcloc="/ulei/components/partners-section.tsx:40"></div></div><div class="partners-logos-row" data-srcloc="/ulei/components/partners-section.tsx:45"><div class="partners-logo-item" data-srcloc="/ulei/components/partners-section.tsx:47"><img src="https://fs.chatium.ru/get/image_msk_wSZi93QtIK.739x232.png" alt="Логотип" data-srcloc="/ulei/components/partners-section.tsx:51"></div><div class="partners-logo-item" data-srcloc="/ulei/components/partners-section.tsx:47"><img src="https://fs.chatium.ru/get/image_msk_wSZi93QtIK.739x232.png" alt="Логотип" data-srcloc="/ulei/components/partners-section.tsx:51"></div><div class="partners-logo-item" data-srcloc="/ulei/components/partners-section.tsx:47"><img src="https://fs.chatium.ru/get/image_msk_H17OAzVSq7.1160x227.png" alt="Билайн" data-srcloc="/ulei/components/partners-section.tsx:51"></div><div class="partners-logo-item" data-srcloc="/ulei/components/partners-section.tsx:47"><img src="https://fs.chatium.ru/get/image_msk_bQ0cJT5UBh.739x232.png" alt="Логотип" data-srcloc="/ulei/components/partners-section.tsx:40"></div><div class="partners-logo-item" data-srcloc="/ulei/components/partners-section.tsx:47"><img src="https://fs.chatium.ru/get/image_msk_wSZi93QtIK.739x232.png" alt="Логотип" data-srcloc="/ulei/components/partners-section.tsx:51"></div></div></div></section><style data-srcloc="/ulei/components/partners-section.tsx:59">
        .partners-section {
          background: #000000;
          padding: 100px 0 80px;
          text-align: center;
          position: relative;
          overflow: hidden;
        }

        .partners-heading {
          font-size: 72px;
          font-weight: 800;
          letter-spacing: 16px;
          background: linear-gradient(135deg, #f7d875 0%, #e8a90a 50%, #d4940a 100%);
          -webkit-background-clip: text;
          -webkit-text-fill-color: transparent;
          background-clip: text;
          text-transform: uppercase;
          margin: 0 0 20px;
          padding: 0 32px;
        }

        .partners-divider {
          width: 100%;
          height: 1px;
          background: linear-gradient(90deg, transparent 0%, rgba(232, 169, 10, 0.4) 50%, transparent 100%);
          margin-bottom: 0;
        }

        .partners-gradient-bg {
          background: linear-gradient(
            90deg,
            rgba(232, 169, 10, 0.35) 0%,
            rgba(232, 169, 10, 0.15) 12%,
            transparent 30%,
            transparent 70%,
            rgba(232, 169, 10, 0.15) 88%,
            rgba(232, 169, 10, 0.35) 100%
          );
          padding: 50px 0 40px;
          width: 100%;
        }

        .partners-logos-row {
          display: flex;
          align-items: center;
          justify-content: center;
          width: 100%;
          max-width: 1400px;
          margin: 0 auto;
          padding: 8px 32px;
        }

        .partners-logos-row + .partners-logos-row {
          margin-top: 12px;
        }

        .partners-logo-item {
          flex: 1 1 0;
          display: flex;
          align-items: center;
          justify-content: center;
          height: 80px;
          padding: 0 12px;
          min-width: 0;
        }

        .partners-logo-item img {
          max-height: 65px;
          max-width: 100%;
          width: auto;
          object-fit: contain;
          mix-blend-mode: screen;
          opacity: 0.9;
          transition: opacity 0.3s ease, transform 0.3s ease;
        }

        .partners-logo-item:hover img {
          opacity: 1;
          transform: scale(1.06);
        }

        .logo-placeholder {
          font-family: 'Inter', Arial, sans-serif;
          font-size: 20px;
          font-weight: 700;
          letter-spacing: 4px;
          color: rgba(255, 255, 255, 0.5);
          text-transform: uppercase;
          opacity: 0.6;
        }

        @media (max-width: 1024px) {
          .partners-heading {
            font-size: 56px;
            letter-spacing: 12px;
          }
          .partners-gradient-bg {
            padding: 40px 0 30px;
          }
          .partners-logo-item {
            height: 64px;
            padding: 0 8px;
          }
          .partners-logo-item img {
            max-height: 50px;
          }
        }

        @media (max-width: 768px) {
          .partners-section {
            padding: 70px 0 50px;
          }
          .partners-heading {
            font-size: 42px;
            letter-spacing: 8px;
          }
          .partners-logos-row {
            padding: 6px 16px;
            flex-wrap: wrap;
          }
          .partners-logo-item {
            height: 52px;
            padding: 0 6px;
            flex: 1 1 33%;
          }
          .partners-logo-item img {
            max-height: 40px;
          }
          .logo-placeholder {
            font-size: 14px;
            letter-spacing: 2px;
          }
        }

        @media (max-width: 480px) {
          .partners-heading {
            font-size: 30px;
            letter-spacing: 5px;
          }
          .partners-gradient-bg {
            padding: 30px 0 20px;
          }
          .partners-logo-item {
            height: 40px;
          }
          .partners-logo-item img {
            max-height: 30px;
          }
          .logo-placeholder {
            font-size: 11px;
            letter-spacing: 1px;
          }
        }
      </style><section class="info-partners-section" data-srcloc="/ulei/components/info-partners-section.tsx:22"><h2 class="info-partners-heading" data-srcloc="/ulei/components/info-partners-section.tsx:23">ИНФОПАРТНЁРЫ</h2><div class="info-partners-divider" data-srcloc="/ulei/components/info-partners-section.tsx:24"></div><div class="info-partners-logos-row" data-srcloc="/ulei/components/info-partners-section.tsx:25"><div class="info-partners-logo-item" data-srcloc="/ulei/components/info-partners-section.tsx:27"><img src="https://fs.chatium.ru/get/image_msk_wSZi93QtIK.739x232.png" alt="Логотип" data-srcloc="/ulei/components/info-partners-section.tsx:31"></div><div class="info-partners-logo-item" data-srcloc="/ulei/components/info-partners-section.tsx:27"><img src="https://fs.chatium.ru/get/image_msk_wSZi93QtIK.739x232.png" alt="Логотип" data-srcloc="/ulei/components/info-partners-section.tsx:31"></div><div class="info-partners-logo-item" data-srcloc="/ulei/components/info-partners-section.tsx:27"><img src="https://fs.chatium.ru/get/image_msk_k9vgeWqE1V.896x404.png" alt="La Riviera" data-srcloc="/ulei/components/info-partners-section.tsx:31"></div><div class="info-partners-logo-item" data-srcloc="/ulei/components/info-partners-section.tsx:27"><img src="https://fs.chatium.ru/get/image_msk_SJyvda8YRS.1107x265.png" alt="Sport Town" data-srcloc="/ulei/components/info-partners-section.tsx:31"></div><div class="info-partners-logo-item" data-srcloc="/ulei/components/info-partners-section.tsx:27"><img src="https://fs.chatium.ru/get/image_msk_IzWTHAsNgf.776x325.png" alt="Наш Журнал" data-srcloc="/ulei/components/info-partners-section.tsx:31"></div><div class="info-partners-logo-item" data-srcloc="/ulei/components/info-partners-section.tsx:27"><img src="https://fs.chatium.ru/get/image_msk_bQ0cJT5UBh.739x232.png" alt="Логотип" data-srcloc="/ulei/components/partners-section.tsx:40"></div></div></section><style data-srcloc="/ulei/components/info-partners-section.tsx:38">
        .info-partners-section {
          background: #000000;
          padding: 40px 0 120px;
          text-align: center;
          position: relative;
          overflow: hidden;
        }

        .info-partners-heading {
          font-size: 56px;
          font-weight: 800;
          letter-spacing: 16px;
          background: linear-gradient(135deg, #f7d875 0%, #e8a90a 50%, #d4940a 100%);
          -webkit-background-clip: text;
          -webkit-text-fill-color: transparent;
          background-clip: text;
          text-transform: uppercase;
          margin: 0 0 20px;
          padding: 0 32px;
        }

        .info-partners-divider {
          width: 100%;
          height: 1px;
          background: linear-gradient(90deg, transparent 0%, rgba(232, 169, 10, 0.4) 50%, transparent 100%);
          margin-bottom: 50px;
        }

        .info-partners-logos-row {
          display: flex;
          align-items: center;
          justify-content: center;
          width: 100%;
          max-width: 1400px;
          margin: 0 auto;
          padding: 0 32px;
        }

        .info-partners-logo-item {
          flex: 1 1 0;
          display: flex;
          align-items: center;
          justify-content: center;
          height: 80px;
          padding: 0 12px;
          min-width: 0;
        }

        .info-partners-logo-item img {
          max-height: 65px;
          max-width: 100%;
          width: auto;
          object-fit: contain;
          mix-blend-mode: screen;
          opacity: 0.8;
          transition: opacity 0.3s ease, transform 0.3s ease;
        }

        .info-partners-logo-item:hover img {
          opacity: 1;
          transform: scale(1.06);
        }

        .info-logo-placeholder {
          font-family: 'Inter', Arial, sans-serif;
          font-size: 20px;
          font-weight: 700;
          letter-spacing: 4px;
          color: rgba(255, 255, 255, 0.45);
          text-transform: uppercase;
          opacity: 0.6;
        }

        @media (max-width: 1024px) {
          .info-partners-section {
            padding: 30px 0 100px;
          }
          .info-partners-heading {
            font-size: 48px;
            letter-spacing: 12px;
          }
          .info-partners-divider {
            margin-bottom: 40px;
          }
          .info-partners-logo-item {
            height: 64px;
            padding: 0 8px;
          }
          .info-partners-logo-item img {
            max-height: 50px;
          }
        }

        @media (max-width: 768px) {
          .info-partners-section {
            padding: 20px 0 80px;
          }
          .info-partners-heading {
            font-size: 36px;
            letter-spacing: 8px;
          }
          .info-partners-divider {
            margin-bottom: 32px;
          }
          .info-partners-logos-row {
            padding: 0 16px;
            flex-wrap: wrap;
          }
          .info-partners-logo-item {
            height: 52px;
            padding: 0 6px;
            flex: 1 1 33%;
          }
          .info-partners-logo-item img {
            max-height: 40px;
          }
          .info-logo-placeholder {
            font-size: 14px;
            letter-spacing: 2px;
          }
        }

        @media (max-width: 480px) {
          .info-partners-heading {
            font-size: 28px;
            letter-spacing: 5px;
          }
          .info-partners-logo-item {
            height: 40px;
          }
          .info-partners-logo-item img {
            max-height: 30px;
          }
          .info-logo-placeholder {
            font-size: 11px;
            letter-spacing: 1px;
          }
        }
      </style><section class="partnership-section" data-srcloc="/ulei/components/partnership-section.tsx:5"><div class="venue-honeycomb-left" data-srcloc="/ulei/components/venue-section.tsx:5.5"></div></div><div class="partnership-glow" data-srcloc="/ulei/components/partnership-section.tsx:9"></div><div class="partnership-container" data-srcloc="/ulei/components/partnership-section.tsx:11"><div class="partnership-label" data-srcloc="/ulei/components/partnership-section.tsx:13">ПАРТНЕРСТВО</div><h2 class="partnership-title" data-srcloc="/ulei/components/partnership-section.tsx:16">ЗАЯВИ О СЕБЕ<br data-srcloc="/ulei/components/partnership-section.tsx:17">НА НАШЕМ ФОРУМЕ!</h2><div class="partnership-cards" data-srcloc="/ulei/components/partnership-section.tsx:22"><div class="partnership-card" data-srcloc="/ulei/components/partnership-section.tsx:24"><div class="partnership-card-icon" data-srcloc="/ulei/components/partnership-section.tsx:25"><img src="https://fs.chatium.ru/get/image_msk_v0fvGtZCWv.112x103.png" alt="Генеральный" class="partnership-card-img" data-srcloc="/ulei/components/partnership-section.tsx:26"></div><h3 class="partnership-card-title" data-srcloc="/ulei/components/partnership-section.tsx:28">ГЕНЕРАЛЬНЫЙ</h3><p class="partnership-card-desc" data-srcloc="/ulei/components/partnership-section.tsx:29">Максимальная видимость бренда на главной сцене форума</p></div><div class="partnership-card" data-srcloc="/ulei/components/partnership-section.tsx:35"><div class="partnership-card-icon" data-srcloc="/ulei/components/partnership-section.tsx:36"><img src="https://fs.chatium.ru/get/image_msk_FGpohaXf9L.78x126.png" alt="Официальный" class="partnership-card-img" data-srcloc="/ulei/components/partnership-section.tsx:37"></div><h3 class="partnership-card-title" data-srcloc="/ulei/components/partnership-section.tsx:39">ОФИЦИАЛЬНЫЙ</h3><p class="partnership-card-desc" data-srcloc="/ulei/components/partnership-section.tsx:40">Присутствие бренда в ключевых точках форума</p></div><div class="partnership-card" data-srcloc="/ulei/components/partnership-section.tsx:46"><div class="partnership-card-icon" data-srcloc="/ulei/components/partnership-section.tsx:47"><img src="https://fs.chatium.ru/get/image_msk_nt2qHyeHD0.170x114.png" alt="Бизнес" class="partnership-card-img" data-srcloc="/ulei/components/partnership-section.tsx:48"></div><h3 class="partnership-card-title" data-srcloc="/ulei/components/partnership-section.tsx:50">БИЗНЕС</h3><p class="partnership-card-desc" data-srcloc="/ulei/components/partnership-section.tsx:51">Точечное присутствие для локальных и отраслевых брендов</p></div></div><div class="partnership-cta-wrap" data-srcloc="/ulei/components/partnership-section.tsx:58"><button onclick="openPartnerModal()" class="partnership-btn" data-srcloc="/ulei/components/partnership-section.tsx:59">Стать партнером</button></div></div><style data-srcloc="/ulei/components/partnership-section.tsx:65">
        .partnership-section {
          position: relative;
          padding: 120px 0 120px;
          background: #000000;
          overflow: hidden;
        }

        

        

        /* ─── Container ─── */
        .partnership-container {
          max-width: 1400px;
          margin: 0 auto;
          padding: 0 32px;
          position: relative;
          z-index: 3;
          text-align: left;
        }

        /* ─── Label ─── */
        .partnership-label {
          font-size: 22px;
          font-weight: 600;
          letter-spacing: 6px;
          color: #e8a90a;
          text-transform: uppercase;
          margin-bottom: 18px;

        }

        /* ─── Title ─── */
        .partnership-title {
          font-size: 72px;
          font-weight: 900;
          color: #fff;

          letter-spacing: -1px;
          line-height: 1.1;
          margin-bottom: 60px;
          text-transform: uppercase;
        }

        /* ─── Cards grid ─── */
        .partnership-cards {
          display: grid;
          grid-template-columns: repeat(3, 1fr);
          gap: 0px;
          max-width: 1400px;
          margin: 0 0 60px;
        }

        .partnership-card {
          background: rgba(255,255,255,0.02);
          border: 1px solid rgba(232,169,10,0.3);
          border-radius: 24px;
          padding: 10px 36px 32px;
          text-align: left;
          transition: all 0.4s ease;
          position: relative;
          overflow: hidden;
          width: 500px;
          margin-left: 10px;

        }

        .partnership-card::before {
          content: '';
          position: absolute;
          inset: 0;
          background: radial-gradient(ellipse at 50% 30%, rgba(232,169,10,0.06) 0%, transparent 70%);
          opacity: 0;
          transition: opacity 0.4s ease;
          pointer-events: none;
        }

        .partnership-card:hover {
          border-color: rgba(232,169,10,0.6);
          transform: translateY(-6px);
          box-shadow: 0 12px 50px rgba(232,169,10,0.12);
        }

        .partnership-card:hover::before {
          opacity: 1;
        }

        .partnership-card-icon {
          width: 84px;
          height: 84px;
          border-radius: 50%;
          
          display: flex;
          align-items: center;
          justify-content: center;
          margin: 0 0 24px;
          transition: all 0.4s ease;
          overflow: hidden;
        }

        .partnership-card-img {
          width: 65%;
          height: 65%;
          object-fit: contain;
        }

        .partnership-card:hover .partnership-card-icon {
          background: rgba(232,169,10,0.18);
          border-color: rgba(232,169,10,0.5);
          transform: scale(1.08);
          box-shadow: 0 0 30px rgba(232,169,10,0.15);
        }

        .partnership-card-title {
          font-size: 30px;
          font-weight: 800;
          color: #fff;

          letter-spacing: 3px;
          margin-bottom: 15px;
          text-transform: uppercase;
        }

        .partnership-card-desc {
          font-size: 18px;
          line-height: 1.6;
          color: rgba(255,255,255,0.7);
          font-family: Arial;
          max-width: 340px;
                  }

        /* ─── CTA Button ─── */
        .partnership-cta-wrap {
          text-align: center;
          font-family: Arial;
        }

        .partnership-btn {
          display: inline-flex;
          align-items: center;
          justify-content: center;
          padding: 27px 78px;
          background: #e8a90a;
          color: #1a1a1a;

          font-size: 25px;
          font-weight: 700;
          letter-spacing: 1px;
          text-transform: uppercase;
          border-radius: 75px;
          transition: all 0.3s ease;
          box-shadow: 0 6px 36px rgba(232,169,10,0.3);
          cursor: pointer;
        }

        .partnership-btn:hover {
          transform: translateY(-3px);
          box-shadow: 0 12px 60px rgba(232,169,10,0.5);
          background: #d49a09;
        }

        /* ─── Responsive ─── */
        @media (max-width: 1024px) {
          .partnership-section {
            padding: 90px 0 90px;
          }

          .partnership-title {
            font-size: 54px;
            margin-bottom: 48px;
          }

          .partnership-cards {
            gap: 20px;
            max-width: 100%;
          }

          .partnership-card {
            padding: 40px 28px 34px;
          }

          .partnership-card-title {
            font-size: 26px;
            letter-spacing: 3px;
          }

          .partnership-card-desc {
            font-size: 20px;
          }
        }

        @media (max-width: 768px) {
          .partnership-section {
            padding: 72px 0 60px;
          }

          .partnership-container {
            padding: 0 20px;
          }

          .partnership-title {
            font-size: 40px;
            margin-bottom: 36px;
          }

          .partnership-cards {
            grid-template-columns: 1fr;
            gap: 18px;
            max-width: 500px;
          }

          .partnership-card {
            padding: 36px 24px 30px;
          }

          .partnership-card-icon {
            width: 72px;
            height: 72px;
            margin-bottom: 18px;
          }

          .partnership-card-title {
            font-size: 24px;
            letter-spacing: 3px;
          }

          .partnership-card-desc {
            font-size: 20px;
          }

          .partnership-btn {
            padding: 24px 60px;
            font-size: 24px;
          }
        }

        @media (max-width: 480px) {
          .partnership-title {
            font-size: 32px;
          }

          .partnership-card {
            padding: 28px 20px 24px;
          }
        }

        /* ─── Honeycomb strip — left edge ─── */
        .partnership-honeycomb-left {
          position: absolute;
          left: 0;
          top: 0;
          bottom: 0;
          width: 120px;
background: url('https://fs.chatium.ru/get/image_msk_XFCxEXfKBT.1822x2977.png') left center / auto 100% no-repeat;
          pointer-events: none;
          z-index: 0;
          opacity: 0.25;
        }

        /* ─── Gold gradient glow — left ─── */
        .partnership-glow {
          position: absolute;
          left: -100px;
          top: 50%;
          transform: translateY(-50%);
          width: 550px;
          height: 700px;
          background: radial-gradient(circle at 30% 50%, rgba(232, 169, 10, 0.15) 0%, transparent 60%);
          pointer-events: none;
          z-index: 0;
        }

        @media (max-width: 1024px) {
          .partnership-honeycomb-left {
            width: 80px;
            opacity: 0.18;
          }
          .partnership-glow {
            width: 380px;
            height: 500px;
            left: -80px;
          }
        }

        @media (max-width: 768px) {
          .partnership-honeycomb-left {
            display: none;
          }
          .partnership-glow {
            width: 300px;
            height: 400px;
            left: -60px;
            opacity: 0.5;
          }
        }
      </style></section><section class="faq-section" data-srcloc="/ulei/components/faq-section.tsx:28"><div class="faq-container" data-srcloc="/ulei/components/faq-section.tsx:29"><div class="faq-label" data-srcloc="/ulei/components/faq-section.tsx:31">ВОПРОС ОТВЕТ</div><div class="faq-layout" data-srcloc="/ulei/components/faq-section.tsx:33"><div class="faq-list" data-srcloc="/ulei/components/faq-section.tsx:35"><div class="faq-item" data-srcloc="/ulei/components/faq-section.tsx:37"><div class="faq-item-header" data-srcloc="/ulei/components/faq-section.tsx:38"><span class="faq-question" data-srcloc="/ulei/components/faq-section.tsx:39">НЕ СМОГУ ПРИЕХАТЬ. БУДЕТ ОНЛАЙН?</span><div class="faq-dot-wrap" data-srcloc="/ulei/components/faq-section.tsx:40"><span class="faq-dot" data-srcloc="/ulei/components/faq-section.tsx:41"></span></div></div><div class="faq-answer" data-srcloc="/ulei/components/faq-section.tsx:44"><div class="faq-answer-inner" data-srcloc="/ulei/components/faq-section.tsx:45"><div class="faq-answer-text" data-srcloc="/ulei/components/faq-section.tsx:46">Нет, форум проходит только офлайн. Мы делаем ставку на живое общение, знакомства и атмосферу, которую невозможно передать через экран</div></div></div></div><div class="faq-item" data-srcloc="/ulei/components/faq-section.tsx:37"><div class="faq-item-header" data-srcloc="/ulei/components/faq-section.tsx:38"><span class="faq-question" data-srcloc="/ulei/components/faq-section.tsx:39">ЗАПИСЬ БУДЕТ?</span><div class="faq-dot-wrap" data-srcloc="/ulei/components/faq-section.tsx:40"><span class="faq-dot" data-srcloc="/ulei/components/faq-section.tsx:41"></span></div></div><div class="faq-answer" data-srcloc="/ulei/components/faq-section.tsx:44"><div class="faq-answer-inner" data-srcloc="/ulei/components/faq-section.tsx:45"><div class="faq-answer-text" data-srcloc="/ulei/components/faq-section.tsx:46">Запись выступлений не планируется. Лучший способ ничего не пропустить - быть с нами в день форума</div></div></div></div><div class="faq-item" data-srcloc="/ulei/components/faq-section.tsx:37"><div class="faq-item-header" data-srcloc="/ulei/components/faq-section.tsx:38"><span class="faq-question" data-srcloc="/ulei/components/faq-section.tsx:39">МОЖНО КУПИТЬ БИЛЕТЫ НА ВСЮ КОМАНДУ?</span><div class="faq-dot-wrap" data-srcloc="/ulei/components/faq-section.tsx:40"><span class="faq-dot" data-srcloc="/ulei/components/faq-section.tsx:41"></span></div></div><div class="faq-answer" data-srcloc="/ulei/components/faq-section.tsx:44"><div class="faq-answer-inner" data-srcloc="/ulei/components/faq-section.tsx:45"><div class="faq-answer-text" data-srcloc="/ulei/components/faq-section.tsx:46">Конечно! Вы можете оформить сразу несколько билетов для коллег, друзей или всей команды </div></div></div></div><div class="faq-item" data-srcloc="/ulei/components/faq-section.tsx:37"><div class="faq-item-header" data-srcloc="/ulei/components/faq-section.tsx:38"><span class="faq-question" data-srcloc="/ulei/components/faq-section.tsx:39">РЕГИСТРАЦИЯ ОБЯЗАТЕЛЬНА?</span><div class="faq-dot-wrap" data-srcloc="/ulei/components/faq-section.tsx:40"><span class="faq-dot" data-srcloc="/ulei/components/faq-section.tsx:41"></span></div></div><div class="faq-answer" data-srcloc="/ulei/components/faq-section.tsx:44"><div class="faq-answer-inner" data-srcloc="/ulei/components/faq-section.tsx:45"><div class="faq-answer-text" data-srcloc="/ulei/components/faq-section.tsx:46">Да. Вход только по предварительной регистрации и приобретённому билету</div></div></div></div><div class="faq-item" data-srcloc="/ulei/components/faq-section.tsx:37"><div class="faq-item-header" data-srcloc="/ulei/components/faq-section.tsx:38"><span class="faq-question" data-srcloc="/ulei/components/faq-section.tsx:39">ГДЕ ПРОВЕСТИ ВРЕМЯ ПОСЛЕ ФОРУМА?</span><div class="faq-dot-wrap" data-srcloc="/ulei/components/faq-section.tsx:40"><span class="faq-dot" data-srcloc="/ulei/components/faq-section.tsx:41"></span></div></div><div class="faq-answer" data-srcloc="/ulei/components/faq-section.tsx:44"><div class="faq-answer-inner" data-srcloc="/ulei/components/faq-section.tsx:45"><div class="faq-answer-text" data-srcloc="/ulei/components/faq-section.tsx:46">Обязательно стоит отправиться на новую набережную Тольятти и продолжить обсуждения тем бизнеса за чашкой кофе с прекрасным видом! Стоит обратить внимание на музей Автоваза. Если вы из другого города, обязательно посетите замок Гарибальди</div></div></div></div></div><div class="faq-decor" data-srcloc="/ulei/components/faq-section.tsx:54"><div class="faq-video-wrap" data-srcloc="/ulei/components/faq-section.tsx:55"><video class="faq-video" autoplay="autoplay" loop="loop" muted="muted" playsinline="playsinline" poster="https://slt.cdn-chatium.io/thumbnail/video_msk_wtxMQxVoeH.d5.720x810.webm/s/600x" data-srcloc="/ulei/components/faq-section.tsx:56"><source src="https://fs.chatium.ru/get/video_msk_wtxMQxVoeH.d5.720x810.webm" type="video/webm" data-srcloc="/ulei/components/faq-section.tsx:64"></video></div></div></div></div><style data-srcloc="/ulei/components/faq-section.tsx:71">
        .faq-section {
          position: relative;
          padding: 120px 0 105px;
          background: #000000;
          overflow: hidden;
          margin-left: 200px;
        }

        /* ─── Container ─── */
        .faq-container {
          max-width: 2200px;
          margin: 0 auto;
          padding: 0 32px 0 132px;
          position: relative;
          z-index: 3;
        }

        /* ─── Label ─── */
        .faq-label {
          font-size: 30px;
          font-weight: 600;
          letter-spacing: 4px;
          color: #e8a90a;
          text-transform: uppercase;
          margin-bottom: -20px;
        }

        /* ─── Layout ─── */
        .faq-layout {
          display: grid;
          grid-template-columns: 1fr auto;
          gap: 100px;
          align-items: center;
        }

        /* ─── FAQ list ─── */
        .faq-list {
          display: flex;
          flex-direction: column;
          gap: 21px;
          max-width: 720px;
        }

        .faq-item {
          display: flex;
          flex-direction: column;
          background: rgba(0, 0, 0, 0.4);
          border: 1px solid rgba(232, 169, 10, 0.35);
          border-radius: 21px;
          padding: 0;
          cursor: pointer;
          transition: all 0.3s ease;
          overflow: hidden;
        }

        .faq-item:hover {
          border-color: rgba(232, 169, 10, 0.6);
          background: rgba(255, 255, 255, 0.03);
          transform: translateY(-2px);
          box-shadow: 0 4px 24px rgba(232, 169, 10, 0.08);
        }

        .faq-item-header {
          display: flex;
          align-items: center;
          justify-content: space-between;
          gap: 16px;
          padding: 21px 30px;
        }

        .faq-question {
          font-size: 24px;
          font-weight: 600;
          color: #fff;
          letter-spacing: 0.5px;
          line-height: 1.4;
        }

        /* ─── Dot wrapper ─── */
        .faq-dot-wrap {
          position: relative;
          flex-shrink: 0;
          display: flex;
          align-items: center;
          justify-content: center;
          z-index: 5;
        }

        .faq-dot {
          display: block;
          width: 18px;
          height: 18px;
          border-radius: 50%;
          background: #e8a90a;
          flex-shrink: 0;
          box-shadow: 0 0 10px rgba(232, 169, 10, 0.3);
          transition: all 0.35s ease;
          cursor: pointer;
          position: relative;
          z-index: 2;
        }

        .faq-item:hover .faq-dot {
          transform: scale(1.6);
          box-shadow: 0 0 20px rgba(232, 169, 10, 0.6), 0 0 40px rgba(232, 169, 10, 0.2);
          background: #d49a09;
        }

        /* ─── Answer (expands downward via max-height) ─── */
        .faq-answer {
          max-height: 0;
          overflow: hidden;
          transition: max-height 0.5s cubic-bezier(0.34, 1.56, 0.64, 1), opacity 0.3s ease;
          opacity: 0;
        }

        .faq-item:hover .faq-answer {
          max-height: 200px;
          opacity: 1;
        }

        .faq-answer-inner {
          padding: 0 36px 27px 36px;
        }

        .faq-answer-text {
          font-size: 18px;
          line-height: 1.6;
          color: rgba(255, 255, 255, 0.75);
          border-top: 1px solid rgba(232, 169, 10, 0.2);
          padding-top: 18px;
          font-family: Arial;
        }

        /* ─── Decor: Video ─── */
        .faq-decor {
          flex-shrink: 0;
          display: flex;
          align-items: center;
          justify-content: center;
        }

        .faq-video-wrap {
          display: flex;
          align-items: center;
          justify-content: center;
          border-radius: 24px;
          overflow: hidden;
          
          width: 720px;
          height: auto;
          aspect-ratio: 720 / 810;
        }

        .faq-video {
          width: 100%;
          height: 100%;
          object-fit: cover;
          display: block;
          border-radius: inherit;
        }

        /* ─── Responsive ─── */
        @media (max-width: 1600px) {
          .faq-video-wrap {
            width: 560px;
          }
          .faq-layout {
            gap: 60px;
          }
        }

        @media (max-width: 1400px) {
          .faq-video-wrap {
            width: 440px;
          }
          .faq-layout {
            gap: 48px;
          }
        }

        @media (max-width: 1024px) {
          .faq-section {
            padding: 90px 0 75px;
          }

          .faq-layout {
            gap: 40px;
          }

          .faq-video-wrap {
            width: 360px;
          }

          .faq-question {
            font-size: 22px;
          }

          .faq-item-header {
            padding: 18px 24px;
          }

          .faq-answer-inner {
            padding: 0 28px 20px 28px;
          }

          .faq-answer-text {
            padding-top: 14px;
          }
        }

        @media (max-width: 860px) {
          .faq-container {
            padding: 0 32px;
          }

          .faq-layout {
            grid-template-columns: 1fr;
            gap: 32px;
          }

          .faq-decor {
            justify-self: center;
          }

          .faq-video-wrap {
            width: 400px;
          }

          .faq-list {
            max-width: 100%;
          }
        }

        @media (max-width: 768px) {
          .faq-section {
            padding: 72px 0 60px;
          }

          .faq-container {
            padding: 0 20px;
          }

          .faq-label {
            font-size: 18px;
            letter-spacing: 3px;
            margin-bottom: 32px;
          }

          .faq-item-header {
            padding: 18px 21px;
          }

          .faq-question {
            font-size: 20px;
            letter-spacing: 0.3px;
          }

          .faq-dot {
            width: 16px;
            height: 16px;
          }

          .faq-answer-inner {
            padding: 0 21px 18px 21px;
          }

          .faq-answer-text {
            font-size: 18px;
            padding-top: 14px;
          }

          .faq-video-wrap {
            width: 320px;
          }
        }

        @media (max-width: 480px) {
          .faq-question {
            font-size: 18px;
          }

          .faq-item-header {
            padding: 15px 18px;
            gap: 8px;
          }

          .faq-answer-inner {
            padding: 0 18px 15px 18px;
          }

          .faq-answer-text {
            font-size: 16px;
            padding-top: 12px;
          }

          .faq-video-wrap {
            width: 260px;
          }
        }
      </style></section><section class="organizer-section" data-srcloc="/ulei/components/organizer-section.tsx:5"><div class="organizer-glow" data-srcloc="/ulei/components/organizer-section.tsx:7"></div><div class="organizer-honeycomb" data-srcloc="/ulei/components/organizer-section.tsx:9"></div><div class="organizer-container" data-srcloc="/ulei/components/organizer-section.tsx:11"><div class="organizer-label" data-srcloc="/ulei/components/organizer-section.tsx:13">ОРГАНИЗАТОР ФОРУМА</div><div class="organizer-logo" data-srcloc="/ulei/components/organizer-section.tsx:16"><img src="https://fs.chatium.ru/get/image_msk_07DUYFHjDD.1124x249.png" alt="УЛЕЙ" class="organizer-logo-img" data-srcloc="/ulei/components/organizer-section.tsx:17"></div><div class="organizer-tagline" data-srcloc="/ulei/components/organizer-section.tsx:25">Федеральная сеть печатных центров</div></div><style data-srcloc="/ulei/components/organizer-section.tsx:30">
        .organizer-section {
          position: relative;
          padding: 128px 0;
          background: #000000;
          overflow: hidden;
          border-top: 2px solid rgba(232, 169, 10, 0.1);
          border-bottom: 2px solid rgba(232, 169, 10, 0.1);
        }

        /* ─── Large honeycomb glow — right ─── */
        .organizer-honeycomb {
          position: absolute;
          right: 0;
          top: 50%;
          transform: translateY(-50%);
          width: 1000px;
          height: 1000px;
          background: url('https://fs.chatium.ru/get/image_msk_UOYwVFBlfX.6672x6215.png') center center / contain no-repeat;
          pointer-events: none;
          z-index: 0;
          opacity: 0.8;
        }

        .organizer-glow {
          position: absolute;
          right: 0;
          top: 50%;
          transform: translateY(-50%);
          width: 1200px;
          height: 1200px;
          background: radial-gradient(circle at 50% 50%, rgba(232, 169, 10, 0.18) 0%, rgba(232, 169, 10, 0.06) 40%, transparent 70%);
          pointer-events: none;
          z-index: 0;
        }

        .organizer-container {
          max-width: 1400px;
          margin: 0 auto;
          padding: 0 32px;
          position: relative;
          z-index: 2;
          display: flex;
          flex-direction: column;
          align-items: center;
          text-align: center;
          gap: 40px;
        }

        .organizer-label {
          font-size: 25px;
          font-weight: 600;
          letter-spacing: 8px;
          color: rgba(255, 255, 255, 0.5);
          text-transform: uppercase;
          opacity: 0.8;
          margin-bottom: 100px;
          font-family: Arial;
        }

        .organizer-logo {
          display: flex;
          align-items: center;
          justify-content: center;
        }

        .organizer-logo-img {
          height: 170px;
          width: auto;
          object-fit: contain;
          filter: brightness(1) contrast(1.1);
          transition: opacity 0.3s ease;
        }

        .organizer-tagline {
          font-size: 25px;
          font-weight: 400;
          color: rgba(255, 255, 255, 0.5);
          letter-spacing: 4px;
          text-transform: uppercase;
          margin-top: 100px;
          font-family: Arial;
        }

        @media (max-width: 1024px) {
          .organizer-section {
            padding: 80px 0;
          }

          .organizer-logo-img {
            height: 100px;
          }

          .organizer-honeycomb {
            width: 500px;
            height: 500px;
            right: 0;
            opacity: 0.6;
          }
          .organizer-glow {
            width: 500px;
            height: 500px;
            right: -80px;
          }
        }

        @media (max-width: 768px) {
          .organizer-section {
            padding: 64px 0;
          }

          .organizer-container {
            padding: 0 20px;
            gap: 24px;
          }

          .organizer-label {
            font-size: 22px;
            letter-spacing: 5px;
          }

          .organizer-logo-img {
            height: 80px;
          }

          .organizer-tagline {
            font-size: 22px;
            letter-spacing: 2.5px;
          }

          .organizer-honeycomb {
            display: none;
          }
          .organizer-glow {
            width: 400px;
            height: 400px;
            right: -60px;
          }
        }

        @media (max-width: 480px) {
          .organizer-section {
            padding: 48px 0;
          }

          .organizer-logo-img {
            height: 60px;
          }

          .organizer-tagline {
            font-size: 16px;
          }
        }
      </style></section><div data-vue-component-id="idvbFxDvJT1-8DOyhkeuIBx"></div><script type="module">
          const Vue = __lazyImport("*", r => import(r("//" + window.__ugc_internals__.helpers.httpConfDomain + "/s/static/builtin/vue.js")));
          const ComponentModule = __lazyImport("*", r => import(r("https://app-generation-61yz.chatium.ru/static/.client/db/ulei/components/ticket-modal.vue?lang=ru%2Cen")))
          __resolveModules([], [ComponentModule, Vue], async ([ComponentModule, Vue]) => {
            const props = {};
            
            const Component = await ComponentModule.default;
            const __chatiumPrepareVueApp = await ComponentModule.__chatiumPrepareVueApp
            let vueApp = Vue.createApp(Component, props);
            vueApp.config.globalProperties.ctx = window.__jsx_app_ctx;
            if (typeof __chatiumPrepareVueApp === "function") {
              vueApp =  __chatiumPrepareVueApp(vueApp)
              if (!(vueApp && typeof vueApp.mount === "function")) {
                throw new Error("__chatiumPrepareVueApp should return vueApp, received " + typeof vueApp)
              }
            }
            vueApp.mount('[data-vue-component-id="idvbFxDvJT1-8DOyhkeuIBx"]');
          })
        </script><script data-srcloc="/ulei/index.tsx:1468">
          document.addEventListener('DOMContentLoaded', function() {
            var header = document.getElementById('header');
            var hamburger = document.getElementById('hamburger');
            var mobileMenu = document.getElementById('mobileMenu');
            var mobileLinks = document.querySelectorAll('.mobile-link');

            // Scroll effect
            function onScroll() {
              if (window.scrollY > 50) {
                header.classList.add('scrolled');
              } else {
                header.classList.remove('scrolled');
              }
            }

            window.addEventListener('scroll', onScroll, { passive: true });
            onScroll();

            // Hamburger toggle
            hamburger.addEventListener('click', function() {
              hamburger.classList.toggle('active');
              mobileMenu.classList.toggle('open');
              document.body.style.overflow = mobileMenu.classList.contains('open') ? 'hidden' : '';
            });

            // Close menu on link click
            mobileLinks.forEach(function(link) {
              link.addEventListener('click', function() {
                hamburger.classList.remove('active');
                mobileMenu.classList.remove('open');
                document.body.style.overflow = '';
              });
            });

            // Ticket modal — open on any 'Купить билет' or 'Купить' click
            document.querySelectorAll('.btn-ticket, .ticket-btn').forEach(function(btn) {
              btn.addEventListener('click', function(e) {
                e.preventDefault();
                if (window.openTicketModal) {
                  window.openTicketModal();
                }
              });
            });

            
          });
        </script><section class="hero-end" id="hero-end" data-srcloc="/ulei/components/hero-end-section.tsx:5"><div class="hero-end-bg" data-srcloc="/ulei/components/hero-end-section.tsx:7"><img src="https://fs.chatium.ru/get/image_msk_cMIac7vGaB.7983x3435.png" alt="" data-srcloc="/ulei/components/hero-end-section.tsx:8"></div><div class="hero-end-overlay" data-srcloc="/ulei/components/hero-end-section.tsx:13"></div><div class="hero-end-content" data-srcloc="/ulei/components/hero-end-section.tsx:16"><div class="hero-end-label" data-srcloc="/ulei/components/hero-end-section.tsx:18">Бизнес-форум · Тольятти</div><div class="hero-end-logo-row" data-srcloc="/ulei/components/hero-end-section.tsx:21"><img src="https://fs.chatium.ru/get/image_msk_nltjFq8mOn.804x452.png" alt="УЛЕЙ" class="hero-end-logo-img" data-srcloc="/ulei/components/hero-end-section.tsx:22"></div><h2 class="hero-end-headline" data-srcloc="/ulei/components/hero-end-section.tsx:34">МЕСТО РОСТА ТВОЕГО БИЗНЕСА</h2><div class="hero-end-actions" data-srcloc="/ulei/components/hero-end-section.tsx:37"><a href="#buy" class="hero-end-btn hero-end-btn-primary" data-srcloc="/ulei/components/hero-end-section.tsx:38">Купить билет<path d="M3 8H13M13 8L9 4M13 8L9 12" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" data-srcloc="/ulei/components/hero-end-section.tsx:41"></path></svg></a><button onclick="openPartnerModal()" class="hero-end-btn hero-end-btn-secondary" data-srcloc="/ulei/components/hero-end-section.tsx:44">Стать партнером</button></div></div><style data-srcloc="/ulei/components/hero-end-section.tsx:50">
        .hero-end {
          position: relative;
          overflow: hidden;
          min-height: 100vh;
          display: flex;
          align-items: center;
          justify-content: center;
          background: #000;
        }

        .hero-end-bg {
          position: absolute;
          inset: 0;
          z-index: 0;
        }

        .hero-end-bg img {
          width: 100%;
          height: 100%;
          object-fit: cover;
        }

        .hero-end-overlay {
          position: absolute;
          inset: 0;
          z-index: 1;
          background: linear-gradient(135deg,
            rgba(0,0,0,0.65) 0%,
            rgba(0,0,0,0.5) 50%,
            rgba(232,169,10,0.15) 75%,
            rgba(232,169,10,0.08) 100%
          );
        }

        .hero-end-content {
          position: relative;
          z-index: 3;
          width: 100%;
          max-width: 1200px;
          margin: 0 auto;
          padding: 100px 32px;
          display: flex;
          flex-direction: column;
          align-items: center;
          justify-content: center;
          text-align: center;
          gap: 20px;
        }

        /* ─── TOP LABEL ─── */
        .hero-end-label {
          font-size: 25px;
          font-weight: 600;
          color: #e8a90a;
          letter-spacing: 4px;
          text-transform: uppercase;
          margin-bottom: 10px;
        }

        /* ─── LOGO ROW ─── */
        .hero-end-logo-row {
          display: flex;
          align-items: center;
          justify-content: center;
          gap: 20px;
          margin-bottom: 8px;
        }

        .hero-end-logo-img {
          height: 350px;
          width: auto;
          object-fit: contain;
          display: block;
        }
        

        /* ─── HEADLINE ─── */
        .hero-end-headline {
          font-size: 45px;
          font-weight: 1000;
          color: #ffffff;
          letter-spacing: 1px;
          line-height: 1.15;
          margin-left: -200px;
          max-width: 700px;
          white-space: nowrap;
          margin-bottom: 50px;
        }

        /* ─── BUTTONS ─── */
        .hero-end-actions {
          display: flex;
          align-items: center;
          justify-content: center;
          gap: 20px;
          flex-wrap: wrap;
        }

        .hero-end-btn {
          display: inline-flex;
          align-items: center;
          justify-content: center;
          padding: 12px 32px;
          font-size: 20px;
          font-weight: 700;
          letter-spacing: 0.5px;
          border-radius: 50px;
          transition: all 0.3s ease;
          white-space: nowrap;
          cursor: pointer;
          border: none;
          margin-top: 50px;
        }

        .hero-end-btn-primary {
          background: #e8a90a;
          color: #1a1a1a;
          box-shadow: 0 4px 20px rgba(232, 169, 10, 0.3);
        }

        .hero-end-btn-primary:hover {
          transform: translateY(-2px);
          box-shadow: 0 8px 30px rgba(232, 169, 10, 0.5);
          background: #d49a09;
        }

        .hero-end-btn-secondary {
          display: inline-flex;
          align-items: center;
          justify-content: center;
          padding: 12px 32px;
          background: rgba(255, 255, 255, 0.06);
          color: #fff;
          font-size: 20px;
          font-weight: 700;
          letter-spacing: 0.5px;
          border-radius: 50px;
          transition: all 0.3s ease;
          white-space: nowrap;
          border: 1px solid rgba(255, 255, 255, 0.2);
          margin-top: 50px;
        }

        .hero-end-btn-secondary:hover {
          background: rgba(255, 255, 255, 0.12);
          border-color: rgba(255, 255, 255, 0.35);
          transform: translateY(-2px);
        }

        /* ─── TABLET 1200px ─── */
        @media (max-width: 1200px) {
          .hero-end-logo-img {
            height: 240px;
          }
          .hero-end-headline {
            font-size: 35px;
          }
          
          
        }

        /* ─── TABLET 1024px ─── */
        @media (max-width: 1024px) {
          .hero-end-content {
            padding: 80px 32px;
            gap: 16px;
          }
          .hero-end-logo-img {
            height: 200px;
          }
          .hero-end-headline {
            font-size: 28px;
          }
          
          
          .hero-end-label {
            font-size: 13px;
            letter-spacing: 3px;
          }
          .hero-end-btn {
            padding: 11px 27px;
            font-size: 12px;
          }
          .hero-end-btn-secondary {
            padding: 11px 27px;
            font-size: 12px;
          }
        }

        /* ─── MOBILE 768px ─── */
        @media (max-width: 768px) {
          .hero-end {
            min-height: 80vh;
          }
          .hero-end-content {
            padding: 60px 20px;
            gap: 14px;
          }
          .hero-end-logo-img {
            height: 144px;
          }
          .hero-end-headline {
            font-size: 21px;
          }
          
          
          .hero-end-label {
            font-size: 11px;
            letter-spacing: 2px;
          }
          .hero-end-actions {
            gap: 12px;
          }
          .hero-end-btn {
            padding: 9px 19px;
            font-size: 11px;
          }
          .hero-end-btn-secondary {
            padding: 9px 19px;
            font-size: 11px;
          }
          .hero-end-logo-row {
            gap: 12px;
          }
        }

        /* ─── SMALL 480px ─── */
        @media (max-width: 480px) {
          .hero-end-content {
            padding: 40px 16px;
            gap: 12px;
          }
          .hero-end-logo-img {
            height: 104px;
          }
          .hero-end-headline {
            font-size: 16px;
          }
          
          
          .hero-end-label {
            font-size: 9px;
            letter-spacing: 2px;
          }
          .hero-end-actions {
            flex-direction: column;
            gap: 12px;
            width: 100%;
            max-width: 320px;
          }
          .hero-end-btn {
            width: 100%;
            padding: 8px 19px;
            font-size: 9px;
          }
          .hero-end-btn-secondary {
            width: 100%;
            padding: 8px 19px;
            font-size: 9px;
          }
        }
      </style></section><footer class="footer" id="contacts" data-srcloc="/ulei/components/footer-section.tsx:5"><div class="footer-container" data-srcloc="/ulei/components/footer-section.tsx:6"><div class="footer-columns" data-srcloc="/ulei/components/footer-section.tsx:8"><div class="footer-col footer-col-about" data-srcloc="/ulei/components/footer-section.tsx:10"><div class="footer-logo-row" data-srcloc="/ulei/components/footer-section.tsx:11"><img src="https://fs.chatium.ru/get/image_msk_Cv0SnevmN6.804x452.png?v=2" alt="УЛЕЙ" class="footer-logo-img" data-srcloc="/ulei/components/footer-section.tsx:12"></div><div class="footer-logo-sub" data-srcloc="/ulei/components/footer-section.tsx:18">коннект и нетворкинг</div><p class="footer-desc" data-srcloc="/ulei/components/footer-section.tsx:19">Бизнес-форум от СЕО федеральной<br data-srcloc="/ulei/components/footer-section.tsx:20">сети печатных центров «Облако»</p></div><div class="footer-col footer-col-nav" data-srcloc="/ulei/components/footer-section.tsx:26"><h4 class="footer-col-heading" data-srcloc="/ulei/components/footer-section.tsx:27" style="margin-top: 50px; ">НАВИГАЦИЯ</h4><ul class="footer-nav-list" data-srcloc="/ulei/components/footer-section.tsx:28"><li data-srcloc="/ulei/components/footer-section.tsx:29"><a href="#about" data-srcloc="/ulei/components/footer-section.tsx:29">О форуме</a></li><li data-srcloc="/ulei/components/footer-section.tsx:30"><a href="#speakers" data-srcloc="/ulei/components/footer-section.tsx:30">Спикеры</a></li><li data-srcloc="/ulei/components/footer-section.tsx:31"><a href="#program" data-srcloc="/ulei/components/footer-section.tsx:31">Программа</a></li><li data-srcloc="/ulei/components/footer-section.tsx:32"><a href="#tickets" data-srcloc="/ulei/components/footer-section.tsx:32">Билеты</a></li><li data-srcloc="/ulei/components/footer-section.tsx:33"><a href="#partners" data-srcloc="/ulei/components/footer-section.tsx:33">Партнёры</a></li></ul></div><div class="footer-col footer-col-contacts" data-srcloc="/ulei/components/footer-section.tsx:38"><h4 class="footer-col-heading" data-srcloc="/ulei/components/footer-section.tsx:39" style="margin-top: 50px;">КОНТАКТЫ</h4><ul class="footer-contacts-list" data-srcloc="/ulei/components/footer-section.tsx:40"><li data-srcloc="/ulei/components/footer-section.tsx:41"><i class="fas fa-envelope" data-srcloc="/ulei/components/footer-section.tsx:42"></i><span data-srcloc="/ulei/components/footer-section.tsx:43">ulei@oblako63.ru</span></li><li data-srcloc="/ulei/components/footer-section.tsx:45"><i class="fas fa-phone-alt" data-srcloc="/ulei/components/footer-section.tsx:46"></i><span data-srcloc="/ulei/components/footer-section.tsx:47">+7 (8482) 68-77-28</span></li><li data-srcloc="/ulei/components/footer-section.tsx:49"><i class="fas fa-map-marker-alt" data-srcloc="/ulei/components/footer-section.tsx:50"></i><span data-srcloc="/ulei/components/footer-section.tsx:51">Легкоатлетический манеж,<br data-srcloc="/ulei/components/footer-section.tsx:51">стадион «Торпедо»</span></li></ul></div></div><div class="footer-separator" data-srcloc="/ulei/components/footer-section.tsx:58"></div><div class="footer-bottom" data-srcloc="/ulei/components/footer-section.tsx:61"><div class="footer-bottom-left" data-srcloc="/ulei/components/footer-section.tsx:62">© 2026 УЛЕЙ. Все права защищены.</div><div class="footer-bottom-right" data-srcloc="/ulei/components/footer-section.tsx:65">Организатор - федеральная сеть печатных центров <<Облако>></div></div></div><style data-srcloc="/ulei/components/footer-section.tsx:75">
        .footer {
          background: #000;
          color: #fff;
          padding: 80px 0 0;
          font-family: 'Inter', sans-serif;
        }

        .footer-container {
          max-width: 1400px;
          margin: 0 auto;
          padding: 0 -1000px;
        }

        /* ─── THREE COLUMNS ─── */
        .footer-columns {
          display: grid;
          grid-template-columns: 1fr 1fr 1fr;
          gap: 40px;
        }

        .footer-col {
          display: flex;
          flex-direction: column;
          align-items: flex-start;
        }

        /* ─── Column 1: Logo ─── */
        .footer-logo-row {
          display: flex;
          align-items: center;
        }

        .footer-logo-img {
          margin-left: 0px;
          height: 100px;
          width: auto;
          object-fit: contain;
        }

        .footer-logo-sub {
          font-size: 18px;
          font-weight: 500;
          color: rgba(255, 255, 255, 0.45);
          letter-spacing: 2px;
          text-transform: uppercase;
          margin-top: 4px;
        }

        .footer-desc {
          font-size: 21px;
          font-weight: 400;
          color: rgba(255, 255, 255, 0.6);
          line-height: 1.6;
          margin: 20px 0 0;
          max-width: 280px;
        }

        /* ─── Column 2: Navigation ─── */
        .footer-col-heading {
          font-size: 20px;
          font-weight: 700;
          color: rgba(255, 255, 255, 0.7);
          letter-spacing: 2px;
          margin: 0 0 20px;
          text-transform: uppercase;
        }

        .footer-nav-list {
          list-style: none;
          margin: 0;
          padding: 0;
          display: flex;
          flex-direction: column;
          gap: 12px;
        }

        .footer-nav-list li {
          margin: 0;
          padding: 0;
        }

        .footer-nav-list a {
          font-size: 21px;
          font-weight: 500;
          color: rgba(255, 255, 255, 0.5);
          text-decoration: none;
          transition: color 0.3s ease;
        }

        .footer-nav-list a:hover {
          color: #e8a90a;
        }

        /* ─── Column 3: Contacts ─── */
        .footer-contacts-list {
          list-style: none;
          margin: 0;
          padding: 0;
          display: flex;
          flex-direction: column;
          gap: 16px;
        }

        .footer-contacts-list li {
          display: flex;
          align-items: flex-start;
          gap: 12px;
          font-size: 21px;
          font-weight: 400;
          color: rgba(255, 255, 255, 0.5);
          line-height: 1.6;
        }

        .footer-contacts-list i {
          color: #e8a90a;
          font-size: 21px;
          width: 16px;
          text-align: center;
          margin-top: 3px;
          flex-shrink: 0;
        }

        .footer-contacts-list span {
          flex: 1;
        }

        /* ─── SEPARATOR ─── */
        .footer-separator {
          height: 1px;
          background: rgba(255, 255, 255, 0.15);
          margin: 60px 0 24px;
        }

        /* ─── BOTTOM BAR ─── */
        .footer-bottom {
          display: flex;
          align-items: center;
          justify-content: space-between;
          padding-bottom: 32px;
          gap: 20px;
        }

        .footer-bottom-left {
          font-size: 18px;
          font-weight: 500;
          color: rgba(255, 255, 255, 0.35);
        }

        .footer-bottom-right {
          display: flex;
          align-items: center;
          justify-content: flex-end;
          color: rgba(255, 255, 255, 0.35);
        }

        .footer-bottom-logo {
          height: 48px;
          width: auto;
          object-fit: contain;
        }

        /* ─── RESPONSIVE ─── */
        @media (max-width: 1024px) {
          .footer {
            padding: 60px 0 0;
          }

          .footer-columns {
            grid-template-columns: 1fr 1fr;
            gap: 32px;
          }

          .footer-col-contacts {
            grid-column: 1 / -1;
          }

          .footer-logo-text {
            font-size: 34px;
          }
        }

        @media (max-width: 768px) {
          .footer {
            padding: 48px 0 0;
          }

          .footer-container {
            padding: 0 24px;
          }

          .footer-columns {
            grid-template-columns: 1fr;
            gap: 36px;
          }

          .footer-col-contacts {
            grid-column: auto;
          }

          .footer-logo-text {
            font-size: 32px;
          }

          .footer-separator {
            margin: 40px 0 20px;
          }

          .footer-bottom {
            flex-direction: column;
            text-align: center;
            gap: 6px;
            padding-bottom: 24px;
          }

          .footer-bottom-right {
            justify-content: center;
          }
        }

        @media (max-width: 480px) {
          .footer-container {
            padding: 0 16px;
          }

          .footer-logo-text {
            font-size: 28px;
          }

          .footer-desc {
            font-size: 20px;
          }
        }
      </style></footer>
  <!-- Partner Modal NEW DESIGN -->
  <style>
    .pm-overlay {
      position: fixed; inset: 0; z-index: 99999;
      display: none; align-items: center; justify-content: center;
      padding: 24px; overflow-y: auto;
    }
    .pm-backdrop {
      position: fixed; inset: 0; z-index: -1;
      background: rgba(0,0,0,0.65); backdrop-filter: blur(6px);
      -webkit-backdrop-filter: blur(6px);
      cursor: pointer;
    }
    .pm-overlay.open { display: flex; }
    .pm-modal {
      position: relative; width: 100%; max-width: 560px; margin: 0 auto;
    }
    .pm-close {
      position: absolute; top: 20px; right: 24px; z-index: 10;
      width: 40px; height: 40px; border-radius: 50%;
      background: rgba(0,0,0,0.2); border: none;
      display: flex; align-items: center; justify-content: center;
      cursor: pointer; color: #000; transition: background 0.2s;
    }
    .pm-close:hover { background: rgba(0,0,0,0.35); }
    .pm-card {
      background: linear-gradient(180deg, #F5B700 0%, #D49A00 25%, #8A6A00 55%, #000000 100%);
      border-radius: 40px; padding: 48px 36px 32px; color: #000; position: relative;
    }
    .pm-title {
      font-size: 30px; font-weight: 900; letter-spacing: 3px;
      text-align: center; margin-bottom: 20px; color: #000;
      text-transform: uppercase;
    }
    .pm-cta-top {
      display: block; width: 100%; max-width: 380px; margin: 0 auto 28px;
      padding: 16px 28px; background: #000; color: #fff;
      font-size: 15px; font-weight: 800; letter-spacing: 1px;
      text-transform: uppercase; text-align: center;
      border: none; border-radius: 50px; cursor: pointer;
      transition: all 0.3s ease; font-family: inherit;
    }
    .pm-cta-top:hover { background: #1a1a1a; transform: translateY(-1px); box-shadow: 0 4px 16px rgba(0,0,0,0.2); }
    .pm-cta-top:disabled { opacity: 0.6; cursor: not-allowed; transform: none; }
    .pm-body { display: flex; flex-direction: column; gap: 14px; margin-bottom: 20px; }
    .pm-input {
      width: 100%; padding: 18px 24px;
      border: 2px solid rgba(0,0,0,0.35); border-radius: 50px;
      background: transparent; font-size: 16px; font-family: inherit;
      color: #000; outline: none; transition: border-color 0.2s;
      box-sizing: border-box;
    }
    .pm-input::placeholder { color: rgba(0,0,0,0.55); font-weight: 500; }
    .pm-input:focus { border-color: #000; }
    .pm-submit {
      display: block; width: 100%; max-width: 280px; margin: 0 auto 20px;
      padding: 18px 28px; background: #000; color: #fff;
      font-size: 18px; font-weight: 700; letter-spacing: 1px;
      border: none; border-radius: 50px; cursor: pointer;
      transition: all 0.3s ease; font-family: inherit;
    }
    .pm-submit:hover { background: #1a1a1a; transform: translateY(-1px); box-shadow: 0 4px 16px rgba(0,0,0,0.2); }
    .pm-submit:disabled { opacity: 0.6; cursor: not-allowed; transform: none; }
    .pm-consent-row {
      display: flex; align-items: flex-start; gap: 10px; cursor: pointer;
      justify-content: center; margin-top: 4px;
    }
    .pm-consent-row input { display: none; }
    .pm-check {
      display: inline-block; width: 18px; height: 18px; min-width: 18px;
      border: 2px solid rgba(255,255,255,0.6); border-radius: 4px;
      flex-shrink: 0; margin-top: 1px; position: relative; transition: all 0.2s;
      background: transparent;
    }
    .pm-consent-row input:checked + .pm-check {
      background: #fff; border-color: #fff;
    }
    .pm-consent-row input:checked + .pm-check::after {
      content: ''; position: absolute; top: 2px; left: 5px;
      width: 5px; height: 9px; border: solid #000;
      border-width: 0 2px 2px 0; transform: rotate(45deg);
    }
    .pm-consent-text {
      font-size: 13px; line-height: 1.4; color: #fff;
      font-weight: 400; text-align: left;
    }
    .pm-success {
      position: absolute; inset: 0;
      background: linear-gradient(180deg, #F5B700 0%, #D49A00 25%, #8A6A00 55%, #000000 100%);
      border-radius: 40px; display: none; flex-direction: column;
      align-items: center; justify-content: center; gap: 16px; z-index: 5;
    }
    .pm-success.open { display: flex; }
    .pm-s-icon {
      width: 80px; height: 80px; background: #000; border-radius: 50%;
      display: flex; align-items: center; justify-content: center;
    }
    .pm-s-title { font-size: 24px; font-weight: 900; color: #000; }
    .pm-s-sub { font-size: 15px; color: rgba(0,0,0,0.6); font-weight: 500; }
    @media (max-width: 768px) {
      .pm-overlay { padding: 16px; align-items: center; }
      .pm-card { padding: 36px 24px 24px; border-radius: 32px; }
      .pm-title { font-size: 26px; }
      .pm-cta-top { font-size: 14px; padding: 14px 20px; max-width: 100%; }
      .pm-input { padding: 14px 18px; font-size: 15px; }
      .pm-submit { max-width: 100%; padding: 16px; font-size: 16px; }
    }
    @media (max-width: 480px) {
      .pm-overlay { padding: 0; align-items: flex-end; }
      .pm-modal { margin: 0; }
      .pm-card { border-radius: 28px 28px 0 0; padding: 32px 16px 20px; }
      .pm-close { top: 14px; right: 14px; width: 36px; height: 36px; }
    }
  </style>
  <div class="pm-overlay" id="partnerModalOverlay" onclick="handleOverlayClick(event)">
    <div class="pm-backdrop"></div>
    <div class="pm-modal">
      <button class="pm-close" onclick="closePartnerModal()" aria-label="Закрыть">
        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round">
          <line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/>
        </svg>
      </button>
      <div class="pm-card" id="partnerModalCard" onclick="event.stopPropagation()">
        <div class="pm-title">СТАТЬ ПАРТНЕРОМ</div>
        <button class="pm-cta-top" id="pmCtaTop" onclick="requestTerms()">ПОЛУЧИТЕ ПОДРОБНЫЕ УСЛОВИЯ</button>
        <div class="pm-body">
          <input class="pm-input" id="f_company" type="text" placeholder="Введите название компании" />
          <input class="pm-input" id="f_phone" type="tel" placeholder="Введите номер телефона" />
          <input class="pm-input" id="f_email" type="email" placeholder="Введите Email" />
          <input class="pm-input" id="f_person" type="text" placeholder="Введите ФИО" />
          <input class="pm-input" id="f_position" type="text" placeholder="Введите должность" />
        </div>
        <button class="pm-submit" id="pmSubmitBtn" onclick="submitPartnerForm()">Заявить о себе</button>
        <label class="pm-consent-row" id="consentLabel">
          <input type="checkbox" id="f_consent" />
          <span class="pm-check"></span>
          <span class="pm-consent-text">Я даю согласие на обработку персональных данных и на отправку уведомлений</span>
        </label>
        <div class="pm-success" id="pmSuccess">
          <div class="pm-s-icon">
            <svg width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
              <polyline points="20 6 9 17 4 12"/>
            </svg>
          </div>
          <p class="pm-s-title">Заявка отправлена!</p>
          <p class="pm-s-sub">Мы свяжемся с вами в ближайшее время</p>
        </div>
      </div>
    </div>
  </div>
  <script>
    function openPartnerModal() {
      document.getElementById('partnerModalOverlay').classList.add('open');
      document.getElementById('pmSuccess').classList.remove('open');
      document.getElementById('f_company').value = '';
      document.getElementById('f_person').value = '';
      document.getElementById('f_phone').value = '';
      document.getElementById('f_email').value = '';
      document.getElementById('f_position').value = '';
      document.getElementById('f_consent').checked = false;
      document.body.style.overflow = 'hidden';
    }
    function closePartnerModal() {
      document.getElementById('partnerModalOverlay').classList.remove('open');
      document.body.style.overflow = '';
    }
    function handleOverlayClick(e) {
      if (e.target === e.currentTarget || e.target.classList.contains('pm-backdrop')) {
        closePartnerModal();
      }
    }
    async function requestTerms() {
      var company = document.getElementById('f_company').value.trim();
      var email = document.getElementById('f_email').value.trim();
      if (!company || !email) { return; }
      var btn = document.getElementById('pmCtaTop');
      btn.disabled = true;
      btn.textContent = 'Отправка...';
      try {
        var resp = await fetch('/ulei/api/partners/submit', {
          method: 'POST',
          headers: { 'Content-Type': 'application/json' },
          body: JSON.stringify({
            company_name: company,
            contact_person: '',
            phone: '',
            email: email,
            partnership_type: 'terms_request',
            position: '',
            comment: 'Запрос подробных условий партнёрства',
            consent: true
          })
        });
        if (!resp.ok) { throw new Error('HTTP ' + resp.status); }
        var data = await resp.json();
        if (data && data.success) {
          document.getElementById('pmSuccess').classList.add('open');
          btn.textContent = 'ПОЛУЧИТЕ ПОДРОБНЫЕ УСЛОВИЯ';
        } else {
          throw new Error(data?.error || 'Неизвестная ошибка');
        }
      } catch(e) {
        console.error('Submit error', e);
        alert('Ошибка при отправке: ' + e.message);
      } finally {
        btn.disabled = false;
      }
    }
    async function submitPartnerForm() {
      var company = document.getElementById('f_company').value.trim();
      var person = document.getElementById('f_person').value.trim();
      var phone = document.getElementById('f_phone').value.trim();
      var email = document.getElementById('f_email').value.trim();
      var position = document.getElementById('f_position').value.trim();
      var consent = document.getElementById('f_consent').checked;
      if (!company || !person || !phone || !email) { alert('Пожалуйста, заполните все обязательные поля'); return; }
      if (!consent) { alert('Пожалуйста, дайте согласие на обработку данных'); return; }
      var btn = document.getElementById('pmSubmitBtn');
      btn.disabled = true;
      btn.textContent = 'Отправка...';
      try {
        var resp = await fetch('/ulei/api/partners/submit', {
          method: 'POST',
          headers: { 'Content-Type': 'application/json' },
          body: JSON.stringify({
            company_name: company,
            contact_person: person,
            phone: phone,
            email: email,
            partnership_type: 'partner_application',
            position: position || '',
            comment: '',
            consent: consent
          })
        });
        if (!resp.ok) { throw new Error('HTTP ' + resp.status); }
        var data = await resp.json();
        if (data && data.success) {
          document.getElementById('pmSuccess').classList.add('open');
        } else {
          throw new Error(data?.error || 'Неизвестная ошибка');
        }
      } catch(e) {
        console.error('Submit error', e);
        alert('Ошибка при отправке: ' + e.message);
      } finally {
        btn.disabled = false;
        btn.textContent = 'Заявить о себе';
      }
    }
  </script></body></html>