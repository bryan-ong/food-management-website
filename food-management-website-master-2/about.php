<?php
// Include database connection or other necessary files if required
// require_once 'util/db_connect.php';
?>

<?php include('header.php'); // Include your header/navigation ?>
<?php include "navbar.php"; ?>
<!-- Main Content Section -->
<section class="about-us py-5">
    <div class="container">
        <div class="row">
            <div class="col-12 text-center">
                <h1 class="display-4 mb-4">About Us</h1>
                <p class="lead">Welcome to Grub, your go-to platform for discovering and ordering food from the best restaurants around you.</p>
            </div>
        </div>

        <div class="row">
            <!-- Section 1: Our Mission -->
            <div class="col-md-6">
                <h2 class="h3 mb-3">Our Mission</h2>
                <p>
                    At Grub, we are dedicated to helping you discover your next favorite meal. Our mission is to make the process of finding food more convenient, enjoyable, and accessible to everyone.
                </p>
            </div>

            <!-- Section 2: Our Values -->
            <div class="col-md-6">
                <h2 class="h3 mb-3">Our Values</h2>
                <ul>
                    <li><strong>Convenience:</strong> Order food from the best restaurants near you, with just a few clicks.</li>
                    <li><strong>Quality:</strong> We only partner with top-rated restaurants to ensure you get the best quality food.</li>
                    <li><strong>Customer Focus:</strong> Your satisfaction is our priority. We are committed to providing excellent customer service.</li>
                </ul>
            </div>
        </div>

        <!-- Section 3: Our Team -->
        <div class="row mt-5">
            <div class="col-12 text-center">
                <h2 class="h3 mb-3">Meet Our Team</h2>
                <p>Our team is passionate about food and technology. Here's a little about the people behind Grub.</p>
            </div>
            <div class="col-md-4">
                <div class="team-member">
                    <h5>Bryan Ong</h5>
                    <p>Founder & CEO</p>
                    <p>Bryan is the visionary behind Grub, and he’s passionate about bringing convenience to food lovers everywhere.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="team-member">
                    <h5>Niko Zheyu</h5>
                    <p>Co-Founder & CTO</p>
                    <p>Niko Zheyu handles all things tech at Grub, ensuring our platform is user-friendly and reliable.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="team-member">>
                    <h5>Youssef Barakat</h5>
                    <p>Marketing Director</p>
                    <p>Youssef ensures that people know about Grub, bringing our platform to foodies far and wide.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Footer Section -->
<?php include('footer.php'); // Include your footer ?>

<!-- Optional: Include any required JS scripts if needed -->
<script src="path/to/your/script.js"></script>
</body>
</html>