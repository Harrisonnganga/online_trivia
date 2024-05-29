<?php include "partials/head.php"; ?>
<body>
<section class="main-section">
<?php include "partials/nav.php"; ?>

    <div class="container">
      <div class="row justify-content-center">
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
              <a href="/quiz" class="btn btn-info">Start Quiz</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
