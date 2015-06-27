<?php
include 'Autoloader.php';
class SpecialTableauPileTest extends PHPUnit_Framework_TestCase {
    public function setup() {
        $this->pile = new SpecialTableauPile();
        $this->pile->show_user_message = false;
    }

    public function test_card_donation() {
        $this->assertEquals(true, $this->pile->can_donate_card_to(new FoundationPile()));
        $this->assertEquals(true, $this->pile->can_donate_card_to(new SpecialTableauPile()));
        $this->assertEquals(true, $this->pile->can_donate_card_to(new SixteensTableauPile()));
    }

    public function test_name() {
        $this->assertEquals("SpecialTableauPile", $this->pile->pile_name());
    }

    public function test_card_addtion() {
        $this->assertEquals(true, $this->pile->is_empty());
        $this->assertEquals(true, $this->pile->add_card(new Card("H", 1)));
        $this->assertEquals(false, $this->pile->is_empty());
        $top_card = $this->pile->get_top_card();
        $this->assertEquals(1, $top_card->get_rank());
        $this->assertEquals("H", $top_card->get_suit());
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
