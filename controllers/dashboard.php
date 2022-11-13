<?php

class Dashboard extends Controller{

    function __construct(){
        parent::__construct();
    error_log('Dashboard::construnct-> start Dashboard');
    }

    function render(){
       
         error_log('Dashboard::render-> start render Dashboard ');
       $expensesModel = new ExpensesModel();
       $expenses = $this->getExpenses(5); 
   // $totalThisMonth = $expensesModel->getTotalAmountThisMonth();
     $categories = $this->getCategories();
       $this->view->render('dashboard/index', [
        'expenses' => $expenses,
        'categories' => $categories,

       ]);
    }

    private function getExpenses($n = 0){
        if($n < 0) return NULL;
        

    }

    public function getCategories(){
        
    }

}

?>