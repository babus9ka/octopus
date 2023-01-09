<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

class RateComponentClass extends CBitrixComponent {

   function GetRate(){
       $curl = curl_init();
       curl_setopt_array($curl, array(
           CURLOPT_URL => 'https://www.cbr-xml-daily.ru/daily_json.js',
           CURLOPT_RETURNTRANSFER => true,
           CURLOPT_ENCODING => '',
           CURLOPT_MAXREDIRS => 10,
           CURLOPT_TIMEOUT => 0,
           CURLOPT_FOLLOWLOCATION => true,
           CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
           CURLOPT_CUSTOMREQUEST => 'GET',
       ));

       $response = curl_exec($curl);

       curl_close($curl);
        if (!empty($response)){
               $response = json_decode($response, true);
               $arResult['VALUES'][] = $response['Valute']['USD'];
               $arResult['VALUES'][] = $response['Valute']['EUR'];
        }

       return $arResult;
    }

    function MarkUp($arResult, $arParams){
       if ($this->getUserID()) {
           if (!empty($arParams['MARKUP_USER'])) {
               for ($i= 0; $i < count($arResult['VALUES']); $i++) {
                   $PercentInt = $arResult['VALUES'][$i]['Value'] * (intval($arParams['MARKUP_USER']) / 100);
                   $arResult['RATES'][$i]['VALUE'] = $arResult['VALUES'][$i]['Value'] + $PercentInt;
                   $arResult['RATES'][$i]['NAME'] = $arResult['VALUES'][$i]['CharCode'];
               }
           } else {
               for ($i= 0; $i < count($arResult['VALUES']); $i++) {
                   $arResult['RATES'][$i]['VALUE'] = $arResult['VALUES'][$i]['Value'];
                   $arResult['RATES'][$i]['NAME'] = $arResult['VALUES'][$i]['CharCode'];
               }
           }
       } else {
           if (!empty($arParams['MARKUP'])) {
               for ($i= 0; $i < count($arResult['VALUES']); $i++) {
                   $PercentInt = $arResult['VALUES'][$i]['Value'] * (intval($arParams['MARKUP']) / 100);
                   $arResult['RATES'][$i]['VALUE'] = $arResult['VALUES'][$i]['Value'] + $PercentInt;
                   $arResult['RATES'][$i]['NAME'] = $arResult['VALUES'][$i]['CharCode'];
               }
           } else {
               for ($i= 0; $i < count($arResult['VALUES']); $i++) {
                   $arResult['RATES'][$i]['VALUE'] = $arResult['VALUES'][$i]['Value'];
                   $arResult['RATES'][$i]['NAME'] = $arResult['VALUES'][$i]['CharCode'];
               }
           }
       }

        return $arResult;
    }

    function getUserID(){
        global $USER;
        return $USER->GetID();
    }

    public function executeComponent() {

       $this->arResult = array_merge($this->arResult, $this->GetRate());
       $this->arResult = array_merge($this->arResult, $this->MarkUp($this->arResult, $this->arParams));
       $this -> includeComponentTemplate();
    }
}
?>





