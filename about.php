<?php
include 'header.php';
?>
<title>About Us</title>
</head>

<body class="d-flex flex-column min-vh-100">
    <?php include 'navbar.php'; ?>

    <main class="container my-5 flex-grow-1">
        <h2 class="mb-4 text-capitalize">About Us</h2>

        <section class="mb-5 card p-5 fs-5">
            <p>
                Welcome to <strong>GrubApp</strong> — the easiest way to browse menus and order delicious meals
                from your favourite restaurants. Our mission is to make dining seamless and
                enjoyable, whether you're at home, at the office, or on the go.
            </p>
            <p>
                This project was built by our awesome team as part of a web development course.
                We poured our hearts into every feature and hope you enjoy using it as much as we
                enjoyed building it!
            </p>
        </section>

        <section>
            <h3 class="mb-5 text-center">Meet the Team</h3>
            <div class="row g-4">
                <?php
                $team = [
                    ['name' => 'Youssef Barakat',   'role' => 'Backend Lead',   'img' => 'assets/team/youssef-barakat.jpg'],
                    ['name' => 'Bryan Ong',         'role' => 'Frontend Lead',  'img' => 'assets/pfp.png'],
                    ['name' => 'Musaiwale Mutale',  'role' => 'Database Guru',  'img' => 'assets/pfp.png'],
                    ['name' => 'Niko',              'role' => 'UI/UX Designer', 'img' => 'assets/pfp.png'],
                ];

                foreach ($team as $member): ?>
                    <div class="col-6 col-md-3 text-center">
                        <img src="<?= htmlspecialchars($member['img']) ?>"
                            alt="<?= htmlspecialchars($member['name']) ?>"
                            class="rounded-circle mb-3 shadow-sm team-img"
                            width="150" height="150">
                        <h5 class="text-capitalize mb-1"><?= htmlspecialchars($member['name']) ?></h5>
                        <p class="text-muted text-capitalize"><?= htmlspecialchars($member['role']) ?></p>
                    </div>
                <?php endforeach; ?>
            </div>
        </section>
    </main>

    <?php include 'footer.php'; ?>
</body>

</html>
