<?php include("../require/recaptchakey.php") ?>

<html>

<head>
  <title>Karel Bolbloemen B.V. - Contact</title>
  <?php include("../base/head.php") ?>
  <script src="https://www.google.com/recaptcha/api.js" async defer></script>
</head>

<body>
  <!-- Navbar -->
  <?php include("../base/navbar.php") ?>
  <!----Slider---->
  <?php include("../base/slider.php");

  if (!isset($_GET['submit'])) {
  } else {

    if ($_GET['submit'] == "true") {

  ?>
      <div class="alerts">
        <div class="alert alert-success alert-dismissible fade show m-3" role="alert">
          <strong>Success!</strong> Jouw bericht is verzonden!
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
      </div>
    <?php
    } else if ($_GET['submit'] == "false") {
    ?>
      <div class="alerts">
        <div class="alert alert-danger alert-dismissible fade show m-3" role="alert">
          <strong>Error!</strong> Er is een fout opgetreden. Probeer het later opnieuw.
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
      </div>
  <?php
    }
  }
  ?>

  <!----Formulier---->
  <section id="contact">
    <div class="container">
      <h1>Contact</h1>
      <div class="container-form">
        <form id="form" action="process.php" method="post">
          <input type="text" name="name" id="name" placeholder="Naam" onchange="enableBtn()" required>
          <input type="email" name="email" id="email" placeholder="Email" onchange="enableBtn()" required>
          <input type="text" name="subject" id="subject" placeholder="Onderwerp" onchange="enableBtn()" required>
          <textarea name="message" name="message" id="message" rows="4" placeholder="Bericht" onchange="enableBtn()" required></textarea>
          <div class="g-recaptcha" id="my-recaptcha" data-callback="enableBtn" data-sitekey=<?php echo $public_key; ?>></div>
          <input type="submit" id="form-submit" name="submit" value="Versturen"></input>
        </form>
      </div>
    </div>
  </section>

  <!-- Footer -->
  <?php include("../base/footer.php") ?>

  <script>
    function onloadCallback() {
      var btn = document.getElementById("form-submit");
      btn.disabled = true;
      btn.style.cursor = "not-allowed";
      btn.style.opacity = "0.5";
    };

    function enableBtn() {
      var btn = document.getElementById("form-submit");
      var name = document.getElementById("name").value;
      var email = document.getElementById("email").value;
      var subject = document.getElementById("subject").value;
      var message = document.getElementById("message").value;
      var captcha = grecaptcha.getResponse();
      if (captcha && name && email && subject && message) {
        btn.disabled = false;
        btn.style.cursor = "pointer";
        btn.style.opacity = "1";
        btn.style.transition = "opacity 0.5s ease-in-out";
      }
    }
  </script>
  <script src="https://www.google.com/recaptcha/api.js?onload=onloadCallback&render=explicit" async defer></script>


</body>

</html>