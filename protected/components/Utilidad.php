<?php

class Utilidad extends CApplicationComponent{

        /**
         * 
         * @param date $fecha1 formato dd/mm/yyyy
         * @param date $fecha2 formato dd/mm/yyyy
         * @param string $comparador
         */
        public function compararRangoFechas($fecha1, $fecha2, $comparador = "=="){
                $fecha1 = Yii::app()->format->FormatoFechaComparar($fecha1);
                $fecha2 = Yii::app()->format->FormatoFechaComparar($fecha2);
                switch ($comparador){
                        case "==": return $fecha1 == $fecha2? true:false;
                        case "!=": return $fecha1 != $fecha2? true:false;
                        case "<": return $fecha1 < $fecha2? true:false;
                        case "<=": return $fecha1 <= $fecha2? true:false;
                        case ">": return $fecha1 > $fecha2? true:false;
                        case ">=": return $fecha1 >= $fecha2? true:false;
                        default: return $fecha1 == $fecha2? true:false;
                }
        }
        
        public function acortarTexto($texto, $limite_caracteres)
        {
            $texto = trim($texto);
            if (strlen($texto) > $limite_caracteres+1)
            {
                $nuevo_texto = trim(mb_substr($texto, 0, $limite_caracteres, Yii::app()->charset));                
                return $nuevo_texto . "...";
            }
            else
            {
                return $texto;
            }
        }
        
}
?>
