<?php
include 'Autoloader.php';
class FortyThievesTableauPileTest extends PHPUnit_Framework_TestCase {
    public function setup() {
        $this->pile = new FortyThievesTableauPile();
        $this->pile->show_user_message = false;
    }

    public function test_card_donation() {
        $this->assertEquals(false, $this->pile->can_donate_card_to(new StockPile(), false));
        $this->assertEquals(false, $this->pile->can_donate_card_to(new DiscardPile(), false));
        $this->assertEquals(true, $this->pile->can_donate_card_to(new FortyThievesTableauPile(), false));
        $this->assertEquals(true, $this->pile->can_donate_card_to(new FoundationPile(), false));
    }

    public function test_name() {
        $this->assertEquals("FortyThievesTableauPile", $this->pile->pile_name());
    }

    public function test_card_addtion() {
        $this->assertEquals(true, $this->pile->is_empty());
        $this->assertEquals(true, $this->pile->add_card(new Card("S", 10), false));
        $this->assertEquals(false, $this->pile->is_empty());
        $this->assertEquals(false, $this->pile->add_card(new Card("H", 1), false)); //Can only add 9 of S here
        $this->assertEquals(false, $this->pile->add_card(new Card("H", 9), false)); //Can only add 9 of S here
        $this->assertEquals(true, $this->pile->add_card(new Card("S", 9), false));
        $top_card = $this->pile->get_top_card();
        $this->assertEquals(9, $top_card->get_rank());
        $this->assertEquals("S", $top_card->get_suit());
        $this->assertEquals(2, count($this->pile->get_cards()));
        $this->pile->remove_card();
        $this->assertEquals(1, count($this->pile->get_cards()));
    }
}
?>
