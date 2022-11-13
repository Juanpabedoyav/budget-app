<?php 

class JoinExpensesCategoriesModel extends Model{

    private $expenseId;
    private $title;
    private $amount;
    private $categoryId;
    private $date;
    private $userId;
    private $nameCategory;
    private $color;

    public function __construct(){
        parent::__construct();
    }

    public function getAll($userid){
        $items = [];
        try {
            $query = $this->query('SELECT expenses.id as expense_id, title, category_id, amount, date, id_user, categories.id, name, color INNER JOIN categories WHERE expenses.categoy_id = categories.id AND expenses.id_user = :userid');
            $query->execute([
                'userid' => $userid
            ]);
            while ($p = $query->fetch(PDO::FETCH_ASSOC)) {
                $item = new JoinExpensesCategoriesModel();
                $item->from($p);
                array_push($items, $item);
            }
            return $items;
        } catch (PDOExeption $e) {
            error_log('JoinExpensesCategoriesModel:: getAll -> PDOException' . $e );
            return false;
        }
    }

    public function from($array){

        $this->expenseId   = $array['expense_id'];
        $this->title        = $array['title'];
        $this->amount       = $array['amount'];
        $this->categoryId   = $array['category_id'];
        $this->date         = $array['date'];
        $this->userId       = $array['id_user'];
        $this->nameCategory = $array['name'];
        $this->color        = $array['color'];

    }
    
    public function toArray(){
        $array = [];
        $array['expense_id']  = $this->expenseId; 
        $array['title']       = $this->title;
        $array['amount']      = $this->amount; 
        $array['category_id'] =  $this->categoryId; 
        $array['date']        =  $this->date; 
        $array['id_user']     =  $this->userId; 
        $array['name']        = $this->nameCategory;
        $array['color']       = $this->color; 
        return $array; 
       }

       public function getExpenseId(){ return $this->expenseId;}
       public function getTitle(){ return $this->title;}
       public function getAmount(){ return $this->amount;}
       public function getCategoryId(){ return $this->categoryId;}
       public function getDate(){ return $this->date;}
       public function getUserId(){ return $this->userId;}
       public function getNameCategory(){ return $this->nameCategory;}
       public function getColor(){ return $this->color;;} 

       public function setExpenseId($expenseId){$this->expenseId = $expenseId;}
       public function setTitle($title){$this->title = $title;}
       public function setAmount($amount){$this->amount = $amount;}
       public function setCategoryId($categoryId){$this->categoryId = $categoryId;}
       public function setDate($date){$this->date = $date;}
       public function setUserId($userId){$this->userId = $userId;}
       public function setNameCategory($nameCategory){$this->nameCategory = $nameCategory;}
       public function setColor($color){$this->color = $color;} 
}

?>