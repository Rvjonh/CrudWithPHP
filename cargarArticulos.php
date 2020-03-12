<?php 
    require 'database.php';
    
    $records = $conn->prepare('SELECT * FROM publicaciones');


    if($records->execute()){
        $results = $records->fetch(PDO::FETCH_ASSOC);
        
        while ($results!=null){
            
            echo '
            <article id="articulosEscritos">
                    <h3>'.$results["titulo"].'</h3>
                    <p>'.$results["descripcion"].'</p>
                    <span>'.$results["fecha"].'</span>
                    <form action="borrarArticulo.php" method="POST">
                        <input name="numero" type="hidden" value="'.$results['id'].'" readonly>
                        <button>Eliminar</button>
                    </form>
            </article>
            ';

            $results = $records->fetch(PDO::FETCH_ASSOC);
        }

    }else{
        echo "Fallo en conexcion a base de datos";
    }


?>