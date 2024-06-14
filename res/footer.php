<footer class="fixed-bottom bg-light text-center py-3">
    <p>&copy; Tecnología Educativa, UNAN - Managua 2024</p>
</footer>

<!-- Biblioteca jQuery -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert2/11.11.0/sweetalert2.all.js"></script>
<!-- DataTables -->
<script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.10.23/datatables.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.13/index.global.min.js'></script>
<script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.13/locale/es.js'></script> <!-- Incluye el archivo de idioma español desde un CDN -->

<script>

        document.addEventListener('DOMContentLoaded', function() {
        var calendarEl = document.getElementById('calendar');
        var calendar = new FullCalendar.Calendar(calendarEl, {
        initialView: 'dayGridMonth',
            locale: 'es' // Especifica el idioma a español
        });
        calendar.render();
    });

</script>


<script>
    $(document).ready(function() {
        $('#MiTabla').DataTable({
            responsive: true
        });
    });
</script>

</body>
</html>
