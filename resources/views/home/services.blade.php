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
    <link rel=" stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.3/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">

    <!-- aos animation -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
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



        <!-- Services Section -->
        <section id="services" class="services container">
            <h2><span>Our</span> Services</h2>
            <h3>A Wide Range of Services for Your Best Smile</h3>
            <div class="cards-services">
                <article class="card service-card">
                    <figure>
                        <img src="{{ asset('images/picture-service-01.jpg') }}"
                            alt="Dentist applying a cosmetic filling to a patient's tooth" loading="lazy">
                        <figcaption class="visually-hidden">Advanced Cosmetic Fillings</figcaption>
                    </figure>
                    <div class="service-card__info">
                        <i class="fas fa-fill-drip" aria-hidden="true"></i>
                        <h4>Advanced Cosmetic Fillings</h4>
                        <p>We provide tooth-colored fillings that blend seamlessly for a natural, stunning smile.</p>
                    </div>
                </article>

                <article class="card service-card">
                    <figure>
                        <img src="{{ asset('images/picture-service-02.jpg') }}" alt="Clear aligners displayed on a dental model"
                            loading="lazy">
                        <figcaption class="visually-hidden">Innovative Orthodontics for All Ages</figcaption>
                    </figure>
                    <div class="service-card__info">
                        <i class="fas fa-sliders-h" aria-hidden="true"></i>
                        <h4>Innovative Orthodontics for All Ages</h4>
                        <p>Comfortable, clear aligners that gently straighten teeth with minimal disruption.</p>
                    </div>
                </article>

                <article class="card service-card">
                    <figure>
                        <img src="{{ asset('images/picture-service-03.jpg') }}"
                            alt="Patient receiving professional teeth whitening treatment" loading="lazy">
                        <figcaption class="visually-hidden">Professional Teeth Whitening</figcaption>
                    </figure>
                    <div class="service-card__info">
                        <i class="fas fa-star-of-life" aria-hidden="true"></i>
                        <h4>Professional Teeth Whitening</h4>
                        <p>One session brightens your teeth several shades while safeguarding enamel against
                            sensitivity.</p>
                    </div>
                </article>

                <article class="card service-card">
                    <figure>
                        <img src="{{ asset('images/picture-service-04.jpg') }}"
                            alt="Dental implants inserted into a patient's jawbone" loading="lazy">
                        <figcaption class="visually-hidden">State-of-the-Art Dental Implants</figcaption>
                    </figure>
                    <div class="service-card__info">
                        <i class="fas fa-tooth" aria-hidden="true"></i>
                        <h4>State-of-the-Art Dental Implants</h4>
                        <p>Secure, long-lasting implants that fully restore function and confidence in your bite.</p>
                    </div>
                </article>

                <article class="card service-card">
                    <figure>
                        <img src="{{ asset('images/picture-service-05.jpg') }}" alt="Microscopic view of root canal instruments"
                            loading="lazy">
                        <figcaption class="visually-hidden">Precise &amp; Pain-Free Root Canal Therapy</figcaption>
                    </figure>
                    <div class="service-card__info">
                        <i class="fas fa-microscope" aria-hidden="true"></i>
                        <h4>Precise &amp; Pain-Free Root Canal Therapy</h4>
                        <p>Microscopic instruments remove infection and ease pain for fast, reliable healing.</p>
                    </div>
                </article>

                <article class="card service-card">
                    <figure>
                        <img src="{{ asset('images/picture-service-06.jpg') }}"
                            alt="Dental hygienist performing a check-up and cleaning" loading="lazy">
                        <figcaption class="visually-hidden">Comprehensive Check-Up &amp; Cleaning</figcaption>
                    </figure>
                    <div class="service-card__info">
                        <i class="fas fa-soap" aria-hidden="true"></i>
                        <h4>Comprehensive Check-Up &amp; Cleaning</h4>
                        <p>Thorough exams remove buildup and catch issues early to maintain lifelong oral health.</p>
                    </div>
                </article>
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