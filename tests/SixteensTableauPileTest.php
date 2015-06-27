<?php
include 'Autoloader.php';
class SixteensTableauPileTest extends PHPUnit_Framework_TestCase {
    public function setup() {
        $this->pile = new SixteensTableauPile();
        $this->pile->show_user_message = false;
    }

    public function test_card_donation() {
        $this->assertEquals(true, $this->pile->can_donate_card_to(new FoundationPile()));
        $this->assertEquals(true, $this->pile->can_donate_card_to(new SpecialTableauPile()));
    }

    public function test_name() {
        $this->assertEquals("SixteensTableauPile", $this->pile->pile_name());
    }

    public function test_card_addtion() {
        $this->assertEquals(true, $this->pile->is_empty());
        $this->assertEquals(false, $this->pile->add_card(new Card("H", 1))); //Cannot add card to an empty SixteensTableauPile
        $this->pile->deal_card(new Card("S", 5));
        $this->assertEquals(false, $this->pile->is_empty());
        $top_card = $this->pile->get_top_card();
        $this->assertEquals(5, $top_card->get_rank());
        $this->assertEquals("S", $top_card->get_suit());
        $this->assertEquals(1, count($this->pile->get_cards()));
        $this->pile->remove_card();
        $this->assertEquals(0, count($this->pile->get_cards()));
        $this->assertEquals(true, $this->pile->add_card(new Card("H", 13)));
        $this->assertEquals(false, $this->pile->add_card(new Card("H", 12)));//Cannot add same suit card
        $this->assertEquals(false, $this->pile->add_card(new Card("D", 12)));//Cannot add same color card
        $this->assertEquals(true, $this->pile->add_card(new Card("S", 12)));
        $this->assertEquals(true, $this->pile->add_card(new Card("H", 11)));
        $this->assertEquals(3, count($this->pile->get_cards()));
        $this->assertEquals(false, $this->pile->add_card(new Card("S", 10)));//Cannot add more than 3 cards
    }
}
?>
