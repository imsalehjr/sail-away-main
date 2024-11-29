<main>
        <section class="">
            <h2>Boot Verwijderen</h2>
            <p></p>
        </section>

        <!-- Boot Verwijderen Formulier -->
        <section class="about">
            <form action="bootverwijderen.php" method="POST" class="boot-form">
                <!-- BootID Dropdown -->
                <select name="bootID" required>
                    <option value="">Selecteer een boot</option>
                    <?php
                    // Vul de dropdown met boten uit de database
                    foreach ($boten as $boot) {
                        echo "<option value='{$boot['bootID']}'>{$boot['bootNaam']}</option>";
                    }
                    ?>
                </select>
                
                <button type="submit" name="delete" class="cta-button">Verwijderen</button>
            </form>

            <!-- Bevestigingsbericht -->
            <?php if ($bootVerwijderd): ?>
                <p style="color: red; margin-top: 20px;">De boot is succesvol verwijderd!</p>
            <?php endif; ?>
        </section>
    </main>