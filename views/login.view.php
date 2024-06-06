<?php include "partials/head.php"; ?>
<body>
<section class="main-section">

    <div class="container">
      <div class="row justify-content-center">
        <div class="col-md-6">
        <div class="img"></div>

          <div class="card my-4 p-3">
            <div class="card-body">
              <?php if (isset($_SESSION['msg'])): ?>
                <div class="alert <?php echo $_SESSION['class']; ?> mt-2">
                  <?php echo $_SESSION['msg']; ?>
                </div>
                <?php unset($_SESSION['msg']); ?>
                <?php unset($_SESSION['class']); ?>
              <?php endif; ?>

              <h5 class="card-title">Login</h5>
              <form method="POST" action="">
                <div class="mb-3">
                  <label for="email" class="form-label">Email</label>
                  <input type="email" class="form-control" id="email" name="email" required>
                </div>
                <div class="mb-3">
                  <label for="password" class="form-label">Password</label>
                  <input type="password" class="form-control" id="password" name="password" required>
                </div>
                <button type="submit" name="login" class="btn btn-primary">Login</button>
              </form>
              <div class="py-4 text-center">
                You new, <br>
                <a href="/signup" class="link">Sign Up</a>
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
