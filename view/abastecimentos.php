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
        <body>
            <tbody>
              <?= filtrarAbastecimentos($filtroPrefixo, $filtroCombustivel, $filtroMarca, $filtroModelo, $filtroSetor, $filtrodataInicial, $filtrodataFinal); ?>
            </tbody>
         </table>
      </div>
     </div>
    </div>
    </div>
    </div>
    <script src="diesel-control-1.1/assets/js/scripts.js"></script>
    <script src="diesel-control-1.1/assets/js/fontawesome.all.min.js"></script>
    <script src="diesel-control-1.1/assets/js/bootstrap.bundle.min.v5.2.3.js"></script>
</body>
</html>