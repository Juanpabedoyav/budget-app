<?php 

class UserModel extends Model implements IModel{


private $id;
private $username;
private $password;
private $role;
private $budget;
private  $photo;
private  $name;

    function __construct(){
        parent::__construct();
       $this->id = '';
       $this->username = '';
       $this->password = '';
       $this->role = '';
       $this->budget = 0.0;
       $this->photo =  '';
       $this->name =  '';

    }

    public function save(){
        try {
            $query = $this->prepare('INSERT INTO users (username, password, role, budget, photo, name) VALUES(:username, :password, :role, :budget, :photo, :name)');
            $query->execute([
                'username' => $this->username,
                'password' => $this->password,
                'role' => $this->role,
                'budget' => $this->budget,
                'photo' =>$this->photo,
                'name' => $this->name,
            ]);    
            return true;
        } catch (PDOExeption $e) {
            error_log('USERMODEL:: save -> PDOException' . $e );
            return false;
        }
    }
    public function getAll(){
        $items = [];
        try {
            $query = $this->query('SELECT * FROM users');
            while( $p = $query->fetch(PDO::FETCH_ASSOC)){
                $item = new UserModel();
                $item->setId($p['id']);
                $item->setUsename($p['username']);
                $item->setPassword($p['password']);
                $item->setRole($p['role']);
                $item->setBudget($p['budget']);
                $item->setphoto($p['photo']);
                $item->setname($p['name']);
            
                array_push($items, $item);
            }
            return $items;
        } catch (PDOExeption $e) {
            error_log('USERMODEL:: getAll -> PDOEception' . $e );
            return false;
        }

    }
    public function get($id){

        try {
            $query = $this->prepare('SELECT * FROM users WHERE id = :id');
            $query->execute([
                'id' => $id,
            ]);
            $user =  $query->fetch(PDO::FETCH_ASSOC);
                $this->setId($user['id']);
                $this->setUsename($user['username']);
                $this->setPassword($user['password']);
                $this->setRole($user['role']);
                $this->setBudget($user['budget']);
                $this->setphoto($user['photo']);
                $this->setname($user['name']);            
            
            return $this;
        } catch (PDOExeption $e) {
            error_log('USERMODEL:: get -> PDOEception' . $e );
            return false;
        }

    }
    public function delete($id){
        try {
            $query = $this->prepare('DELETE FROM users WHERE id = :id');
            $query->execute([
                'id' => $id,
            ]);
            return true;
        } catch (PDOExeption $e) {
            error_log('USERMODEL:: delete -> PDOEception' . $e );
            return false;
        }
    }
    public function update(){
        try {
            $query = $this->prepare('UPDATE users SET username = :username, password = :password, role = :role, budget = :budget, photo = :photo, name = :name  FROM users WHERE id = : id');
            $query->execute([
                'id' => $this->id,
                'username' => $this->username,
                'password' => $this->password,
                'role' => $this->role,
                'budget' => $this->budget,
                'photo' =>$this->photo,
                'name' => $this->name,
            ]);      
        
        return true;
        } catch (PDOExeption $e) {
            error_log('USERMODEL:: update -> PDOEception' . $e );
            return false;
        }
    }
    public function from($array){
        $this->id = $array['id'];
        $this->username = $array['username'];
        $this->password = $array['password'];
        $this->role = $array['role'];
        $this->budget = $array['budget'];
        $this->photo =  $array['photo'];
        $this->name =  $array['name'];
    }

public function exist($username){
    
    try {
        $query = $this->prepare('SELECT username FROM users WHERE username = :username');
        $query->execute([
            'username' => $username,
        ]);
        if($query->rowCount() > 0){
            return true;
        }else{
            return false;
        } 
            
        
  
    } catch (PDOExeption $e) {
        error_log('USERMODEL:: exist -> PDOEception' . $e );
        return false;
    }
}

public function comparePasswords($password, $id){
    try {
     $user =  $this->get($id);

       return password_verify($password , $user->getPassword());
    } catch (PDOExeption $e) {
        error_log('USERMODEL:: comparePasswords -> PDOEception' . $e );
        return false;
    }


}

   //setter   
    public function setId($id){ $this->id = $id;}
    public function setUsername($username){$this->username = $username;}
    
    private function getHashedPassword($password){
     return password_hash($password, PASSWORD_DEFAULT, ['cost' => 10]);
    }


    public function setPassword($password){
        $this->password = $this->getHashedPassword($password);
    }

    public function setRole($role){$this->role = $role;}
    public function setBudget($budget){$this->budget = $budget;}
    public function setphoto($photo){$this->photo = $photo;}
    public function setname($name){$this->name = $name;}

    //getter

    public function getId(){ return $this->id; }
    public function getUsername(){ return $this->username ;}
    public function getPassword(){ return $this->password ;}
    public function getRole(){ return $this->role ;}
    public function getBudget(){ return $this->budget;}
    public function getphoto(){ return $this->photo ;}
    public function getname(){ return $this->name;}
   

}





?>