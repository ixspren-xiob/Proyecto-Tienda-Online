<%@ page language="java" contentType="text/html; charset=UTF-8" pageEncoding="UTF-8" %>
<!DOCTYPE html>
<html lang="es">
<head>
    <title>La Ciudad Del Libro</title>
    <link rel="icon" type="image/ico" href="img/icono.ico" sizes="64x64">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="./Css_general/bootstrap-5.3.3-dist/css/bootstrap.css" rel="stylesheet">
    <link href="./Css_general/css_propio/style.css" rel="stylesheet">
</head>
<body>

    <mi-menu></mi-menu>
    <main>
        <div class="fondo">
            <!-- Banner -->
            <div class="banner"> 
                    <h2>La Ciudad Del Libro</h2>
                    <h4>Tu tienda de ediciones especiales de libros</h4>          
            </div> 
           <!-- Sección de libros en desplazamiento -->
            <div>
                <div class="book-slider-wrapper">
                    <div class="book-slider">
                        <div class="book-slider-track">
                            <img src="./imagenes/elantris_ed_especial.jpg" alt="Elantris">
                            <img src="./imagenes/Aistant-to-the-Villain.jpg" alt="Asistente">
                            <img src="./imagenes/rebeca_yarrros.jpg" alt="Dragons">
                            <img src="./imagenes/el-familiar.jpg" alt="Libro 4">
                            <img src="./imagenes/acotar.jpg" alt="Libro 5">
                            <img src="./imagenes/rebeca_yarrros.jpg" alt="Dragons">
                            <!-- Repetimos los libros para un efecto continuo -->
                            <img src="./imagenes/elantris_ed_especial.jpg" alt="Elantris">
                            <img src="./imagenes/Aistant-to-the-Villain.jpg" alt="Asistente">
                            <img src="./imagenes/rebeca_yarrros.jpg" alt="Dragons">
                            <img src="./imagenes/el-familiar.jpg" alt="Libro 4">
                            <img src="./imagenes/acotar.jpg" alt="Libro 5">
                            <img src="./imagenes/rebeca_yarrros.jpg" alt="Dragons">
                        </div>
                    </div>
                </div>
            </div>

            <!-- Sección de tarjetas de libros -->
            <div class="elemento">
                <h2>Ediciones exclusivas de La Ciudad Del Libro</h2>
                <div class="h4 pb-2 mb-4 border-bottom"></div>
                <div class="container">
                    <div class="row">
                        <div class="col-md-4 col-sm-6 mb-4">
                            <div class="card h-100">
                                <img src="./imagenes/elantris_ed_especial.jpg" class="card-img-top" alt="Elantris">
                                <div class="card-body">
                                    <h5 class="card-title">Elantris</h5>
                                    <p class="card-text">Una novela de fantasía épica escrita por Brandon Sanderson.</p>
                                    <a href="libro.jsp?codigo=1" class="btn btn-primary">Ver más</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-6 mb-4">
                            <div class="card h-100">
                                <img src="./imagenes/Aistant-to-the-Villain.jpg" class="card-img-top" alt="Asistente">
                                <div class="card-body">
                                    <h5 class="card-title">Asistente</h5>
                                    <p class="card-text">Una historia intrigante sobre una asistente que trabaja para un villano.</p>
                                    <a href="libro.jsp?codigo=2" class="btn btn-primary">Ver más</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-6 mb-4">
                            <div class="card h-100">
                                <img src="./imagenes/rebeca_yarrros.jpg" class="card-img-top" alt="Dragons">
                                <div class="card-body">
                                    <h5 class="card-title">Dragons</h5>
                                    <p class="card-text">Una emocionante aventura de fantasía con dragones.</p>
                                    <a href="libro.jsp?codigo=3" class="btn btn-primary">Ver más</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="featured-section">
                <div class="content">
                    <h2 class="title">Tu próxima gran lectura te está esperando</h2>
                    <p class="description">
                        Sumérgete en nuevas historias, descubre mundos fascinantes y vive aventuras inolvidables. ¿Estás listo para el siguiente capítulo?
                    </p>
                    <a href="productos.jsp" class="cta-button">Explorar libros</a>
                </div>
            </div>
            <div class="featured2-section">
                <div class="content">
                    <h2 class="title">¿Te atreves con un Misterio?</h2>
                    <p class="description">
                        ¿No tienes clara tu próxima lectura? Atrévete con nuestros libros misteriosos. No sabrás cuál es hasta que llegue a tus manos...
                    </p>
                    <a href="libro.jsp?codigo=4" class="cta-button">???</a>
                </div>
            </div>

            <mi-pie></mi-pie>
        </div>
    </main>



    <script src="./js/mis-etiquetas.js"></script>
    <script src="./Css_general/bootstrap-5.3.3-dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>