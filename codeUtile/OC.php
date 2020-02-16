<?php 

$array =[
    'items' => [
        'foo',
        'bar'
    ],

];

print_r($array);

// $object = json_decode(json_encode($array));
$object = (object)$array;

var_dump($object);

class Test{
    public $test = ['foo', 'bar'];

    public function testEcho(){
        echo "test";
    }
}

$test = new Test();
var_dump($test);

class Foo // méthode magique <3
{
    public function __call($method, $args)
    {
        if (isset($this->$method)) {
            $func = $this->$method;
            return call_user_func_array($func, $args);
        }
    }
}

$foo = new Foo();
$foo->bar = function () { echo "Hello, this function is added at runtime"; };
$foo->bar();

$nameFunction = "test";

$foo->$nameFunction = function () { echo "ça marche putain !"; };

$foo->$nameFunction();

$bool = true;
$anotherNameFunction = "AnotherNameFunction";

if ($bool) {
    $foo->$anotherNameFunction = function () { echo "Oh yeah !"; };

$foo->$anotherNameFunction();
}

class Robot {
    private $_win = 1;

    public function __call($method, $args)
    {
        if (isset($this->$method)) {
            $func = $this->$method;
            return call_user_func_array($func, $args);
        }
    }

    public function createFunction($nameFunction){
        if ($this->_win == 1){
            $this->$nameFunction = function () { echo "<p>Oh c'est trop bon !</p>"; };
            return $this->ifAnotherFunction($nameFunction);
        }
    }

    public function ifAnotherFunction($nameFunction){
        return $this->$nameFunction();
    }

}

$dominion = new Robot();
$dominion->createFunction("jouir");
$dominion->{'_name'} = "dominion";
echo $dominion->_name;

var_dump($dominion);
?>