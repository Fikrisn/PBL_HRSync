<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="{{ asset('polinema.png') }}" type="image/png">
    <title>HRSync</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" integrity="sha512-k6RqeWeci5ZR/Lv4MR0sA0FfDOM7TQ0m1H0gG4w9gG8Z2C6h5zv6oX+E8s5i1YbXG3M1uO4p5c0w5o3u0g7z9g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        /* Reset and base styles */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            color: #333;
            background-color: #f4f4f4;
            transition: background-color 0.3s, color 0.3s;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
        }

        /* Layout */
        .layout {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            position: relative;
        }

        /* Header */
        .header {
            background-color: #003366;
            padding: 10px 0;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            transition: background-color 0.3s;
        }

        .container {
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .logo a {
            display: flex;
            align-items: center;
            text-decoration: none;
            color: #ffffff;
        }

        .logo img {
            height: 70px;
            vertical-align: middle;
        }

        .logo-text {
            font-size: 35px;
            margin-left: 10px;
            font-family: Arial, Helvetica, sans-serif;
        }

        /* Navigation Menu */
        .menu ul {
            list-style: none;
            display: flex;
            gap: 15px;
        }

        .menu ul li a {
            color: #ffffff;
            text-decoration: none;
            font-size: 1em;
            padding: 10px 15px;
            border-radius: 5px;
            transition: background-color 0.3s;
        }

        .menu ul li a:hover {
            background-color: #0057b7;
        }

        /* Login Button */
        .login-button {
            background-color: #0057b7;
            padding: 8px 12px;
            border-radius: 5px;
            color: #ffffff;
            font-weight: bold;
            text-decoration: none;
            transition: background-color 0.3s ease;
        }

        .login-button:hover {
            background-color: #003366;
        }

        /* Responsive design */
        @media (max-width: 768px) {
            .header .container {
                flex-wrap: wrap;
                justify-content: center;
            }

            .menu ul {
                width: 100%;
                justify-content: center;
                margin-top: 10px;
            }
        }

        /* Main content */
        main {
            flex: 1;
            padding: 2rem;
            color: #1b2a49;
        }

        /* Section styling */
        .section {
            padding: 20px 10px;
            background-color: #f9f9f9;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
            transition: transform 0.3s;
        }

        .section:hover {
            transform: translateY(-5px);
        }

        .section-title {
            font-size: 35px;
            font-weight: bold;
            text-align: center;
            margin-bottom: 30px;
            color: #007bff;
        }

        .feature-card {
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            padding: 1.5rem;
            transition: transform 0.3s ease;
        }

        .feature-card:hover {
            transform: translateY(-5px);
        }

        /* Footer */
        .footer {
            background-color: #1b2a49;
            color: #fff;
            padding: 2rem 0;
            margin-top: 2rem;
        }

        .footer-content {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
        }

        .footer-section {
            flex: 1;
            margin-bottom: 1rem;
            min-width: 200px;
        }

        .footer-section h3 {
            margin-bottom: 0.5rem;
            color: #4a90e2;
        }

        .footer-section ul {
            list-style: none;
        }

        .footer-section a {
            color: #fff;
            text-decoration: none;
        }

        .footer-bottom {
            margin-top: 1rem;
            text-align: center;
            font-size: 0.9rem;
        }

        /* Dark Mode */
        body.dark-mode {
            background-color: #121212;
            color: #ffffff;
        }

        .dark-mode .header {
            background-color: #1b2a49;
        }

        .dark-mode .menu ul li a {
            color: #ffffff;
        }

        .dark-mode .footer {
            background-color: #1b2a49;
        }

        /* Slider */
        .photo-slider {
            position: relative;
            overflow: hidden;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .slider-container {
            display: flex;
            transition: transform 0.5s ease;
        }

        .slider-image {
            min-width: 100%;
            transition: opacity 1s ease-in-out;
        }

        .slider-image.active {
            opacity: 1;
        }

        /* Welcome section */
        .welcome h2 {
            font-size: 2rem;
            margin-bottom: 1rem;
            font-weight: 600;
            color: #1b2a49;
            text-align: center;
        }

        .welcome p {
            font-size: 1.1rem;
            line-height: 1.7;
            color: #555;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="layout">
        <header class="header">
            <div class="container">
                <div class="logo">
                    <a href="https://polinema.ac.id">
                        <img src="polinema.png" alt="Polinema Logo" style="height: 40px; vertical-align: middle;">
                        <span class="logo-text">HRSync</span>
                    </a>
                </div>
                <nav class="menu">
                    <ul>
                        <li><a href="#home" onclick="showSection('home')">Home</a></li>
                        <li><a href="#about" onclick="showSection('about')">About</a></li>
                        <li><a href="#contact" onclick="showSection('contact')">Contact</a></li>
                        <li><a href="{{ route('login') }}" class="login-button" id="loginButton">Login</a></li>
                    </ul>
                </nav>
            </div>
        </header>
        <main>
            <section id="home" class="section">
                <section class="photo-slider">
                    <div class="slider-container">
                        <img src="img/jtiblur.png" alt="Campus Photo 1" class="slider-image active">
                        <img src="img/poltek.png" alt="Campus Photo 2" class="slider-image">
                        <img src="img/poltek4.png" alt="Campus Photo 3" class="slider-image">
                    </div>
                </section>
                <section class="welcome">
                    <h2>Welcome to JTI HR Management System</h2>
                    <p>
                    Sistem ini dirancang khusus untuk mempermudah pengelolaan kepegawaian dosen di Jurusan Teknologi Informasi Politeknik Negeri Malang. Dengan fitur-fitur unggulan seperti manajemen kegiatan dan point yang didapatkan setiap dosen, sistem ini memberikan kemudahan dan efisiensi dalam memonitor dan mendokumentasikan seluruh aktivitas dosen. Akses data yang cepat, transparan, dan aman membantu meningkatkan kinerja akademik dan administrasi.
                    </p>
                </section>
                <br>
                <section class="features">
                    <div class="feature-card">
                        <h3><a href="https://jti.polinema.ac.id/playit2024/" class="feature-link">JTI Play IT! 2024</a></h3>
                        <p>PLAY IT! (Competition for Learning and Advancing Youth in Information Technology) adalah kompetisi nasional yang diselenggarakan oleh Jurusan Teknologi Informasi, Politeknik Negeri Malang, yang bertujuan untuk mendorong generasi muda Indonesia dalam mengembangkan kreativitas dan inovasi di bidang teknologi. Kompetisi ini terbuka bagi mahasiswa/i perguruan tinggi dan siswa/i SMA/SMK sederajat dari seluruh Indonesia, sebagai ajang untuk menampilkan kemampuan dan solusi inovatif mereka dalam memanfaatkan teknologi informasi dengan memperhatikan poin (SDG's) atau pembangunan berkelanjutan..</p>
                    </div>
                    <div class="feature-card">
                        <h3><a href="https://jti.polinema.ac.id/index.php/2024/08/08/jti-polinema-gelar-workshop-kurikulum-berbasis-obe-untuk-prodi-d4-teknik-informatika-dan-d4-sistem-informasi-bisnis/" class="feature-link">Workshop Kurikulum Berbasis OBE</a></h3>
                        <p>Workshop ini bertujuan untuk menyelaraskan kurikulum dengan pendekatan OBE, guna menghasilkan lulusan yang kompeten dan siap bersaing di dunia kerja.</p>
                    </div>
                    <div class="feature-card">
                        <h3><a href="https://jti.polinema.ac.id/index.php/2024/06/24/program-kewirausahaan-jti-polinema-dibuka-kembali/" class="feature-link">Program Kewirausahaan JTI Polinema</a></h3>
                        <p>Program ini saat ini sudah berjalan di tahun kedua dan memacu mahasiswa untuk berkembang dan memberdayakan potensi wirausaha setelah lulus kuliah.</p>
                    </div>
                </section>

                
                <br>
                <section class="welcome">
                    <h2>Fitur unggulan website ini </h2>
                    <p>
                    Sistem Informasi Manajemen SDM JTI merupakan sistem informasu yang dibuat untuk mengatur pemerataan tugas SDM di JTI. Harapannya dengan adanya sistem informasi ini dapat memantau persebaran tugas yang ada di JTI. Dengan pemantauan yang mudah, diharapkan beban kerja SDM di JTI bisa merata. 
                    </p>
                </section>
                <br>
                <section class="features">
                    <div class="feature-card">
                        <h3>Pemerataan Kegiatan Dosen</h3>
                        <p>Sistem ini membantu admin dan pimpinan dalam pemilihan dosen yang bertugas dalam setiap kegiatan yang dimiliki Jurusan Teknologi Informasi  </p>
                    </div>
                    <div class="feature-card">
                        <h3>Monitoring Kegiatan dosen</h3>
                        <p> HRSync membantu Dosen yang bertugas menjadi PIC untuk memonitoring progress selama kegiatan berlangsung</p>
                    </div>
                    <div class="feature-card">
                        <h3>Statistik Kinerja Dosen</h3>
                        <p> HRSync memberikan statistik kinerja dosen kepada agar sebagai bahan evaluasi dan laporan kepada Pimpinan</p>
                    </div>
                </section>
            </section>

            <!-- About Section -->
            <section id="about" class="section about-section">
            <div class="container">
                <div class="card about-card">
                    <h2 class="section-title">About Us</h 2>
                    <div class="card-body">
                        <div class="about-content text-center">
                            <img src="polinema.png" alt="Politeknik Negeri Malang Logo" class="polinema-logo">
                            <p>
                                At Politeknik Negeri Malang (Polinema), we are dedicated to creating a comprehensive HR solution tailored specifically for our academic institution. Our platform is built with the needs of our faculty and administrative staff in mind, ensuring efficiency and ease of use. 
                                <br>
                                We strive to provide innovative tools and resources that facilitate effective communication, enhance collaboration, and streamline HR processes. By focusing on the unique challenges faced by our institution, we aim to foster a supportive environment that promotes professional growth and development for all staff members.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            </section>

            <!-- Contact Section -->
            <section id="contact" class="section">
                <h2 class="section-title">Contact Us</h2>
                <div class="container"> 
                    <div class="row mt-4">
                        <div class="col-12 text-center">
                            <h5 class="institution-name">Politeknik Negeri Malang</h5>
                            <p class="address text-muted">Jl. Soekarno Hatta No.9, Jatimulyo, Kec. Lowokwaru, Kota Malang, Jawa Timur 65141</p>
                        </div>
                        <div class="map-container">
                            <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d15806.010732341647!2d112.6161209!3d-7.9468912!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e78827687d272e7%3A0x789ce9a636cd3aa2!2sPoliteknik%20Negeri%20Malang!5e0!3m2!1sid!2sid!4v1714835289599!5m2!1sid!2sid" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="contact-info">
                            <h4 class="contact-header">Hubungi Kami</h4>
                            <ul class="contact-list">
                                <li>
                                    <a href="tel:0341404424">
                                        <span class="icon"><i class="fas fa-phone"></i></span>
                                        (0341) 404424
                                    </a>
                                </li>
                                <li>
                                    <a href="mailto:humas@polinema.ac.id">
                                        <span class="icon"><i class="fas fa-envelope"></i></span>
                                        humas@polinema.ac.id
                                    </a>
                                </li>
                                <li>
                                    <span class="icon"><i class="fas fa-clock"></i></span>
                                    Jam Kerja: 
                                    <ul class="working-hours">
                                        <li>Senin - Jumat : 07:00 - 16:00 WIB</li>
                                        <li>Sabtu & Minggu : Tutup</li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </section>            
        </main>

        <footer class="footer">
            <div class="footer-content container">
                <div class="footer-section">
                    <h3>About Us</h3>
                    <ul>
                        <li><a href="https://github.com/Fikrisn/HRSync/graphs/contributors">Our Team</a></li>
                        <li><a href="https://jti.polinema.ac.id/">PBL Info</a></li>
                        <li><a href="https://www.linkedin.com/in/moch-fikri-setiawan-43183b252/">Careers</a></li>
                    </ul>
                </div>
                <div class="footer-section">
                    <h3>Resources</h3>
                    <ul>
                        <li><a href="Https://polinema.ac.id">Blog</a></li>
                        <li><a href="https://helpakademik.polinema.ac.id/">Help Center</a></li>
                        <li><a href="https://jpkm.polinema.ac.id/index.php/jpkm/about/privacy">Privacy Policy</a></li>
                    </ul>
                </div>
                <div class="footer-section">
                    <h3>Connect</h3>
                    <ul>
                        <li><a href="https://ppid.polinema.ac.id/">Contact</a></li>
                        <li><a href="https://ppid.polinema.ac.id/regulasi/">Support</a></li>
                    </ul>
                </div>
            </div>
            <div class="footer-bottom">
                <strong>
                    Copyright &copy; 2024-2025 
                    <a href="https://polinema.ac.id" style="color: blue;">HRSync</a>.
                </strong> All rights reserved.
            </div>                
        </footer>
    </div>

    <script>
        // JavaScript to show and hide sections
        function showSection(sectionId) {
            const sections = document.querySelectorAll('.section');
            sections.forEach(section => {
                section.style.display = 'none'; // Hide all sections
            });

            const activeSection = document.getElementById(sectionId);
            if (activeSection) {
                activeSection.style.display = 'block'; // Show the selected section
            }
        }

        // Automatically show the home section on page load
        window.onload = function() {
            showSection('home');
        };

        // Slider functionality
        let currentSlide = 0;
        const slides = document.querySelectorAll('.slider-image');
        function showSlides() {
            slides[currentSlide].classList.remove('active'); // Hide current slide
            currentSlide = (currentSlide + 1) % slides.length; // Move to the next slide
            slides[currentSlide].classList.add('active'); // Show new slide
        }
        setInterval(showSlides, 3000); // Change slide every 3 seconds

        // Dark mode toggle
        const toggleDarkMode = () => {
            document.body.classList.toggle('dark-mode');
        };

        // Add a button for dark mode toggle
        const darkModeButton = document.createElement('button');
        darkModeButton.innerText = 'Toggle Dark Mode';
        darkModeButton.style.position = 'fixed';
        darkModeButton.style.top = '10px';
        darkModeButton.style.right = '10px';
        darkModeButton.style.padding = '10px';
        darkModeButton.style.backgroundColor = '#0057b7';
        darkModeButton.style.color = '#fff';
        darkModeButton.style.border = 'none';
        darkModeButton.style.borderRadius = '5px';
        darkModeButton.style.cursor = 'pointer';
        darkModeButton.onclick = toggleDarkMode;
        document.body.appendChild(darkModeButton);
    </script>
</body>
</html>