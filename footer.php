</main>
<footer>
    <p>
        <strong>&copy; THE ARTBOX par Aly Diabira - <span id="current-time"></span></strong> 
        - <em>Tous droits réservés</em>
    </p>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            function updateTime() {
                const date = new Date();
                document.getElementById("current-time").textContent = date.toLocaleString("fr-FR", { 
                    day: "2-digit", month: "2-digit", year: "numeric", 
                    hour: "2-digit", minute: "2-digit", second: "2-digit"
                });
            }
            updateTime(); // Mettre à jour immédiatement
            setInterval(updateTime, 1000); // Actualiser chaque seconde
        });
    </script>
</footer>
</body>
</html>

</body>
</html>
