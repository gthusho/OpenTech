<?php

namespace App;

 class ImageManager
{
     /**
      * METODO SE ENCARGA DE CREAR UNA IMAGEN A PARTIR DE UNA DIRECCION
      * @param $path
      * @param bool|false $user_functions
      * @return bool
      */
     static function imagecreatefromfile($path, $user_functions = false)
     {
         $info = @getimagesize(url($path));

         if(!$info)
         {
             return false;
         }

         $functions = array(
             IMAGETYPE_GIF => 'imagecreatefromgif',
             IMAGETYPE_JPEG => 'imagecreatefromjpeg',
             IMAGETYPE_PNG => 'imagecreatefrompng',
             IMAGETYPE_WBMP => 'imagecreatefromwbmp',
             IMAGETYPE_XBM => 'imagecreatefromwxbm',
         );

         if($user_functions)
         {
             $functions[IMAGETYPE_BMP] = 'imagecreatefrombmp';
         }

         if(!$functions[$info[2]])
         {
             return false;
         }

         if(!function_exists($functions[$info[2]]))
         {
             return false;
         }

         return $functions[$info[2]]($path);
     }

     /**
      * METODO QUE REDIMENSIONA Y QUITA TAMAÑO A LAS IMAGENES
      * ruta completa de la imagen
      * @param $path_image
      * ruta donde se va guardar la nueva imagen
      * @param $dndGuardar
      * tamañao maximo
      * @param $_max
      * tamaño minimo
      * @param $_min
      * calidad de la imagen
      * @param $_calidad
      * retorna solo el nombre de la imagen generada
      * @return string
      */
     static public function doWork($path_image, $dndGuardar, $_max, $_min, $_calidad){
         //Ruta de la imagen original
         $rutaImagenOriginal=$path_image;

         //Creamos una variable imagen a partir de la imagen original
         $img_original = ImageManager::imagecreatefromfile($path_image);

         //Se define el maximo ancho o alto que tendra la imagen final
         $max_ancho = $_max;
         $max_alto = $_min;

         //Ancho y alto de la imagen original
         list($ancho,$alto)=getimagesize($path_image);

         //Se calcula ancho y alto de la imagen final
         $x_ratio = $max_ancho / $ancho;
         $y_ratio = $max_alto / $alto;

         //Si el ancho y el alto de la imagen no superan los maximos,
         //ancho final y alto final son los que tiene actualmente
         if( ($ancho <= $max_ancho) && ($alto <= $max_alto) ){//Si ancho
             $ancho_final = $ancho;
             $alto_final = $alto;
         }
         /*
          * si proporcion horizontal*alto mayor que el alto maximo,
          * alto final es alto por la proporcion horizontal
          * es decir, le quitamos al alto, la misma proporcion que
          * le quitamos al alto
          *
         */
         elseif (($x_ratio * $alto) < $max_alto){
             $alto_final = ceil($x_ratio * $alto);
             $ancho_final = $max_ancho;
         }
         /*
          * Igual que antes pero a la inversa
         */
         else{
             $ancho_final = ceil($y_ratio * $ancho);
             $alto_final = $max_alto;
         }

         //Creamos una imagen en blanco de tama�o $ancho_final  por $alto_final .
         $tmp=imagecreatetruecolor($ancho_final,$alto_final);

         //Copiamos $img_original sobre la imagen que acabamos de crear en blanco ($tmp)
         imagecopyresampled($tmp,$img_original,0,0,0,0,$ancho_final, $alto_final,$ancho,$alto);

         //Se destruye variable $img_original para liberar memoria
         imagedestroy($img_original);

         //Definimos la calidad de la imagen final
         $calidad=$_calidad;

         //Se crea la imagen final en el directorio indicado
         $nombreImagen = uniqid().uniqid().'.jpg';
         imagejpeg($tmp,$dndGuardar.$nombreImagen,$calidad);

         /* SI QUEREMOS MOSTRAR LA IMAGEN EN EL NAVEGADOR
          *
          * descomentamos las lineas 64 ( Header("Content-type: image/jpeg"); ) y 65 ( imagejpeg($tmp); )
          * y comentamos la linea 57 ( imagejpeg($tmp,"./imagen/retoque.jpg",$calidad); )
          */
         // Header("Content-type: image/jpeg");
         //return imagejpeg($tmp);
         return $nombreImagen;
     }

     /**
      * EL METODO SE ENCARGA DE SUBIR IMAGENES AL SERVIDOR.
      * Y AL MISMO TIEMPO DE GENERAR UNA NUEVA IMAGEN CON UN PESO MAS LIGERO Y APTO PARA LA WEB
      * ruta completa de la imagen ej.: 'system/ruta/imagen.jpg
      * @param $imagen
      * ruta para almacenar imagenes temporales ej.: 'system/temp/
      * @param $rutatemp
      * ruta oficial donde se debe almacenar la imagen 'system/imagenes/
      * @param $rutaOficial
      * tamaño maximo recibe valores enteros
      * @param int $max
      * tamaño minimo recibe valores enteros
      * @param int $min
      * calidad en la que se generara la imagen
      * @param int $calidad
      * retorna el nombre del archivo creado
      * @return string
      */
     static function crearImagen($imagen, $rutatemp, $rutaOficial, $max=800, $min=800, $calidad=95){

         $nombreImagen = uniqid().strtotime(date('d/m/Y')).'.'.$imagen->getClientOriginalExtension();
         $imagen->move($rutatemp,$nombreImagen);
         $ruta = $rutatemp.$nombreImagen;
         $nuevaImagen = ImageManager::doWork($ruta,$rutaOficial,$max,$min,$calidad);
         \File::Delete($ruta);
         return $nuevaImagen;
     }
}