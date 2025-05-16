<?php
session_start();
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tentang Kami - Mini Blog Kreatif</title>
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
    <div class="container">
        <!-- Header -->
        <?php include 'includes/header.php'; ?>
        
        <!-- About Section -->
        <section class="about-section">
            <div class="about-header">
                <h1>Tentang Mini Blog Kreatif</h1>
                <p class="subtitle">Platform berbagi ide dan inspirasi kreatif untuk semua orang</p>
            </div>
            
            <div class="about-content">
                <div class="about-image">
                    <img src="assets/img/about.jpg" alt="Mini Blog Kreatif Team" onerror="this.src='https://via.placeholder.com/600x400?text=Mini+Blog+Kreatif'">
                </div>
                
                <div class="about-text">
                    <h2>Cerita Kami</h2>
                    <p>Mini Blog Kreatif didirikan pada tahun 2023 dengan tujuan menjadi platform berbagi pengetahuan dan inspirasi dalam berbagai bidang seperti teknologi, seni, kuliner, dan travel.</p>
                    <p>Kami percaya bahwa setiap orang memiliki cerita dan pengetahuan yang berharga untuk dibagikan. Melalui Mini Blog Kreatif, kami ingin memfasilitasi pertukaran ide dan pengalaman yang dapat menginspirasi orang lain.</p>
                    <p>Tim kami terdiri dari para profesional dan penggemar di berbagai bidang yang bersemangat untuk berbagi pengetahuan dan pengalaman mereka dengan komunitas yang lebih luas.</p>
                </div>
            </div>
            
            <div class="mission-vision">
                <div class="mission">
                    <i class="fas fa-bullseye"></i>
                    <h2>Misi Kami</h2>
                    <p>Menyediakan platform yang mudah diakses bagi semua orang untuk berbagi pengetahuan, ide, dan pengalaman yang bermanfaat dan menginspirasi.</p>
                </div>
                
                <div class="vision">
                    <i class="fas fa-eye"></i>
                    <h2>Visi Kami</h2>
                    <p>Menjadi komunitas online terkemuka yang menghubungkan individu kreatif dan inovatif dari berbagai latar belakang untuk saling berbagi dan belajar.</p>
                </div>
            </div>
            
            <div class="team-section">
                <h2>Tim Kami</h2>
                <div class="team-grid">
                    <div class="team-member">
                        <div class="member-image">
                            <img src="assets/img/team1.jpg" alt="John Doe" onerror="this.src='https://via.placeholder.com/300x300?text=John+Doe'">
                        </div>
                        <h3>John Doe</h3>
                        <p class="member-role">Pendiri & CEO</p>
                        <p class="member-bio">John adalah seorang penggemar teknologi dan pendidikan. Dia mendirikan Mini Blog Kreatif dengan visi membuat platform berbagi pengetahuan yang mudah diakses oleh semua orang.</p>
                        <div class="member-social">
                            <a href="#"><i class="fab fa-twitter"></i></a>
                            <a href="#"><i class="fab fa-linkedin"></i></a>
                            <a href="#"><i class="fab fa-instagram"></i></a>
                        </div>
                    </div>
                    
                    <div class="team-member">
                        <div class="member-image">
                            <img src="assets/img/team2.jpg" alt="Jane Smith" onerror="this.src='https://via.placeholder.com/300x300?text=Jane+Smith'">
                        </div>
                        <h3>Jane Smith</h3>
                        <p class="member-role">Editor Kepala</p>
                        <p class="member-bio">Jane memiliki latar belakang jurnalistik dan pengalaman lebih dari 10 tahun dalam dunia penulisan. Dia bertanggung jawab atas kualitas konten di Mini Blog Kreatif.</p>
                        <div class="member-social">
                            <a href="#"><i class="fab fa-twitter"></i></a>
                            <a href="#"><i class="fab fa-linkedin"></i></a>
                            <a href="#"><i class="fab fa-instagram"></i></a>
                        </div>
                    </div>
                    
                    <div class="team-member">
                        <div class="member-image">
                            <img src="assets/img/team3.jpg" alt="Budi Santoso" onerror="this.src='https://via.placeholder.com/300x300?text=Budi+Santoso'">
                        </div>
                        <h3>Budi Santoso</h3>
                        <p class="member-role">Pengembang Web</p>
                        <p class="member-bio">Budi adalah seorang pengembang web berpengalaman yang bertanggung jawab atas semua aspek teknis dari platform Mini Blog Kreatif.</p>
                        <div class="member-social">
                            <a href="#"><i class="fab fa-twitter"></i></a>
                            <a href="#"><i class="fab fa-linkedin"></i></a>
                            <a href="#"><i class="fab fa-github"></i></a>
                        </div>
                    </div>
                    
                    <div class="team-member">
                        <div class="member-image">
                            <img src="assets/img/team4.jpg" alt="Siti Nuraini" onerror="this.src='https://via.placeholder.com/300x300?text=Siti+Nuraini'">
                        </div>
                        <h3>Siti Nuraini</h3>
                        <p class="member-role">Manajer Komunitas</p>
                        <p class="member-bio">Siti fokus pada pengembangan komunitas dan memastikan pengalaman pengguna yang optimal di platform Mini Blog Kreatif.</p>
                        <div class="member-social">
                            <a href="#"><i class="fab fa-twitter"></i></a>
                            <a href="#"><i class="fab fa-linkedin"></i></a>
                            <a href="#"><i class="fab fa-instagram"></i></a>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="cta-section">
                <h2>Bergabunglah dengan Komunitas Kami</h2>
                <p>Jadilah bagian dari komunitas Mini Blog Kreatif dan mulailah berbagi ide dan pengalaman Anda dengan dunia.</p>
                <a href="register.php" class="btn">Daftar Sekarang</a>
            </div>
        </section>
        
        <!-- Footer -->
        <?php include 'includes/footer.php'; ?>
    </div>
    
    <script src="assets/js/script.js"></script>
</body>
</html>
