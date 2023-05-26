
    <style>
        body {
            background-color: #bfbfbf;
        }

        .imgnormalizada img {
            height: 600px !important;
            max-height: 600px !important;
        }

        .carrusel {
            width: 100% !important;
     
        }
        .justificado{
            text-align: justify !important;
            line-height: 30px !important;
        }
    </style>
    <div class="container contenedor">
        <?php include("../Header-Footer/header2.php"); ?>
        <br>
        <div id="carouselExampleAutoplaying" class="carousel slide carrusel" data-bs-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active imgnormalizada">
                    <img src="../images/2-1F516103020964.jpg" class="d-block w-100" alt="imagen">
                </div>
                <div class="carousel-item imgnormalizada">
                    <img src="../images/foto3.png" class="d-block w-100" alt="imagen">
                </div>
                <div class="carousel-item imgnormalizada">
                    <img src="../images/generador-electrico-construccion-1.png" class="d-block w-100" alt="imagen">
                </div>
                <div class="carousel-item imgnormalizada">
                    <img src="../images/sk-rental-1-896x504.png" class="d-block w-100" alt="imagen">
                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleAutoplaying"
                data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleAutoplaying"
                data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
        <br><br><br>

        <div class="row">
            <div class="col">
                <img src="../images/Diferencias-entre-obra-pública-y-obra-civil-v2-3.jpg" alt="imagen"
                    style="width: 700px !important;">
            </div>
            <div class="col justificado">
            ¡Bienvenidos a RentFacil, tu partner confiable en el mundo de los equipos industriales y la construcción! 
            Contamos con una amplia variedad de maquinarias en arriendo, especialmente diseñadas para satisfacer tus necesidades. 
            Además, ofrecemos servicios de estacionamiento especializados para el transporte seguro de tus equipos pesados. Nuestro 
            compromiso con la calidad nos distingue, entregando soluciones confiables para empresas, hogares y obras. ¡Confía en RentFacil 
            para llevar tus proyectos al siguiente nivel! Descubre por qué somos la opción preferida de los expertos de la industria y logra 
            el éxito en cada desafío. ¡Vamos juntos por el camino del éxito!
            </div>
        </div>


        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe"
            crossorigin="anonymous"></script>

        <br><br>
        <?php //include("../Header-Footer/footer.php"); ?>
    </div>
    <br><br>
</body>

</html>