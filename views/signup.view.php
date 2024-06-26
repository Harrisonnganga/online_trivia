<?php include "partials/head.php"; ?>

<body>
    <section class="main-section">
        <div class="container">
            <div class="row justify-content-center align-items-center" style="height: 100vh">
                <div class="col-md-7 col-lg-4">
                    <div class="box rounded">
                        <div class="img"></div>
                        <div class="login-box p-5">
                            <h2 class="pb-4">Sign Up</h2>
                            <form action="" method="post">
                                <div class="mb-4">
                                    <input type="text" class="form-control" placeholder="Enter Name" name="name" required>
                                </div>
                                <div class="mb-4">
                                    <input type="email" class="form-control" placeholder="Enter Email address" name="email" required>
                                </div>
                                <div class="mb-4">
                                    <input type="password" class="form-control" placeholder="Enter Password" name="password" required>
                                </div>
                                <div class="d-grid gap-2">
                                    <button type="submit" class="btn btn-primary" name="signup">Sign Up</button>
                                </div>
                            </form>
                            <div class="py-4 text-center">
                                <a href="/login" class="link">Login</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>