<?php
include 'Autoloader.php';
class StockPileTest extends PHPUnit_Framework_TestCase {
    public function setup() {
        $this->pile = new StockPile();
        $this->pile->show_user_message = false;
    }

    public function test_card_donation() {
        $this->assertEquals(false, $this->pile->can_donate_card_to(new StockPile(), false));
        $this->assertEquals(false, $this->pile->can_donate_card_to(new FortyThievesTableauPile(), false));
        $this->assertEquals(true, $this->pile->can_donate_card_to(new DiscardPile(), false));
    }

    public function test_name() {
        $this->assertEquals("StockPile", $this->pile->pile_name());
    }

    public function test_card_addtion() {
        $this->assertEquals(true, $this->pile->is_empty());
        $this->assertEquals(false, $this->pile->add_card(new Card("H", 1))); //Cannot add card to a stock pile
        $this->assertEquals(true, $this->pile->is_empty());
        $top_card = $this->pile->get_top_card();
        $this->assertEquals(null, $top_card);
        $this->pile->deal_card(new Card("H", 1));
        $top_card = $this->pile->get_top_card();
        $this->assertEquals(1, $top_card->get_rank());
        $this->assertEquals("H", $top_card->get_suit());
        $this->pile->deal_card(new Card("C", 10));
        $this->assertEquals(2, count($this->pile->get_cards()));
        $this->pile->remove_card();
        $this->assertEquals(1, count($this->pile->get_cards()));
    }
}
?>
