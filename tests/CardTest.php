<?php
include 'Autoloader.php';
class CardTest extends PHPUnit_Framework_TestCase {
    public function setup() {
        $this->card = new Card("H", 1);
    }

    public function test_card() {
        $this->assertEquals("H", $this->card->get_suit());
        $this->assertEquals(1, $this->card->get_rank());
        $this->assertEquals("A❤️", (string)$this->card);
    }
}
?>
