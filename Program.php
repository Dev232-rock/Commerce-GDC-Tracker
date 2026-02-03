<?php
class Car{
        private $brand;
        public function setBrand($brand) {
                $this->brand = $brand;
        }
        public function  getBrand() {
                return $this->brand;
        }
}
$car = new Car();
$car->setBrand("BMW");
echo $car->getBrand();
?>
