<?php
/**
 * Created by PhpStorm.
 * User: Vanderlei Weber
 * Date: 23/08/2018
 * Time: 01:11
 */
/**
 * Função que busca as informações da url informada via Curl
 * @param $urlDaPesquisa
 * @return array de titulos
 */
function scraping_script($urlDaPesquisa)
{
    // Informo a url que pegarei o retorno
    $curl = curl_init($urlDaPesquisa);
    //Configuro que há retorno
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);
    //Configuro para não verificar o ssl, para casos como esse em que a navegação é por https
    curl_setopt($curl,CURLOPT_SSL_VERIFYPEER, false);
    //Executo via curl
    $page = curl_exec($curl);
    //Checagem de erros
    if(curl_errno($curl))
    {
        echo 'Mensagem de erro: ' . curl_error($curl);
        exit;
    }

    //Fecha o link
    curl_close($curl);

    //expressao regular para achar a tag do titulo
    $regex = '/<div class="views-field views-field-title">(.*?)<\/div>/s';

    if ( preg_match_all($regex, $page, $lista) )
        return $lista;
    else
        return false;
}