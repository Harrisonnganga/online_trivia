<?php include "partials/head.php"; ?>

<body>
  <section class="main-section">
    <?php include "partials/nav.php"; ?>

    <div class="container">
      <?php if (isset($_SESSION['msg'])) : ?>
        <div class="toast-container position-fixed bottom-0 end-0 p-3">
          <div class="toast fade show" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="toast-header <?php echo $_SESSION['class']; ?>">
              <strong class="me-auto">Success</strong>
              <button type="button" class="btn-close text-white" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
            <div class="toast-body">
              <?php
              $message = $_SESSION['msg'];
              unset($_SESSION['msg']);
              echo $message;
              ?>
            </div>
          </div>
        </div>
      <?php endif; ?>
      <div class="row justify-content-center">
        <h2 class="pt-4">Welcome to Dashboard, <?php echo $_SESSION['user_name']; ?></h2>
        <div class="col-md-6">
          <div class="card m-5 p-3">
            <div class="card-body">

              <h3 class="card-title py-2">Start taking Quiz</h3>
              <!-- <form action="start_quiz.php" method="POST">
                <button type="submit">Start Quiz</button>
              </form> -->
              <a href="/quiz" class="btn btn-warning m-2">Start the Quiz</a>
            </div>
          </div>
        </div>
        <div class="col-md-8">
          <div class="card my-2 p-3">
            <div class="card-body">
              <h5 class="card-title py-2">Top Scores</h5>
              <table class="table">
                <thead>
                  <tr>
                    <th>Name</th>
                    <th>Score</th>
                  </tr>
                </thead>
                <tbody>
                  <?php while ($row = mysqli_fetch_assoc($result)) : ?>
                    <tr>
                      <td><?php echo htmlspecialchars($row['name']); ?></td>
                      <td><?php echo htmlspecialchars($row['score']); ?></td>
                    </tr>
                  <?php endwhile; ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
  <?php include "partials/footer.php"; ?>
</body>
</html>