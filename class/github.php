<?php

class GithubAPI {

    const API_URL = 'https://api.github.com/';
    const TOKEN = '';

    public static function getRepositories($name, $page, $sort_field = null, $sort_direct = null){
        $params = array(
            'per_page' => 5,
            'page' => $page
        );
        if($sort_field){
            $params += array(
                  'sort' => $sort_field,
                  'direction' => $sort_direct
            );
        }

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-length: 0', 'Content-type: application/json', 'Authorization: token '.self::TOKEN));
        curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 6.2; WOW64; rv:17.0) Gecko/20100101 Firefox/17.0');
        curl_setopt($ch, CURLOPT_URL, self::API_URL."orgs/".$name."/repos?".http_build_query($params));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $repositories = curl_exec($ch);
        curl_close($ch);

        $repositories = json_decode($repositories);

        if(isset($repositories->message) && $repositories->message = 'Not Found') return [];
        return $repositories;
    }

    public static function getContributors($name, $repo_name){
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-length: 0', 'Content-type: application/json', 'Authorization: token '.self::TOKEN));
        curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 6.2; WOW64; rv:17.0) Gecko/20100101 Firefox/17.0');
        curl_setopt($ch, CURLOPT_URL, self::API_URL."repos/".$name."/".$repo_name."/contributors");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $contributors = curl_exec($ch);
        curl_close($ch);

        return json_decode($contributors);
    }

}



?>
