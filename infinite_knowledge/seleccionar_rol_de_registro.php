<?php require_once('plantillas/head.php'); ?>

<body>
    <section>
        <div class="container">
            <img src="img/logo.png" alt="">
            <h3>Seleccionar su rol para registrarse:</h3>
            <br><br>
            <form method="post">
                <button><a href="registrar_director_academico.php">Director Académico</a></button>
                <button><a href="registrar_auxiliar_academico.php">Auxiliar Académico</a></button>
                <br><br><br><br>
                <button><a href="registrar_docente.php">Docente </a></button>
                <button><a href="registrar_estudiante.php">Estudiante</a></button>
                <br><br><br><br>
                <button>Regresar</button>
                <bUTton>Salir</bUTton>
            </form>
        </div>
    </section>
</body>
</html>