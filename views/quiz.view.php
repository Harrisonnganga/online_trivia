<?php include "partials/head.php"; ?>
<body>
<section class="main-section">
<?php include "partials/nav.php"; ?>

    <div class="container">
      <div class="row justify-content-center">
        <div class="col-md-8">
          <div class="card my-2 p-3">
            <div class="card-body">
              <?php if (isset($question) && isset($answers)) : ?>
                <h5 class="card-title py-2">Q.<?php echo $question['qid'] . " " . $question['question']; ?></h5>
                <form method="POST" action="">
                  <?php foreach ($answers as $answer) : ?>
                    <div class="form-check">
                      <input class="form-check-input" type="radio" name="answer" value="<?php echo $answer['aid']; ?>" required>
                      <label class="form-check-label">
                        <?php echo $answer['answer']; ?>
                      </label>
                    </div>
                  <?php endforeach; ?>
                  <button type="submit" class="btn btn-primary mt-3">Next</button>
                </form>
              <?php else : ?>
                <p>No questions available.</p>
              <?php endif; ?>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
