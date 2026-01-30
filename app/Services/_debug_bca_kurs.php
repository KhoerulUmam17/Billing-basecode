LOG BCA KURS DEBUG
<?php
file_put_contents(storage_path('logs/bca_kurs_debug.log'), print_r($kurs, true));
