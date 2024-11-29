<main>
        <section class="">
            <h2>Boten Toevoegen</h2>
            <p></p>
        </section>

        <!-- Boot Toevoegen Formulier -->
        <section class="about">
            <form action="bootbeheer.php" method="POST" class="boot-form">
                <input type="text" name="bootNaam" placeholder="Bootnaam" required>
                <input type="text" name="merk" placeholder="Merk" required>
                <input type="number" name="capaciteit" placeholder="Capaciteit" required>
                <input type="number" name="bouwjaar" placeholder="Bouwjaar" required>
                <input type="number" step="0.01" name="lengte" placeholder="Lengte in meters" required>
                
                <!-- BootTypeID Dropdown -->
                <select name="bootTypeID" required>
                    <option value="">Selecteer een boot type</option>
                    <?php
                    // Haal de boot types op uit de database
                    $types = $pdo->query("SELECT bootTypeID, typeBeschrijving FROM boottype")->fetchAll(PDO::FETCH_ASSOC);
                    foreach ($types as $type) {
                        echo "<option value='{$type['bootTypeID']}'>{$type['typeBeschrijving']}</option>";
                    }
                    ?>
                </select>
                
                <textarea name="bootBeschrijving" placeholder="Beschrijving van de boot" required></textarea>
                <button type="submit" name="save" class="cta-button">Toevoegen</button>
            </form>

            <!-- Bevestigingsbericht -->
            <?php if ($bootToegevoegd): ?>
                <p style="color: green; margin-top: 20px;">De boot is succesvol toegevoegd!</p>
            <?php endif; ?>
        </section>
    </main>