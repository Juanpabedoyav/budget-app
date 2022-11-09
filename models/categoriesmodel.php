<?php 
class CategoriesModel extends Model implements IModel{


    private $id;
    private $name;
    private $color;
 

    public function __construct(){
        parent::__construct();
    }

    

    ///setters

    public function setId($id){ $this->id = $id;}
    public function setName($name){$this->name = $name;}
    public function setColor($color){$this->color = $color;}
   

    ///getter
    public function getId(){ return $this->id;}
    public function getName(){ return $this->name;}
    public function getColor(){ return $this->color;}


        public function exist($name){
            try {
                $query = $this->prepare('SELECT name FROM categories WHERE name = :name');
                $query->execute([
                    'name' => $name,
                ]);
                if($query->rowCount()) return true;
                return false;
            } catch (PDOExeption $e) {
                error_log('CategoriesModel:: get -> PDOEception' . $e );
                return false;
            }

        }

        public function save(){
            try {
                $query = $this->prepare('INSERT INTO categories (name, color) VALUES (:name, :color)');
                $query->execute([
                    'name' => $this->name,
                    'color' => $this->color,
                ]);
                if($query->rowCount()) return true;
                return false;
            } catch (PDOExeption $e) {
                error_log('CategoriesModel:: save -> PDOException' . $e );
                return false;
            }
        
        }

        public function getAll(){
            $items = [];
            try {
                $query = $this->query('SELECT * FROM categories');
                while ($p = $query->fetch(PDO::FETCH_ASSOC)) {
                    $item = new CategoriesModel();
                    $item->array($p);
                    array_push($items, $item);
                }
                return $items;
            } catch (PDOExeption $e) {
                error_log('CategoriesModel:: getAll -> PDOException' . $e );
                return false;
            }
        }

        public function get($id){
            try {
                $query = $this->prepare('SELECT * FROM categories WHERE id = :id');
                $query->execute([
                    'id' => $id,
                ]);
                $categories =  $query->fetch(PDO::FETCH_ASSOC);
                $this->form($categories);         
                return $this;
            } catch (PDOExeption $e) {
                error_log('CategoriesModel:: get -> PDOEception' . $e );
                return NULL;
            }
        }

        public function delete($id){
            try {
                $query = $this->prepare('DELETE FROM categories WHERE id = :id');
                $query->execute([
                    'id' => $id,
                ]);
                return true;
            } catch (PDOExeption $e) {
                error_log('CategoriesModel:: delete -> PDOEception' . $e );
                return false;
            }
        }
        public function update(){
            try {
                $query = $this->prepare('UPDATE categories SET name = :name, color = :name WHERE id = :id');
                $query->execute([
                    'id' => $this->id,
                    'name' => $this->name,
                    'color' => $this->color,
                ]);
                if($query->rowCount()) return true;
                return false;
            } catch (PDOExeption $e) {
                error_log('CategoriesModel:: update -> PDOEception' . $e );
                return false;
            }
        }
        public function from($array){
          $this->id = $array['id'];
          $this->name = $array['name'];
          $this->color = $array['color'];
            
        }

       
}

?>