<html>

<head>
  <title>Karel Bolbloemen B.V. - Onze Werkwijze</title>
  <?php include("../base/head.php") ?>
</head>

<body>
  <!-- Navbar -->
  <?php include("../base/navbar.php") ?>
  <!----Slider---->
  <?php include("../base/slider.php") ?>
  <!----Formulier---->
  <section id="contact">
    <div class="container">
      <h1>Contact</h1>
      <div class="container-form">
        <form action="process.php" method="post">
          <input type="text" name="name" id="name" placeholder="Naam" required>
          <input type="email" name="email" id="email" placeholder="Email" required>
          <textarea name="message" name="message" id="message" rows="4" placeholder="Bericht"></textarea>
          <button type="submit">Versturen</button>
        </form>
      </div>

    </div>
  </section>

  <!-- Footer -->
  <?php include("../base/footer.php") ?>
</body>

</html>