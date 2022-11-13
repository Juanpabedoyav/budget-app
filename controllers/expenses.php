<?php 
require_once 'models/expensesmodel.php';
require_once 'models/usermodel.php';

class Expenses extends Controller{
        private $user;

        function __construct(){
            parent:: __construct();
            $usermodel = new UserModel();
            $this->user = $usermodel->getUsername();
            error_log('Expenses::Construct -> expenses of' . $usermodel->getUsername());
        }

        function render(){
            $this->view->render('expenses/index',[
                'user' => $this->user,
            ]);
        }


        function newExpense(){
            if(!$this->existPost(['title', 'amount','category', 'date'])){
                $this->redirect('dashboard', []); //ERRROR
                return;
            }
            if($this->user === NULL){
                $this->redirect('dashboard', []); //ERRROR
                return;
            }
              $expenses = new ExpensesModel();
              $expenses->setTitle($this->getPost('title'));
              $expenses->setMount((float)$this->getPost('amount'));
              $expenses->setCategoryid($this->getPost('category'));
              $expenses->setDate($this->getPost('date'));
              $expenses->setUserid($this->user->getId());
              $expenses->save();
             $this->redirect('dashboard', []);
        }
        
}


?>