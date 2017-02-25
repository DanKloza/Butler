<?php
require '../../vendor/autoload.php';

class ButlerBase {

    private $firebase_instance;
    private $firebase_database;

    function __construct() {
        $this->firebase_instance = Firebase::fromServiceAccount(__DIR__.'/../../src/resources/FireBaseButler.json');
        $this->firebase_database = $this->firebase_instance->getDatabase();
    }

    public function get_user ($phone) {
        
        $user_conf = $this->firebase_database->getReference("users/$phone")->orderByKey("name")->getSnapshot();
        if ($user_conf->exists()) return $user_conf->getValue();
        else return null;
    }

    public function add_task_to_user ($phone, $subject, $time) {
        $user_conf = $this->firebase_database->getReference("users/$phone")->orderByKey('name')->getSnapshot();
        if ($user_conf->exists()) {
            $this->firebase_database->getReference("users/$phone/tasks/$time")->set(["task" => $subject]);
            return 0;
        } else {
            return -1;
        }
    }

    public function create_user ($phone, $name) {
        
        $user_conf = $this->firebase_database->getReference("users/$phone")->set([
            'name' => "$name",
            'phone' => "$phone",
            'preferences' => 0,
            'tasks' => []
        ]);
        //var_dump($user_conf);
        //var_dump($user_conf);
    }
}

//$bb = new ButlerBase();
//$bb->create_user("+17738291129", "Andriy");
//$bb->add_task_to_user("+17738291129", "walk the dog", strtotime("14:00 next thursday"));
//$result = $bb->get_user("+17738291129");
//var_dump($result);

//$bb->create_user("lil dicky");
//$bb->create_user("lil wayne");
//$bb->create_user("lil jonny");
//$bb->create_user("Johnny cash");
//$bb->create_user("Ammar");


?>
