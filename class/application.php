<?php


class Application {

    function index() {

        $page = isset($_GET['page']) ? $_GET['page'] : 1;
        $arr = new GithubRepositoryList();

        if(isset($_GET['user'])){
            $arr = new GithubRepositoryList($_GET['user']);
        }

        if(isset($_GET['sort'])){

            if($_GET['direction'] == 'asc' || $_GET['direction'] == 'desc'){
                if($_GET['sort'] == 'name'){
                    $arr->sortByName($_GET['direction'], $page);
                }
                if($_GET['sort'] == 'contributors'){
                    $arr->sortByContributors($_GET['direction']);
                }
            }

        }

        $this->data = $arr;
        $this->display('index');
    }

    function display($view) {
        echo '<link rel="stylesheet" href="/style.css">';
        include "views/".$view.".php";
    }

}




?>
