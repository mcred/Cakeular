<?php
class CakeularShell extends AppShell {
    public $tasks = array('Cakeular');
    public function main() {
        $this->Sound->execute();
    }
}
?>