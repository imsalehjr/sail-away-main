<main>
        <section class="">
            <h2>Boot Wijzigen</h2>
            <p></p>
        </section>

        <section class="about">
            <!-- Selecteer Boot Formulier -->
            <form action="bootwijzigen.php" method="POST">
                <select name="bootID" required>
                    <option value="">Selecteer een boot</option>
                    <?php foreach ($boten as $bootOptie): ?>
                        <option value="<?= $bootOptie['bootID'] ?>" <?= (isset($boot) && $boot['bootID'] == $bootOptie['bootID']) ? 'selected' : '' ?>>
                            <?= $bootOptie['bootNaam'] ?>
                        </option>
                    <?php endforeach; ?>
                </select>
                <button type="submit" name="select" class="cta-button">Selecteer</button>
            </form>

            <!-- Update Boot Formulier -->
            <?php if ($boot): ?>
                <form action="bootwijzigen.php" method="POST" class="boot-form">
                    <input type="hidden" name="bootID" value="<?= $boot['bootID'] ?>">
                    <input type="text" name="bootNaam" value="<?= $boot['bootNaam'] ?>" placeholder="Bootnaam" required>
                    <input type="text" name="merk" value="<?= $boot['merk'] ?>" placeholder="Merk" required>
                    <input type="number" name="capaciteit" value="<?= $boot['capaciteit'] ?>" placeholder="Capaciteit" required>
                    <input type="number" name="bouwjaar" value="<?= $boot['bouwjaar'] ?>" placeholder="Bouwjaar" required>
                    <input type="number" step="0.01" name="lengte" value="<?= $boot['lengte'] ?>" placeholder="Lengte in meters" required>

                    <!-- BootTypeID Dropdown -->
                    <select name="bootTypeID" required>
                        <option value="">Selecteer een boot type</option>
                        <?php foreach ($types as $type): ?>
                            <option value="<?= $type['bootTypeID'] ?>" <?= ($boot['bootTypeID'] == $type['bootTypeID']) ? 'selected' : '' ?>>
                                <?= $type['typeBeschrijving'] ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                    
                    <textarea name="bootBeschrijving" placeholder="Beschrijving van de boot" required><?= $boot['bootBeschrijving'] ?></textarea>
                    <button type="submit" name="update" class="cta-button">Opslaan</button>
                </form>
            <?php endif; ?>

            <!-- Bevestigingsbericht -->
            <?php if ($bootBijgewerkt): ?>
                <p style="color: green; margin-top: 20px;">De bootgegevens zijn succesvol bijgewerkt!</p>
            <?php endif; ?>
        </section>