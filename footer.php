    </section>
    <footer>
        <a href="http://<?= $_SERVER['HTTP_HOST'] .'/' ?>blissim/index.php">Retour à l'accueil</a><br>
        <small class="credits">Créé par Anaïs Benslimane, le 18 Décembre 2020 pour Blissim</small>
    </footer>
    <script>
        'use strict';
        document.querySelectorAll('.edit-comment-btn').forEach((btn) => {
            const id = btn.id;
            btn.addEventListener('click', (e) => {
            e.preventDefault();
            document.querySelector('#edit-comment-form-' + id ).classList.toggle('hidden');
            })
        });

    </script>
</body>
</html>