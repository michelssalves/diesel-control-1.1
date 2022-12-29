
<style>
    #blanket,#aguarde {
    position: fixed;
    display: none;
}

#blanket {
    left: 0;
    top: 0;
    background-color: #f0f0f0;
    filter: alpha(opacity = 65);
    height: 100%;
    width: 100%;
    -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=65)";
    opacity: 0.65;
    z-index: 9998;
}

#aguarde {
    width: auto;
    height: 30px;
    top: 40%;
    left: 45%;
    background: url('http://i.imgur.com/SpJvla7.gif') no-repeat 0 50%;
    line-height: 30px;
    font-weight: bold;
    font-family: Arial, Helvetica, sans-serif;
    z-index: 9999;
    padding-left: 27px;
}
</style>
<script>
    $(document).ready(function() {
    $('.btn-theme').click(function(){
        $('#aguarde, #blanket').css('display','block');
    });
});
</script>
<body>
<div id="blanket"></div>
<div id="aguarde">Aguarde...</div> 

<?php
session_start();
include '../model/Abastecimentos.php';
include '../controller/abastecimentosController.php';
include 'header.php';
            if ($_SESSION['id_permissao'] > 1) {

                include 'menuAdm.php';
            } else {

                include 'menuOperador.php';
            }
            ?>
            <tbody>
              <?= filtrarAbastecimentos($filtroPrefixo, $filtroCombustivel, $filtroMarca, $filtroModelo, $filtroSetor, $filtrodataInicial, $filtrodataFinal); ?>
            </tbody>
         </table>
      </div>
     </div>
    </div>
    </div>
    <script src="diesel-control-1.1/assets/js/scripts.js"></script>
    <script src="diesel-control-1.1/assets/js/fontawesome.all.min.js"></script>
    <script src="diesel-control-1.1/assets/js/bootstrap.bundle.min.v5.2.3.js"></script>
</body>
</html>