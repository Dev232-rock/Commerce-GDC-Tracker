<?php
class Car {
  public $brand;
  public $model;

  function __construct($brand, $model) {
    $this->brand = $brand;
    $this->model = $model;
  }

  function __destruct() {
    echo "Brand: " . $this->brand . ". Model: " . $this->model . ".<br>";
  }
}

$car1 = new Car('Toyota', 'Corolla');
$car2 = new Car('Tesla', 'Model S');
?>

