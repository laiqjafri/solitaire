<?php
include 'Autoloader.php';
class DiscardPileTest extends PHPUnit_Framework_TestCase {
    public function setup() {
        $this->pile = new DiscardPile();
        $this->pile->show_user_message = false;
    }

    public function test_card_donation() {
        $this->assertEquals(false, $this->pile->can_donate_card_to(new StockPile()));
        $this->assertEquals(true, $this->pile->can_donate_card_to(new FortyThievesTableauPile()));
    }

    public function test_name() {
        $this->assertEquals("DiscardPile", $this->pile->pile_name());
    }

    public function test_card_addtion() {
        $this->assertEquals(true, $this->pile->is_empty());
        $this->assertEquals(true, $this->pile->add_card(new Card("H", 1)));
        $this->assertEquals(true, $this->pile->add_card(new Card("S", 13)));
        $this->assertEquals(false, $this->pile->is_empty());
        $top_card = $this->pile->get_top_card();
        $this->assertEquals(13, $top_card->get_rank());
        $this->assertEquals("S", $top_card->get_suit());
        $this->assertEquals(2, count($this->pile->get_cards()));
        $this->pile->remove_card();
        $this->assertEquals(1, count($this->pile->get_cards()));
    }
}
?>
