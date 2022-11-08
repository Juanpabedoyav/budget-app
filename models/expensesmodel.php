<?php 
class ExpensesModel extends Model implements IModel{


    private $id;
    private $title;
    private $mount;
    private $categoryid;
    private $date;
    private $userid;


    public function __construct(){
        parent::__construct();
    }

    

    

}

?>