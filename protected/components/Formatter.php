<?php

class Formatter extends CFormatter {
    
    public function formatBoolean($value){
            return $value ? Yii::t('app', $this->booleanFormat[1]) : Yii::t('app',$this->booleanFormat[0]);
    }
    
    public function formatDecimal($value){
        return $value ? Yii::app()->NumberFormatter->formatDecimal($value) : $value;
    }
 
    public function formatHeadline($value) {
        return '<b>' . $value . '</b>';
    }
    
    public function FormatoFechaBD($value){
        if(!empty($value))
            return date(Yii::app()->params['dateOutcomeFormat'], CDateTimeParser::parse($value, Yii::app()->locale->dateFormat));
        return $value;
    }
    
    public function FormatoFechaApp($value){
        if(!empty($value))
            return date(Yii::app()->dateFormatter->formatDateTime(CDateTimeParser::parse($value, Yii::app()->params['dateIncomeFormat']),'medium',null));
        return $value;
    }
    
    /**
     * 
     * @param date $value
     * @param bool $formatoApp
     * @return int timestamp
     */
    public function FormatoFechaComparar($value, $formatoApp = true){
        if(!empty($value)){
                if($formatoApp)
                        return strtotime($this->FormatoFechaBD($value));
                else 
                        return strtotime($value);;
        }
        return $value;
    }
    
}
?>
