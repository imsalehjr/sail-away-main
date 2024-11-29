<?php
$boten = $pdo->query("SELECT * FROM boot")->fetchAll(PDO::FETCH_ASSOC);
?>

<main>
        <section class="">
            <h2>Boten Lezen</h2>
            <p></p>
        </section>

        <section class="about">
            <table border="1" cellpadding="10" cellspacing="0">
                <thead>
                    <tr>
                        <th>Boot ID</th>
                        <th>Naam</th>
                        <th>Merk</th>
                        <th>Capaciteit</th>
                        <th>Bouwjaar</th>
                        <th>Lengte</th>
                        <th>Boot Type ID</th>
                        <th>Beschrijving</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($boten as $boot): ?>
                        <tr>
                            <td><?= htmlspecialchars($boot['bootID']) ?></td>
                            <td><?= htmlspecialchars($boot['bootNaam']) ?></td>
                            <td><?= htmlspecialchars($boot['merk']) ?></td>
                            <td><?= htmlspecialchars($boot['capaciteit']) ?></td>
                            <td><?= htmlspecialchars($boot['bouwjaar']) ?></td>
                            <td><?= htmlspecialchars($boot['lengte']) ?></td>
                            <td><?= htmlspecialchars($boot['bootTypeID']) ?></td>
                            <td><?= htmlspecialchars($boot['bootBeschrijving']) ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </section>
    </main>