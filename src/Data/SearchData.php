<?php

namespace App\Data;

use App\Entity\Ville;

class SearchData
{
    /**
     * @var int
     */
    public $page = 1;
    
    /**
     * @var  string
     */
    public $q = '';

    /**
     * @var Ville[]
     */
    public $ville_arrive =[];

    /**
     * @var Ville[]
     */
    public $ville_depart =[]; 

    /**
     * @var boolean
     */

    public $dispo = false;



}