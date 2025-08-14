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

                @if (Auth::check())
                    <!-- Create an array to check the role - (for the dashboard button)  -->
                    @php
                        $role = Auth::user()->getRoleNames()->first();
                        $routes = [
                            'admin' => 'admin.dashboard',
                            'dentist' => 'dentist.dashboard',
                            'receptionist' => 'receptionist.dashboard',
                            'nurse' => 'nurse.dashboard',
                            'accountant' => 'accountant.dashboard',
                        ];
                    @endphp
                    <a href="{{ isset($routes[$role]) ? route($routes[$role]) : route('home') }}" class="link-btn"> Dashboard</a>
                    @else
                    <a href="{{ route('login') }}" class="link-btn">login</a>
                    <div id="menu-btn" class="fas fa-bars"></div>
                @endif
            </div>
        </div>
    </header>
    <!-- header section ends -->

    <!-- home section starts -->
        <section class="home">
            <div class="container">
                <div class="row min-vh-100 align-items-center">
                    <div class="content">
                        <h3 data-aos="fade-right" data-aos-duration="1000">helping you stay happy one</h3>
                        <p data-aos="fade-down" data-aos-duration="1500">everyday we bring hope and smile to the patient
                            we serve</p>
                        <a data-aos="fade-up" data-aos-duration="1900" href="{{ route('login') }}" class="btn-1 "><i
                                class="animation"></i>login now<i class="animation"></i>
                        </a>
                    </div>
                </div>
            </div>
        </section>
        <!-- home section ends -->

        <!-- About Section -->
        <section class="about container">
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
                    results. Utilizing the latest technologies in cosmetic and restorative dentistry.</p>
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
                <a data-aos="zoom-in" data-aos-duration="2400" href="{{ route('about') }}" class="btn-about">Learn More</a>
            </div>
        </section>

        <!-- Services Section -->
        <section id="services" class="services container">
            <h2><span>Our</span> featured Services</h2>
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

            </div>
            <a data-aos="zoom-in" data-aos-duration="2400" href="{{ route('services') }}"
                class="btn-service text-center mt-5">Learn More</a>

        </section>

        <!-- Contact Section  -->
        <section class="contact">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="section-title pb-5">
                            <h2 class="mb-5"><span>Contact</span> us</h2>

                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="contact__info col-md-6 col-sm-12">
                        <div class="border rounded px-5 py-3 shadow-lg">

                            <h2 class="mt-4 mp-2">let's get in touch</h2>
                            <p class="mt-3">we're open for any suggestion or just to have a chat</p>
                            <div class="d-flex mt-2">
                                <i class="bi bi-geo-alt"></i>
                                <p class="mt-3 ms-3">adrees:Syria,Damascuse</p>
                            </div>
                            <div class="d-flex mt-2">
                                <i class="bi bi-phone"></i>
                                <p class="mt-3 ms-3">Phone: <a href="tel:+963 092618689">+963 092618689</a></p>
                            </div>
                            <div class="d-flex mt-2">
                                <i class="bi bi-envelope-open-heart"></i>
                                <p class="mt-3 ms-3">Email:<a
                                        href="mailto:info@dentalclinic.com">info@dentalclinic.com</a></p>
                            </div>
                            <div class="d-flex mt-2">
                                <i class="bi bi-whatsapp"></i>
                                <p class="mt-3 ms-3">whatsapp:<a
                                        href="https://wa.me/+963932119543?text=hello">+963932119543</a></p>
                            </div>

                            <div class="py-3 mt-3 border-top contact-social-icons-div" data-aos="zoom-in"
                                data-aos-duration="1000">
                                <h3 class="my-3"> Follow Us:</h3>
                                <a data-mdb-ripple-init class="btn btn-primary" style="background-color: #3b5998;"
                                    href="#!" role="button"><i class="fab fa-facebook-f"></i></a>


                                <!-- Instagram -->
                                <a data-mdb-ripple-init class="btn btn-primary" style="background-color: #ac2bac;"
                                    href="#!" role="button"><i class="fab fa-instagram"></i></a>

                                <!-- Youtube -->
                                <a data-mdb-ripple-init class="btn btn-primary" style="background-color: #ed302f;"
                                    href="#!" role="button"><i class="fab fa-youtube"></i></a>

                                <!-- Linkedin -->
                                <a data-mdb-ripple-init class="btn btn-primary" style="background-color: #0082ca;"
                                    href="#!" role="button"><i class="fab fa-linkedin-in"></i></a>
                            </div>
                        </div>

                    </div>
                
                    <div class="col-md-6 col-sm-12 px-5">
                        <div class="map-area border rounded">
                            <iframe
                                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d53233.35267040624!2d36.17547872167969!3d33.499177499999995!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x1518df14417fb8c7%3A0x2c403bd64f06afcc!2sSunlight%20Dental%20Clinic!5e0!3m2!1sen!2s!4v1749276729035!5m2!1sen!2s"
                                width="600" height="450" allowfullscreen="" loading="lazy"
                                referrerpolicy="no-referrer-when-downgrade"></iframe>
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
                        <li><a href="#" aria-label="Facebook"><i class="fab fa-facebook" aria-hidden="true"></i></a>
                        </li>
                        <li><a href="#" aria-label="Instagram"><i class="fab fa-instagram" aria-hidden="true"></i></a>
                        </li>
                        <li><a href="#" aria-label="WhatsApp"><i class="fab fa-whatsapp" aria-hidden="true"></i></a>
                        </li>
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