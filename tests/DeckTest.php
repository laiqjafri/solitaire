<?php
include 'Autoloader.php';
class DeckTest extends PHPUnit_Framework_TestCase {
    public function setup() {
        $this->deck = new Deck(false); //unshuffled deck
    }

    public function test_deck() {
        $this->assertEquals(52, $this->deck->length());
        $c = $this->deck->get_next_card();
        $this->assertEquals("S", $c->get_suit());
        $this->assertEquals(13,  $c->get_rank());
        $c = $this->deck->get_next_card();
        $this->assertEquals("S", $c->get_suit());
        $this->assertEquals(12,  $c->get_rank());
        $this->deck->shuffle();
        $this->assertEquals(50, $this->deck->length());
    }
}
?>
