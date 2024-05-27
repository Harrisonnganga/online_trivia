<?php

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Online Trivia</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <section class="main-section">
        <div class="container">
            <div class="toast-container position-fixed bottom-0 end-0 p-3">
                <div class="toast fade show" role="alert" aria-live="assertive" aria-atomic="true">
                    <div class="toast-header">
                        <strong class="me-auto">Message</strong>
                        <button type="button" class="btn-close text-white" data-bs-dismiss="toast"
                            aria-label="Close">
                        </button>
                    </div>
                    <div class="toast-body"></div>
                </div>
            </div>
            <div class="row justify-content-center align-items-center" style="height: 100vh">
                <div class="col-md-7 col-lg-4">
                    <div class="box rounded">
                        <div class="img"></div>
                        <div class="login-box p-5">
                            <h2 class="pb-4">Login</h2>
                            <form action="" method="post">
                                <div class="mb-4">
                                    <input type="email" class="form-control" placeholder="Enter Email address"
                                        name="email" />
                                </div>
                                <div class="mb-4">
                                    <input type="password" class="form-control" placeholder="Enter Password"
                                        name="password" />
                                </div>
                                <div class="d-grid gap-2">
                                    <button type="submit" class="btn btn-primary" name="login">
                                        Login
                                    </button>
                                </div>
                            </form>
                            <div class="py-4 text-center">
                                Join now, <a href="signup.php" class="link">Sign Up</a>
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