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

    

    ///setters

    public function setId($id){ $this->id = $id;}
    public function setTitle($title){$this->title = $title;}
    public function setMount($mount){$this->mount = $mount;}
    public function setCategoryid($categoryid){$this->categoryid = $categoryid;}
    public function setDate($date){$this->date = $date;}
    public function setUserid($userid){$this->userid = $userid;}


    ///getter
    public function getId(){ return $this->id;}
    public function getTitle(){ return $this->title;}
    public function getMount(){ return $this->mount;}
    public function getCategoryid(){ return $this->categoryid;}
    public function getDate(){ return $this->date;}
    public function getUserid(){ return $this->userid;}

        public function save(){
            
            try {
                $query = $this->prepare('INSERT INTO expenses (title, mount, category_id, date, id_user ) VALUES (:title, :mount, :category_id, :dat, :user)');
                $query->execute([
                    'title' => $this->title,
                    'mount' => $this->mount,
                    'category_id' => $this->categoryid,
                    'dat' => $this->date,
                    'user' => $this->userid,
                ]);
                if($query->rowCount()) return true;
                return false;
            } catch (PDOExeption $e) {
                error_log('ExpensesModel:: save -> PDOException' . $e );
                return false;
            }
        }

        public function getAll(){
            $items = [];
            try {
                $query = $this->query('SELECT * FROM expenses');
                while ($p = $query->fetch(PDO::FETCH_ASSOC)) {
                    $item = new ExpensesModel;
                    $item->from($p);
                    array_push($items, $item);
                }                
                return $items;
            } catch (PDOExeption $e) {
                error_log('ExpensesModel:: getAll -> PDOException' . $e );
                return false;
            }
        }

        public function get($id){
            try {
                $query = $this->prepare('SELECT * FROM expenses WHERE id = :id');
                $query->execute([
                    'id' => $id,
                ]);
                $expenses =  $query->fetch(PDO::FETCH_ASSOC);
                $this->from($expenses);         
                return $this;
            } catch (PDOExeption $e) {
                error_log('ExpensesModel:: get -> PDOEception' . $e );
                return false;
            }
        }

        public function delete($id){
            try {
                $query = $this->prepare('DELETE FROM expenses WHERE id = :id');
                $query->execute([
                    'id' => $id,
                ]);
                return true;
            } catch (PDOExeption $e) {
                error_log('ExpensesModel:: delete -> PDOEception' . $e );
                return false;
            }
        }
        public function update(){
            try {
                $query = $this->prepare('UPDATE expenses SET title = :title, amount = :mount, category_id = :category_id, date = :dat, id_user = :user WHERE id = :id');
                $query->execute([
                    'id' => $this->id,
                    'title' => $this->title,
                    'mount' => $this->mount,
                    'category_id' => $this->categoryid,
                    'dat' => $this->date,
                    'user' => $this->userid,
                ]);
                if($query->rowCount()) return true;
                return false;
            } catch (PDOExeption $e) {
                error_log('ExpensesModel:: update -> PDOException' . $e );
                return false;
            }
        }
        public function from($array){
            $this->id = $array['id'];
            $this->title = $array['id'];
            $this->mount = $array['title'];
            $this->categoryid = $array['category_id'];
            $this->date = $array['date'];   
            $this->userid = $array['id_user'];
   
        }

        public function getAllByUserId($userid){
            $items = [];
            try {
                $query = $this->prepare('SELECT * FROM expenses WHERE id_user = :userid');
                $query->execute([
                    'userid' => $userid,
                ]);
                while ($p = $query->fetch(PDO::FETCH_ASSOC)) {
                    $item = new ExpensesModel;
                    $item->from($p);
                    array_push($items, $item);
                }                
                return $items;
            } catch (PDOExeption $e) {
                error_log('ExpensesModel:: getAllByUserId -> PDOException' . $e );
                return [];
            }
        }

        public function getAllByUserIdAndLimit($userid, $n){
            $items = [];
            try {
                $query = $this->prepare('SELECT * FROM expenses WHERE id_user = :userid ORDER BY expenses.date DESC LIMIT 0, :n');
                $query->execute([
                    'userid' => $userid,
                    'n' => $n,
                ]);
                while ($p = $query->fetch(PDO::FETCH_ASSOC)) {
                    $item = new ExpensesModel;
                    $item->from($p);
                    array_push($items, $item);
                }                
                return $items;
            } catch (PDOExeption $e) {
                error_log('ExpensesModel:: getAllByUserIdAndLimit -> PDOException' . $e );
                return [];
            }
        }

        public function getTotalAmountThisMonth($userid){
            try {
                $year = date('Y');
                $month = date('m');
                $query = $this->prepare('SELECT SUM(amount) AS total FROM expenses WHERE YEAR(date) =:year AND MONTH(date) = :month AND id_user = :userid');
                $query->execute([
                    'userid' => $userid,
                    'year' => $year,
                    'month' => $month,

                ]);
              $total = $query->fetch(PDO::FETCH_ASSOC)['total'];
              if($total === NULL) $total = 0;
              return $total;
            } catch (PDOExeption $e) {
                error_log('ExpensesModel:: getTotalAmountThisMonth -> PDOException' . $e );
                return NULL;
            }
        }
        public function getMaxExpensesThisMonth($userid){
            try {
                $year = date('Y');
                $month = date('m');
                $query = $this->prepare('SELECT MAX(amount) AS total FROM expenses WHERE YEAR(date) =:year AND MONTH(date) = :month AND id_user = :userid');
                $query->execute([
                    'userid' => $userid,
                    'year' => $year,
                    'month' => $month,

                ]);
              $total = $query->fetch(PDO::FETCH_ASSOC)['total'];
              if($total === NULL) $total = 0;
              return $total;
            } catch (PDOExeption $e) {
                error_log('ExpensesModel:: getMaxExpensesThisMonth -> PDOException' . $e );
                return NULL;
            }
        }
        public function getTotalByCategoryThisMonth($categoryid, $userid){
            try {
                $total = 0;
                $year = date('Y');
                $month = date('m');
                $query = $this->prepare('SELECT MAX(amount) AS total FROM expenses WHERE category_id = :categoryid AND YEAR(date) =:year AND MONTH(date) = :month AND id_user = :userid');
                $query->execute([
                    'userid' => $userid,
                    'year' => $year,
                    'month' => $month,
                    'category_id' =>$categoryid

                ]);
              $total = $query->fetch(PDO::FETCH_ASSOC)['total'];
              if($total === NULL) $total = 0;
              return $total;
            } catch (PDOExeption $e) {
                error_log('ExpensesModel:: getTotalByCategoryThisMonth -> PDOException' . $e );
                return NULL;
            }
        }
        public function getNumberOfExpensesByCategoryThisMonth($categoryid, $userid){
            try {
                $total = 0;
                $year = date('Y');
                $month = date('m');
                $query = $this->prepare('SELECT COUNT(amount) AS total FROM expenses WHERE category_id = :categoryid AND YEAR(date) =:year AND MONTH(date) = :month AND id_user = :userid');
                $query->execute([
                    'userid' => $userid,
                    'year' => $year,
                    'month' => $month,
                    'category_id' =>$categoryid

                ]);
              $total = $query->fetch(PDO::FETCH_ASSOC)['total'];
              if($total === NULL) $total = 0;
              return $total;
            } catch (PDOExeption $e) {
                error_log('ExpensesModel:: getNumberOfExpensesByCategoryThisMonth -> PDOException' . $e );
                return NULL;
            }
        }
}

?>