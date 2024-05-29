<?php include "partials/head.php"; ?>
<body>
<section class="main-section">
    <?php include "partials/nav.php"; ?>

    <div class="container">
      <div class="row justify-content-center">
        <div class="col-md-8">
          <div class="card my-2 p-3 text-center">
            <div class="card-body">
              <h5 class="card-title py-2">Quiz Completed</h5>
              <p class="card-text">You answered <span id="correct-answers"><?php echo $score / 4; ?></span> questions correctly!</p>
              <p class="card-text">Your Score: <span id="score"><?php echo $score; ?></span>%</p>
              <a href="dashboard.php" class="btn btn-info">Go to Dashboard</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>