<?php

class GithubRepositoryList {

    function __construct($name = null) {
        $this->name = $name;
        $this->repositories = $name ? GithubAPI::getRepositories($name, 1) : array();
        $this->prepareContributors();
    }

    function sortByName($direction, $page) {
        $this->repositories = GithubAPI::getRepositories($this->name, $page, 'full_name', $direction);
        $this->prepareContributors();
    }

    function prepareContributors(){
        foreach ($this->repositories as $key => $repository) {
            $repository->count_contributtors = count(GithubAPI::getContributors($this->name, $repository->name));
        }
    }

    function sortByContributors($direction) {
        usort($this->repositories, function($a, $b) use ($direction){
            if ($a == $b) {
                return 0;
            }
            $direction = $direction == 'asc' ? -1 : 1;
            return ($a->count_contributtors < $b->count_contributtors) ? ($direction * -1) : ($direction * 1);
        });
    }

    public function getRepositories(){
        return $this->repositories;
    }

    public function getSize(){
        return count($this->repositories);
    }

}



?>
