<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Sail Away</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

    <!-- Header met zij-navigatie -->
    <header>
    <img class="logo" src="images/logo.png">
        <nav>
            <ul>
                <li><a href="#home">Home</a></li>
                <li><a href="contact.php">Contact</a></li>
                <li><a href="registreren.php">Registreren</a></li>
                <li><a href="inloggen.php">Inloggen</a></li>
                <li><a href="reserveren.php">Reserveren</a></li>
                <li><a href="Menu.php">Beheer</a></li>
            </ul>
        </nav>
    </header>

    <!-- Inhoud -->
    <main>
        <!-- Hero Section -->
        <section class="hero" id="home">
            <div class="hero-content">
                <h2>Beleef het avontuur op zee</h2>
                <p>Vaar weg met Sail Away en ontdek de mooiste bestemmingen op het water.</p>
                <a href="#about" class="cta-button">Meer weten</a>
            </div>
        </section>

        <!-- About Section -->
        <section id="about" class="about">
            <h2>Over Sail Away</h2>
            <p>Bij Sail Away bieden we unieke zeilervaringen aan op luxe schepen. Of je nu op zoek bent naar een rustige vakantie of een avontuurlijke tocht, wij maken het voor je mogelijk!</p>
        </section>

        <!-- Footer -->
        <footer>
            <p>&copy; <?php echo date('Y'); ?> Sail Away. Alle rechten voorbehouden.</p>
        </footer>
    </main>

</body>
</html>
