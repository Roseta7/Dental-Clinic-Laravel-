<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description"
        content="Family-friendly dental clinic offering cosmetic and restorative dentistry in your city. Personalized, safe treatments in a comfortable environment.">
    <title>Dental Clinic</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100..900;1,100..900&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/home/style.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="preload" as="image" href="{{ asset('images/picture-about.png') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"
        integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="shortcut icon" href="{{ asset('images/icon.ico') }}" type="image/x-icon">
    <!-- bootstrap cdn link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.3/css/bootstrap.min.css">
    <!-- bootstrap cdn link end -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.3/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
        

    <!-- aos animation -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <style>
        .row p {
            font-size: 20px;
        }

        .row div {
            height: 400px;
            border: none !important;
        }

        .row h3 {
            color: #00b8b8;
        }

        .about-attributes img {
            width: 60px;
            height: 50px;
        }
    </style>
</head>

<body>
    <header class="header fixed-top">
        <div class="container">
            <div class="d-flex align-items-center justify-content-between">
                <a href="#"><img src="{{ asset('images/logo.png') }}" alt="hi clinic" class="logo"> </a>
                <nav class="nav">
                    <a href="{{ route('home') }}">home</a>
                    <a href="{{ route('about') }}">about</a>
                    <a href="{{ route('services') }}">services</a>
                    <a href="{{ route('contact') }}">contact</a>
                </nav>
                <a href="{{ route('login') }}" class="link-btn">login</a>
                <div id="menu-btn" class="fas fa-bars"></div>
            </div>
        </div>
    </header>
    <!-- header section ends -->

    <main>


        <!-- About Section -->
        <section id="about" class="about container pt-5">
            <div class="about__image">
                <picture>
                    <source srcset="{{ asset('images/picture-about.png') }}" type="image/webp">
                    <img src="{{ asset('images/picture-about.png') }}" alt="Dentist talking to a young patient in a bright operatory"
                        loading="lazy">
                </picture>
            </div>
            <div class="about__info">
                <h2>About Us</h2>
                <h1>We Care For Your Dental Health</h1>
                <p>At our dental clinic, we go beyond providing routine care — we foster trust and deliver lasting
                    results. Utilizing the latest technologies in cosmetic and restorative dentistry, we are committed
                    to designing healthy, natural-looking smiles that endure. Our priority is to ensure each patient
                    receives personalized, precise, and safe treatment in a professional and comfortable environment.
                </p>
                <ul class="about__features">
                    <li data-aos="fade-right" data-aos-duration="600">
                        <i class="fas fa-check-circle" aria-hidden="true"></i>
                        <span>Premium Dental Services You Can Trust</span>
                    </li>
                    <li data-aos="fade-right" data-aos-duration="1200">
                        <i class="fas fa-check-circle" aria-hidden="true"></i>
                        <span>Award-Winning Experts in Dental Care</span>
                    </li>
                    <li data-aos="fade-right" data-aos-duration="1800">
                        <i class="fas fa-check-circle" aria-hidden="true"></i>
                        <span>Dedicated Experts Behind Every Smile</span>
                    </li>
                </ul>
            </div>
        </section>

        <section class="about-attributes">
            <div class="container">
                <div class="row">
                    <!-- vision -->
                    <div class="col-md-4 col-sm-12 px-3 py-3" data-aos="fade-up" data-aos-duration="1000">

                        <div class="border rounded shadow px-3 py-3 text-center">
                            <img src="{{ asset('images/vision.svg') }}" alt="vision">
                            <h3 class="mt-2 mb-5 text-center">Vision</h3>
                            <p>To be a leading dental clinic recognized for excellence in patient care, innovation, and
                                a commitment to creating confident, healthy smiles in our community.
                            </p>

                        </div>
                    </div>


                    <!-- mission -->
                    <div class="col-md-4 col-sm-12 px-3 py-3" data-aos="fade-up" data-aos-duration="1000">

                        <div class="border rounded shadow px-3 py-3 text-center">
                            <img src="{{ asset('images/mission.svg') }}" alt="mission">
                            <h3 class="mt-2 mb-5  text-center">Mission</h3>
                            <p>Our mission is to provide high-quality, compassionate, and personalized dental care using
                                advanced technology and a patient-centered approach. We strive to make every visit
                                comfortable and every smile brighter.</p>


                        </div>
                    </div>

                    <!-- vision -->
                    <div class="col-md-4 col-sm-12 px-3 py-3" data-aos="fade-down" data-aos-duration="1000">

                        <div class="border rounded shadow px-3 py-3 text-center">
                            <img src="{{ asset('images/values.svg') }}" alt="values">
                            <h3 class="mt-2 mb-5  text-center">values</h3>
                            <ul class="about__features">
                                <li>
                                    <i class="fas fa-check-circle" aria-hidden="true"></i>
                                    <span> Patient-Centered Care: We prioritize your comfort, needs, and satisfaction.
                                        t</span>
                                </li>
                                <li>
                                    <i class="fas fa-check-circle" aria-hidden="true"></i>
                                    <span>Excellence: We are committed to the highest standards in dental care.
                                    </span>
                                </li>
                                <li>
                                    <i class="fas fa-check-circle" aria-hidden="true"></i>
                                    <span>Integrity: We are honest, transparent, and ethical in all we do.</span>
                                </li>
                                <li>
                                    <i class="fas fa-check-circle" aria-hidden="true"></i>
                                    <span>Innovation: We embrace advanced technology to improve care and results.
                                    </span>
                                </li>

                            </ul>

                        </div>
                    </div>




                </div>
            </div>
        </section>

        <!-- Footer -->
        <footer class="footer container">
            <p>© 2025 Dental Clinic</p>
            <nav aria-label="Social Media">
                <ul class="social-icons">
                    <li><a href="#" aria-label="Facebook"><i class="fab fa-facebook" aria-hidden="true"></i></a></li>
                    <li><a href="#" aria-label="Instagram"><i class="fab fa-instagram" aria-hidden="true"></i></a></li>
                    <li><a href="#" aria-label="WhatsApp"><i class="fab fa-whatsapp" aria-hidden="true"></i></a></li>
                </ul>
            </nav>
            <p>
                <a href="#">Privacy Policy</a> |
                <a href="#">Terms of Service</a>
            </p>
        </footer>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.3/js/bootstrap.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO"
            crossorigin="anonymous"></script>
        <script src="{{ asset('js/home/main.js') }}"></script>

        <!-- aos animation -->
        <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
        <script>
            AOS.init();
        </script>
</body>

</html>